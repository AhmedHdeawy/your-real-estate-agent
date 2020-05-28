<template>
  <div class="col-lg-3 col-md-6 col-12">
    <div class="search-result-box">
      <div class="img-con">
        <img v-if="image" :src="'/uploads/groups/' + image" class="img-avatar img-fluid" />
        <avatar
          v-else
          class="img-avatar d-inline-block"
          :username="name_for_avatar"
          background-color="#7F78B4"
          color="#FFF"
        ></avatar>
      </div>
      <h6 style="font-size: .9rem; height: 40px;">{{ name }}</h6>
      <div :class="getLocaleLang == 'ar' ? 'text-right' : 'text-left'">
        <p>
          <i class="fas fa-users"></i>
          {{ users_count }} {{ translate('lang.member') }}
        </p>

        <p>
          <i class="fas fa-map-marker-alt"></i>
          {{ city }}
        </p>

        <p style="font-size: .7rem; height: 45px;">
          <i class="fas fa-globe"></i>
          <span style="display: initial">{{ address }}</span>
        </p>
      </div>

      <div class="btn-con">
        <button class="btn" :data-target="'#joinGroupModal' + unique_name" data-toggle="modal">
          <i class="fas fa-plus-circle"></i>
          {{ translate('lang.join') }}
        </button>
      </div>
    </div>

    <div
      aria-hidden="true"
      aria-labelledby="joinGroupModalLabel"
      class="modal join-group-modal fade"
      :id="'joinGroupModal' + unique_name"
      role="dialog"
      tabindex="-1"
    >
      <div class="modal-dialog" role="document">
        <div v-if="!answersSent" class="modal-content">
          <h4 class="mb-4">{{ name }}</h4>
          <h5 class="color-rbzgo mb-3">{{ translate('lang.askeQuestionToJoin') }}</h5>
          <div v-for="(question, index) in questions" :key="question.id" class="form-group">
            <label for>{{ question.title }}</label>
            <textarea
              v-model="answers[index].answer"
              class="form-control"
              :placeholder="translate('lang.answer')"
            ></textarea>
          </div>
          <button :disabled="loader.load" class="btn" type="button" @click="sendAnswers">
            <beat-loader
              v-if="loader.load"
              class="custom-class"
              :color="loader.color"
              :size="loader.size"
            ></beat-loader>
            <span class="text-white" v-else>{{ translate('lang.sendAnswerAndJoin') }}</span>
          </button>
        </div>

        <div v-else class="modal-content">
          <h4 class="mb-4">{{ name }}</h4>
          <div class="text-center mb-4">
            <i class="fas fa-check-circle text-success fa-8x mx-3" aria-hidden="true"></i>
          </div>
          <h5 class="color-rbzgo mb-3">{{ translate('lang.answersSentAndDone') }}</h5>
          <button class="btn" @click="closeModal" type="button">{{ translate('lang.close') }}</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { BeatLoader } from "@saeris/vue-spinners";
export default {
  components: {
    BeatLoader
  },
  props: {
    group: {
      type: Object,
      require: true
    }
  },
  created() {
    this.fillQuestions();
    console.log(this.url);
  },
  data() {
    return {
      url: window.location.protocol + "//" + window.location.hostname,
      id: this.group.id,
      name: this.group.name,
      name_for_avatar: this.group.name_for_avatar,
      unique_name: this.group.unique_name,
      description: this.group.description,
      address: this.group.address,
      city: this.group.city,
      image: this.group.image,
      users_count: this.group.users_count,
      questions: this.group.questions,
      groups: [],
      page: 2,
      answersSent: false,
      answers: [],
      loader: {
        color: "#FFF",
        size: 15,
        load: false
      }
    };
  },
  computed: {
    getLocaleLang: function() {
      return localeLang;
    },
    sendAnswersUrl: function() {
      return this.url + "/" + this.getLocaleLang + "/groups/requestJoin";
    }
  },
  methods: {
    sendAnswers() {
      // Run Spinnser
      this.loader.load = true;

      axios
        .post(this.sendAnswersUrl, {
          groupId: this.id,
          answers: this.answers
        })
        .then(data => {
          this.answersSent = true;
        })
        .catch(() => {});
    },

    closeModal() {
      $("#joinGroupModal" + this.unique_name).modal("hide");
    },

    // Fill Questions IDs in answer array to answer each question with its ID
    fillQuestions() {
      this.questions.forEach(question => {
        this.answers.push({
          title: question.title,
          answer: ""
        });
      });
    }
  }
};
</script>
