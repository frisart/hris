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
                  <q-btn
                    label="Discard"
                    color="primary"
                    size="sm"
                    to="/client"
                  />
                </div>
              </template>

              <div class="row">
                <div class="col-md-6 q-pr-md">
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
                    dense
                    v-model="email"
                    label="Email *"
                    hint="Email"
                    lazy-rules
                    :rules="[
                      (val) =>
                        (val && val.length > 0) || 'Please type something',
                    ]"
                  />
                  <q-input
                    dense
                    v-model="password"
                    label="Password *"
                    :type="isPwd ? 'password' : 'text'"
                    hint="Password with toggle"
                    lazy-rules
                    :rules="[
                      (val) =>
                        (val && val.length > 0) || 'Please type something',
                    ]"
                  >
                    <template v-slot:append>
                      <q-icon
                        :name="isPwd ? 'visibility_off' : 'visibility'"
                        class="cursor-pointer"
                        @click="isPwd = !isPwd"
                      />
                    </template>
                  </q-input>
                </div>

                <div class="col-md-6 q-pr-md">
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
                  <q-input
                    dense
                    type="textarea"
                    v-model="address"
                    label="Address *"
                    hint="Address"
                    rows="1"
                    lazy-rules
                    :rules="[
                      (val) =>
                        (val && val.length > 0) || 'Please type something',
                    ]"
                  />
                  <q-toggle v-model="accept" label="Active" val="sm" />
                </div>
              </div>

              <!-- <div>
                <q-btn label="Submit" type="submit" color="primary" />
                <q-btn
                  label="Reset"
                  type="reset"
                  color="primary"
                  flat
                  class="q-ml-sm"
                />
              </div> -->
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
    const email = ref(null);
    const password = ref(null);
    const address = ref(null);
    const order = ref(null);
    const accept = ref(true);
    const router = useRouter();
    const isPwd = ref(true);
    const $q = useQuasar();
    const sbtnSave = ref(true);

    return {
      isPwd,
      name,
      email,
      password,
      order,
      accept,
      address,
      sbtnSave,

      async onSubmit() {
        await api
          .post("api/client/register", {
            name: name.value,
            email: email.value,
            password: password.value,
            password: password.value,
            address: address.value,
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

              router.push({ path: "/client" });
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