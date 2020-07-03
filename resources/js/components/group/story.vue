<template>
  <div id="stories"></div>
</template>

<script>
import Zuck from "zuck.js";
import "zuck.js/dist/skins/snapgram.min.css";
import "zuck.js/dist/zuck.min.css";
export default {
  mounted() {
    this.initStories();
  },
  methods: {
    timestamp() {
      var timeIndex = 0;
      var shifts = [
        35,
        60,
        60 * 3,
        60 * 60 * 2,
        60 * 60 * 25,
        60 * 60 * 24 * 4,
        60 * 60 * 24 * 10
      ];

      var now = new Date();
      var shift = shifts[timeIndex++] || 0;
      var date = new Date(now - shift * 1000);

      return date.getTime() / 1000;
    },

    initStories() {

      var stories = new Zuck("stories", {
        backNative: true,
        previousTap: true,
        skin: "FaceSnap",
        autoFullScreen: false,
        avatars: true,
        paginationArrows: true,
        list: false,
        cubeEffect: false,
        localStorage: true,
        reactive: true,
        stories: [
          Zuck.buildTimelineItem(
            "ramon",
            "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/users/1.jpg",
            "Ramon",
            "https://ramon.codes",
            this.timestamp(),
            [
              [
                "ramon-1",
                "photo",
                3,
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/1.jpg",
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/1.jpg",
                "",
                false,
                false,
                this.timestamp()
              ],
              [
                "ramon-2",
                "video",
                0,
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/2.mp4",
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/2.jpg",
                "",
                false,
                false,
                this.timestamp()
              ],
              [
                "ramon-3",
                "photo",
                3,
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/3.png",
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/3.png",
                "https://ramon.codes",
                "Visit my Portfolio",
                false,
                this.timestamp()
              ]
            ]
          ),
          Zuck.buildTimelineItem(
            "gorillaz",
            "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/users/2.jpg",
            "Gorillaz",
            "",
            this.timestamp(),
            [
              [
                "gorillaz-1",
                "video",
                0,
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/4.mp4",
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/4.jpg",
                "",
                false,
                false,
                this.timestamp()
              ],
              [
                "gorillaz-2",
                "photo",
                3,
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/5.jpg",
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/5.jpg",
                "",
                false,
                false,
                this.timestamp()
              ]
            ]
          ),
          Zuck.buildTimelineItem(
            "ladygaga",
            "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/users/3.jpg",
            "Lady Gaga",
            "",
            this.timestamp(),
            [
              [
                "ladygaga-1",
                "photo",
                5,
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/6.jpg",
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/6.jpg",
                "",
                false,
                false,
                this.timestamp()
              ],
              [
                "ladygaga-2",
                "photo",
                3,
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/7.jpg",
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/7.jpg",
                "http://ladygaga.com",
                false,
                false,
                this.timestamp()
              ]
            ]
          ),
          Zuck.buildTimelineItem(
            "starboy",
            "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/users/4.jpg",
            "The Weeknd",
            "",
            this.timestamp(),
            [
              [
                "starboy-1",
                "photo",
                5,
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/8.jpg",
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/8.jpg",
                "",
                false,
                false,
                this.timestamp()
              ]
            ]
          ),
          Zuck.buildTimelineItem(
            "riversquomo",
            "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/users/5.jpg",
            "Rivers Cuomo",
            "",
            this.timestamp(),
            [
              [
                "riverscuomo",
                "photo",
                10,
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/9.jpg",
                "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/9.jpg",
                "",
                false,
                false,
                this.timestamp()
              ]
            ]
          )
        ]
      });
    }
  }
};
</script>
