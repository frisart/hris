<template>
  <div>
    <q-page>
      <div class="q-pa-md row">
        <q-card class="full-width">
          <q-form class="q-gutter-md" @submit="onSubmit" @reset="onReset">
            <q-card-section>
              <div class="row">
                <q-input v-model="id" type="hidden" id="id" />
                <q-input v-model="parentid" type="hidden" id="parentid" />
                <q-input
                  class="col-md-6 q-pr-md"
                  v-model="name"
                  label="Name"
                  hint="Name "
                  lazy-rules
                  :rules="[
                    (val) => (val && val.length > 0) || 'Please type something',
                  ]"
                  :dense="true"
                />

                <q-input
                  class="col-md-6"
                  type="number"
                  v-model="order"
                  label="Order *"
                  hint="Order"
                  lazy-rules
                  :dense="true"
                  :rules="[
                    (val) =>
                      (val !== null && val !== '') || 'Please type your age',
                    (val) => (val > 0 && val < 100) || 'Please type a real age',
                  ]"
                />
              </div>

              <div class="row">
                <q-input
                  class="col-md-6"
                  v-model="parent"
                  label="Parent"
                  hint="Parent"
                  lazy-rules
                  :dense="true"
                >
                  <template v-slot:append>
                    <q-btn round dense flat icon="add" @click="showModal" />
                  </template>
                </q-input>
                <q-toggle v-model="accept" label="Active" />
              </div>

              <div>
                <q-btn label="Submit" type="submit" color="primary" />
                <q-btn
                  label="Reset"
                  type="reset"
                  color="primary"
                  flat
                  class="q-ml-sm"
                />
              </div>
            </q-card-section>

            <!-- <q-card-actions>
              <q-btn flat>Action 1</q-btn>
              <q-btn flat>Action 2</q-btn>
            </q-card-actions> -->
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
  </div>
</template>

<script>
// import mediumModal from "../modal/mediumModal.vue";
import TreeDepartement from "../departement/TreeDepartement.vue";
import { api } from "boot/axios";

export default {
  components: { TreeDepartement },
  name: "form-departement",
  data() {
    return {
      dense: true,
      modalMedium: false,
      id: "",
      parentid: "",
      name: "",
      parent: "",
      order: "",
      status: false,
      accept: true,
    };
  },
  methods: {
    async onSubmit() {
      await api
        .post("api/departement/save", {
          name: this.name,
          order: this.order,
          active: this.accept,
          parent: this.parentid,
        })
        .then((response) => {
          if (response.status == 200) {
            this.$q.notify({
              color: "positive",
              message: response.data.message,
              icon: "ion-close",
            });

            this.$router.push({ name: "departement" });
          } else {
            console.log("error");
          }
        });
    },
    async onReset() {},
    updateParent(id) {
      api.get("api/departement/" + id).then((response) => {
        console.log(response.data.data.name);
        // context.emit("test", "AAA");
        this.parent = response.data.data.name;
        this.parentid = response.data.data.ID_departement;
      });
    },
    showModal() {
      this.modalMedium = true;
      this.status = false;
      // console.log(this.modalMedium);
    },
  },
};
</script>