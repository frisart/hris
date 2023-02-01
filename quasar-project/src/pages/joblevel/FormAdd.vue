<template>
  <div>
    <q-page>
      <div class="q-pa-md row items-start q-gutter-md">
        <q-card class="col-md-6">
          <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
            <q-card-section>
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
              <q-input
                dense
                v-model="name"
                label="Job Title *"
                hint="Name Job Title"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Please type something',
                ]"
              />

              <q-input
                type="number"
                dense
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

              <q-toggle v-model="accept" label="Active" val="sm" />

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
    const sbtnSave = ref(true);

    return {
      name,
      order,
      accept,
      sbtnSave,

      async onSubmit() {
        await api
          .post("api/joblevel/save", {
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

              router.push({ path: "/joblevel" });
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