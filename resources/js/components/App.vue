<template>
  <v-app>
    <v-navigation-drawer v-model="drawer" elevation=0 app floating style="height: 100%" class="background border-none d-sm-block" absolute  :temporary="$vuetify.breakpoint.xsOnly" :permanent="$vuetify.breakpoint.smAndUp" >
    <v-list-item v-ripple="false" class="home" href="/dashboard">
        <v-list-item-content class="header">
            <img src="/mainSideBarLogo.png" style="width: 10% !important;"/>
        </v-list-item-content>
    </v-list-item>

    <v-list dense nav class="p-0 mt-1">
        <v-list-item-group mandatory>
          <!-- <v-list-item disabled class="p-1 pl-5">
        <v-list-item-content>
          <v-list-item-title style="font-size: 0.75rem;">
            <b>Optional Heading 1</b>
          </v-list-item-title>
        </v-list-item-content>
        </v-list-item> -->
        <div class="col-12 pb-0">
          <v-select
          :items="items"
          label="Account"
          dense
          outlined
          dark
          color="white"
          hide-details
          single-line
        ></v-select>
        </div>

         <div>
            <v-divider style="color: white"></v-divider>
        </div>

        <v-list-item color='white' :to="'/dashboard'" dark v-ripple="false" class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon>
            <v-icon style="color: white;" class="d-flex align-items-center">mdi-poll</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item color='white' :to="'/reports'" dark v-ripple="false" class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon style="color: white !important;" class="d-flex align-items-center">
            <v-icon>mdi-file-chart</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Reports</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item color='white' :to="'/insights'" v-ripple="false"  dark class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon style="color: white;" class="d-flex align-items-center">
            <v-icon>mdi-magnify</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Insights</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item disabled color='white' opacity=0.5 v-ripple="false"  dark class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon style="color: white; opacity: 0.5;" class="d-flex align-items-center">
            <v-icon>mdi-chart-line</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText" style="opacity: 0.5;">Forecast</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <div>
            <v-divider style="color: white"></v-divider>
        </div>

        <v-list-item color='white' v-ripple="false" href="/profile"  dark class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon style="color: white;" class="d-flex align-items-center">
            <v-icon>mdi-account</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Profile</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
         <v-list-item color='white' v-ripple="false" :to="'/accounts'"  dark class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon style="color: white;" class="d-flex align-items-center">
            <v-icon>mdi-account-multiple</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Accounts</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item color='white' v-ripple="false" href="/billing"  dark class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon style="color: white;" class="d-flex align-items-center">
            <v-icon>mdi-currency-usd</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Billing</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item color='white' v-ripple="false" href="/support"  dark class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon style="color: white;" class="d-flex align-items-center">
            <v-icon>mdi-headset</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Support</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <div >
            <v-divider style="color: white"></v-divider>
        </div>

        <v-list-item color='white' v-ripple="false" href="/logout"  dark class="p-1 pl-5" style="text-decoration: none; color: inherit;" >
          <v-list-item-icon style="color: white;" class="d-flex align-items-center">
            <v-icon>mdi-logout</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Logout</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        </v-list-item-group>
    </v-list>
    </v-navigation-drawer>
    <v-main class="background-main">
        <div class="container">
            <div class="col-12 pt-3 p-0" v-if="plan == 'Free Trial'">
            <v-alert dense text color="orange" style="border: 2px orange solid"><div class="d-flex justify-content-between align-items-center"><span style="font-size: 0.8rem"><span style="color: #000000 !important">⚠️ <b>You are currently on your free trial!</b></span></span><v-spacer></v-spacer><v-btn href='/billing' small elevation=0 color="#fb5f65"><span style="color: white;">Upgrade Now</span></v-btn></div></v-alert>
        </div>
        <router-view></router-view>
        </div>
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
    padding-left: 24px;
    padding-right: 24px;
    }

    .background{
        background-color: #fb5f65 !important;
    }
    .background-main{
        background-color: #F3F4F6 !important;
    }
    .v-list-item__content.header{
        padding: 1.25rem !important;
    }
    .v-list-item__content.navbar{
        padding: 0rem;
    }
    .sidebarText{
        font-size: 0.75rem;
        color: white;
    }
    .v-list-item.displayCard{
        padding: 0rem;
    }
    .home{
        cursor: pointer;
        height: 60px;
        background-color: #ffffff10;
    }
    .cardShadow{
      box-shadow: 0px 0px 15px rgb(0,0,0,0.40) !important;
    }
    .toolButton{
      position: absolute !important;
      right: 24px;
      bottom: 24px;
    }
    .theme--dark.v-list-item--active:hover::before, .theme--dark.v-list-item--active::before{
      background-color: #ffffff !important;
    }
    .theme--dark.v-list-item:hover::before, .theme--dark.v-list-item::before{
      background-color: #ffffff !important;
    }
</style>
