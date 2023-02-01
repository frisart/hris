<template>
  <div>
    <q-page>
      <div class="q-pa-md row items-start q-gutter-md">
        <q-card class="col-md-6">
          <q-form @submit="onSubmit" class="q-gutter-md">
            <q-input v-model="id" type="hidden" />
            <q-card-section>
              <q-input
                v-model="name"
                label="Job GRade *"
                hint="Name Job Grade"
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
                lazy-rules
                :rules="[
                  (val) =>
                    (val !== null && val !== '') || 'Please type your age',
                  (val) =>
                    (val > 0 && val < 1000000) || 'Please type a real age',
                ]"
              />

              <q-toggle v-model="accept" label="Active" />

              <div>
                <q-btn label="Submit" type="submit" color="primary" />
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
    <router-view></router-view>
  </div>
</template>


<script>
import { api } from "boot/axios";

export default {
  name: "edit-job-grade",
  data() {
    return {
      id: "",
      name: "",
      order: "",
      accept: true,
    };
  },
  created() {
    this.gejobLevel();
  },
  methods: {
    async gejobLevel() {
      let url = `api/jobgrade/${this.$route.params.id}`;
      await api.get(url).then((response) => {
        this.id = response.data.id_job_level;
        this.name = response.data.name;
        this.order = response.data.order;
        this.accept = response.data.active;

        // console.log("test : "+this.perkiraan.no);
      });
    },
    async onSubmit() {
      let url = `api/jobgrade/update/${this.$route.params.id}`;
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
            this.$router.push({ name: "jobgrade" });
          } else {
            console.log("error");
          }
        });
    },
  },
};
</script>