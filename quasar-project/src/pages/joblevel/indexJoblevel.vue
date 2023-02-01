<template>
  <div>
    <!-- <q-card> INI HALAMAN Title </q-card> -->
    <tbl-joblevel />
  </div>
</template>

<script>
import { api } from "../../boot/axios";
// import { defineComponent } from "@vue/composition-api";

import TblJoblevel from "../joblevel/TblJoblevel.vue";

export default {
  name: "index-job-title",
  components: { TblJoblevel },
};
</script>
