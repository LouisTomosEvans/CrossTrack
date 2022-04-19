<template>
  <v-app>
    <v-navigation-drawer v-model="drawer" elevation=0 app class="background d-sm-block" absolute style="height: 100%;" :temporary="$vuetify.breakpoint.smOnly" :permanent="$vuetify.breakpoint.mdAndUp" >
    <v-list-item class="home"  :to="'/dashboard'">
        <v-list-item-content class="header">
            <img src="/HuntIntelLogo.png" style="width: 50% !important;" />
        </v-list-item-content>
    </v-list-item>

    <v-list dense nav class="p-0 mt-1">
        <v-list-item-group mandatory color="#ffffff">
          <v-list-item disabled class="p-1 pl-5">
        <v-list-item-content>
          <v-list-item-title style="color: white; font-size: 0.75rem;">
            <b>MY INTEL<span style="color: #44d62c;">.</span></b>
          </v-list-item-title>
        </v-list-item-content>
        </v-list-item>

        <v-list-item :to="'/dashboard'" v-ripple="false" class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon>
            <v-icon style="color: white;">mdi-poll</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title style="color: white;" class="sidebarText">Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <!-- <v-list-item :to="'/records'" v-ripple="false" class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon>
            <v-icon style="color: white;">mdi-content-save</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title style="color: white;" class="sidebarText">My Records</v-list-item-title>
          </v-list-item-content>
        </v-list-item> -->

        <v-list-item :to="'/knowledge-base'" v-ripple="false" class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon>
            <v-icon style="color: white;">mdi-school</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title style="color: white;" class="sidebarText">Knowledge Base</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider class="my-3"></v-divider>
        <v-list-item v-ripple="false" disabled class="p-1 pl-5">
        <v-list-item-content>
          <v-list-item-title style="color: white; font-size: 0.75rem;">
            <b>OSINT TOOLKIT<span style="color: #44d62c;">.</span></b>
          </v-list-item-title>
        </v-list-item-content>
        </v-list-item>


        <!-- <v-list-item :to="'/account-finder'" v-ripple="false" class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon>
            <v-icon style="color: white;">mdi-account-search</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title style="color: white;" class="sidebarText">Account Finder</v-list-item-title>
          </v-list-item-content>
        </v-list-item> -->

        <v-list-item :to="'/location-tools'" v-ripple="false" class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon style="color: white;">mdi-map-marker-question</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title style="color: white;" class="sidebarText">Location Tools</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <!-- <v-list-item :to="'/person-finder'" v-ripple="false" class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon>
            <v-icon style="color: white;">mdi-account-tie</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title style="color: white;" class="sidebarText">Person Finder</v-list-item-title>
          </v-list-item-content>
        </v-list-item> -->

        <!-- <v-list-item :to="'/text-analyser'" v-ripple="false" class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon>
            <v-icon style="color: white;">mdi-text-box-search</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title style="color: white;" class="sidebarText">Text Analyser</v-list-item-title>
          </v-list-item-content>
        </v-list-item> -->

        <!-- <v-list-item :to="'/image-analyser'" v-ripple="false" class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon>
            <v-icon style="color: white;">mdi-image</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title style="color: white;" class="sidebarText">Image Analyser</v-list-item-title>
          </v-list-item-content>
        </v-list-item> -->


        <!-- <v-list-item :to="'/leak-finder'" v-ripple="false" class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon>
            <v-icon style="color: white;">mdi-water-outline</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title style="color: white;" class="sidebarText">Leak Finder</v-list-item-title>
          </v-list-item-content>
        </v-list-item> -->

        </v-list-item-group>
    </v-list>
    </v-navigation-drawer>
    <v-app-bar absolute elevation=0 style="background-color: #242424; height: 60px; border-bottom: 2px solid #44d62c;" app>
        <v-app-bar-nav-icon @click="drawer = true" class="d-flex d-block d-md-none"></v-app-bar-nav-icon>
        <!-- <v-icon style="color: white;">mdi-magnify</v-icon> -->
        <v-spacer></v-spacer>
                <v-list-item class="navbar" style="padding-right: 0px !important;">
                        <v-list-item-content style="text-align: right;">
                            <v-list-item-title style="color: white; font-size: 0.75rem;"><b>{{user}}</b></v-list-item-title>
                            <v-list-item-subtitle style="color: white; font-size: 0.75rem;">{{plan}}</v-list-item-subtitle>
                        </v-list-item-content>
                        <v-menu bottom right>
                        <template v-slot:activator="{ on, attrs }">
                        <v-list-item-avatar style="cursor: pointer; margin-left: 12px;"  v-bind="attrs" v-on="on">
                            <img :src="'profile.png'">
                        </v-list-item-avatar>
                        </template>
                    <v-list dark width="140px">
                        <v-list-item style="border-bottom: solid 2px #1a1a1a;" href="/profile">
                            <v-list-item-title>Profile</v-list-item-title>
                        </v-list-item>
                        <v-list-item style="border-bottom: solid 2px #1a1a1a;" href="/billing">
                            <v-list-item-title>Billing</v-list-item-title>
                        </v-list-item>
                        <v-list-item style="border-bottom: solid 2px #1a1a1a;" href="/logout">
                            <v-list-item-title>Logout</v-list-item-title>
                        </v-list-item>
                    </v-list>
                    </v-menu>
                </v-list-item>
    </v-app-bar>
    <v-main class="background-main">
      <router-view></router-view>
    </v-main>
  </v-app>
</template>

<script>


export default {
    name: 'App',

    data(){
    return{
        user: '',
        plan: '',
        drawer: null,
    }},
    mounted() {
        this.getUser();
    },
    methods:{
        getUser(){
            this.loading = true;

            let route = '../api/app/';
            this.$http.get(route, {withCredentials: true}).then((res) => {
                this.user = res.data[0];
                this.plan = res.data[1];
            })
            .finally(() => {
            this.loading = false;
            });
        }
    }
};
</script>



<style scoped>
    .container {
    max-width: 1200px;
    }

    .background{
        background-image: #242424;
    }
    .background-main{
        background-color: #1A1A1A !important;
    }
    .displayCardBackground{
      background-image: linear-gradient(45deg, #242424, #2f2f2f);
    }
    .v-list-item__content.header{
        padding: 1.25rem !important;
    }
    .v-list-item__content.navbar{
        padding: 0rem;
    }
    .sidebarText{
        font-size: 0.75rem;
    }
    .v-list-item.displayCard{
        padding: 0rem;
    }
    .home{
        background-color: rgb(0,0,0,0.12);
        cursor: pointer;
        height: 60px;
    }
    .bannerLeft{
      position: absolute;
      left: 0px;
      top: 0;
      z-index: 0;
      width: 40%;
      opacity: 0.75;
    }
    .bannerRight{
      position: absolute;
      right: 0px;
      top: 0;
      z-index: 0;
      width: 40%;
      opacity: 0.75;
    }
    .cardShadow{
      box-shadow: 0px 0px 15px rgb(0,0,0,0.40) !important;
    }
    .toolButton{
      position: absolute !important;
      right: 24px;
      bottom: 24px;
    }
    .theme--light.v-list-item--active:hover::before, .theme--light.v-list-item--active::before{
      background-color: #000000 !important;
    }
    .theme--light.v-list-item:hover::before, .theme--light.v-list-item::before{
      background-color: #000000 !important;
    }

    .v-navigation-drawer {
        z-index: 999999 !important;
    }


</style>
