<template>
  <div class="post">
    <section v-if="!editPost">
      <!-- Post Head -->
      <div class="post-head">
        <div class="row">
          <!-- User Data -->
          <div class="col-auto">
            <div class="user-data">
              <a href="#">
                <img alt="User Image" src="/images/user.png" />
                <span>{{ post.user.name }}</span>
              </a>
              <a href="#">{{ post.created_at | dateFromNow }}</a>
            </div>
          </div>
          <!-- Post Edit -->
          <div class="col-auto">
            <div class="group-data">
              <div class="dropdown">
                <a
                  aria-expanded="false"
                  aria-haspopup="true"
                  class="btn"
                  data-toggle="dropdown"
                  href="#"
                  id="dropdownMenuLink1"
                  role="button"
                >
                  <i class="fas fa-ellipsis-h"></i>
                </a>
                <div aria-labelledby="dropdownMenuLink1" class="dropdown-menu">
                  <a
                    class="dropdown-item"
                    @click.prevent="editPost = true"
                    href="#"
                  >{{ translate('lang.edit') }}</a>
                  <a
                    class="dropdown-item text-danger"
                    @click="deletePost"
                    href="#"
                  >{{ translate('lang.delete') }}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Post Text -->
      <div class="post-content">
        <!-- Show Post Text -->
        <p>{{ post.text }}</p>

        <!-- Handle Post Medi -->
        <section v-if="post.media.length > 0">
          <!-- Show images -->
          <div v-if="mediaImage.length > 0" class="post-imglist row">
            <a
              v-for="media in mediaImage"
              :key="media.id"
              :href="url + '/uploads/posts/' + media.name"
              :data-fancybox="post.id"
              class="fancy-element image-link col-4 col-md-3 px-1 m-md-0 mb-1"
            >
              <img :src="'/uploads/posts/' + media.name" class="img-fluid" />
            </a>
          </div>

          <!-- Show videos -->
          <div v-if="mediaVideo.length > 0" class="mt-4 row post-videolist">
            <a
              v-for="media in mediaVideo"
              :key="media.id"
              :href="url + '/uploads/posts/' + media.name"
              data-width="640"
              data-height="360"
              :data-fancybox="post.id"
              class="fancy-element image-link col-4 col-md-3 px-1 m-md-0 mb-1"
            >
              <img src="/images/video-overlay.jpg" class="img-fluid" />
            </a>
          </div>

          <!-- Show audios -->
          <div v-if="mediaAudio.length > 0" class="mt-4 row post-videolist">
            <audio v-for="media in mediaAudio" :key="media.id" controls>
              <source :src="url + '/uploads/posts/' + media.name" />Your browser does not support the audio element.
            </audio>
          </div>

          <!-- Show files -->
          <div v-if="mediaFile.length > 0" class="mt-4 row post-filelist">
            <a
              v-for="media in mediaFile"
              :key="media.id"
              data-fancybox
              data-type="iframe"
              :data-src="url + '/uploads/posts/' + media.name"
              href="javascript:;"
              class="fancy-element image-link col-4 col-md-3 px-1 m-md-0 mb-1"
            >
              <img src="/images/pdf-overlay.webp" class="img-fluid" />
            </a>
          </div>

          <!-- End Media -->
        </section>

        <hr />
      </div>

      <!-- Posts Likes and Comments Count -->
      <div class="post-interaction">
        <button class="btn like">
          <i class="far fa-thumbs-up"></i>
          <span>{{ likesCount }} {{ translate('lang.like') }}</span>
        </button>
        <button class="btn btn-comment">
          <i class="far fa-comment"></i>
          <span>{{ commentsCount }} {{ translate('lang.comment') }}</span>
        </button>
      </div>

      <!-- Comments -->
      <div class="post-comments">
        <h6>
          <i class="far fa-comments"></i>
          <span>{{ translate('lang.comments') }}</span>
        </h6>

        <!-- Type Comment -->
        <div class="comment-input">
          <div class="form-group">
            <input
              class="form-control"
              :placeholder="translate('lang.writeComment')"
              title="comment input"
              type="text"
            />
            <div class="input-group-append">
              <button class="btn">
                <i class="far fa-paper-plane"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Show  Comments -->
        <!-- <comment v-for="comment in comments" :key="comment.id" :comment="comment"></comment> -->
      </div>
    </section>

    <!-- Edit Posts Component -->
    <edit-post
      v-if="editPost"
      :unique-name="post.group.unique_name"
      :post="post"
      @update-post="updatePost"
    ></edit-post>
  </div>
</template>

<script>
import EditPost from "./EditPost";
import comment from "./comment";
import fancyapps from "@fancyapps/fancybox";
import "@fancyapps/fancybox/dist/jquery.fancybox.min.css";

/**
 * v-confirm="{ok: deletePost, message: 'User will be given admin privileges. Make user an Admin?'}"
 */

export default {
  components: {
    EditPost,
    comment
  },
  props: {
    postData: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      post: this.postData,
      url: window.location.protocol + "//" + window.location.hostname,
      comments: this.postData.comments,
      likesCount: this.postData.likes_count,
      commentsCount: this.postData.comments_count,
      editPost: false
    };
  },
  mounted() {
    $(".fancy-element").fancybox({
      infobar: false,
      buttons: [
        "zoom",
        "slideShow",
        "fullScreen",
        "download",
        "thumbs",
        "close"
      ],
      lang: localeLang,
      i18n: {
        ar: {
          CLOSE: "خروج",
          NEXT: "التالي",
          PREV: "السابق",
          ERROR: "لايمكن تحميل المحتوى. من فضلك حاول مره أخرى.",
          PLAY_START: "بدء العرض",
          PLAY_STOP: "ايقاف العرض",
          FULL_SCREEN: "شاشة كاملة",
          THUMBS: "المصغرة",
          DOWNLOAD: "تحميل",
          SHARE: "مشاركة",
          ZOOM: "تقريب"
        }
      }
    });
  },
  computed: {
    mediaImage: function() {
      return this.post.media.filter(m => m.type == "image");
    },

    mediaVideo: function() {
      return this.post.media.filter(m => m.type == "video");
    },

    mediaAudio: function() {
      return this.post.media.filter(m => m.type == "audio");
    },

    mediaFile: function() {
      return this.post.media.filter(m => m.type == "file");
    }
  },

  methods: {
    // Add New Post to the data
    updatePost(post) {
      this.post = post;
      this.editPost = false;
    },

    // Delete Post from the server and from posts data
    deletePost(e) {
      e.preventDefault();

      Swal.fire({
        title: this.translate("lang.areSure"),
        text: this.translate("lang.deleteHint"),
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: this.translate("lang.yes"),
        cancelButtonText: this.translate("lang.no")
      })
        .then(result => {
          // If User accept
          if (result.value) {
            // emit event to posts component, to delete posts
            this.$emit("delete-post", this.post);
          }
        })
        .catch(() => {});
    }
  }
};
</script>
