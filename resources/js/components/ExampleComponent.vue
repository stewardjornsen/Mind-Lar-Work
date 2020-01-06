<template>
  <div>
    <img :src="app_url+'images/posts/'+loader" class="img-fluid" alt v-if="loading" />

    <div v-if="!loading">
      <div class="top-div">
        <img :src="banner" class="img-fluid top-banner" />

        <div class="row">
          <div class="col-6">
            <div>Become a Winning</div>
            <h1>PARTNER</h1>
            <div>
              Join us enrich, reach, teach,
              <br />empower and train
            </div>
          </div>
          <div class="col-6">
            <h3>N500.00__</h3>
            <div>Monthly</div>
            <button class="btn btn-secondary">Donate</button>
          </div>
        </div>
        <!-- <div>{{ vod}}</div> -->
      </div>
      <div v-if="nearestEvents != undefined">
        <div class="bannertop" style="position: relative; z-index:1">
          <div class="card shadow blue-bg my-3">
            <img :src="banner_image" alt="banner Image" class="img-fluid card-img" />
            <div class="card-body blue-dark-bg"></div>
          </div>
        </div>

        <div style="position: relative">
          <div style="position: absolute; z-index:2; bottom: 10px; left: 20px; ">
            <div>
              <h5 class="text-holder text-contrast-dark">{{ nearestEvents.title || 'None' }}</h5>
            </div>
            <div v-if="nearestEvents.subtitle">
              <div class="text-holder bg-primary">
                <span
                  style="font-weight:bold; text-transform:uppercase;"
                >{{ nearestEvents.subtitle }}</span>
              </div>
            </div>
            <div>
              <div class="text-holder bg-primary shadow">
                <span
                  style="font-weight:bold"
                >{{ moment(nearestEvents.start_date).format('Do MMM, YYYY LT') }}</span>
              </div>
            </div>
            <div>
              <div class="text-holder bg-secondary text-white">
                <span style="font-weight:bold">{{ moment(nearestEvents.start_date).fromNow() }}</span>
              </div>
            </div>

            <!-- <h5>{{ moment(currentevent.start_date).format('LT') }}</h5> -->
          </div>
        </div>
      </div>

      <div class="my-5 d-flex justify-content-center" v-if="!eventmoreinfo">
        <button
          type="button"
          class="btn btn-outline-secondary stx m-1"
          @click="eventmoreinfo = true"
        >
          <span class="oi oi-document"></span>
          Get Event Info...
        </button>
        <button type="button" class="btn btn-outline-secondary stx m-1">
          <span class="oi oi-home"></span> Enter Hall
        </button>
      </div>

      <div class="card shadow bg-gradient-primary my-3" v-if="eventmoreinfo">
        <div class="card-body bg-gradient-quaternary">
          <div class="row">
            <div class="col-10 mb-5">
              <img :src="featured_image" alt="Featured Image" class="img-fluid mb-5" />
              <h4 class="orange-color">{{ nearestEvents.post.title }}</h4>
              <div class="green-color">
                <span>{{ nearestEvents.post.subtitle }}</span>
              </div>
              <hr class="divider" style="border-top-color: #415973" />
              <div class="text-light font-weight-light">{{ nearestEvents.post.textcontent }}</div>
              <hr class="divider" style="border-top-color: #415973" />
            </div>
            <div class="col-2">
              <button
                type="button"
                class="btn btn-outline-primary btn-sm m-1"
                @click="eventmoreinfo = false"
              >Close</button>
              <button type="button" class="btn btn-outline-primary btn-sm m-1">Enter</button>
            </div>
          </div>
        </div>
      </div>

      <!-- <div>{{ upcomingevents }}</div> -->
      <div class="card shadow blue-bg my-3">
        <div class="card-body blue-dark-bg">
          <div class="d-flex justify-content-between">
            <div>
              <h3 class="green-color" style="font-weight:bold">Events</h3>
            </div>
            <div>
              <div class="orange-color d-flex justify-content-end">
                <div class="mx-3">Past</div>

                <div class="custom-control custom-switch">
                  <input
                    type="checkbox"
                    v-model="eventswitch"
                    @click="!eventswitch"
                    class="custom-control-input"
                    id="customSwitch1"
                  />
                  <label class="custom-control-label" for="customSwitch1"></label>
                </div>
                <div class>Upcoming</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-for="(event, index) in eventShowing" :key="index">
        <div class="card shadow blue-bg my-3">
          <div class="card-body blue-dark-bg">
            <div class="d-flex justify-content-between">
              <div>
                <h2
                  class="m-0"
                  style="text-transform:uppercase"
                >{{ moment(event.start_date).format('DD') }}</h2>
                <h5
                  class="m-0"
                  style="text-transform:uppercase"
                >{{ moment(event.start_date).format('MMM') }}</h5>
              </div>
              <div class="blue-muted-color mx-4">
                <h5 class="card-title orange-color">{{ event.title }}</h5>
                <div class>{{ event.subtitle }}</div>
                <div>Time: {{ moment(event.start_date).format(' LT') }}</div>
                <div>{{ moment(event.start_date).fromNow() }}</div>
                <!-- <div>{{ moment(event.start_date).isSameOrBefore(undefined) }}</div> -->
              </div>
              <div>
                <button type="button" class="btn btn-outline-primary stx btn-sm">Add to Calendar</button>
                <button type="button" class="btn btn-outline-primary stx btn-sm">More Info</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <button @click="refreshtoken()">Refresh Access Token</button>
    </div>
  </div>
