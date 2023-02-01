<template>
  <div>
    <div class="q-pa-md">
      <q-page>
        <div class="full-width">
          <tree-departement />
        </div>
      </q-page>
    </div>
  </div>
</template>

<script>
import TreeDepartement from "./TreeDepartement.vue";

export default {
  components: { TreeDepartement },
};
</script>