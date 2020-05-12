<template>
  <div class="comment">
    <div class="comment-head">
      <div class="row">
        <div class="col-auto">
          <div class="user-data">
            <a href="#">
              <img alt="User Image" src="/images/user.png" />
              <span> {{ comment.user.name }} </span>
            </a>
          </div>
        </div>
        <div class="col-auto">
          <div class="comment-date"> {{ dateForHuman }} </div>
        </div>
      </div>
    </div>
    <div class="comment-content">
      <p> {{ comment.text }} </p>
    </div>
    <div class="comment-interactions">
      <button class="btn like">
        <i class="far fa-thumbs-up"></i>
        <span> {{ comment.likes_count }} Likes </span>
      </button>
    </div>
    <hr>

  </div>
</template>

<script>
export default {
  props: ["comment"],
   computed: {
        dateForHuman: function () {
            return moment(this.comment.created_at).fromNow();
        }
    },
};
</script>
