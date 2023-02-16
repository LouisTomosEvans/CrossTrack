<template>
  <v-app>
    <keep-alive style="z-index: 9999999 !important">
        <loading-screen style="z-index: 9999999 !important"></loading-screen>
    </keep-alive>

    <v-navigation-drawer v-model="drawer" color="#f05628" elevation=0 app class="background border-none d-sm-block" :mini-variant="mini" mini-variant-width="60" absolute style="height: 100%;" :temporary="$vuetify.breakpoint.smOnly" :permanent="$vuetify.breakpoint.mdAndUp" >
    <v-list-item v-ripple="false" class="home">
        <v-list-item-icon v-if="mini" class="d-flex justify-content-center align-items-center" style="margin-top:24px;">
            <img src="brandAssets/Mark.svg" width=50/>
        </v-list-item-icon>
        <v-list-item-content class="header">
            <img src="brandAssets/Logo.png" style="width: 10% !important;"/>
        </v-list-item-content>
    </v-list-item>

    <v-list dense nav class="p-0 mt-1">
        <v-list-item-group rounded color="#f05628" mandatory>

        <v-list-item  color="#f05628" :v-ripple="false" :to="'/dashboard'" class="p-1 pl-5" v-if="!mini">
          <v-list-item-icon>
            <v-icon class="d-flex align-items-center">mdi-poll</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" :to="'/dashboard'" class="p-1" style="text-decoration: none; " v-if="mini" >
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-poll</v-icon>
          </v-list-item-icon>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" :to="'/companies'" class="p-1 pl-5" style="text-decoration: none;"  v-if="!mini"  >
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-domain</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Company Leads</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" :to="'/companies'" class="p-1" style="text-decoration: none;" v-if="mini" >
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-domain</v-icon>
          </v-list-item-icon>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" :to="'/segments'" class="p-1 pl-5" style="text-decoration: none;" v-if="!mini" >
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-chart-pie</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Segments</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" :to="'/segments'" class="p-1" style="text-decoration: none;" v-if="mini" >
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-chart-pie</v-icon>
          </v-list-item-icon>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" class="p-1 pl-5" style="text-decoration: none;"  v-if="!mini" >
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-sitemap-outline</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Workflows</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" class="p-1" style="text-decoration: none;" v-if="mini" >
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-sitemap-outline</v-icon>
          </v-list-item-icon>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" class="p-1 pl-5" style="text-decoration: none;"  v-if="!mini" >
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-map</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Lead Map</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" class="p-1" style="text-decoration: none;" v-if="mini" >
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-map</v-icon>
          </v-list-item-icon>
        </v-list-item>

        <div>
            <v-divider style="color: #28323b"></v-divider>
        </div>

        <v-list-item color="#f05628" :v-ripple="false" :to="'/websites'" class="p-1 pl-5" style="text-decoration: none;" v-if="!mini">
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-web</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Websites</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" :to="'/websites'" class="p-1" style="text-decoration: none;" v-if="mini">
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-web</v-icon>
          </v-list-item-icon>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" :to="'/integrations'" class="p-1 pl-5" style="text-decoration: none;" v-if="!mini">
                  <v-list-item-icon class="d-flex align-items-center">
                    <v-icon>mdi-connection</v-icon>
                  </v-list-item-icon>

                  <v-list-item-content>
                    <v-list-item-title class="sidebarText">Integrations</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>

                <v-list-item color="#f05628" :v-ripple="false" :to="'/integrations'" class="p-1" style="text-decoration: none;" v-if="mini">
                  <v-list-item-icon class="d-flex align-items-center">
                    <v-icon>mdi-connection</v-icon>
                  </v-list-item-icon>
                </v-list-item>

                <v-list-item color="#f05628" :v-ripple="false"  :to="'/team'" class="p-1 pl-5" style="text-decoration: none;" v-if="!mini">
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-account-group</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Team</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item href="/billing" :v-ripple="false"  :to="'/team'" color="#f05628" class="p-1" style="text-decoration: none;" v-if="mini">
            <v-list-item-icon class="d-flex align-items-center">
                <v-icon id="billing_icon">mdi-account-group</v-icon>
            </v-list-item-icon>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" href="/profile" class="p-1 pl-5" style="text-decoration: none;"  v-if="!mini" >
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-account</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Profile</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" href="/profile" class="p-1" style="text-decoration: none;" v-if="mini" >
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-account</v-icon>
          </v-list-item-icon>
        </v-list-item>

        

        <v-list-item color="#f05628" :v-ripple="false" href="/billing" class="p-1 pl-5" style="text-decoration: none;" v-if="!mini && checkIfUserIsOwnerOfCurrentTeam">
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-currency-usd</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Billing</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item href="/billing" :v-ripple="false" color="#f05628" class="p-1" style="text-decoration: none;" v-if="mini  && checkIfUserIsOwnerOfCurrentTeam">
            <v-list-item-icon class="d-flex align-items-center">
                <v-icon id="billing_icon">mdi-currency-usd</v-icon>
            </v-list-item-icon>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" href="/support" class="p-1 pl-5" style="text-decoration: none;"  v-if="!mini" >
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-headset</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Support</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" href="/support" class="p-1" style="text-decoration: none;" v-if="mini" >
            <v-list-item-icon class="d-flex align-items-center">
                <v-icon>mdi-headset</v-icon>
            </v-list-item-icon>
        </v-list-item>

        <div >
            <v-divider style="color: #28323b"></v-divider>
        </div>

        <v-list-item color="#f05628" :v-ripple="false" href="/logout" class="p-1 pl-5" style="text-decoration: none;"  v-if="!mini">
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-logout</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="sidebarText">Logout</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item color="#f05628" :v-ripple="false" href="/logout" v-ripple="false" class="p-1" style="text-decoration: none;" v-if="mini">
          <v-list-item-icon class="d-flex align-items-center">
            <v-icon>mdi-logout-variant</v-icon>
          </v-list-item-icon>
        </v-list-item>


        </v-list-item-group>
    </v-list>
    </v-navigation-drawer>

    <v-app-bar absolute elevation=0 style="background-color: white; height: 64px; border-bottom: thin solid #28323b30;" app>
        <v-app-bar-nav-icon @click="drawer = true" class="d-flex d-block d-md-none"></v-app-bar-nav-icon>
        <v-icon @click="collapseSidebar()" class="d-none d-md-block" style="color: #28323b;">{{ mini ? 'mdi-forwardburger' : 'mdi-backburger'}}</v-icon>
        <!-- <v-icon style="color: white;">mdi-magnify</v-icon> -->
        <v-spacer></v-spacer>
                  <v-list-item class="navbar" style="padding-right: 0px !important;">
                          <v-list-item-content style="text-align: right;">
                              <v-list-item-title style="color: #28323b ; font-size: 0.8125rem; font-weight: 700;">{{user.name}}</v-list-item-title>
                              <v-list-item-subtitle style="color: #28323b ; font-size: 0.8125rem;" >
                                <v-menu offset-y allow-overflow style="min-width: 150px;">
                                <template v-slot:activator="{ on, attrs }">
                                  <span v-bind="attrs" v-on="on" v-ripple="false">{{currentCompany.name}}</span>
                                </template>
                              <v-list class="p-0" dense>
                                <!-- heading -->
                                <v-list-item style="background-color: #F5F5F5;">
                                  <v-list-item-content>
                                    <v-list-item-title style="font-weight: 700;">Your Teams</v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item>
                                    <v-list-item v-for="(item, i) in this.userCompanyList" :key="i">
                                      <v-list-item-title v-if="item.pivot.invite == 0 && item.pivot.active == 1" class="pr-5" @click="switchTeam(item)" style="cursor: pointer;">{{ item.name }}
                                        <v-chip v-if="item.owner_id == user.id" class="ml-2" color="#f05628" text-color="white" small label>Owner</v-chip>
                                        <v-chip v-if="item.owner_id != user.id && item.pivot.invite == 0 && item.pivot.active == 1" color="#f0562820" class="ml-2" text-color="#f05628" small label>Member</v-chip>
                                      </v-list-item-title>
                                      <v-list-item-title v-if="item.pivot.invite == 1" class="pr-5" @click="invitationModal(item)" style="cursor: pointer;">{{ item.name }}
                                        <v-chip class="ml-2" color="info" text-color="white" small label>Invited</v-chip>
                                      </v-list-item-title>
                                      <v-list-item-title v-if="item.owner_id != user.id && item.pivot.invite == 0 && item.pivot.active == 0" class="pr-5" @click="deactivatedInfoModal(item)" style="cursor: pointer;">{{ item.name }}
                                        <v-chip  color="error" class="ml-2" text-color="white" small label>De-Activated</v-chip>
                                      </v-list-item-title>
                                      <!-- edit icon -->
                                      <v-list-item-action v-if="item.owner_id == user.id">
                                        <v-icon @click="editTeamDialog=true; editItem = item" style="cursor: pointer;">mdi-pencil-outline</v-icon>
                                      </v-list-item-action>
                                      <v-list-item-action v-if="item.owner_id != user.id && item.pivot.invite == 0">
                                        <v-icon @click="leaveTeamDialog=true; leaveItem = item" style="cursor: pointer;">mdi-exit-run</v-icon>
                                      </v-list-item-action>
                                    </v-list-item>
                                    <v-divider v-if="!this.checkIfUserOwnsAnyTeam" class="p-0 my-1"></v-divider>
                                    <v-list-item v-if="!this.checkIfUserOwnsAnyTeam">
                                    <!-- create new team -->
                                    <v-list-item-content>
                                      <v-list-item-title @click="createTeamDialog = true" style="font-weight: 700; cursor: pointer;">+ Create Your Own Team</v-list-item-title>
                                    </v-list-item-content>
                                  </v-list-item>
                                  </v-list>
                            </v-menu>
                                </v-list-item-subtitle>
                          </v-list-item-content>          
                          <v-list-item-avatar style="margin-left: 12px;">
                              <img :src="userAvatar" alt="avatar">
                          </v-list-item-avatar>                      
                  </v-list-item>
                  <!-- v-menu to switch teams -->
    </v-app-bar>

    <!-- dialog -->
    <v-dialog
      v-model="createTeamDialog"
      persistent
      max-width="550px"
      >
      <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
          <v-card-title>
              <b><span style="font-size: 1.25rem; color: #28323b;">Create you own team</span></b>
          </v-card-title>
          <v-card-text>
              <v-row>
                  <v-col cols="12">
                      <span style="color: #28323b; font-size: 0.8125rem;">To create your team, simply enter your team name and click “Create Team”. Once your team is created, you’ll be able to add members and begin using the LeadRhino Dashboard. We're excited to have you on board!</span>
                  </v-col>
              </v-row>
              <v-row class="pt-0">
                  <v-col cols="12" class="pt-0">
                      <v-text-field color="#f05628" dense v-model="teamName" height="40px" elevation=0 single-line hide-details style="width: 100%;">
                          <template v-slot:label>
                              <strong>Enter your new team name</strong> ex. {{ user.name }}'s Team
                          </template>
                      </v-text-field>
                  </v-col>
              </v-row>
          </v-card-text>
          <v-card-actions class="pt-0 pb-4">
          <v-spacer></v-spacer>
          <v-btn @click="createTeamDialog = false" outlined elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span>Close</span>
          </v-btn>
          <v-btn @click="createTeam()" class="px-4" elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span style="color: #FFFFFF;">+ Create Team</span>
          </v-btn>
          </v-card-actions>
      </v-card>
      </v-dialog>


      <!-- dialog -->
      <v-dialog
      v-model="editTeamDialog"
      persistent
      max-width="550px"
      >
      <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
          <v-card-title>
              <b><span style="font-size: 1.25rem; color: #28323b;">Edit your team</span></b>
          </v-card-title>
          <v-card-text>
              <v-row>
                  <v-col cols="12">
                      <span style="color: #28323b; font-size: 0.8125rem;">To edit your team, simply enter your new team name and click “Edit Team”. Once your changes are sved, you’ll be directed to the LeadRhino Dashboard.</span>
                  </v-col>
              </v-row>
              <v-row class="pt-0">
                  <v-col cols="12" class="pt-0">
                      <v-text-field color="#f05628" dense v-model="editItem.name" height="40px" elevation=0 single-line hide-details style="width: 100%;">
                          <template v-slot:label>
                              <strong>Enter your team name</strong> ex. {{ user.name }}'s Team
                          </template>
                      </v-text-field>
                  </v-col>
              </v-row>
          </v-card-text>
          <v-card-actions class="pt-0 pb-4">
          <v-spacer></v-spacer>
          <v-btn @click="editTeamDialog = false" outlined elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span>Close</span>
          </v-btn>
          <v-btn @click="editTeam()" elevation=0 class="px-4" color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span style="color: #FFFFFF;">Save Changes</span>
          </v-btn>
          </v-card-actions>
      </v-card>
      </v-dialog>


      <!-- dialog -->
      <v-dialog
      v-model="leaveTeamDialog"
      persistent
      max-width="550px"
      >
      <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
          <v-card-title>
              <b><span style="font-size: 1.25rem; color: #28323b;">Leave team</span></b>
          </v-card-title>
          <v-card-text>
              <v-row>
                  <v-col cols="12">
                      <span style="color: #28323b; font-size: 0.8125rem;">To leave your team, simply click the “Leave Team” button below. You will no longer have access to the LeadRhino Dashboard or any of your team's data.</span>
                  </v-col>
              </v-row>
          </v-card-text>
          <v-card-actions class="pt-0 pb-4">
          <v-spacer></v-spacer>
          <v-btn @click="leaveTeamDialog = false" outlined elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span>Close</span>
          </v-btn>
          <v-btn @click="leaveTeam()" class="px-4" elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span style="color: #FFFFFF;">Leave team</span>
          </v-btn>
          </v-card-actions>
      </v-card>
      </v-dialog>

      <!-- dialog -->
      <v-dialog
      v-model="invitationModalDialog"
      persistent
      max-width="550px"
      >
      <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
          <v-card-title>
              <b><span style="font-size: 1.25rem; color: #28323b;">Join team</span></b>
          </v-card-title>
          <v-card-text>
              <v-row>
                  <v-col cols="12">
                      <span style="color: #28323b; font-size: 0.8125rem;">To leave your team, simply click the “Leave Team” button below. You will no longer have access to the LeadRhino Dashboard or any of your team's data.</span>
                  </v-col>
              </v-row>
          </v-card-text>
          <v-card-actions class="pt-0 pb-4">
          <v-spacer></v-spacer>
          <v-btn @click="invitationModalDialog = false" outlined elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span>Close</span>
          </v-btn>
          <v-btn @click="denyTeam()" class="px-4" elevation=0 color="error" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span style="color: #FFFFFF;">Deny Invite</span>
          </v-btn>
          <v-btn @click="joinTeam()" class="px-4" elevation=0 color="success" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span style="color: #FFFFFF;">Join team</span>
          </v-btn>
          </v-card-actions>
      </v-card>
      </v-dialog>

    <v-main class="background-main">
        <div class="container">
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
        user: {
          teams: [],
        },
        plan: '',
        teamName: '',
        drawer: null,
        mini: false,
        search: '',
        editTeamDialog: false,
        createTeamDialog: false,
        leaveTeamDialog: false,
        leaveItem: {},
        invitationModalDialog: false,
        inviteItem: {},
        userCompanyList: [],
        editItem: {},
        removeItem: {},
        currentCompany: {
          name: '',
        },

        avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',

        // dummy data for websites
        websites: [
            {
                name: 'Website 1',
                url: 'https://www.website1.com',
                status: 'Online'
            },
            {
                name: 'Website 2',
                url: 'https://www.website2.com',
                status: 'Offline'
            },
            {
                name: 'Website 3',
                url: 'https://www.website3.com',
                status: 'Online'
            },    
        ],

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
                this.currentCompany = this.user.current_team;
                this.userCompanyList = this.user.teams;
            })
            .finally(() => {
            this.loading = false;
            });
        },
        collapseSidebar(){
            this.mini = !this.mini;
        },
        switchTeam(item){
          this.currentCompanyID = item.id;
          this.loading = true;
          let route = '../api/teams/switch/' + item.id;
          this.$http.get(route, {withCredentials: true}).then((res) => {
            // force refresh to the /dashboard route
            this.$router.go();
          })
          .finally(() => {
          this.loading = false;
          });
        },
        invitationModal(item){
          this.invitationModalDialog = true;
          this.inviteItem = item;
        },
        joinTeam(){
          this.loading = true;
          let route = '../api/teams/join/{team_id}/{user_id}';
          route = route.replace('{team_id}', this.inviteItem.id);
          route = route.replace('{user_id}', this.user.id);
          this.$http.get(route, {withCredentials: true}).then((res) => {
            this.invitationModalDialog = false;
            this.getUser();
          })
          .finally(() => {
          this.loading = false;
          });
        },
        denyTeam(){
          this.loading = true;
          let route = '../api/teams/deny/{team_id}/{user_id}';
          route = route.replace('{team_id}', this.inviteItem.id);
          route = route.replace('{user_id}', this.user.id);
          this.$http.get(route, {withCredentials: true}).then((res) => {
            this.invitationModalDialog = false;
            this.getUser();
          })
          .finally(() => {
          this.loading = false;
          });
        },
        createTeam(){
          this.loading = true;
          let route = '../api/teams/teams';
          this.$http.post(route, {name: this.teamName}, {withCredentials: true}).then((res) => {
            this.createTeamDialog = false;
            this.getUser();
          })
          .finally(() => {
          this.loading = false;
          });
        },
        editTeam(){
          let item = this.editItem;

          this.loading = true;
          let route = '../api/teams/edit/' + item.id;
          this.$http.put(route, {name: item.name}, {withCredentials: true}).then((res) => {
            this.editTeamDialog = false;
            this.getUser();
          })
          .finally(() => {
          this.loading = false;
          });
        },
        leaveTeam(){
          this.loading = true;
          let route = '../api/members/leave/' + this.leaveItem.id;
          this.$http.delete(route, {withCredentials: true}).then((res) => {
            this.leaveTeamDialog = false;
            // force refresh to the /dashboard route
            this.$router.go();
            this.getUser();
          })
          .finally(() => {
            this.loading = false;
          });
        },
    },
    computed:{
      userAvatar(){
        return "https://ui-avatars.com/api/?background=f05628&color=fff&bold=true&name=" + this.user.name;
      },
      checkIfUserOwnsAnyTeam(){
        let company = this.userCompanyList.find(company => company.owner_id == this.user.id);
        if (company == undefined) {
          return false;
        }
        return true;
      },
      checkIfUserIsOwnerOfCurrentTeam(){
        if (this.currentCompany.owner_id == null) {
            return false;
        }
        if (this.currentCompany.owner_id == this.user.id) {
          return true;
        }
        return false;
      },
    }
};
</script>



