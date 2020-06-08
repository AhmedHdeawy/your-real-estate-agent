<template>
  <a class="contact" @click.prevent="getChat">
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
        <h6>
          {{ friend.name }}
        </h6>
        <p>
            <i class="text-success fa fa-circle"></i>
            {{ translate('lang.active') }}
        </p>
      </div>
    </div>
  </a>
</template>

<script>
export default {
  props: ["friend"],
  data() {
    return {};
  },
  computed: {
    getLocaleLang: function() {
      return localeLang;
    }
  },
  methods: {
      getChat() {
          this.$emit('get-chat', this.friend);
      }
  },
};
</script>
