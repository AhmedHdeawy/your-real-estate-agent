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
      <div class="messages">
        <div
          v-for="(message, index) in chat"
          :key="index"
          :class="getAuthedUser.id == message.sender_id ? 'sent' : 'received'"
        >{{ message.text }}</div>
      </div>
      <div class="message-input">
        <form>
          <div class="form-group">
            <input
              class="form-control"
              :placeholder="translate('lang.typeMessage')"
              :title="translate('lang.typeMessage')"
              type="text"
              v-model="message"
            />
            <div class="input-group-append">
              <button class="btn" @click.prevent="saveMessage()">
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
    },

    saveMessage() {
        var data = {
            sender_id: this.getAuthedUser,
            receiver_id: this.friend.id,
            text: this.message
        }
        this.message = '';
        this.chat.push(data);
    }
  }
};
</script>

<style>
</style>
