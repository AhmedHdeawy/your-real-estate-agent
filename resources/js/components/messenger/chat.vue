<template>
  <div class="message-con">
    <div class="sender-name">
      <img
        v-if="friend.avatar"
        :alt="friend.name"
        class="img-avatar"
        :src="'/uploads/users/' + friend.avatar"
      />
      <avatar
        v-else
        :username="friend.name_for_avatar"
        :customStyle="customStyle"
        background-color="#7F78B4"
        color="#FFF"
      ></avatar>
      <h6>{{ friend.name }}</h6>
    </div>
    <div v-if="chat" class="messages-box">
      <div v-if="chat.length" v-chat-scroll="{always: false, smooth: true, smoothonremoved: false}" class="messages">
        <infinite-loading direction="top" @infinite="infiniteHandler" spinner="circles">
          <div slot="no-more"></div>
          <div slot="no-results"></div>
        </infinite-loading>

        <div
          v-for="(message, index) in chat"
          :key="index"
          :class="getAuthedUser.id == message.sender_id ? 'sent' : 'received'"
        >
          {{ message.text }}
          <p class="message-date mb-0">{{ showDateInFormat(message.created_at) }}</p>
        </div>
      </div>
      <div v-else class="text-center align-items-center justify-content-center d-flex h-100">
        <p class="font-weight-bold">{{ translate('lang.youhavenoMessage') }}</p>
      </div>
      <div class="message-input">
        <form @submit.prevent>
          <div class="form-group">
            <input
              class="form-control"
              :placeholder="translate('lang.typeMessage')"
              :title="translate('lang.typeMessage')"
              type="text"
              v-model="message"
              @keyup.enter="saveMessage"
            />
            <div class="input-group-append">
              <button class="btn" type="button" @click.prevent="saveMessage">
                <i class="far fa-paper-plane"></i>
                <span>{{ translate('lang.send') }}</span>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div v-else class="row justify-content-center align-content-center h-100">
      <fade-loader class="custom-class" :color="loader.color"></fade-loader>
      <p class="text-center w-100 mt-2">{{ translate('lang.loadingChat') }}</p>
    </div>
  </div>
</template>

<script>
import { FadeLoader } from "@saeris/vue-spinners";
import InfiniteLoading from "vue-infinite-loading";
export default {
  components: {
    FadeLoader,
    InfiniteLoading
  },
  props: ["chat", "friend"],
  data() {
    return {
      message: "",
      page: 2,
      customStyle: {
        display: "inline-block",
        "-webkit-margin-end": "10px",
        "margin-inline-end": "10px"
      },
      loader: {
        color: "#6E67A0"
      }
    };
  },
  computed: {
    getAuthedUser: function() {
      return authedUser;
    }
  },
  created() {
    //   Listen for new message
    Echo.private("rbzgo-chat." + this.friend.id + "." + authedUser.id).listen(
      "MessageSent",
      e => {
        this.chat.push(e.message);
      }
    );
  },
  methods: {
    saveMessage() {
      if (this.message != "") {
        var data = {
          sender_id: authedUser.id,
          receiver_id: this.friend.id,
          text: this.message,
          created_at: moment()
        };

        this.message = "";
        this.chat.push(data);

        //   Send Request
        axios.post("messenger/saveMessage", data).then(response => {});
      }
    },

    //   Handle Infinte Scroll to Load more posts and append it to posts array
    infiniteHandler($state) {
      axios
        .get("/messenger/getChat/" + this.friend.id, {
          params: {
            page: this.page
          }
        })
        .then(({ data }) => {
          if (data.data.length) {
            this.page += 1;
            this.chat.unshift(...data.data);
            $state.loaded();
          } else {
            $state.complete();
          }
        });
    },

    showDateInFormat(date) {
      // Get Date in UTC
      var stillUtc = moment.utc(date).toDate();
      // Convert it to Locale timezone 'Africa/Cairo'

      var local = moment(stillUtc).local();

      return local.format("h:m a");
    }
  }
};
</script>

<style>
</style>
