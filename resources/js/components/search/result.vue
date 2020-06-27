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
      <h6
        :data-target="'#joinGroupModal' + unique_name"
        data-toggle="modal"
        style="cursor: pointer"
      >{{ name }}</h6>
      <p v-if="forHome">
        {{ distanceBetween }}
      </p>
      <div v-if="!forHome" :class="getLocaleLang == 'ar' ? 'text-right' : 'text-left'">
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

      <div v-if="!forHome" class="btn-con">
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
        <section v-if="getAuthedUser">
          <div v-if="!answersSent" class="modal-content">
            <h5 class="text-center color-rbzgo mb-4">{{ name }}</h5>

            <div
              v-if="!existAnswer"
              class="alert alert-danger alert-dismissible fade show"
              role="alert"
            >
              {{ translate('lang.youMustAnswerOneQuestions') }}
              <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <!-- <h6 class="color-rbzgo mb-3">{{ translate('lang.askeQuestionToJoin') }}</h6> -->
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
              <span class="text-white" v-else>{{ translate('lang.send') }}</span>
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
        </section>
        <section v-else>
          <div class="modal-content">
            <h4 class="mb-4">{{ translate('lang.loginToJoin') }}</h4>
            <a href="/login" class="btn">{{ translate('lang.login') }}</a>

            <div class="login-now">
              <a href="/register">
                {{ translate('lang.hasNoUser') }}
                {{ translate('lang.register') }}
              </a>
            </div>
          </div>
        </section>
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
      required: true
    },
    forHome: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  created() {
    this.fillQuestions();

    this.handelUserLocation();
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
      existAnswer: true,
      answers: [],
      userLat: 28.8136932,
      userLng: 30.907292799999997,
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
    },
    getAuthedUser: function() {
      return authedUser;
    },
    distanceBetween: function() {
      if (this.forHome) {
        //   Calclate Distance
        let dis = this.distanceBetweenCoordinates(
          this.group.lat,
          this.group.lng,
          this.userLat,
          this.userLng,
          "K"
        );
        // text that will be show
        var translateText = "";
        // check
        if (dis == 0) {
          translateText = this.translate("lang.here");
        } else if (dis <= 2) {
          translateText = this.translate("lang.veryClose");
        } else {
          translateText = this.translate("lang.distanceFromHere", {
            km: dis
          });
        }

        return translateText;
      }
      return null;
    }
  },
  methods: {
    sendAnswers() {
      if (!this.checkAnswerIsEmpty()) {
        this.existAnswer = false;
        this.answersSent = false;
      } else {
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
      }
    },

    checkAnswerIsEmpty() {
      let check = false;
      for (let i = 0; i < this.answers.length; i++) {
        if (this.answers[i].answer) {
          check = true;
          break;
        }
      }
      return check;
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
    },

    handelUserLocation() {
      // Get Local Component Variable
      var self = this;
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          function(pos) {
            self.userLat = pos.coords.latitude;
            self.userLng = pos.coords.longitude;
          },
          function() {}
        );
      } else {
        // Browser doesn't support Geolocation
        alert(self.translate("lang.doesnotSupportGeolocation"));
      }
    },

    distanceBetweenCoordinates(lat1, lon1, lat2, lon2, unit) {
      if (lat1 == lat2 && lon1 == lon2) {
        return 0;
      } else {
        var radlat1 = (Math.PI * lat1) / 180;
        var radlat2 = (Math.PI * lat2) / 180;
        var theta = lon1 - lon2;
        var radtheta = (Math.PI * theta) / 180;
        var dist =
          Math.sin(radlat1) * Math.sin(radlat2) +
          Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
        if (dist > 1) {
          dist = 1;
        }
        dist = Math.acos(dist);
        dist = (dist * 180) / Math.PI;
        dist = dist * 60 * 1.1515;
        if (unit == "K") {
          dist = dist * 1.609344;
        }
        if (unit == "N") {
          dist = dist * 0.8684;
        }
        return Math.round(dist);
      }
    }
  }
};
</script>
