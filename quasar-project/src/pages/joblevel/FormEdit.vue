<template>
  <div>
    <q-page>
      <div class="q-pa-md row items-start q-gutter-md">
        <q-card class="col-md-6">
          <q-form @submit="onSubmit" class="q-gutter-md">
            <q-card-section>
              <template v-if="sbtnEdit">
                <div class="q-pr-md q-gutter-sm">
                  <q-btn
                    size="sm"
                    label="Edit"
                    type="button"
                    color="primary"
                    @click="editData"
                  />
                  <q-btn
                    label="Discard"
                    color="primary"
                    size="sm"
                    to="/joblevel"
                  />
                </div>
              </template>
              <template v-if="sbtnSave">
                <div class="q-pr-md q-gutter-sm">
                  <q-btn label="Save" type="submit" color="primary" size="sm" />
                  <q-btn
                    label="Discard"
                    color="primary"
                    size="sm"
                    to="/joblevel"
                  />
                </div>
              </template>
              <q-input v-model="id" type="hidden" />

              <q-input
                v-model="name"
                label="Job Title *"
                hint="Name Job Title"
                dense
                :readonly="editInput"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Please type something',
                ]"
              />

              <q-input
                type="number"
                v-model="order"
                label="Order *"
                hint="Order"
                dense
                :readonly="editInput"
                lazy-rules
                :rules="[
                  (val) =>
                    (val !== null && val !== '') || 'Please type your age',
                  (val) =>
                    (val > 0 && val < 1000000) || 'Please type a real age',
                ]"
              />

              <q-toggle
                v-model="accept"
                label="Active"
                val="md"
                :disable="editInput"
              />
            </q-card-section>

            <!-- <q-card-actions>
              <q-btn flat>Action 1</q-btn>
              <q-btn flat>Action 2</q-btn>
            </q-card-actions> -->
          </q-form>
        </q-card>
      </div>
    </q-page>
    <router-view></router-view>
  </div>
</template>


<script>
import { api } from "boot/axios";

export default {
  name: "edit-job-level",
  data() {
    return {
      id: "",
      name: "",
      order: "",
      accept: true,
      editInput: true,
      sbtnEdit: true,
      sbtnSave: false,
    };
  },
  created() {
    this.gejobLevel();
  },
  methods: {
    async gejobLevel() {
      let url = `api/joblevel/${this.$route.params.id}`;
      await api.get(url).then((response) => {
        this.id = response.data.id_job_level;
        this.name = response.data.name;
        this.order = response.data.order;
        this.accept = response.data.active;

        // console.log("test : "+this.perkiraan.no);
      });
    },
    async onSubmit() {
      let url = `api/joblevel/update/${this.$route.params.id}`;
      await api
        .put(url, {
          id_job_level: this.id,
          name: this.name,
          order: this.order,
          active: this.accept,
        })
        .then((response) => {
          if (response.status == 200) {
            this.$q.notify({
              color: "positive",
              message: response.data.message,
              icon: "ion-close",
            });
            this.$router.push({ name: "joblevel" });
          } else {
            console.log("error");
          }
        });
    },

    editData() {
      // alert();
      this.sbtnEdit = false;
      this.sbtnSave = true;
      this.editInput = false;
    },
  },
};
</script>