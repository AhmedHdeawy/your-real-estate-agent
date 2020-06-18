<template>
  <div v-if="!loading" class="home-page mt-5">
    <div class="container search-box">
      <div class="search-results">
        <!-- <div class="row justify-content-start">
          <h2 class="mt-5 mb-2">{{ translate('lang.nearestGroups') }}</h2>
        </div> -->
        <div class="row mt-4">
          <group v-bind:for-home="true" v-for="group in groups" :key="group.id" :group="group"></group>
        </div>
      </div>
    </div>
  </div>
  <div v-else>
    <section v-if="!resultExist">
      <div class="text-center">{{ translate('lang.nearestGroupsSearching') }}</div>
      <div class="text-center d-flex justify-content-center align-items-center">
        <bar-loader
          class="custom-class"
          :color="loader.color"
          :width="loader.width"
          :height="loader.height"
        ></bar-loader>
      </div>
    </section>
  </div>
</template>

<script>
import result from "./search/result";
import { BarLoader } from "@saeris/vue-spinners";
export default {
  components: {
    group: result,
    BarLoader
  },
  data() {
    return {
      groups: [],
      loading: true,
      resultExist: false,
      loader: {
        color: "#6E67A0",
        width: 300,
        height: 6
      }
    };
  },
  created() {
    this.handelUserLocation();
    this.fetchNearestGroups(28.8114573, 30.907292799999997);
  },
  methods: {
    handelUserLocation() {
      // Get Local Component Variable
      var self = this;
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          function(pos) {
            self.fetchNearestGroups(pos.coords.latitude, pos.coords.longitude);
          },
          function() {}
        );
      } else {
        // Browser doesn't support Geolocation
        alert(self.translate("lang.doesnotSupportGeolocation"));
      }
    },

    fetchNearestGroups(lat, lng) {
      axios
        .get("/groups/fetchNearestGroups", {
          params: {
            lat,
            lng
          }
        })
        .then(({ data }) => {
            if (data.length > 0) {
                this.groups = data;
                this.loading = false;
            } else {
                this.resultExist = true;
            }
        })
        .catch(error => {});
    }
  }
};
</script>
