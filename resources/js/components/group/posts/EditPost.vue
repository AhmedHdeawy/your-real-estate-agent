<template>
  <section>
    <div class="row justify-content-center align-content-center my-3">
      <grid-loader
        class="custom-class"
        :color="loader.color"
        :loading="loader.loading"
        :size="loader.size"
      ></grid-loader>
    </div>

    <div class="row mb-2"></div>

    <!-- New Post -->
    <div v-show="!loader.loading" class="new-post mb-4">
      <!-- Error Section -->
      <ul v-if="validationErrors" class="list-group mb-2 px-0">
        <li
          v-for="(err, index) in validationErrors"
          :key="index"
          class="list-group-item list-group-item-danger"
        >{{ err }}</li>
      </ul>
      <!-- Post Content -->
      <div class="form-group">
        <textarea
          class="form-control"
          :placeholder="textareaPlaceholder"
          v-model="postData.text"
          :title="textareaPlaceholder"
        ></textarea>
        <div class="input-group-append">
          <button
            class="btn multi-media"
            type="button"
            data-toggle="collapse"
            data-target="#uploadImages"
            aria-expanded="true"
            aria-controls="uploadImages"
          >
            <i class="fas fa-photo-video"></i>
            <span>{{ translate('lang.attachFileOrImage') }}</span>
          </button>
          <button class="btn btn-post" @click="updatePost" :disabled="disabled">
            <i class="far fa-paper-plane"></i>
            <span>{{ translate('lang.save') }}</span>
          </button>
        </div>
      </div>

      <!-- Handle Post Medi -->
      <section v-if="post.media">
        <!-- Show images -->
        <div v-if="mediaImage" class="post-imglist row">
          <div v-for="media in mediaImage" :key="media.id" class="col-4 col-md-3 px-1 m-md-0 mb-1">
            <img :src="'/uploads/posts/' + media.name" class="img-fluid" style="height: 100px" />
            <button class="btn btn-sm" @click="deleteMedia(media.id)">
              <i class="fas fa-trash text-danger"></i>
            </button>
          </div>
        </div>

        <!-- Show videos -->
        <div v-if="mediaVideo" class="mt-4 row post-videolist">
          <div v-for="media in mediaVideo" :key="media.id" class="col-4 col-md-3 px-1 m-md-0 mb-1">
            <img src="/images/video-overlay.jpg" class="img-fluid" />
            <button class="btn btn-sm" @click="deleteMedia(media.id)">
              <i class="fas fa-trash text-danger"></i>
            </button>
          </div>
        </div>

        <!-- Show audios -->
        <div v-if="mediaAudio" class="mt-4 row post-videolist">
          <div class="row col-12 mx-1" v-for="media in mediaAudio" :key="media.id">
            <audio controls>
              <source :src="url + '/uploads/posts/' + media.name" />Your browser does not support the audio element.
            </audio>
            <button class="btn btn-sm" @click="deleteMedia(media.id)">
              <i class="fas fa-trash text-danger"></i>
            </button>
          </div>
        </div>

        <!-- Show files -->
        <div v-if="mediaFile" class="mt-4 row post-filelist">
          <div v-for="media in mediaFile" :key="media.id" class="col-4 col-md-3 px-1 m-md-0 mb-1">
            <img src="/images/pdf-overlay.webp" class="img-fluid" />
            <button class="btn btn-sm" @click="deleteMedia(media.id)">
              <i class="fas fa-trash text-danger"></i>
            </button>
          </div>
        </div>

        <!-- End Media -->
      </section>

      <!-- Show DropZone -->
      <div class="collapse show post_attachfile" id="uploadImages">
        <vue-dropzone
          ref="myVueDropzone"
          id="dropzone"
          :options="dropzoneOptions"
          @vdropzone-removed-file="removedfile"
          @vdropzone-success="fileUploaded"
        ></vue-dropzone>
      </div>
    </div>
  </section>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import { BounceLoader } from "@saeris/vue-spinners";

export default {
  components: {
    vueDropzone: vue2Dropzone,
    BounceLoader
  },
  mounted() {
    this.postData.text = this.post.text;
  },
  computed: {
    textareaPlaceholder: function() {
      return this.translate("lang.whatsInYourMind") + ", " + authedUser.name;
    },
    validationErrors: function() {
      let errors = Object.values(this.errors);
      errors = errors.flat();

      return errors;
    },
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
  props: {
    uniqueName: {
      type: Number,
      required: true
    },
    post: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      url: window.location.protocol + "//" + window.location.hostname,
      loader: {
        loading: false,
        color: "#6E67A0",
        size: 50
      },
      postData: {
        text: "",
        files: []
      },
      errors: "",
      disabled: false,
      dropzoneOptions: {
        url: `${this.uniqueName}/posts/uploadAttachment`,
        thumbnailWidth: 150,
        maxFilesize: 50,
        acceptedFiles: "image/*,application/pdf,audio/*,video/*",
        addRemoveLinks: true,
        dictRemoveFile: this.translate("lang.delete"),
        dictDefaultMessage:
          "<i class='fas fa-cloud-upload-alt mx-2'></i>" +
          this.translate("lang.dragFilesHere"),
        dictFileTooBig: this.translate("lang.maxFileSize"),
        dictInvalidFileType: this.translate("lang.invalid_filetype"),
        dictCancelUpload: this.translate("lang.cancel"),
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        renameFile: file => {
          // Generate Unique Name
          const newName =
            "rbzgo_" + moment().unix() + "_" + this.generateRandomString();
          const type = file.type.split("/")[1];
          return newName + "." + type;
        }
      }
    };
  },
  methods: {
    updatePost() {
      //   Disable Button
      this.errors = "";
      this.disabled = true;
      this.loader.loading = true;

      axios
        .post(`${this.uniqueName}/posts/updatePost`, {
          id: this.post.id,
          text: this.postData.text,
          attachedFiles: this.postData.files
        })
        .then(({ data }) => {
          // emit event to posts component, to update posts with new post
          this.$emit("update-post", data.post);

          // empty Post Files
          this.postData.files = [];

          // Enable Button again
          this.disabled = false;
          this.loader.loading = false;
        })
        .catch(error => {
          this.errors = error.response.data.errors;

          // Enable Button again
          this.disabled = false;
          this.loader.loading = false;
        });
    },

    // Remove file from server when remove it from dropzone
    removedfile(file, error, xhr) {
      const name = file.upload.filename;
      console.log(this.postData.files.length);

      if (this.postData.files.length > 0) {
        axios
          .post(`${this.uniqueName}/posts/deleteAttachment`, {
            filename: name
          })
          .then(({ data }) => {
            // Remove file from post files array
            _.remove(this.postData.files, el => el.name == name);
          });
      }
    },

    // After File has been uploaded successfully
    fileUploaded(file, response) {
      // Push file that uploaded to post files array
      this.postData.files.push({
        name: response.name,
        type: response.type
      });
    },
    deleteMedia(id) {
      // Remove file from post files array
      this.post.media = this.post.media.filter(el => el.id !== id);

      axios
        .post(`${this.uniqueName}/posts/deleteMedia`, {
          mediaId: id
        })
        .then(({ data }) => {});
    },

    // Generate Random String
    generateRandomString() {
      return (
        Math.random()
          .toString(36)
          .substring(2, 15) +
        Math.random()
          .toString(36)
          .substring(2, 15)
      );
    }
  }
};
</script>
