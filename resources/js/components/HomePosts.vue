<template>
  <div>
    <div class="row justify-content-center">
      <h5 class="mb-2 color-rbzgo mb-3">{{ translate('lang.posts') }}</h5>
    </div>
    <!-- Posts and Create post -->
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <!-- Posts -->
        <div class="posts-con mt-3">
          <post
            v-for="post in posts.data"
            :key="post.id"
            :post-data="post"
            @delete-post="deletePost"
          ></post>

          <infinite-loading @infinite="infiniteHandler" spinner="circles">
            <div slot="no-more"></div>
            <div slot="no-results"></div>
          </infinite-loading>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import post from "./group/posts/post";
import InfiniteLoading from "vue-infinite-loading";

export default {
  components: {
    post,
    InfiniteLoading
  },
  props: {
    postsData: {
      type: Object,
      require: true
    }
  },
  data() {
    return {
      posts: this.postsData,
      page: 2
    };
  },
  methods: {
    // Add New Post to the data
    updatePosts(post) {
      this.posts.data.unshift(post);
    },

    // Delete the Post from the data
    deletePost(post) {
      axios
        .post(`${BASE_URL}/posts/deletePost`, {
          id: post.unique_id
        })
        .then(data => {
          //   console.log(data);
          //   _.remove(this.posts.data, el => el.id == id);
          this.posts.data.splice(this.posts.data.indexOf(post), 1);

          // Show sweet alert
          toast.fire({
            icon: "success",
            title: this.translate("lang.titleSucess")
          });
        })
        .catch(error => {});
    },

    //   Handle Infinte Scroll to Load more posts and append it to posts array
    infiniteHandler($state) {
      axios
        .get(`${BASE_URL}/posts/homePosts`, {
          params: {
            page: this.page
          }
        })
        .then(({ data }) => {
          if (data.data.length) {
            this.page += 1;
            this.posts.data.push(...data.data);
            $state.loaded();
          } else {
            $state.complete();
          }
        });
    }
  }
};
</script>
