<template>
  <v-app>
    <v-navigation-drawer v-model="drawer" elevation=0 app floating class="background border-none d-sm-block" absolute style="height: 100%;" :temporary="$vuetify.breakpoint.xsOnly" :permanent="$vuetify.breakpoint.smAndUp" >
    <v-list-item class="home">
        <v-list-item-content class="header">
            <img src="/mainSideBarLogo.png" style="width: 10% !important;"/>
        </v-list-item-content>
    </v-list-item>

    <v-list dense nav class="p-0 mt-1">
        <v-list-item-group mandatory>
          <v-list-item disabled class="p-1 pl-5">
        <v-list-item-content>
          <v-list-item-title style="font-size: 0.75rem;">
            <b>Optional Heading 1</b>
          </v-list-item-title>
        </v-list-item-content>
        </v-list-item>

        <v-list-item :to="'/dashboard'" v-ripple="false" class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon>
            <v-icon>mdi-poll</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-ripple="false" class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon>
            <v-icon>mdi-school</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Example Component 1</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-ripple="false" class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-map-marker-question</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Example  Component 2</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        </v-list-item-group>
    </v-list>
    </v-navigation-drawer>
    <v-app-bar absolute elevation=0 style="cursor: pointer; background: white; height: 60px;" app>
        <v-app-bar-nav-icon @click="drawer = true" class="d-flex d-block d-sm-none"></v-app-bar-nav-icon>
        <!-- <v-icon style="color: white;">mdi-magnify</v-icon> -->
        <v-spacer></v-spacer>
                <v-list-item class="navbar" style="padding-right: 0px !important;">
                        <v-list-item-content style="text-align: right;">
                            <v-list-item-title style="font-size: 0.75rem;"><b>{{user}}</b></v-list-item-title>
                            <v-list-item-subtitle style="font-size: 0.75rem;">{{plan}}</v-list-item-subtitle>
                        </v-list-item-content>
                        <v-menu bottom right>
                        <template v-slot:activator="{ on, attrs }">
                        <v-list-item-avatar style="margin-left: 12px;"  v-bind="attrs" v-on="on">
                            <img :src="'profile.png'">
                        </v-list-item-avatar>
                        </template>
                    <v-list width="140px">
                        <v-list-item href="/profile">
                            <v-list-item-title>Profile</v-list-item-title>
                        </v-list-item>
                        <v-list-item href="/billing">
                            <v-list-item-title>Billing</v-list-item-title>
                        </v-list-item>
                        <v-list-item href="/logout">
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
        background-image: #ffffff;
    }
    .background-main{
        background-color: #F3F4F6 !important;
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


</style>
