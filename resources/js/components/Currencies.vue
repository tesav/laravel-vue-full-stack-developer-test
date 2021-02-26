<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <div v-if="baseCurrencyCharCode" class="mb-2">
              <button @click="setBaseCurrencyCharCode(null)">Back</button>
              Currency {{ baseCurrencyCharCode }}
            </div>
            <div v-else>Currencies</div>
            <div>
              <per-page
                class="float-left"
                @selectedPerPage="setPerPage"
                :num="perPage"
              />
              <currency-char-codes
                class="float-left"
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
import PerPage from "./PerPage.vue";
import CurrencyCharCodes from "./CurrencyCharCodes.vue";
import CurrenciesList from "./CurrenciesList.vue";
import CurrencyHistory from "./CurrencyHistory.vue";

export default {
  components: {
    PerPage,
    CurrencyCharCodes,
    CurrenciesList,
    CurrencyHistory,
  },

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
