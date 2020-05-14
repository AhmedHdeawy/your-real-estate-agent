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
        <new-post :unique-name="group.unique_name"></new-post>

        <!-- Posts -->
        <div class="posts-con">
          <h2> {{ translate('lang.discussions') }} </h2>
          <post v-for="post in posts.data" :key="post.id" :post="post"></post>

          <infinite-loading @infinite="infiniteHandler" spinner="circles">
              <div slot="no-more"> {{ translate('lang.noMorePosts') }} </div>
          </infinite-loading>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import story from "./story";
import post from "./posts/post";
import NewPost from './posts/NewPost'
import InfiniteLoading from "vue-infinite-loading";

export default {
  components: {
    story,
    post,
    NewPost,
    InfiniteLoading,
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
      page: 2,
    };
  },
  methods: {
    //   Handle Infinte Scroll to Load more posts and append it to posts array
    infiniteHandler($state) {
      axios
        .get(`${this.group.unique_name}/posts`, {
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
    },
  }
};
</script>
