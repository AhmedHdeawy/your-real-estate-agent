<template>
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <!-- Post -->
      <div class="posts-con mt-3">
        <post :post-data="post" v-bind:show-text="true" v-bind:show-less-text="false" @delete-post="deletePost"></post>
      </div>
    </div>
  </div>
</template>

<script>
import post from './post';

export default {
  components: {
    post
  },
  props: {
    post: {
      type: Object,
      require: true
    }
  },
  data() {
    return {
      unique_name: this.post.group.unique_name
    };
  },
  methods: {
    // Delete the Post from the data
    deletePost(post) {
      axios
        .post(`${BASE_URL}/posts/deletePost`, {
          id: post.id
        })
        .then(data => {
          // Redirect to Home Page
        })
        .catch(error => {});
    }
  }
};
</script>
