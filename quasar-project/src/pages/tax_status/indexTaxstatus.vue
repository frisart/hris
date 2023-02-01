<template>
  <div>
    <!-- <q-card> INI HALAMAN Title </q-card> -->
    <tbl-taxstatus />
  </div>
</template>

<script>
import { api } from "../../boot/axios";
// import { defineComponent } from "@vue/composition-api";

import TblTaxstatus from "../tax_status/TblTaxstatus.vue";

export default {
  name: "index-taxstatus",
  components: { TblTaxstatus },
};
</script>
