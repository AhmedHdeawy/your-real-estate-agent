<template>
  <div class="home-page mt-5">
    <div class="container search-box">
      <div class="search-results">
        <div class="row justify-content-start">
          <h2 class="mt-5 mb-2">{{ translate('lang.nearestGroups') }}</h2>
        </div>

        <div class="row mt-4">
          <group v-bind:for-home="true" v-for="group in groups" :key="group.id" :group="group"></group>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import result from "./search/result";
export default {
  components: {
    group: result
  },
  props: {
    groups: {
      type: Array,
      require: true
    }
  }
};
</script>
