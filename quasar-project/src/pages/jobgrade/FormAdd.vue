<template>
  <div>
    <q-page>
      <div class="q-pa-md row items-start q-gutter-md">
        <q-card class="col-md-6">
          <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
            <q-card-section>
              <q-input
                v-model="name"
                label="Job Grade *"
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
                  (val) => (val > 0 && val < 100) || 'Please type a real age',
                ]"
              />

              <q-toggle v-model="accept" label="Active" />

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
    <router-view></router-view>
  </div>
</template>


<script>
import { ref } from "vue";
import { api } from "boot/axios";
import { useRouter } from "vue-router";
import { useQuasar } from "quasar";

export default {
  setup() {
    const name = ref(null);
    const order = ref(null);
    const accept = ref(true);
    const router = useRouter();
    const $q = useQuasar();

    return {
      name,
      order,
      accept,

      async onSubmit() {
        await api
          .post("api/jobgrade/save", {
            name: name.value,
            order: order.value,
            active: accept.value,
          })
          .then((response) => {
            if (response.status == 200) {
              $q.notify({
                color: "positive",
                message: response.data.message,
                icon: "ion-close",
              });

              router.push({ path: "/jobgrade" });
            } else {
              console.log("error");
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