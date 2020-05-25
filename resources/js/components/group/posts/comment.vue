<template>
  <div class="comment">
    <div class="comment-head">
      <div class="row">
        <div class="col-auto">
          <div class="user-data">
            <a href="#">
              <img
                v-if="comment.user.avatar"
                alt="User Image"
                src="/uploads/users/1587210878_business-man-1385050_19201.jpg"
              />
              <avatar
                v-else
                :username="comment.user.name_for_avatar"
                :customStyle="customStyle"
                background-color="#7F78B4"
                color="#FFF"
              ></avatar>
              <span>{{ comment.user.name }}</span>
            </a>
          </div>
        </div>
        <div class="col-auto">
          <div class="comment-date">{{ comment.created_at | dateFromNow }}</div>
        </div>
      </div>
    </div>
    <div class="comment-content">
      <p>{{ comment.text }}</p>
    </div>
    <!-- <div class="comment-interactions">
      <button class="btn like">
        <i class="far fa-thumbs-up"></i>
        <span>{{ comment.likes_count }} Likes</span>
      </button>
    </div> -->
    <hr />
  </div>
</template>

<script>

export default {
  props: ["comment"],
  data() {
    return {
      customStyle: {
        display: "inline-block",
        "text-align": "center"
      }
    };
  },
};
</script>
