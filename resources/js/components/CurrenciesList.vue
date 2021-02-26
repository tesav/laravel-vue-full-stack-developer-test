<template>
  <div>
    <div v-if="currencies === null" class="d-flex justify-content-center">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <div v-else-if="!currencies.length" class="d-flex justify-content-center">
      <div>
        <span>Not Found</span>
      </div>
    </div>
    <div v-else>
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
      <ul v-if="lastPage > 1" class="pagination">
        <li
          class="page-item"
          v-for="link in links"
          :key="link.label"
          :class="{ active: link.active }"
        >
          <a
            class="page-link"
            :href="link.url"
            @click.prevent="loadPage(link.url)"
          >
            <span v-html="link.label"></span>
          </a>
        </li>
      </ul>
    </div>
  </div>
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
    currentUrl: false,
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
