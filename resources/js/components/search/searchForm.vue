<template>
  <section>
    <!-- <h2>ابحث عن مجموعتك الان</h2> -->
    <form class="search-form">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="country">{{ translate('lang.country') }}</label>
            <select
              class="form-control select2"
              id="country"
              :title="translate('lang.country')"
              v-model="searchData.country_id"
              @change="fetchStatesByCountry"
            >
              <option disabled selected value>{{ translate('lang.country') }}</option>
              <option
                v-for="country in countries"
                :key="country.id"
                :value="country.id"
              >{{ country.name }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="state">{{ translate('lang.states') }}</label>
            <select
              class="form-control"
              id="state"
              :title="translate('lang.states')"
              v-model="searchData.state_id"
            >
              <option disabled selected value>{{ translate('lang.states') }}</option>
              <option v-for="state in states" :key="state.id" :value="state.id">{{ state.name }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="address">{{ translate('lang.searchByAddress') }}</label>
            <input
              v-model="searchData.address"
              class="form-control"
              id="address"
              :placeholder="translate('lang.searchByAddress')"
              title="search input"
              type="text"
            />
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label for="city">{{ translate('lang.searchByCity') }}</label>
            <input
              v-model="searchData.city"
              class="form-control"
              id="city"
              :placeholder="translate('lang.searchByCity')"
              title="search input"
              type="text"
            />
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label for="name">{{ translate('lang.searchByName') }}</label>
            <input
              v-model="searchData.name"
              class="form-control"
              id="name"
              :placeholder="translate('lang.searchByName')"
              title="search input"
              type="text"
            />
          </div>
        </div>

        <div class="col-md-12 my-3">
          <div class="form-group">
            <label class="mb-3">{{ translate('lang.searchByLocation') }}</label>

            <GmapMap :center="position" :zoom="5" style="height: 400px" @click="getLatLng">
              <GmapMarker :animation="2" :position="position" />
            </GmapMap>
          </div>
        </div>
      </div>
      <div class="btn-con mt-3">
        <button class="btn" @click.prevent="search()" type="button">
          <i class="fas fa-search"></i>
          بحث
        </button>
      </div>
    </form>
  </section>
</template>

<script>
export default {
  props: {
    countries: {
      type: Array,
      require: true
    }
  },
  data() {
    return {
      searchData: {
        name: "",
        address: "",
        city: "",
        lat: "",
        lng: "",
        country_id: "",
        state_id: ""
      },
      position: {
        lat: 23.8859,
        lng: 45.0792
      },
      states: []
    };
  },
  methods: {
    getLatLng(event) {
      // Get Lat and Long
      var lat = event.latLng.lat();
      var lng = event.latLng.lng();

      this.position.lat = this.searchData.lat = lat;
      this.position.lng = this.searchData.lng = lng;

      console.log(lat, lng);
    },
    // Search for groups with searchData
    search() {
      axios
        .get("/groups/searchResults", {
          params: {
            name: this.searchData.name,
            address: this.searchData.address,
            city: this.searchData.city,
            lat: this.searchData.lat,
            lng: this.searchData.lng,
            country_id: this.searchData.country_id,
            state_id: this.searchData.state_id
          }
        })
        .then(({ data }) => {
          console.log(...data.data);
          this.$emit("update-results", ...data.data);
        })
        .catch(error => {});
    },

    // Get States for specifiec country
    fetchStatesByCountry() {
      axios
        .get("/fetchStatesByCountry/" + this.searchData.country_id)
        .then(({ data }) => {
          console.log(data);
          this.states = data;
        })
        .catch(error => {});
    }
  }
};
</script>
