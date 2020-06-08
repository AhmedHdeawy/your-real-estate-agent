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
                <div v-if='friends.length'>
                    <friend v-for="friend in friends" :key="friend.id" :friend="friend" @get-chat="getChat"></friend>
                </div>
                <div v-else>
                    <p class="text-center">
                        {{ translate('lang.youhavenofriends') }}
                    </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-9 col-md-8">
            <chat v-if="chat" :chat="chat" :friend="friend"></chat>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import friend from './friend';
import chat from './chat';

export default {
  components:{
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
      if (this.friend) {

          this.fetchMessages(this.friend);
      }
  },
  data() {
      return {
          friend: this.friends[0],
          chat: '',
      }
  },
  methods: {
      fetchMessages(friend) {
          axios.get('/messenger/getChat/' + friend.id).then((response)    => {
        //   axios.get('/messenger/getChat/' + 50).then((response)    => {
              this.friend = friend;
              this.chat = response.data;

          })
      },

      getChat(friend) {

          this.fetchMessages(friend);
      }
  },
};
</script>
