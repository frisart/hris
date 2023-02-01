<template>
  <div>
    <q-select
      v-model="model"
      use-input
      input-debounce="0"
      label="Job Grade"
      :options="filterOption"
      @filter="filterFn"
      behavior="menu"
      emit-value
      options-dense
      dense
    >
      <template v-slot:no-option>
        <q-item>
          <q-item-section class="text-grey"> No results </q-item-section>
        </q-item>
      </template>
    </q-select>
  </div>
</template>


<script>
import { api } from "boot/axios";

export default {
  name: "select-option-job-title",
  data() {
    return {
      model: null,
      options: null,
      filterOption: [],
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    filterFn(val, update) {
      if (val === "") {
        update(() => {
          //   this.options = stringOptions;
          this.filterOption = this.options;
        });
        return;
      }

      update(() => {
        const needle = val.toLowerCase();
        this.filterOption = this.options.filter((option) => {
          return option.label.toLowerCase().includes(needle);
        });
      });
    },
    async getData() {
      await api.get("api/jobgrade/option-data").then((response) => {
        console.log(response);
        // alert(response.status);
        if (response.data.code == 200) {
          console.log(response.data.data);
          this.options = response.data.data;
        } else {
          console.log("error");
          this.$q.notify({
            color: "info",
            message: response.data.info,
            icon: "ion-close",
          });
        }
      });
    },
  },
};
</script>