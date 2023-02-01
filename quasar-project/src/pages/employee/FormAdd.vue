<template>
  <div>
    <q-page>
      <div class="q-pa-md row">
        <q-card class="full-width">
          <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
            <q-card-section>
              <template v-if="sbtnSave">
                <div class="q-pr-md q-gutter-sm">
                  <q-btn label="Save" type="submit" color="primary" size="sm" />
                  <q-btn label="Discard" color="primary" size="sm" to="/bank" />
                </div>
              </template>

              <div class="row">
                <div class="col-md-6 q-pr-md">
                  <q-input
                    type="number"
                    class="col-md-12 q-pt-none"
                    dense
                    v-model="empno"
                    label="No Employee *"
                    lazy-rules
                    :rules="[
                      (val) =>
                        (val !== null && val !== '') ||
                        'Please type your number',
                      (val) =>
                        (val > 0 && val < 100) || 'Please type a real number',
                    ]"
                  />
                  <q-input
                    type="number"
                    dense
                    class="col-md-12 q-pt-none"
                    v-model="empno"
                    label="NIK *"
                    lazy-rules
                    :rules="[
                      (val) =>
                        (val !== null && val !== '') ||
                        'Please type your number',
                      (val) =>
                        (val > 0 && val < 100) || 'Please type a real number',
                    ]"
                  />

                  <q-input
                    v-model="name"
                    dense
                    label="Name *"
                    lazy-rules
                    :rules="[
                      (val) =>
                        (val && val.length > 0) || 'Please type something',
                    ]"
                  />
                  <q-input v-model="parent" label="Departement *" dense>
                    <template v-slot:append>
                      <q-btn round dense flat icon="add" @click="showModal" />
                    </template>
                  </q-input>
                  <div class="q-pt-md">
                    <job-title />
                  </div>
                  <div class="q-pt-md">
                    <job-level />
                  </div>
                  <div class="q-pt-md">
                    <job-grade />
                  </div>
                  <q-input
                    dense
                    type="email"
                    v-model="email"
                    label="Email *"
                    lazy-rules
                    :rules="[
                      (val) =>
                        (val && val.length > 0) || 'Please type something',
                    ]"
                  />

                  <q-input
                    dense
                    v-model="parentid"
                    id="parentid"
                    style="display: none"
                  />

                  <!-- <q-input
                    type="number"
                    dense
                    v-model="order"
                    label="Order *"
                    lazy-rules
                    :rules="[
                      (val) =>
                        (val !== null && val !== '') ||
                        'Please type your number',
                      (val) =>
                        (val > 0 && val < 100) || 'Please type a real number',
                    ]"
                  /> -->

                  <q-toggle v-model="accept" label="Active" val="sm" />
                </div>
              </div>
            </q-card-section>
          </q-form>
        </q-card>
      </div>
    </q-page>
    <q-dialog v-model="modalMedium">
      <!-- <tree-departement/> -->
      <q-card style="width: 700px; max-width: 80vw">
        <q-card-section>
          <div class="text-h6">Medium</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <tree-departement
            :status="status"
            @close="modalMedium = false"
            @test="updateParent"
          />
        </q-card-section>
      </q-card>
    </q-dialog>
    <router-view></router-view>
  </div>
</template>


<script>
import { ref } from "vue";
import { api } from "boot/axios";
import { useRouter } from "vue-router";
import { useQuasar } from "quasar";
import TreeDepartement from "../departement/TreeDepartement.vue";
import JobLevel from "../joblevel/SelectOption.vue";
import JobTitle from "../jobtitle/SelectOption.vue";
import JobGrade from "../jobgrade/SelectOption.vue";

export default {
  components: { TreeDepartement, JobLevel, JobTitle, JobGrade },
  setup() {
    const name = ref(null);
    const empno = ref(null);
    const email = ref(null);
    const order = ref(null);
    const accept = ref(true);
    const router = useRouter();
    const $q = useQuasar();
    const sbtnSave = ref(true);
    const modalMedium = ref(false);
    const status = ref(false);
    const parentid = ref(null);
    const parent = ref(null);

    return {
      model: ref(null),
      parentid,
      empno,
      email,
      modalMedium,
      status,
      name,
      order,
      parent,
      accept,
      sbtnSave,
      updateParent(id) {
        api.get("api/departement/" + id).then((response) => {
          console.log(response.data.data.name);
          // context.emit("test", "AAA");
          parent.value = response.data.data.name;
          parentid.value = response.data.data.ID_departement;
        });
      },
      showModal() {
        modalMedium.value = true;
        status.value = false;
        // console.log(this.modalMedium);
      },
      async onSubmit() {
        await api
          .post("api/employee/save", {
            name: name.value,
            order: order.value,
            active: accept.value,
          })
          .then((response) => {
            console.log(response);
            // alert(response.status);
            if (response.data.code == 200) {
              $q.notify({
                color: "positive",
                message: "Success Insert Data",
                icon: "ion-close",
              });

              router.push({ path: "/employee" });
            } else {
              console.log("error");
              $q.notify({
                color: "info",
                message: response.data.info,
                icon: "ion-close",
              });
            }
          });
      },

      onReset() {
        name.value = null;
        order.value = null;
        accept.value = false;
      },
    };
  },
};
</script>