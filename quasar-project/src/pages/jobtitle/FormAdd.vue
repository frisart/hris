<template>
  <div>
    <q-page>
      <div class="q-pa-md row">
        <q-card class="full-width">
          <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
            <q-card-section>
              <div class="row">
                <q-input v-model="parentid" type="hidden" id="parentid" />
                <q-input
                  class="col-md-6 q-pr-md"
                  v-model="name"
                  label="Job Title *"
                  hint="Name Job Title"
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
                <q-toggle :dense="true" v-model="accept" label="Active" />
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
    <router-view></router-view>
  </div>
</template>


<script>
import { ref } from "vue";
import { api } from "boot/axios";
import { useRouter } from "vue-router";
import { useQuasar } from "quasar";
import TreeDepartement from "../departement/TreeDepartement.vue";

export default {
  components: { TreeDepartement },
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
        .post("api/jobtitle/save", {
          name: this.name,
          order: this.order,
          active: this.accept,
          departement: this.parentid,
        })
        .then((response) => {
          if (response.status == 200) {
            this.$q.notify({
              color: "positive",
              message: "Success",
              icon: "ion-close",
            });

            this.$router.push({ name: "jobtitle" });
          } else {
            console.log("error");
          }
        });
    },
    async onReset() {
      this.parentid = "";
      this.name = "";
      this.parent = "";
      this.order = "";
    },
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