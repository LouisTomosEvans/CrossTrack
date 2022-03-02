<template>
    <div style="padding: 12px;">
    <div style="text-align: center;">
        <strong>{{feature.features[0].properties.name}}</strong>
        <br>
        <div style="padding-top: 0.5rem;">
        <span @click="openFacebook()">
        <img style="cursor: pointer;"  id="facebookIcon" src="https://www.facebook.com/favicon.ico"/>
        </span>
        <span style="padding-left: 0.5rem; padding-right: 0.5rem;">
        </span>
        <span @click="openInstagram()">
        <img style="cursor: pointer;" id="instagramIcon" src="https://www.instagram.com/favicon.ico"/>
        </span>
        <!-- <v-btn class="col-12 mt-2" color="#e10367" small elevation=0 @click="openPosts()"><b style="color: white">View Posts</b></v-btn> -->
        </div>
    </div>
    </div>
</template>

<script>

export default {
    name: 'PopupContent',
  props: {
    feature: {
      required: true,
      type: Object,
    }
  },
  methods: {
    viewClicked() {
        let route = "/location/show/{id}";
        var newRoute = route.replace("{id}", this.feature.id);
        this.$router.push(newRoute);
    },
    readableDate(date){
      return window.Utils.dateTimeToDDMMYYYY(date);
    },
    openInstagram(){
            let url = 'https://www.instagram.com/explore/locations/' + this.feature.features[0].properties.id;
            window.open(url, '_blank');
    },
    openFacebook(){
            let url = 'https://www.facebook.com/' + this.feature.features[0].properties.id;
            window.open(url, '_blank');
    },


  }
}
</script>

<style scoped>
</style>
