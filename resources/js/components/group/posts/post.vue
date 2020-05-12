<template>
<div class="post">
    <!-- Post Head -->
    <div class="post-head">
        <div class="row">
            <!-- User Data -->
        <div class="col-auto">
            <div class="user-data">
            <a href="#">
                <img alt="User Image" src="/images/user.png" />
                <span> {{ post.user.name }} </span>
            </a>
            <a href="#"> {{ dateForHuman }} </a>
            </div>
        </div>
        <!-- Post Edit -->
        <div class="col-auto">
            <div class="group-data">
            <div class="dropdown">
                <a
                aria-expanded="false"
                aria-haspopup="true"
                class="btn"
                data-toggle="dropdown"
                href="#"
                id="dropdownMenuLink1"
                role="button"
                >
                <i class="fas fa-ellipsis-h"></i>
                </a>
                <div aria-labelledby="dropdownMenuLink1" class="dropdown-menu">
                <a class="dropdown-item" href="#">ذكر</a>
                <a class="dropdown-item" href="#">انثي</a>
                <a class="dropdown-item" href="#">تيست</a>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Post Text -->
    <div class="post-content">
        <p> {{ post.text }} </p>
        <hr />
    </div>

    <!-- Posts Likes and Comments Count -->
    <div class="post-interaction">
        <button class="btn like">
        <i class="far fa-thumbs-up"></i>
        <span> {{ likesCount }} Likes </span>
        </button>
        <button class="btn btn-comment">
        <i class="far fa-comment"></i>
        <span> {{ commentsCount }} Comment </span>
        </button>
    </div>

    <!-- Comments -->
    <div class="post-comments">
        <h6>
            <i class="far fa-comments"></i>
            <span>التعليقات</span>
        </h6>

        <!-- Type Comment -->
        <div class="comment-input">
            <div class="form-group">
                <input class="form-control" placeholder="أكتب تعليق" title="comment input" type="text" />
                <div class="input-group-append">
                <button class="btn">
                    <i class="far fa-paper-plane"></i>
                </button>
                </div>
            </div>
        </div>

        <!-- Show  Comments -->
        <!-- <comment v-for="comment in comments" :key="comment.id" :comment="comment"></comment> -->
    </div>

</div>
</template>

<script>
import comment from './comment'
export default {
    components: {
        comment
    },
    props: ['post'],
    data() {
        return {
            comments: this.post.comments,
            likesCount: this.post.likes_count,
            commentsCount: this.post.comments_count,
        }
    },
    mounted() {

    },
    computed: {
        dateForHuman: function () {
            return moment(this.post.created_at).fromNow();
        }
    },
};
</script>
