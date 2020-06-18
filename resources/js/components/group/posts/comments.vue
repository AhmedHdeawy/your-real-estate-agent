<template>
  <section>
    <!-- Comments -->
    <div class="post-comments">

        <!-- Imput to add new comment -->
      <div class="comment-input">
        <div class="form-group">
          <input
            class="form-control"
            :placeholder="translate('lang.writeComment')"
            title="comment input"
            type="text"
            v-model="commentText"
            @keyup.enter="saveComment"
          />
          <div class="input-group-append">
            <button class="btn" @click="saveComment">
              <i class="far fa-paper-plane"></i>
            </button>
          </div>
        </div>
      </div>

        <!-- Clickable to view some comments -->
      <p
        v-if="!comments.length && commentsCount"
        @click="fetchComments"
        style="cursor: pointer"
      >
        <span class="font-weight-bold">{{ translate('lang.viewComments') }}</span>
      </p>

      <!-- Show  Comments -->
      <div v-if="comments.length > 0">
        <comment v-for="comment in comments" :key="comment.id" :comment="comment"></comment>

        <p
          v-if="commentsCount != comments.length"
          class="mb-4"
          @click="fetchComments"
          style="cursor: pointer"
        >
          <span class="font-weight-bold">{{ translate('lang.viewMore') }}</span>
        </p>
      </div>
      <div v-if="loadComments" class="row justify-content-center align-content-center my-3">
        <clip-loader
          class="custom-class"
          :color="loader.color"
          :loading="loadComments"
          :size="loader.size"
        ></clip-loader>
      </div>
    </div>
  </section>
</template>

<script>
import comment from "./comment";
import { ClipLoader } from "@saeris/vue-spinners";

/**
 * v-confirm="{ok: deletePost, message: 'User will be given admin privileges. Make user an Admin?'}"
 */

export default {
  components: {
    comment,
    ClipLoader
  },
  props: {
    post: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      unique_name: this.post.group.unique_name,
      comments: [],
      commentsCount: this.post.comments_count,
      commentText: "",
      commentPage: 1,
      loadComments: false,
      loader: {
        color: "#6E67A0",
        size: 50
      }
    };
  },
  methods: {
    fetchComments() {
      this.loadComments = true;

      // Call Serer
      axios
        .get(`${BASE_URL}/posts/fetchComments`, {
          params: {
            id: this.post.unique_id,
            page: this.commentPage
          }
        })
        .then(({ data }) => {
          // add new comments to exist comments
          this.comments.push(...data.data);

          // Remove duplicated comments
          this.comments = _.uniqBy(this.comments, "id");
          // increment Page
          this.commentPage++;
          //   Stop Loader
          this.loadComments = false;
        })
        .catch(error => {});
    },

    saveComment() {
      this.commentsCount++;
      const text = this.commentText;
      this.commentText = "";

      // Call Server
      axios
        .post(`${BASE_URL}/posts/commentPost`, {
          id: this.post.unique_id,
          text
        })
        .then(({ data }) => {
          this.comments.unshift(data.comment);
          this.$emit("update-commentsCount", data.count);
        })
        .catch(error => {});
    }
  }
};
</script>
