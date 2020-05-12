<template>
  <div>
    <!-- Description and Stories -->
    <div class="row">
      <!-- Group Description -->
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="group-description">
          <h2>{{ name }}</h2>
          <p>{{ description }}</p>
        </div>
      </div>
      <div class="col-lg-8 col-md-10 mx-auto">
        <!-- <story></story> -->
      </div>
    </div>

    <!-- Posts and Create post -->
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <!-- New Post -->
        <div class="new-post">
          <div class="form-group">
            <textarea class="form-control" placeholder="ماذا الجديد لديك؟" title="Whats New"></textarea>
            <div class="input-group-append">
              <button class="btn multi-media">
                <i class="fas fa-photo-video"></i>
                <span>إرفاق صورة/فيديو</span>
              </button>
              <button class="btn btn-post">
                <i class="far fa-paper-plane"></i>
                <span>نشر</span>
              </button>
            </div>
          </div>
        </div>

        <!-- Posts -->
        <div class="posts-con">
          <h2>المناقشات</h2>
          <post v-for="post in posts.data" :key="post.id" :post="post"></post>

          <infinite-loading @infinite="infiniteHandler" spinner="circles">
              <div slot="no-more">No more Posts</div>
          </infinite-loading>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import story from "./story";
import post from "./posts/post";
import InfiniteLoading from "vue-infinite-loading";

export default {
  components: {
    story,
    post,
    InfiniteLoading
  },
  props: {
    group: {
      type: Object,
      require: true
    },
    posts: {
      type: Object,
      require: true
    }
  },
  data() {
    return {
      id: this.group.id,
      name: this.group.name,
      description: this.group.description,
      image: this.group.image,
      members: this.group.members,
      posts: this.posts,
      page: 2
    };
  },
  methods: {
    infiniteHandler($state) {
      axios
        .get(`${this.group.unique_name}/posts`, {
          params: {
            page: this.page
          }
        })
        .then(({ data }) => {
          if (data.data.length) {
            this.page += 1;
            this.posts.data.push(...data.data);
            $state.loaded();
          } else {
            $state.complete();
          }
        });
    }
  }
};
</script>
