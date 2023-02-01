<template>
  <router-view />
</template>

<script>
import { defineComponent } from "vue";
import { api } from "./boot/axios";

export default defineComponent({
  name: "App",
  beforeCreate() {
    this.$store.dispatch("auth/init");
    // const token = this.$store.getters.getToken;
    const token = localStorage.getItem("token");
    console.log("beforeCreate :" + token);
    if (token) {
      api.defaults.headers.common.Authorization = "Bearer " + token;
    } else {
      api.defaults.headers.common.Authorization = "";
    }
  },
  created() {
    this.$q.dark.set(false);
  },
});
</script>
