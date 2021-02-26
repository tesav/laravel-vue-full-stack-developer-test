<template>
  <div>
    <date-range @updateDateRange="updateDates" />

    <pagination
      :list="dailyRates"
      :links="links"
      :lastPage="lastPage"
      @go="loadPage"
    >
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Day</th>
            <th>Rate</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="rate in dailyRates" :key="rate.id">
            <td>{{ rate.date }}</td>
            <td>{{ rate.rate }}</td>
          </tr>
        </tbody>
      </table>
    </pagination>
  </div>
</template>

<script>
import moment from "moment";
import DateRange from "./DateRange";

export default {
  components: { DateRange },

  props: {
    perPage: Number,
    charCode: String,
  },

  data: () => ({
    dateRange: {
      startDate: moment().format("YYYY-MM-DD"),
      endDate: moment().format("YYYY-MM-DD"),
    },
    dailyRates: null,
    links: null,
    lastPage: null,
    currentUrl: null,
  }),

  watch: {
    dateRange() {
      this.dailyRates = null;
      this.loadPage();
    },
    charCode() {
      this.dailyRates = null;
      this.loadPage();
    },
    perPage() {
      this.dailyRates = null;
      this.loadPage();
    },
  },

  methods: {
    async loadPage(url = "?page=1") {
      if (this.dailyRates === null || (url && this.currentUrl !== url)) {
        this.currentUrl = url;

        const aQuery = [
          `per_page=${this.perPage}`,
          `dt_from=${this.dateRange.startDate}`,
          `dt_to=${this.dateRange.endDate}`,
        ];

        const {
          data: { data, meta },
        } = await axios.get(
          `/api/currency-history/${this.charCode}/${url}&${aQuery.join("&")}`
        );

        this.dailyRates = data;
        this.links = meta.links;
        this.lastPage = meta.last_page;
      }
    },
    updateDates(range) {
      this.dateRange = range;
    },
  },

  async mounted() {
    this.loadPage();
  },
};
</script>