<style scoped>
    .container {
    max-width: 100%;
    padding-left: 24px;
    padding-right: 24px;
    padding-top: 24px;
    padding-bottom: 24px;
    }

    .background{
        background-color: #ffffff !important;
        /* background-color: #f05628 !important; */
    }
    .background-main{
        background-color: #f8f8f8 !important;
    }
    .v-list-item__content.header{
        justify-content: start !important;
        padding-right: 5rem !important;
        padding-left: 6px;
    }
    .v-list-item__content.navbar{
        padding: 0rem;
    }
    .sidebarText{
        font-size: 0.8125rem;
        font-weight: 600 !important;
    }
    .v-list-item.displayCard{
        padding: 0rem;
    }
    .home{
        cursor: pointer;
        height: 64px;
        /* background-color: #f05628; */
        background-color: #ffffff;
        /* border-bottom: #f05628 2px solid; */
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
      background-color: #f05628 !important;
    }
    .theme--dark.v-list-item:hover::before, .theme--dark.v-list-item::before{
      background-color: #f05628 !important;
    }
    .v-text-field--outlined.v-input--dense .v-label{
      font-size: 0.8125rem !important;
    }
    /* v-label in vselect */
    .v-select__selections{
      font-size: 0.8125rem !important;
    }

    .v-application {
        font-family: 'Inter', sans-serif;
    }

    .v-list--nav .v-list-item, .v-list--nav .v-list-item::before, .v-list--nav .v-list-item::after {
      border-radius: 0% 30px 30px 0%;
      margin-right: 3px;
    }
    .active-text {
      color: #f05628 !important;
    }

    .v-menu__content{
      border-radius: 8px; 
      box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);
    }

</style>
