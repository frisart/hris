<template>
  <div>
    <!-- <q-card> INI HALAMAN Title </q-card> -->
    <tbl-religi />
  </div>
</template>

<script>
import { api } from "../../boot/axios";
// import { defineComponent } from "@vue/composition-api";

import TblReligi from "../religi/TblReligi.vue";

export default {
  name: "index-religi",
  components: { TblReligi },
};
</script>
