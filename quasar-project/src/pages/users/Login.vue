<template>
  <q-page
    class="window-height window-width row justify-center items-center"
    style="
      background-image: url('assets/businessman-blurred-background-with-people-connection-icon-business-leadership-chart.jpg');
      background-position: center; /* Center the image */
      background-repeat: no-repeat; /* Do not repeat the image */
      background-size: cover; /* Resize the background image to cover the entire container */
    "
  >
    <div class="column q-pa-lg">
      <div class="row">
        <q-card square class="shadow-24" style="width: 400px; height: 485px">
          <q-card-section class="bg-teal-7">
            <h4 class="text-h5 text-white q-my-md text-center">HRIS</h4>
            <div
              class="absolute-bottom-right q-pr-md"
              style="transform: translateY(50%)"
            >
              <!-- <q-btn fab icon="add" color="purple-4" /> -->
            </div>
          </q-card-section>
          <q-card-section>
            <q-form class="q-px-sm q-pt-xl q-gutter-md" @submit="onSubmit">
              <q-input
                filled
                v-model="FomrDatas.email"
                label="Email *"
                type="email"
                hint="Email"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Please type something',
                ]"
              />
              <q-input
                v-model="FomrDatas.password"
                filled
                label="Password *"
                :type="isPwd ? 'password' : 'text'"
                hint="Password with toggle"
                lazy-rules
                :rules="[
                  (val) => (val && val.length > 0) || 'Please type something',
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

              <q-card-actions class="q-pl-none q-pr-none">
                <q-btn
                  unelevated
                  size="lg"
                  class="full-width text-white"
                  color="teal-8"
                  label="Sign In"
                  type="submit"
                />
              </q-card-actions>
            </q-form>
          </q-card-section>

          <!-- <q-card-section class="text-center q-pa-sm">
            <p class="text-grey-6">Forgot your password?</p>
          </q-card-section> -->
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
// import router from "src/router";
import setAuthHeader from "../../utilitie/setAuthHeader";
import { mapActions } from "vuex";
import { api } from "../../boot/axios";

// const router = useRouter();

export default {
  name: "user-login",

  data() {
    return {
      FomrDatas: {
        email: "",
        password: "",
      },
      isPwd: true,
    };
  },
  methods: {
    ...mapActions("auth", ["doLogin"]),

    async onSubmit() {
      await this.doLogin(this.FomrDatas);

      this.$router.push({ path: "/dashboard" });
    },
  },
};
</script>
