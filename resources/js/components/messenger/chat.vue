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
    <div class="messages-box">
      <div v-if="chat.length" v-chat-scroll="{smooth: true}" class="messages">
        <div
          v-for="(message, index) in chat"
          :key="index"
          :class="getAuthedUser.id == message.sender_id ? 'sent' : 'received'"
        >{{ message.text }}</div>
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
  </div>
</template>

<script>
export default {
  props: ["chat", "friend"],
  data() {
    return {
      message: "",
      customStyle: {
        display: "inline-block",
        "-webkit-margin-end": "10px",
        "margin-inline-end": "10px"
      }
    };
  },
  computed: {
    getAuthedUser: function() {
      return authedUser;
    }
  },
  created() {


    Echo.private("rbzgochat." + this.friend.id + "." + authedUser.id)
      .listen("MessageSent", e => {
        console.log("pmessage sent");
        this.chat.push(e.message);
      });
  },
  methods: {
    saveMessage() {
      if (this.message != "") {
        var data = {
          sender_id: authedUser.id,
          receiver_id: this.friend.id,
          text: this.message
        };

        this.message = "";
        this.chat.push(data);

        //   Send Request
        axios.post("messenger/saveMessage", data).then(response => {
        });
      }
    }
  }
};
</script>

<style>
</style>
