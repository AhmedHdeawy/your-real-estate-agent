<template>
    <section class="discussion_container container px-0 mb-2" :style="{backgroundColor: bgColor}">
      <!-- Discussion time -->
      <div class="row no-gutters px-2 discussion_time">
          <div class="col-12">
            <i class="fas fa-map-marker-alt"></i>
            <span class="px-1">close . </span>
            <span class="px-1">4min</span>
          </div>
      </div>
      <!-- Discussion Contnet and Voting -->
      <div class="row no-gutters discussion_content">
        <div class="col-10 px-2">
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum quos aliquam ad officiis nemo
            </p>
        </div>
        <div class="col-2">
          <div class="row no-gutters align-items-center text-center discussion_voting">
            <div class="col-12">
                <button class="no-btn"><i class="fas fa-angle-up"></i></button>
            </div>
            <div class="col-12">
                <span>8</span>
            </div>
            <div class="col-12">
                <button class="no-btn"><i class="fas fa-angle-down"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- Discussion Comments -->
      <div class="row no-gutters px-2 discussion_comment">
          <div class="col">
              <i class="fas fa-comment-alt"></i>
              <span class="px-1">12</span>
          </div>
          <div class="col">
              <button class="no-btn font-weight-bold">...</button>
          </div>
      </div>
    </section>
</template>

<script>
export default {
    props: {
        bgColor: {
            type: String,
            default: '#06A3CB'
        }
    }
};
</script>

<style>
</style>
