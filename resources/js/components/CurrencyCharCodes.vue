<template>
  <div class="dropdown">
    <button
      class="btn btn-secondary dropdown-toggle"
      type="button"
      id="dropdownMenuButton"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
    >
      {{ charCode ? `Base currency ${charCode}` : "Select Base currency" }}
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a
        v-for="obj in currencyCharCodes"
        :key="obj"
        :class="{ active: obj === charCode }"
        @click.prevent="select(obj)"
        class="dropdown-item"
        href="#"
        >{{ obj }}</a
      >
    </div>
  </div>
</template>

<script>
export default {
  props: {
    charCode: String || null,
  },

  data: () => ({
    currencyCharCodes: null,
  }),

  methods: {
    select(charCode) {
      this.$emit("selectedCharCode", charCode);
    },
  },

  async mounted() {
    const {
      data: { data },
    } = await axios.get("/api/currency-char-codes");

    this.currencyCharCodes = data;
  },
};
</script>
