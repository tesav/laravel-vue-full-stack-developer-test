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
      Per Page {{ num }}
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a
        v-for="n in numbers"
        :key="n"
        :class="{ active: n === num }"
        @click.prevent="select(n)"
        class="dropdown-item"
        href="#"
        >{{ n }}</a
      >
    </div>
  </div>
</template>

<script>
export default {
  props: {
    num: Number,
  },

  data: () => ({
    numbers: [5, 10, 20, 50],
  }),

  methods: {
    select(num) {
      this.$emit("selectedPerPage", num);
    },
  },
};
</script>
