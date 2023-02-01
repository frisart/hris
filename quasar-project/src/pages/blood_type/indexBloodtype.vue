<template>
  <div>
    <!-- <q-card> INI HALAMAN Title </q-card> -->
    <tbl-bloodtype />
  </div>
</template>

<script>
import { api } from "../../boot/axios";
// import { defineComponent } from "@vue/composition-api";

import TblBloodtype from "../blood_type/TblBloodtype.vue";

export default {
  name: "index-bloodtype",
  components: { TblBloodtype },
};
</script>
