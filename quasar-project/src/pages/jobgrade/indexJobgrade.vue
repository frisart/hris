<template>
  <div>
    <!-- <q-card> INI HALAMAN Title </q-card> -->
    <tbl-jobgrade />
  </div>
</template>

<script>
import { api } from "../../boot/axios";
// import { defineComponent } from "@vue/composition-api";

import TblJobgrade from "../jobgrade/TblJobgrade.vue";

export default {
  name: "index-job-grade",
  components: { TblJobgrade },
};
</script>
