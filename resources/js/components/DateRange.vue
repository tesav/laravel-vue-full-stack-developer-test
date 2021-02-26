<template>
  <div>
    <input type="date" v-model="startDate" for />
    <input type="date" v-model="endDate" />
  </div>
</template>

<script>
import moment from "moment";

export default {
  props: {},

  data: () => ({
    startDate: moment().format("YYYY-MM-DD"),
    endDate: moment().format("YYYY-MM-DD"),
  }),

  watch: {
    startDate() {
      if (this.validRange()) {
        this.updateDates();
      }
    },
    endDate() {
      if (this.validRange()) {
        this.updateDates();
      }
    },
  },

  methods: {
    updateDates() {
      this.$emit("updateDateRange", {
        startDate: moment(this.startDate).format("YYYY-MM-DD"),
        endDate: moment(this.endDate).format("YYYY-MM-DD"),
      });
    },
    validRange() {
      return (
        moment(this.startDate).isValid() &&
        moment(this.endDate).isValid() &&
        moment(this.startDate) <= moment(this.endDate)
      );
    },
  },
};
</script>
