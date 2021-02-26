<template>
  <date-range-picker
    ref="picker"
    :locale="locale"
    :opens="opens"
    :locale-data="{ firstDay: 1, format: 'DD-MM-YYYY' }"
    :minDate="minDate"
    :maxDate="maxDate"
    :timePicker="false"
    :timePicker24Hour="false"
    :showWeekNumbers="false"
    :showDropdowns="true"
    :autoApply="false"
    v-model="dateRange"
    @update="updateDates"
    @toggle="checkOpen"
    :linkedCalendars="linkedCalendars"
    :dateFormat="dateFormat"
  >
    <template v-slot:input="picker" style="min-width: 350px">
      {{ picker.startDate | date }} - {{ picker.endDate | date }}
    </template>
  </date-range-picker>
</template>

<script>
import moment from "moment";
import DateRangePicker from "vue2-daterange-picker";

export default {
  components: { DateRangePicker },

  props: {
    startDate: String || Object || null,
    endDate: String || Object || null,
    updateDates: Function,
  },

  data: (instance) => ({
    locale: {
      direction: "ltr",
      format: "mm/dd/yyyy",
      separator: " - ",
      applyLabel: "Apply",
      cancelLabel: "Cancel",
      weekLabel: "W",
      customRangeLabel: "Custom Range",
      daysOfWeek: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      monthNames: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ],
      firstDay: 0,
    },
    linkedCalendars: null,
    singleDatePicker: "range",
    opens: "center",
    minDate: null,
    maxDate: null,
    dateRange: {
      startDate: instance.startDate,
      endDate: instance.endDate,
    },
  }),

  methods: {
    checkOpen() {},
    dateFormat(classes, date) {
      return date ? moment(date).format("DD-MM-YYYY") : "";
    },
  },

  filters: {
    date(date) {
      return date ? moment(date).format("DD-MM-YYYY") : "";
    },
  },
};
</script>

<style lang="css" scoped>
@import "~vue2-daterange-picker/dist/vue2-daterange-picker.css";
</style>  