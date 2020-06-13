<template>
  <div class="row">
    <div class="col-lg-12 mx-auto">
      <div class="messenger-con">
        <div class="row">
          <div class="col-lg-3 col-md-4">
            <div class="contacts-con">
              <h2 id="listToggle">
                {{ translate('lang.friends') }}
                <span>
                  <i class="fas fa-angle-double-down"></i>
                </span>
              </h2>
              <div class="contacts">
                <div v-if="friends.length">
                  <friend
                    v-for="friend in friends"
                    :key="friend.id"
                    :friend="friend"
                    :online="isOnline(friend)"
                    @get-chat="getChat"
                  ></friend>
                </div>
                <div v-else>
                  <p class="text-center">{{ translate('lang.youhavenofriends') }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-9 col-md-8">
            <chat :chat="chat" :friend="friend"></chat>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import friend from "./friend";
import chat from "./chat";

export default {
  components: {
    friend,
    chat
  },
  props: {
    friends: {
      type: Array,
      require: true
    }
  },
  created() {
      console.log(window.mobileCheck);

    if (this.friend) {
      this.fetchMessages(this.friend);
    }

    // Load Online Friends
    Echo.join("online")
      .here(friends => {
        this.onlineFriends = friends;
      })
      .joining(friend => {
        this.onlineFriends.push(friend);
      })
      .leaving(friend => {
        this.onlineFriends.splice(this.onlineFriends.indexOf(friend), 1);
      });
  },
  data() {
    return {
      friend: this.friends[0],
      onlineFriends: [],
      chat: ""
    };
  },
  methods: {
    fetchMessages(friend) {
      axios.get("/messenger/getChat/" + friend.id).then(response => {
        this.friend = friend;
        this.chat = response.data.data;
      });
    },

    getChat(friend) {
      this.fetchMessages(friend);
    },

    isOnline(friend) {
      return this.onlineFriends.find(
        onlineFriend => onlineFriend.id === friend.id
      );
    }
  }
};
</script>
