<template>
  <div>
    <!-- <q-card> INI HALAMAN Title </q-card> -->
    <tbl-employee />
  </div>
</template>

<script>
import { api } from "../../boot/axios";
// import { defineComponent } from "@vue/composition-api";

import TblEmployee from "../employee/TblEmployee.vue";

export default {
  name: "index-bank",
  components: { TblEmployee },
};
</script>
