<template>
  <!-- New Post -->
  <div class="new-post mb-4">
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
          aria-expanded="false"
          aria-controls="uploadImages"
        >
          <i class="fas fa-photo-video"></i>
          <span>{{ translate('lang.attachFileOrImage') }}</span>
        </button>
        <button class="btn btn-post" @click="savePost" :disabled="disabled">
          <i class="far fa-paper-plane"></i>
          <span>{{ translate('lang.publish') }}</span>
        </button>
      </div>
    </div>
    <!-- Show DropZone -->
    <div class="collapse post_attachfile" id="uploadImages">
      <vue-dropzone
        ref="myVueDropzone"
        id="dropzone"
        :options="dropzoneOptions"
        @vdropzone-removed-file="removedfile"
        @vdropzone-success="fileUploaded"
      ></vue-dropzone>
    </div>
  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
  components: {
    vueDropzone: vue2Dropzone
  },
  computed: {
    textareaPlaceholder: function() {
      return this.translate("lang.whatsInYourMind") + ", " + authedUser.name;
    }
  },
  props: {
    uniqueName: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      postData: {
        text: "",
        files: []
      },
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
    savePost() {
      //   Disable Button
      this.disabled = true;

      axios
        .post(`${this.uniqueName}/posts/savePost`, {
          text: this.postData.text,
          attachedFiles: this.postData.files
        })
        .then(({ data }) => {
          // emit event to posts component, to update posts with new post
          this.$emit("update-posts", data.post);

          // empty Post Data
          this.postData.text = "";
          this.postData.files = [];

          // Reset Dopzone
            this.$refs.myVueDropzone.removeAllFiles();

          // Enable Button again
          this.disabled = false;
        });
    },

    // Remove file from server when remove it from dropzone
    removedfile(file, error, xhr) {
      const name = file.upload.filename;

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
      // Get New name after Rename and Uploading Done
      const name = file.upload.filename;

      // Push file that uploaded to post files array
      this.postData.files.push({
        name: response.name,
        type: response.type
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
