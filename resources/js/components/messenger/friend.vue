<template>
  <a
    class="contact"
    :class="getLocaleLang == 'ar' ? 'ml-1' : 'mr-1'"
    @click.prevent="getChat"
    ref="contact"
  >
    <div class="row">
      <div class="col-auto">
        <!-- <img src="/images/user.png" alt="User Image" /> -->
        <img
          v-if="friend.avatar"
          :alt="friend.name"
          class="img-avatar"
          :src="'/uploads/users/' + friend.avatar"
        />
        <avatar v-else :username="friend.name_for_avatar" background-color="#7F78B4" color="#FFF"></avatar>
      </div>
      <div class="col">
        <h6>{{ friend.name }}</h6>
        <p v-if="online">
          <i class="text-success fa fa-circle"></i>
          {{ translate('lang.active') }}
        </p>
      </div>
    </div>
  </a>
</template>

<script>
export default {
  props: ["friend", "online"],
  data() {
    return {
      active: false,
      counter: 0
    };
  },
  computed: {
    getLocaleLang: function() {
      return localeLang;
    }
  },
  methods: {
    getChat() {
      //   Fire Event to the Parent
      this.$emit("get-chat", this.friend);

      // Get this friend dom element
      var thisFriend = $(this.$refs.contact);
      // Remove Active Class from other friends
      thisFriend.siblings().removeClass("active-friend");
      // Add Active class to this friend
      thisFriend.addClass("active-friend");
    }
  }
};
</script>