</template>
<style scoped>
.bannertop img {
  /* border-radius: 0 0 0 50px; */
  /* clip-path: ellipse(30% 30% at 100% 7%); */
  /* clip-path: polygon(0 0, 100% 0, 100% 100%, 10% 100%, 0 90%); */
  clip-path: polygon(90% 0, 100% 10%, 100% 100%, 0 100%, 0 0);
}
.text-holder {
  padding: 2px 18px;
  margin: 1px;
  display: inline-block;
  clip-path: polygon(95% 0, 100% 33%, 100% 100%, 0 100%, 0 0);
}
.text-contrast-dark {
  background: #212121;
  color: #fff;
}
.text-contrast-light {
  background-color: #fff;
  color: #212121;
}
.text-contrast-gray {
  background-color: #353535;
  color: #fff;
}
</style>
<script>
import moment from "moment";
Vue.prototype.moment = moment;
const loader = "giphy.gif";

export default {
  data() {
    return {
      app_url: "https://stewardjornsen.com/",
      banner: "",
      vod: {},
      loader: "giphy.gif",
      loading: true,
      token: "",
      eventswitch: true,
      eventmoreinfo: false,
      currentevent: {},
      currenteventdetail: {
        featured_image: loader,
        banner_image: loader
      },
      upcomingevents: {
        featured_image: loader,
        banner_image: loader
      },
      allevents: {
        featured_image: loader,
        banner_image: loader
      }
    };
  },
  mounted() {
    console.log(_.random(2, 20));
    axios
      .post(this.app_url + "api/auth/login", {
        email: "stewardjornsen@gmail.com",
        password: "DewIncrease",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json"
        }
      })
      .then(token => {
        this.token = token.data.access_token;
        axios
          .post(this.app_url + "/api/auth/landing2?token=" + this.token, {
            headers: {
              "Content-Type": "application/json",
              Accept: "application/json",
              Authorization: "Bearer " + token.data.access_token
            }
          })
          .then(res => {
            this.app_url = res.data.app_url;
            // this.currentevent = res.data.currentevent;
            this.banner = res.data.banner.value;
            console.log(res.data.banner, "BANNER");
            this.allevents = res.data.allevents;
            // this.upcomingevents = res.data.upcomingevents;
            // this.currenteventdetail = res.data.currentevent.post;
            this.loading = false;
            console.log(res.data, "Response");
          })
          .catch(err => {
            console.log(err, "Error");
          });
      });

    console.log("Component mounted.");
  },
  created() {
    //    youtube() {
    const url =
      "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=20&playlistId=PL4HaMRVB8id5gjmyKiJp6kuPXdGuTjL5K&key=AIzaSyA7zg7JHd0yvPQQsiTEEGTLgKs1Rrqla3Q#";

    axios.get(url).then(vid => {
      // console.log(vid.data.items);
      console.log(vid.data.items[0].snippet.resourceId.videoId);
      this.vod = vid.data.items;
    });

    this.vod;
    // }
  },
  methods: {
    refreshtoken() {
      axios
        .post(this.app_url + "api/auth/refresh?token=" + this.token, {
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json"
          }
        })
        .then(token => {
          this.token = token.data.access_token;
          console.log(token.data.access_token);
        });
    }
  },
  computed: {
    main_banner() {
      return this.allevents.banner.value;
    },

    // featured_image() {
    //   if (this.nearestEvents.post) {
    //     return (
    //       this.app_url +
    //       "images/posts/" +
    //       this.nearestEvents.post.featured_image
    //     );
    //   }
    // },
    // featured_image_thumb() {
    //   if (this.nearestEvents.post) {
    //     return (
    //       this.app_url +
    //       "thumbnails/posts/" +
    //       this.nearestEvents.post.featured_image
    //     );
    //   }
    // },
    // banner_image() {
    //   console.log(this.nearestEvents);
    //   if (this.nearestEvents != undefined) {
    //     return (
    //       this.app_url + "images/posts/" + this.nearestEvents.post.banner_image
    //     );
    //   }
    // },
    // banner_image_thumb() {
    //   if (this.nearestEvents.post) {
    //     return (
    //       this.app_url +
    //       "thumbnails/posts/" +
    //       this.nearestEvents.post.banner_image
    //     );
    //   }
    // },
    pastEvents() {
      return _.filter(this.allevents, item => {
        return moment(item.end_date).isBefore(undefined);
      });
      // .filter(i => i.start_date === 'one')
    },
    upcomingEvents() {
      return _.filter(this.allevents, item => {
        return moment(item.end_date).isSameOrAfter(undefined);
      });
      // .filter(i => i.start_date === 'one')
    },
    nearestEvents() {
      console.log(this.upcomingEvents, "UPCOMING");
      return this.upcomingEvents.slice(0, 1)[0];
      // .filter(i => i.start_date === 'one')
    },
    eventShowing() {
      if (this.eventswitch) {
        return this.upcomingEvents;
      } else {
        return this.pastEvents;
      }
    }
  }
};
</script>
