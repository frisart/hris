<template>
  <q-layout view="lHh Lpr lFf">
    <q-header class="bg-white text-blue-grey-6">
      <q-toolbar>
        <q-btn dense flat round icon="menu" @click="left = !left" />

        <q-toolbar-title></q-toolbar-title>
        <q-btn flat round dense icon="person" style="font-size: 20px">
          <q-menu>
            <div class="row no-wrap q-pa-lg">
              <div class="column">
                <q-item-label class="text-h6">User</q-item-label>
                <q-linear-progress
                  class="q-mb-lg"
                  :value="100"
                  color="grey-4"
                  style="height: 2px"
                />
                <div class="items-center">
                  <div class="text-bold items-center">13421054</div>
                  <div>Dwi Romadon</div>
                </div>
              </div>

              <q-separator vertical inset class="q-mx-lg"></q-separator>

              <div class="column items-center">
                <q-btn flat round dense>
                  <q-avatar size="72px">
                    <img src="https://placeimg.com/500/300/nature" />
                  </q-avatar>
                </q-btn>

                <div class="text-subtitle1 q-mt-md q-mb-xs"></div>
                <div class="text-subtitle1 q-mt-md q-mb-xs"></div>
                <div class="text-subtitle1 q-mt-md q-mb-xs"></div>
                <q-btn
                  color="teal"
                  label="Keluar"
                  unelevated
                  size="sm"
                  v-close-popup
                  @click="logout"
                >
                  <q-tooltip>Keluar disini..</q-tooltip>
                </q-btn>
              </div>
            </div>
          </q-menu>
        </q-btn>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="left"
      :breakpoint="500"
      show-if-above
      content-class="bg-white text-teal-10"
    >
      <q-scroll-area class="fit">
        <q-list>
          <q-item style="height: 50px" class="bg-white text-bold">
            <q-item-section> Aplikasi HRIS </q-item-section>
          </q-item>
          <q-item class="justify-center text-center q-mb-md q-pt-md">
            <div>
              <q-avatar size="100px" class="q-mb-md">
                <img src="https://placeimg.com/500/300/nature" alt="" />
              </q-avatar>
              <div class="text-weight-bold">13421054</div>
              <div>Dwi Romadon</div>
            </div>
          </q-item>

          <q-expansion-item expand-separator icon="folder" label="Master">
            <q-card>
              <q-card-section>
                <q-item
                  clickable
                  active-class="active"
                  exact
                  v-ripple
                  to="users"
                >
                  <q-item-section avatar>
                    <q-icon name="manage_accounts" />
                  </q-item-section>
                  <q-item-section> User </q-item-section>
                </q-item>
                <q-item
                  clickable
                  active-class="active"
                  exact
                  v-ripple
                  to="/joblevel"
                >
                  <q-item-section avatar>
                    <q-icon name="work" />
                  </q-item-section>
                  <q-item-section> Job Level </q-item-section>
                </q-item>
                <q-item
                  clickable
                  active-class="active"
                  exact
                  v-ripple
                  to="/jobgrade"
                >
                  <q-item-section avatar>
                    <q-icon name="grade" />
                  </q-item-section>
                  <q-item-section> Job Grade </q-item-section>
                </q-item>
                <q-item
                  clickable
                  active-class="active"
                  exact
                  v-ripple
                  to="/jobtitle"
                >
                  <q-item-section avatar>
                    <q-icon name="title" />
                  </q-item-section>
                  <q-item-section> Job Title </q-item-section>
                </q-item>
                <q-item
                  clickable
                  active-class="active"
                  exact
                  v-ripple
                  to="/departement"
                >
                  <q-item-section avatar>
                    <q-icon name="group" />
                  </q-item-section>
                  <q-item-section> Departement </q-item-section>
                </q-item>
                <q-item
                  clickable
                  active-class="active"
                  exact
                  v-ripple
                  to="/client"
                >
                  <q-item-section avatar>
                    <q-icon name="person_3" />
                  </q-item-section>
                  <q-item-section> Client </q-item-section>
                </q-item>
                <q-item
                  clickable
                  active-class="active"
                  exact
                  v-ripple
                  to="/religi"
                >
                  <q-item-section avatar>
                    <q-icon name="church" />
                  </q-item-section>
                  <q-item-section> Religi </q-item-section>
                </q-item>
                <q-item
                  clickable
                  active-class="active"
                  exact
                  v-ripple
                  to="/tax-status"
                >
                  <q-item-section avatar>
                    <q-icon name="fa-solid fa-money-check-dollar" />
                  </q-item-section>
                  <q-item-section> Tax Status </q-item-section>
                </q-item>
                <q-item
                  clickable
                  active-class="active"
                  exact
                  v-ripple
                  to="/marriage-status"
                >
                  <q-item-section avatar>
                    <q-icon name="fa-solid fa-ring" />
                  </q-item-section>
                  <q-item-section> Marriage Status </q-item-section>
                </q-item>
                <q-item
                  clickable
                  active-class="active"
                  exact
                  v-ripple
                  to="/blood-type"
                >
                  <q-item-section avatar>
                    <q-icon name="fa-solid fa-stethoscope" />
                  </q-item-section>
                  <q-item-section> Blood Type </q-item-section>
                </q-item>
                <q-item
                  clickable
                  active-class="active"
                  exact
                  v-ripple
                  to="/bank"
                >
                  <q-item-section avatar>
                    <q-icon name="fa-solid fa-building-columns" />
                  </q-item-section>
                  <q-item-section> Bank </q-item-section>
                </q-item>
                <q-item
                  clickable
                  active-class="active"
                  exact
                  v-ripple
                  to="/employee"
                >
                  <q-item-section avatar>
                    <q-icon name="ion-body" />
                  </q-item-section>
                  <q-item-section> Employee </q-item-section>
                </q-item>
              </q-card-section>
            </q-card>
          </q-expansion-item>
        </q-list>
      </q-scroll-area>
    </q-drawer>
    <q-page-container class="bg-grey-2">
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { api } from "../boot/axios";
import { mapGetters } from "vuex";

export default {
  name: "MainLayout",

  data() {
    return {
      left: false,
    };
  },

  methods: {
    // ...mapActions('auth',['signOut']),

    async logout() {
      this.$store.dispatch("auth/signOut");

      this.$router.push({ path: "/auth/login" });
    },
  },
  computed: {
    ...mapGetters("auth", ["isAuthenticated"]),
  },
};
</script>
