<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <div class="float-left" v-if="baseCurrencyCharCode">
              <button @click="setBaseCurrencyCharCode(null)">Back</button>
              Currency {{ baseCurrencyCharCode }}
            </div>
            <div class="float-left" v-else>Currencies</div>
            <div class="float-right">
              <per-page @selectedPerPage="setPerPage" :num="perPage" />
              <currency-char-codes
                @selectedCharCode="setBaseCurrencyCharCode"
                :charCode="baseCurrencyCharCode"
              />
            </div>
          </div>
          <div v-if="baseCurrencyCharCode" class="card-body">
            <currency-history
              :perPage="perPage"
              :charCode="baseCurrencyCharCode"
            />
          </div>
          <div v-else class="card-body">
            <currencies-list :perPage="perPage" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    perPage: 5,
    baseCurrencyCharCode: null,
  }),

  methods: {
    setPerPage(num) {
      this.perPage = num;
    },
    setBaseCurrencyCharCode(сharCode) {
      this.baseCurrencyCharCode = сharCode;
    },
  },

  async mounted() {
    console.log("Component mounted.");
  },
};
</script>
