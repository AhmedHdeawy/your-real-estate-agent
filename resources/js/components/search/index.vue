<template>
  <div class="search-box">

    <searchForm :countries="countries" @update-results="updateResuts"></searchForm>

    <div v-if="groups">
      <result v-for="group in groups" :key="group.id" :group="group"></result>
    </div>

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
      page: 2
    };
  },
  mounted() {
    console.log("hii");
  },
  methods: {
    // Add New Post to the data
    updateResuts(groups) {
      this.groups = groups;
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
