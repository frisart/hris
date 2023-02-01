<template>
  <div>
    <!-- <q-card> INI HALAMAN Title </q-card> -->
    <tbl-bank />
  </div>
</template>

<script>
import { api } from "../../boot/axios";
// import { defineComponent } from "@vue/composition-api";

import TblBank from "../bank/TblBank.vue";

export default {
  name: "index-bank",
  components: { TblBank },
};
</script>
