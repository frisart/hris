<template>
  <div>
    <!-- <q-card> INI HALAMAN Title </q-card> -->
    <tbl-marriagestatus />
  </div>
</template>

<script>
import { api } from "../../boot/axios";
// import { defineComponent } from "@vue/composition-api";

import TblMarriagestatus from "../marriage_status/TblMarriagestatus.vue";

export default {
  name: "index-marriagestatus",
  components: { TblMarriagestatus },
};
</script>
