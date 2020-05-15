<template>
  <div class="post">
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
                <a class="dropdown-item" href="#">{{ translate('lang.edit') }}</a>
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
      <section v-if="post.media">
        <!-- Show images -->
        <div v-if="mediaImage" class="post-imglist row">
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
        <div v-if="mediaVideo" class="mt-4 row post-videolist">
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
        <div v-if="mediaAudio" class="mt-4 row post-videolist">
          <audio v-for="media in mediaAudio" :key="media.id" controls>
            <source :src="url + '/uploads/posts/' + media.name" />Your browser does not support the audio element.
          </audio>
        </div>

        <!-- Show files -->
        <div v-if="mediaFile" class="mt-4 row post-filelist">
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
  </div>
</template>

<script>

import comment from "./comment";
import fancyapps from "@fancyapps/fancybox";
import "@fancyapps/fancybox/dist/jquery.fancybox.min.css";

export default {
  components: {
    comment
  },
  props: ["post"],
  data() {
    return {
      url: window.location.protocol + "//" + window.location.hostname,
      comments: this.post.comments,
      likesCount: this.post.likes_count,
      commentsCount: this.post.comments_count
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
  }
};
</script>
