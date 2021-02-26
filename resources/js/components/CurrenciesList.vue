<template>
  <pagination
    :list="currencies"
    :links="links"
    :lastPage="lastPage"
    @go="loadPage"
  >
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Nominal</th>
          <th>Rate</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="currency in currencies" :key="currency.id">
          <td>{{ currency.name }}</td>
          <td>{{ currency.nominal }}</td>
          <td>{{ currency.rate }}</td>
        </tr>
      </tbody>
    </table>
  </pagination>
</template>

<script>
export default {
  props: {
    perPage: Number,
  },

  data: () => ({
    currencies: null,
    links: null,
    lastPage: null,
    currentUrl: null,
  }),

  watch: {
    perPage(newVal, oldVal) {
      this.currencies = null;
      this.loadPage();
    },
  },

  methods: {
    async loadPage(url = "?page=1") {
      if (this.currencies === null || (url && this.currentUrl !== url)) {
        this.currentUrl = url;
        const {
          data: { data, meta },
        } = await axios.get(`/api/currency${url}&per_page=${this.perPage}`);

        this.currencies = data;
        this.links = meta.links;
        this.lastPage = meta.last_page;
      }
    },
  },

  async mounted() {
    this.loadPage();
  },
};
</script>
