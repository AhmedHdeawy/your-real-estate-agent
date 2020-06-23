<template>
  <div class="search-box">
    <searchForm :countries="countries" @update-results="updateResuts"></searchForm>
    <div id="showSearchResult">
      <div v-if="groups">
        <div class="search-results">
          <h2 class="my-4">{{ translate('lang.searchResult') }}</h2>
          <div class="row">
            <result v-for="group in groups" :key="group.id" :group="group"></result>
          </div>
        </div>
      </div>
    </div>
    <div v-if="resultFound" class="row">{{ translate('lang.noResultsFound') }}</div>
  </div>
</template>

<script>
import searchForm from "./searchForm";
import result from "./result";
import InfiniteLoading from "vue-infinite-loading";

export default {
  components: {
    searchForm,
    result,
    InfiniteLoading
  },
  props: {
    countries: {
      type: Array,
      require: true
    }
  },
  data() {
    return {
      groups: [],
      page: 2,
      resultFound: false
    };
  },
  methods: {
    // Add New Post to the data
    updateResuts(groups) {
      this.resultFound = groups.length > 0 ? false : true;
      this.groups = groups;

        // Scroll to results
      $([document.documentElement, document.body]).animate(
        { scrollTop: $("#showSearchResult").offset().top },
        500
      );
    },

    //   Handle Infinte Scroll to Load more posts and append it to posts array
    infiniteHandler($state) {
      axios
        .post(`/groups/search`, {
          data: searchData
        })
        .then(({ data }) => {
          if (data.data.length) {
            this.page += 1;
            this.groups.data.push(...data.data);
            $state.loaded();
          } else {
            $state.complete();
          }
        });
    }
  }
};
</script>
