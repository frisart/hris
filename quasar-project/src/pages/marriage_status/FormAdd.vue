<template>
  <div>
    <q-page>
      <div class="q-pa-md row">
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
                    to="/marriage-status"
                  />
                </div>
              </template>

              <div class="row">
                <div class="col-md-12 q-pr-md">
                  <q-input
                    dense
                    v-model="name"
                    label="Name *"
                    hint="Name"
                    lazy-rules
                    :rules="[
                      (val) =>
                        (val && val.length > 0) || 'Please type something',
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
                        (val !== null && val !== '') ||
                        'Please type your number',
                      (val) =>
                        (val > 0 && val < 100) || 'Please type a real number',
                    ]"
                  />

                  <q-toggle v-model="accept" label="Active" val="sm" />
                </div>
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
          .post("api/marriage-status/save", {
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

              router.push({ path: "/marriage-status" });
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