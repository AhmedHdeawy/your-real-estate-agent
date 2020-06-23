<template>
  <section>
    <div v-if="!result">
      <!-- <h2>ابحث عن مجموعتك الان</h2> -->
      <section v-if="!searchByMap" class="search-form">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="text">{{ translate('lang.search') }}</label>
              <input
                v-model="searchData.text"
                class="form-control"
                id="text"
                :placeholder="translate('lang.searchPlaceholder')"
                title="search input"
                type="text"
                @keyup.enter="search"
              />
            </div>

            <div class="col-md-12 my-5">
              <div class="form-group">
                <label class="mb-3">{{ translate('lang.searchByLocation') }}</label>

                <GmapMap
                  ref="mapRef"
                  :center="position"
                  :zoom="8"
                  :options="{
                    zoomControl: false,
                    mapTypeControl: false,
                    streetViewControl: false,
                    gestureHandling: 'greedy'
                }"
                  style="height: 400px"
                  @click="getLatLng"
                >
                  <GmapMarker :animation="2" :position="position" />
                </GmapMap>
              </div>
            </div>
          </div>

          <!-- <div class="col-md-4">
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
          </div>-->

          <!-- <div class="col-12">
            <div class="btn-con mt-3" :class="getLocaleLang == 'ar' ? 'text-right' : 'text-left'">
              <button class="btn" @click="toggleSearchForm" type="button">
                <i class="fas fa-map-marker-alt"></i>
                {{ translate('lang.searchByMap') }}
              </button>
            </div>
          </div> -->
        </div>
        <div class="btn-con mt-3">
          <button class="btn" @click.prevent="search()" type="button">
            <i class="fas fa-search"></i>
            {{ translate('lang.search') }}
          </button>
        </div>
      </section>

      <section v-else class="search-form">
        <div class="row">
          <div class="col-12 justify-content-start">
            <div class="btn-con mt-3" :class="getLocaleLang == 'ar' ? 'text-right' : 'text-left'">
              <button class="btn" @click="toggleSearchForm" type="button">
                <i class="fas fa-info-circle"></i>
                {{ translate('lang.searchByInfo') }}
              </button>
            </div>
          </div>

          <div class="col-md-12 my-3">
            <div class="form-group">
              <label class="mb-3">{{ translate('lang.searchByLocation') }}</label>

              <GmapMap
                ref="mapRef"
                :center="position"
                :zoom="8"
                :options="{
                    zoomControl: false,
                    mapTypeControl: false,
                    streetViewControl: false,
                    gestureHandling: 'greedy'
                }"
                style="height: 400px"
                @click="getLatLng"
              >
                <GmapMarker :animation="2" :position="position" />
              </GmapMap>
            </div>
          </div>
        </div>
        <div class="btn-con mt-3">
          <button class="btn" @click.prevent="search()" type="button">
            <i class="fas fa-search"></i>
            {{ translate('lang.search') }}
          </button>
        </div>
      </section>
    </div>

    <div v-else class="row justify-content-center align-content-center my-3">
      <bounce-loader class="custom-class" :color="loader.color" :size="loader.size"></bounce-loader>
      <div class="col-12 text-center">{{ translate('lang.searching') }} ...</div>
    </div>
  </section>
</template>

<script>
import { BounceLoader } from "@saeris/vue-spinners";

export default {
  components: {
    BounceLoader
  },
  props: {
    countries: {
      type: Array,
      require: true
    }
  },
  data() {
    return {
      searchData: {
        text: "",
        name: "",
        address: "",
        city: "",
        lat: "",
        lng: "",
        country_id: "",
        state_id: ""
      },
      position: {
        lat: 24.715869226220885,
        lng: 46.66797131445571
      },
      states: [],
      searchByMap: false,
      result: false,
      loader: {
        color: "#6E67A0",
        size: 100
      }
    };
  },
  created() {
    this.handelUserLocation();
  },
  computed: {
    getLocaleLang: function() {
      return localeLang;
    }
  },
  methods: {
    getLatLng(event) {
      // Get Lat and Long
      var lat = event.latLng.lat();
      var lng = event.latLng.lng();

      this.position.lat = this.searchData.lat = lat;
      this.position.lng = this.searchData.lng = lng;
    },
    // Search for groups with searchData
    search() {
      this.result = true;
      axios
        .get("/groups/searchResults", {
          params: {
            text: this.searchData.text,
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
          this.$emit("update-results", data);
          this.result = false;
        })
        .catch(error => {});
    },

    toggleSearchForm() {
      this.searchByMap = !this.searchByMap;
      this.searchData.name = "";
      this.searchData.address = "";
      this.searchData.city = "";
      this.searchData.lat = "";
      this.searchData.lng = "";
      this.searchData.country_id = "";
      this.searchData.state_id = "";
    },

    // Get States for specifiec country
    fetchStatesByCountry() {
      axios
        .get("/fetchStatesByCountry/" + this.searchData.country_id)
        .then(({ data }) => {
          this.states = data;
        })
        .catch(error => {});
    },
    handelUserLocation() {
      // Get Local Component Variable
      var self = this;
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          function(pos) {
            var userLocation = {
              lat: pos.coords.latitude,
              lng: pos.coords.longitude
            };
            // Override init Position by User Location
            self.position = userLocation;
          },
          function() {}
        );
      } else {
        // Browser doesn't support Geolocation
        alert(self.translate("lang.doesnotSupportGeolocation"));
      }
    }
  }
};
</script>
