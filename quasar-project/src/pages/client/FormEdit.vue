<template>
  <div>
    <q-page>
      <div class="q-pa-md row">
        <q-card class="full-width">
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
                    to="/client"
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
                    to="/client"
                  />
                </div>
              </template>

              <div class="row">
                <div class="col-md-6 q-pr-md">
                  <!-- <q-input v-model="id" type="hidden" /> -->
                  <q-input
                    dense
                    v-model="name"
                    :readonly="editInput"
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
                    :readonly="editInput"
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
                    :readonly="editInput"
                    v-model="password"
                    label="Password *"
                    :type="isPwd ? 'password' : 'text'"
                    hint="Password with toggle"
                    lazy-rules
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
                    :readonly="editInput"
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
                    :readonly="editInput"
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

                  <q-toggle
                    :disable="editInput"
                    v-model="accept"
                    label="Active"
                    val="sm"
                  />
                </div>
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
  name: "edit-job-level",
  data() {
    return {
      id: "",
      name: "",
      email: "",
      password: "",
      address: "",
      order: "",
      accept: true,
      editInput: true,
      sbtnEdit: true,
      sbtnSave: false,
      isPwd: true,
    };
  },
  created() {
    this.geDatabyId();
  },
  methods: {
    async geDatabyId() {
      let url = `api/client/${this.$route.params.id}`;
      await api.get(url).then((response) => {
        this.id = response.data.id_client;
        this.name = response.data.name;
        this.email = response.data.email;
        this.address = response.data.address;
        this.order = response.data.order;
        this.accept = response.data.active;

        // console.log("test : "+this.perkiraan.no);
      });
    },
    async onSubmit() {
      let url = `api/client/update/${this.$route.params.id}`;
      await api
        .put(url, {
          id: this.id,
          name: this.name,
          email: this.email,
          password: this.password,
          address: this.address,
          order: this.order,
          active: this.accept,
        })
        .then((response) => {
          if (response.data.code == 200) {
            this.$q.notify({
              color: "positive",
              message: response.data.message,
              icon: "ion-close",
            });
            this.$router.push({ name: "client" });
          } else {
            console.log("error");
            this.$q.notify({
              color: "info",
              message: response.data.info,
              icon: "ion-close",
            });
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