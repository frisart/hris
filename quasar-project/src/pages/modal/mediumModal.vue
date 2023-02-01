<template>
  <div>
    <q-dialog v-model="modalmedium">
      <q-card style="width: 700px; max-width: 80vw">
        <q-card-section>
          <div class="text-h6">Medium</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <tree-departement />
        </q-card-section>

        <q-card-actions align="right" class="bg-white text-teal">
          <q-btn flat label="OK" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
import TreeDepartement from "../departement/TreeDepartement.vue";
export default {
  components: { TreeDepartement },
  name: "modal-medium",
  props: {
    modalmedium: {
      type: Boolean,
    },
  },
  data() {
    return {
      modalmedium: false,
    };
  },
};
</script>