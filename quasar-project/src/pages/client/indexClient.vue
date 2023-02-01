<template>
  <div>
    <!-- <q-card> INI HALAMAN Title </q-card> -->
    <tbl-client />
  </div>
</template>

<script>
import { api } from "../../boot/axios";
// import { defineComponent } from "@vue/composition-api";

import TblClient from "../client/TblClient.vue";

export default {
  name: "index-client",
  components: { TblClient },
};
</script>
