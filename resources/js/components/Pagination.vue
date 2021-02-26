<template>
  <div>
    <div v-if="list === null" class="d-flex justify-content-center">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <div v-else-if="!list.length" class="d-flex justify-content-center">
      <div>
        <span>Not Found</span>
      </div>
    </div>
    <div v-else>
      <slot></slot>
      <ul v-if="lastPage > 1" class="pagination">
        <li
          class="page-item"
          v-for="link in links"
          :key="link.label"
          :class="{ active: link.active }"
        >
          <a class="page-link" :href="link.url" @click.prevent="go(link.url)">
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
    list: Array || null,
    links: Array,
    lastPage: Number,
  },

  methods: {
    go(url) {
      this.$emit("go", url);
    },
  },
};
</script>
