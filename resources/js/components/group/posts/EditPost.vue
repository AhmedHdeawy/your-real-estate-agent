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
      <ul v-if="validationErrors" class="list-group mb-2 px-0">
        <li
          v-for="(err, index) in validationErrors"
          :key="index"
          class="list-group-item list-group-item-danger"
        >{{ err }}</li>
      </ul>
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
      <!-- Show DropZone -->
      <div class="collapse show post_attachfile" id="uploadImages">
        <vue-dropzone
          ref="myVueDropzone"
          id="dropzone"
          :options="dropzoneOptions"
          @vdropzone-removed-file="removedfile"
          @vdropzone-success="fileUploaded"
          @vdropzone-mounted="vmounted"
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
      if (file.upload && this.postData.files.length > 0) {
        const name = file.upload.filename;
        axios
          .post(`${this.uniqueName}/posts/deleteAttachment`, {
            filename: name
          })
          .then(({ data }) => {
            // Remove file from post files array
            _.remove(this.postData.files, el => el.name == name);
          });
      } else {
        const name = file.name;
        axios
          .post(`${this.uniqueName}/posts/deletePostAttachment`, {
            post_id: this.post.id,
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

    // Add File Manually when Dropzone Mounted
    vmounted() {
      this.$nextTick(function() {
        this.post.media.forEach(element => {
          var file = { size: 123, type: "image/png", name: element.name };

          var url =
            window.location.protocol +
            "//" +
            window.location.hostname +
            "/uploads/posts/" +
            element.name;

          this.$refs.myVueDropzone.manuallyAddFile(file, url);
        });
      });
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
