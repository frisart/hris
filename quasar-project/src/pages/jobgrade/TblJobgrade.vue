<template>
  <div class="q-pa-md">
    <q-page>
      <div class="full-width">
        <q-table
          color="secondary"
          dense
          ref="tableRef"
          :loading="loading"
          :rows="rows"
          :columns="columns"
          v-model:pagination="pagination"
          row-key="name"
          :selected-rows-label="getSelectedString"
          selection="multiple"
          :selected="selected"
          @selection="onSelection"
          @request="onRequest"
          :visible-columns="visibleColumns"
          binary-state-sort
          :filter="filter"
        >
          <template #loading>
            <q-inner-loading showing color="primary" />
          </template>

          <template v-slot:top>
            <q-btn
              color="blue-7"
              :disable="loading"
              label="Add Data"
              to="jobgrade/form-input-grade"
            />
            <q-btn
              class="q-ml-sm"
              color="teal-7"
              :disable="loading"
              label="Edit Data"
              @click="editData"
            />
            <q-btn
              class="q-ml-sm"
              color="red-7"
              :disable="loading"
              label="Remove Data"
              @click="DelData"
            />
            <q-space />
            <q-input
              borderless
              dense
              debounce="300"
              color="primary"
              placeholder="Search"
              v-model="filter"
            >
              <template v-slot:append>
                <q-icon name="search" />
              </template>
            </q-input>
          </template>
        </q-table>
      </div>
      <!-- <div class="q-mt-md">Selected: {{ JSON.stringify(selected) }}</div> -->
    </q-page>
  </div>
</template>

<script>
import { api } from "boot/axios";
import { defineComponent, ref, onMounted } from "vue";
import { useQuasar } from "quasar";
import { useRouter } from "vue-router";

export default defineComponent({
  setup() {
    const $q = useQuasar();
    const loading = ref(true);
    const rows = ref([]);
    const filter = ref("");
    const selected = ref([]);
    const lastIndex = ref(null);
    const tableRef = ref(null);
    const pagination = ref({
      sortBy: "name",
      descending: false,
      page: 1,
      rowsPerPage: 5,
      rowsNumber: 0,
    });
    let idRow = [];
    const router = useRouter();

    const columns = [
      {
        name: "id_job_grade",
        label: "ID",
        field: "id_job_grade",
        align: "left",
        format: (val) => `${val}`,
      },
      {
        name: "desc",
        required: true,
        name: "name",
        label: "Name",
        field: "name",
        align: "left",
        format: (val) => `${val}`,
        sortable: true,
      },
      {
        name: "order",
        label: "Order",
        field: "order",
        align: "left",
        format: (val) => `${val}`,
        sortable: true,
      },
    ];

    const fetcDogs = (page, rowsPerPage, filter, sortBy, descending) => {
      api
        .get("api/jobgrade", {
          params: {
            page: page,
            filter: filter,
            sortBy: sortBy,
            descending: descending ? "desc" : "asc",
            rowsPerPage: rowsPerPage,
          },
        })
        .then((response) => {
          rows.value = response.data.data;
          console.log(response.data.meta);
          const meta = response.data.meta;

          pagination.value.page = meta.current_page;
          pagination.value.rowsPerPage = meta.per_page;
          pagination.value.rowsNumber = meta.total;
          pagination.value.descending = descending;
        })
        .finally(() => {
          loading.value = false;
        });
    };

    const onRequest = (props) => {
      // console.log(props);
      const { page, rowsPerPage, sortBy, descending } = props.pagination;
      const filter = props.filter;

      console.log(sortBy, descending);
      fetcDogs(page, rowsPerPage, filter, sortBy, descending);
    };

    onMounted(() => {
      onRequest({
        pagination,
        filter: undefined,
      });
    });

    return {
      onRequest,
      visibleColumns: ref(["name", "order"]),
      selected,
      pagination,
      loading,
      filter,
      rows,
      columns,
      lastIndex,
      tableRef,
      getSelectedString() {
        console.log(rows.value.length);
        return selected.value.length === 0
          ? ""
          : `${selected.value.length} record${
              selected.value.length > 1 ? "s" : ""
            } selected of ${rows.value.length}`;
      },
      onSelection({ rows, added, evt }) {
        if (rows.length === 0 || tableRef.value === void 0) {
          return;
        }

        const row = rows[0];
        const filteredSortedRows = tableRef.value.filteredSortedRows;
        const rowIndex = filteredSortedRows.indexOf(row);
        const localLastIndex = lastIndex.value;

        lastIndex.value = rowIndex;
        document.getSelection().removeAllRanges();

        if ($q.platform.is.mobile === true) {
          evt = { ctrlKey: true };
        } else if (
          evt !== Object(evt) ||
          (evt.shiftKey !== true && evt.ctrlKey !== true)
        ) {
          selected.value = added === true ? rows : [];
          return;
        }

        const operateSelection =
          added === true
            ? (selRow) => {
                const selectedIndex = selected.value.indexOf(selRow);
                if (selectedIndex === -1) {
                  selected.value = selected.value.concat(selRow);
                }
              }
            : (selRow) => {
                const selectedIndex = selected.value.indexOf(selRow);
                if (selectedIndex > -1) {
                  selected.value = selected.value
                    .slice(0, selectedIndex)
                    .concat(selected.value.slice(selectedIndex + 1));
                }
              };

        if (localLastIndex === null || evt.shiftKey !== true) {
          operateSelection(row);
          return;
        }

        const from = localLastIndex < rowIndex ? localLastIndex : rowIndex;
        const to = localLastIndex < rowIndex ? rowIndex : localLastIndex;
        for (let i = from; i <= to; i += 1) {
          operateSelection(filteredSortedRows[i]);
        }
      },
      async DelData() {
        const obj = JSON.stringify(selected.value);
        var stringify = JSON.parse(obj);
        // console.log(stringify);
        idRow = [];
        for (var i = 0; i < stringify.length; i++) {
          idRow.push(stringify[i]["id_job_grade"]);
        }
        console.log("idRow : " + idRow + " " + obj);

        await api
          .delete("api/jobgrade/delete?id_job_grade=" + idRow)
          .then((response) => {
            loading;
            fetcDogs();
          });
      },

      editData() {
        const obj = JSON.stringify(selected.value);
        var stringify = JSON.parse(obj);
        // console.log(stringify);
        idRow = [];
        for (var i = 0; i < stringify.length; i++) {
          idRow.push(stringify[i]["id_job_grade"]);
        }
        // alert(idRow.length);
        if (idRow.length == 1) {
          router.push({
            path: "jobgrade/form-edit-grade/" + idRow,
          });
        }
      },
    };
  },
});
</script>
