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

          <template v-slot:body-cell-name="props">
            <q-td :props="props">
              <div>
                <router-link
                  :to="{
                    path: 'religi/form-edit-religi/' + props.row.id,
                  }"
                >
                  {{ props.row.name }}
                </router-link>
              </div>
              <!-- <div class="my-table-details">
                {{ props.row.label }}
              </div> -->
            </q-td>
          </template>

          <template v-slot:top>
            <q-btn
              color="blue-7"
              :disable="loading"
              label="Add Data"
              to="religi/form-input-religi"
              size="sm"
            />

            <q-btn
              v-if="showRemove"
              class="q-ml-sm"
              color="red-7"
              :disable="loading"
              label="Remove Data"
              @click="confirm"
              size="sm"
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
    // let idJobLevel = [];
    const router = useRouter();
    const showRemove = ref(false);

    const columns = [
      {
        name: "id",
        label: "ID",
        field: "id",
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
        .get("api/religi", {
          params: {
            page: page,
            filter: filter,
            sortBy: sortBy,
            descending: descending ? "desc" : "asc",
            rowsPerPage: rowsPerPage,
          },
        })
        .then((response) => {
          rows.value = response.data.data.data;
          console.log(response.data.meta);
          // const meta = response.data.meta;

          pagination.value.page = response.data.data.current_page;
          pagination.value.rowsPerPage = response.data.data.per_page;
          pagination.value.rowsNumber = response.data.data.total;
          pagination.value.descending = descending;
        })
        .finally(() => {
          loading.value = false;
        });
    };
    function confirm() {
      $q.dialog({
        // dark: true,
        title: "Confirm",
        message: "Delete Data",
        cancel: true,
        persistent: true,
      })
        .onOk(() => {
          // console.log('>>>> OK')
          DelData();
        })
        .onOk(() => {
          // console.log('>>>> second OK catcher')
        })
        .onCancel(() => {
          // console.log('>>>> Cancel')
        })
        .onDismiss(() => {
          // console.log('I am triggered on both OK and Cancel')
        });
    }

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

    const DelData = async () => {
      const obj = JSON.stringify(selected.value);
      var stringify = JSON.parse(obj);
      console.log(stringify);
      // let idJobLevel = [];

      let id = [];
      for (var i = 0; i < stringify.length; i++) {
        id.push(stringify[i]["id"]);
      }
      console.log("idjob : " + id + " " + obj);

      await api.delete("api/religi/delete?id=" + id).then((response) => {
        loading;
        $q.notify({
          color: "info",
          message: "Delete Seccuss",
          icon: "ion-close",
        });
        fetcDogs();
        showRemove.value = false;
      });
    };

    return {
      confirm,
      showRemove,
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
        // alert();
        // console.log("Count " + rows.length);
        // if (added) {
        //   showRemove.value = true;
        // } else {
        //   showRemove.value = false;
        // }

        if (rows.length === 0 || tableRef.value === void 0) {
          // showRemove.value = false;

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
                  console.log("Count " + selected.value.length);
                  selected.value.length > 0
                    ? (showRemove.value = true)
                    : (showRemove.value = false);
                }
              }
            : (selRow) => {
                const selectedIndex = selected.value.indexOf(selRow);
                if (selectedIndex > -1) {
                  selected.value = selected.value
                    .slice(0, selectedIndex)
                    .concat(selected.value.slice(selectedIndex + 1));
                  console.log("Count Tes " + selected.value.length);
                  selected.value.length == 0
                    ? (showRemove.value = false)
                    : (showRemove.value = true);
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

      // editData() {
      //   const obj = JSON.stringify(selected.value);
      //   var stringify = JSON.parse(obj);
      //   // console.log(stringify);
      //   idJobLevel = [];
      //   for (var i = 0; i < stringify.length; i++) {
      //     idJobLevel.push(stringify[i]["id"]);
      //   }
      //   // alert(idJobLevel.length);
      //   if (idJobLevel.length == 1) {
      //     router.push({
      //       path: "joblevel/form-edit-level/" + idJobLevel,
      //     });
      //   }
      // },
    };
  },
});
</script>

<style>
a:link {
  text-decoration: none;
}
</style>