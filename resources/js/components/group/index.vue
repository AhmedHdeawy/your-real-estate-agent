<template>
  <div>
    <!-- Description and Stories -->
    <div class="row">
      <!-- Group Description -->
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="group-description">
          <h2>{{ name }}</h2>
          <p>{{ description }}</p>
        </div>
      </div>
      <div class="col-lg-8 col-md-10 mx-auto">
        <!-- <story></story> -->
      </div>
    </div>

    <!-- Posts and Create post -->
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <!-- New Post -->
        <new-post :unique-name="group.unique_name" @update-posts="updatePosts"></new-post>

        <!-- Posts -->
        <div class="posts-con mt-3">
          <post v-for="post in posts.data" :key="post.id" :post-data="post" @delete-post="deletePost"></post>

          <infinite-loading @infinite="infiniteHandler" spinner="circles">
            <div slot="no-more">{{ translate('lang.noMorePosts') }}</div>
            <div slot="no-results">{{ translate('lang.noPosts') }}</div>
          </infinite-loading>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import story from "./story";
import post from "./posts/post";
import NewPost from "./posts/NewPost";
import InfiniteLoading from "vue-infinite-loading";

export default {
  components: {
    story,
    post,
    NewPost,
    InfiniteLoading
  },
  props: {
    group: {
      type: Object,
      require: true
    },
    groupPosts: {
      type: Object,
      require: true
    }
  },
  data() {
    return {
      id: this.group.id,
      name: this.group.name,
      unique_name: this.group.unique_name,
      description: this.group.description,
      image: this.group.image,
      members: this.group.members,
      posts: this.groupPosts,
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
            title: this.translate('lang.titleSucess')
          });
        })
        .catch(error => {});
    },

    //   Handle Infinte Scroll to Load more posts and append it to posts array
    infiniteHandler($state) {
      axios
        .get(`${this.unique_name}/posts`, {
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
