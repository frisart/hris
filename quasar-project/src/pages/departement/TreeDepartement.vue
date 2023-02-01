<template>
  <div>
    <div class="q-pa-md">
      <q-card class="my-card">
        <q-card-section>
          <div class="row col-12 col-sm-6">
            <template v-if="(indextree = status)">
              <div>
                <q-btn
                  color="blue-7"
                  label="Add Data"
                  to="departement/form-input-departement"
                />
                <q-btn
                  class="q-ml-sm"
                  color="teal-7"
                  label="Edit Data"
                  @click="edit"
                />
                <q-btn
                  class="q-ml-sm"
                  color="red-7"
                  label="Remove Data"
                  @click="confirm"
                />
              </div>
            </template>
            <template v-else>
              <div>
                <q-btn
                  class="q-ml-sm"
                  color="red-7"
                  label="Check"
                  @click="chose"
                />
              </div>
            </template>

            <q-space />

            <q-input
              borderless
              dense
              debounce="300"
              color="primary"
              placeholder="Search"
              v-model="filter"
              ref="filterRef"
              filled
            >
              <template v-slot:append>
                <q-icon
                  v-if="filter !== ''"
                  name="clear"
                  class="cursor-pointer"
                  @click="resetFilter"
                />
                <q-icon name="search" />
              </template>
            </q-input>
          </div>

          <q-tree
            class="col-12 col-sm-6"
            ref="tree"
            :nodes="simple"
            v-model:ticked="ticked"
            node-key="id"
            :tick-strategy="tickStrategy"
            v-model:expanded="expanded"
            :filter="filter"
            default-expand-all
          />

          <div class="col-12 col-sm-6">
            <!-- <q-option-group v-model="tickStrategy" :options="tickStrategies" /> -->

            <div class="text-h6 q-mt-md">{{ status }}</div>

            <div>
              <div v-for="tick in ticked" :key="`ticked-${tick}`">
                {{ tick }}
              </div>
            </div>
          </div>
        </q-card-section>
      </q-card>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import { api } from "boot/axios";
import { useRouter } from "vue-router";
import { useQuasar } from "quasar";

export default {
  name: "tree-departement",
  props: {
    status: {
      type: Boolean,
      default: true,
    },
  },
  setup(props, context) {
    const simple = ref([]);
    const filter = ref("");
    const modals = ref(false);
    const indextree = ref(true);
    const ticked = ref([]);
    const testes = ref("");
    const router = useRouter();
    const $q = useQuasar();

    const fetcDogs = () => {
      api.get("api/departement").then((response) => {
        console.log(response.data.data);
        simple.value = response.data.data;
      });
    };

    onMounted(() => {
      fetcDogs();
      // indextree = true;
    });
    // fetcDogs();

    const edit = () => {
      const id = ticked.value[0];
      // alert(id);
      router.push({
        path: "departement/form-edit-departement/" + id,
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
          deleted();
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

    const deleted = async () => {
      const id = ticked.value[0];

      await api.delete("api/departement/delete/" + id).then((response) => {
        console.log(response.data.code);

        if (response.data.code == 200) {
          $q.notify({
            color: "positive",
            message: "Delete Succes",
            icon: "ion-close",
          });
          fetcDogs();
          // router.push({ name: "departement" });
        } else {
          console.log("error");
        }
      });
    };

    return {
      confirm,
      deleted,
      edit,
      ticked,
      tickStrategy: ref("strict"),
      expanded: ref([53]),
      simple,
      filter,
      modals,
      indextree,
      resetFilter() {
        filter.value = "";
        filterRef.value.focus();
      },
      chose() {
        context.emit("close");
        const id = ticked.value[0];
        context.emit("test", id);
      },
    };
  },
};
</script>