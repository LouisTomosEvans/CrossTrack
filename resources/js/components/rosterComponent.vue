<template>
        <div class="row justify-content-center">
            <div class="col-12">
                <b><span style="font-size: 1.25rem; color: #28323b;">Your Roster</span></b>
            </div>
            <div class="col-12 d-flex justify-content-between" style="padding-top: 0.5rem;">
                <div class="d-flex align-items-end" style="width: 75%;">
                    <span style="color: #28323b; font-size: 0.8125rem;">Welcome to the Roster section! Here, you can view and manage your team members. You can add new team members, view current team members, and edit their profiles. You can also review your team’s progress and performance. This is a great way to keep track of your team’s progress and ensure everyone is working together to reach your business goals.</span>
                </div>
                <div class="m-0 p-0 d-flex align-content-center">
                    <v-btn v-if="checkIfUserIsOwnerOfCurrentTeam" @click="dialog = true" elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span style="color: #FFFFFF;">+ Add Team Member</span>
                    </v-btn>
                </div>
                <v-dialog
                v-model="dialog"
                persistent
                max-width="550px"
                >
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                    <v-card-title style="border-bottom: solid 1px lightgrey; margin-bottom: 1rem;">
                        <b><span style="font-size: 1rem; color: #28323b;">Send Invitation</span></b>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="12">
                                <span style="color: #28323b; font-size: 0.8125rem;">To add a new team member, simply enter their email address, and select the role you want them to have. Once you've added the new team member, they'll receive an email with instructions to set up their account and confirm their membership.</span>
                            </v-col>
                        </v-row>
                        <v-row class="pt-0">
                            <v-col cols="12" class="pt-0">
                                <v-text-field  :color="appStore.primary_color"  dense v-model="email" height="40px" elevation=0 single-line hide-details style="width: 100%;">
                                    <template v-slot:label>
                                        <strong>Enter your team members e-mail address</strong> ex. example@email.com
                                    </template>
                                </v-text-field>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <v-card-actions class="pt-0 pb-4">
                    <v-spacer></v-spacer>
                    <v-btn @click="dialog = false" outlined elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>Close</span>
                    </v-btn>
                    <v-btn @click="addTeamMember()" class="px-4" elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon class="mr-1" style="color: #FFFFFF; font-size: 0.8125rem;">mdi-send</v-icon>
                        <span style="color: #FFFFFF;" >Send Invitation</span>
                    </v-btn>
                    </v-card-actions>
                </v-card>
                </v-dialog>
                
            </div>
            <div class="col-12 d-flex justify-content-between" style="padding-top: 0.5rem;">
                <!-- <v-btn-toggle color="#f05628" group style="background-color: white; border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);" class="d-flex" dense outlined mandatory>
                    <v-btn elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none; background-color: white; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon class="mr-1">mdi-calendar</v-icon>
                        <span>Custom</span>
                    </v-btn>
                    <v-btn elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  background-color: white; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>Today</span>
                    </v-btn>
                    <v-btn elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  background-color: white; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>Yesterday</span>
                    </v-btn>
                    <v-btn elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  background-color: white; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>7D</span>
                    </v-btn>
                    <v-btn elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  background-color: white; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>30D</span>
                    </v-btn>
                    <v-btn elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  background-color: white; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>3M</span>
                    </v-btn>
                </v-btn-toggle> -->
                <div></div>
                <div class="m-0 p-0 d-flex align-content-center">
                    <v-btn text color="#28323b" elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none; margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon class="mr-1">mdi-filter-outline</v-icon>
                        <span>Filter</span>
                    </v-btn>
                    <v-btn text color="#28323b" elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon class="mr-1">mdi-pencil-outline</v-icon>
                        <span>Data points</span>
                    </v-btn>
                    <v-btn elevation=0 tile style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon color="#28323b">mdi-dots-vertical</v-icon>
                    </v-btn>
                </div>
                
            </div>
            <div class="col-12 d-flex justify-content-between align=content-center" style="padding-bottom: 0rem;">
                <div class="p-0 m-0" style="width: 35%;">
                    <v-text-field  :color="appStore.primary_color"  label="Search your company leads ex. Amazon" clearable dense v-model="search" height="40px" solo elevation=0 append-icon="mdi-magnify" single-line hide-details style="width: 100%; border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1) !important;">
                        <template v-slot:label>
                            <strong>Search your team </strong>ex. Will Smith
                        </template>
                    </v-text-field>
                </div>
                <div class="d-flex align-items-end" v-if="users.length > tableOptions.itemsPerPage">
                    <span style="color: #28323b; font-size: 0.8125rem;">Showing <b>{{ tableOptions.itemsPerPage }} of your team members</b> out of {{users.length}}</span>
                </div>
                <div class="d-flex align-items-end" v-else>
                    <span style="color: #28323b; font-size: 0.8125rem;"><b>Showing all of your team members</b></span>
                </div>
            </div>
            <div class="col-12 d-flex ">
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1); width: 100%;">
                    <div class="p-0">
                        <!-- data table -->
                        <v-data-table
                        :headers="headers"
                        :items="teamStore.team"
                        :search="search"
                        :options.sync="tableOptions"
                        :footer-props="footerOptions"
                        class="elevation-0 custom-data-table"
                        :color="appStore.primary_color" 
                        :loading="loading"
                        loading-text="Loading your team members... Please wait"
                        :checkbox-color="appStore.primary_color" 
                        style="border-radius: 8px;  border: thin solid rgba(0,0,0,.12);"
                        >
                        <!-- change how the name is displayed -->
                        <template v-slot:item.name="{ item }">
                            <div v-if="item.pivot.active !== null && item.pivot.invite == 0" class="d-flex align-items-center">
                                <v-avatar class="mr-1" size="24" :color="getColor(item.name)">
                                    <span class="white--text">{{ item.name[0] }}</span>
                                </v-avatar>
                                <span class="ml-1" style="color: #28323b; font-size: 0.8125rem;">{{ item.name }}</span>
                                <!-- if this is the same as user -->
                                <v-chip label v-if="item.email === user.email" small  :color="appStore.primary_color + '20'"  :text-color="appStore.primary_color"  class="ml-2">
                                    <span>You</span>
                                </v-chip>
                            </div>
                            <div v-else class="d-flex align-items-center">
                                <!-- 24px circle with white email icon in it -->
                                <v-avatar class="mr-1" size="24" color="info">
                                    <!-- 0.75 size -->
                                    <v-icon color="white" style="font-size: 0.95rem;">mdi-email-outline</v-icon>
                                </v-avatar>
                                <span class="ml-1" style="color: #28323b; font-size: 0.8125rem;">Invitation Sent</span>
                            </div>
                        </template>
                        <template v-slot:item.email="{ item }">
                            <span style="color: #28323b; font-size: 0.8125rem;">{{ item.email }}</span>
                        </template>
                        <template v-slot:item.created_at="{ item }">
                            <span style="color: #28323b; font-size: 0.8125rem;">{{ formatDate(item.created_at) }}</span>
                        </template>

                        <!-- last seen + amount of days ago -->
                        <template v-slot:item.last_active_at="{ item }">
                            <!-- if not null -->
                            <span v-if="item.last_active_at !== null" style="color: #28323b; font-size: 0.8125rem;">{{ formatLastSeenDate(item.last_active_at) }}</span>
                            <!-- if null -->
                            <span v-else style="color: #28323b; font-size: 0.8125rem;">-</span>
                        </template>


                        <!-- format status - active and de-active inside chip -->
                        <template v-slot:item.pivot.active="{ item }">
                            <!-- small chip with transparent background -->
                            <!-- expand the code below for invited if the item.pivot.active == null -->
                            <v-chip label small v-if="item.pivot.active !== null && item.email !== user.email && item.pivot.invite == 0" :color="item.pivot.active == 1 ? '#E8F5E9' : '#FFEBEE'" :text-color="item.pivot.active == 1 ? 'success' : 'error'">
                                <span>{{ item.pivot.active == 1 ? 'Active' : 'De-Activated' }}</span>
                            </v-chip>
                            <span v-if="item.email == user.email">-</span>
                            <v-chip label small v-if="item.pivot.invite == 1" color="#E3F2FD" text-color="info">
                                <span>Invited</span>
                            </v-chip>

                        </template>

                        <!-- format actions - three vertical dots -->
                        <template v-slot:item.actions="{ item }">
                            <v-menu offset-y nudge-left="150px">
                                <template v-slot:activator="{ on }">
                                    <v-btn v-if="checkIfUserIsOwnerOfCurrentTeam && item.id != user.id" icon v-on="on">
                                        <v-icon>mdi-dots-vertical</v-icon>
                                    </v-btn>
                                </template>
                                <v-list dense class="mt-0 p-0">
                                <!-- heading -->
                                <v-list-item v-if="item.pivot" style="background-color: #F5F5F5;">
                                  <v-list-item-content>
                                    <v-list-item-title style="font-weight: 700;">Quick Actions</v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item>
                                <v-list-item v-if="item.pivot.active == 0 && item.pivot.invite == 0" style="cursor: pointer;" @click="activateUserDialog = true; activateUser = item">
                                  <v-list-item-content>
                                    <v-list-item-title>
                                        Activate user
                                    </v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item >
                                <v-list-item v-if="item.pivot.active == 1 && item.pivot.invite == 0" style="cursor: pointer;" @click="deactivateUserDialog = true; deactivateUser = item">
                                  <v-list-item-content>
                                    <v-list-item-title>
                                        De-activate user
                                    </v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item>
                                <v-list-item v-if="item.pivot.invite == 1" style="cursor: pointer;" @click="deleteInvitationDialog = true; deleteInvitationObj = item">
                                  <v-list-item-content>
                                    <v-list-item-title>
                                        <v-list-item-title style="color: #FF5252; text-decoration: underline;">Delete Invitation</v-list-item-title>
                                    </v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item>
                                <v-list-item v-if="item.pivot.invite == 0" style="cursor: pointer;" @click="removeUserDialog = true; removeUser = item">
                                  <v-list-item-content>
                                    <v-list-item-title style="color: #FF5252; text-decoration: underline;">Remove user from team</v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item>
                                </v-list>
                                
                            </v-menu>
                        </template>

                        <template v-slot:no-data>
                            
                            <!-- if no data -->
                            <div class="my-12">
                                <v-icon color="warning">mdi-alert</v-icon>
                                <p class="mt-2">
                                No Team Members Found.
                                </p>
                            </div>
                            
                        </template>
                        <template slot="progress">
                            <v-progress-linear :color="appStore.primary_color" indeterminate></v-progress-linear>
                        </template>
                        </v-data-table>
                        <!-- data table -->

                    </div>
                </v-card>
            </div>

            <!-- dialog -->
      <v-dialog
      v-model="removeUserDialog"
      persistent
      max-width="550px"
      >
      <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
        <v-card-title style="border-bottom: solid 1px lightgrey; margin-bottom: 1rem;">
                        <b><span style="font-size: 1rem; color: #28323b;">Remove User</span></b>
                    </v-card-title>
          <v-card-text>
              <v-row>
                  <v-col cols="12">
                      <span style="color: #28323b; font-size: 0.8125rem;">To remove a user from your team, simply click the “Remove User” button below. They will no longer have access to your team dashboard.</span>
                  </v-col>
              </v-row>
          </v-card-text>
          <v-card-actions class="pt-0 pb-4">
          <v-spacer></v-spacer>
          <v-btn @click="removeUserDialog = false" outlined elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span>Close</span>
          </v-btn>
          <v-btn @click="removeTeamMember()" elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span style="color: #FFFFFF;" class="px-4">Remove User</span>
          </v-btn>
          </v-card-actions>
      </v-card>
      </v-dialog>

      <v-dialog
      v-model="deactivateUserDialog"
      persistent
      max-width="550px"
      >
      <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
        <v-card-title style="border-bottom: solid 1px lightgrey; margin-bottom: 1rem;">
                        <b><span style="font-size: 1rem; color: #28323b;">De-activate User</span></b>
                    </v-card-title>
          <v-card-text>
              <v-row>
                  <v-col cols="12">
                      <span style="color: #28323b; font-size: 0.8125rem;">To deactivate a user from your team, simply click the "De-activate User” button below. They will no longer have access to your team dashboard until you re-activate them.</span>
                  </v-col>
              </v-row>
          </v-card-text>
          <v-card-actions class="pt-0 pb-4">
          <v-spacer></v-spacer>
          <v-btn @click="deactivateUserDialog = false" outlined elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span>Close</span>
          </v-btn>
          <v-btn @click="deactivateTeamMember()" elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span style="color: #FFFFFF;" class="px-4">De-activate User</span>
          </v-btn>
          </v-card-actions>
      </v-card>
      </v-dialog>

      <v-dialog
      v-model="activateUserDialog"
      persistent
      max-width="550px"
      >
      <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
        <v-card-title style="border-bottom: solid 1px lightgrey; margin-bottom: 1rem;">
                        <b><span style="font-size: 1rem; color: #28323b;">Activate User</span></b>
                    </v-card-title>
          <v-card-text>
              <v-row>
                  <v-col cols="12">
                      <span style="color: #28323b; font-size: 0.8125rem;">To activate a user from your team, simply click the "Activate User” button below. They will have access to your team dashboard.</span>
                  </v-col>
              </v-row>
          </v-card-text>
          <v-card-actions class="pt-0 pb-4">
          <v-spacer></v-spacer>
          <v-btn @click="activateUserDialog = false" outlined elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span>Close</span>
          </v-btn>
          <v-btn @click="activateTeamMember()" elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span style="color: #FFFFFF;" class="px-4">Activate User</span>
          </v-btn>
          </v-card-actions>
      </v-card>
      </v-dialog>

      <v-dialog
      v-model="deleteInvitationDialog"
      persistent
      max-width="550px"
      >
      <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
        <v-card-title style="border-bottom: solid 1px lightgrey; margin-bottom: 1rem;">
            <b><span style="font-size: 1rem; color: #28323b;">Delete Invitation</span></b>
        </v-card-title>
          <v-card-text>
              <v-row>
                  <v-col cols="12">
                      <span style="color: #28323b; font-size: 0.8125rem;">Are you sure you want to delete this invitation? This action cannot be undone and will permanently remove the invitation from your list.</span>
                  </v-col>
              </v-row>
          </v-card-text>
          <v-card-actions class="pt-0 pb-4">
          <v-spacer></v-spacer>
          <v-btn @click="deleteInvitationDialog = false" outlined elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span>Close</span>
          </v-btn>
          <v-btn @click="deleteInvitation()" elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span style="color: #FFFFFF;" class="px-4">Delete Invitation</span>
          </v-btn>
          </v-card-actions>
      </v-card>
      </v-dialog>
        </div>
</template>

<script>
    import { useAppStore } from '../store/appStore';
    import { useUserStore } from '../store/userStore';
    import { useTeamStore } from '../store/teamStore';
    export default {
        setup() {
            const appStore = useAppStore();
            const userStore = useUserStore();
            const teamStore = useTeamStore();

            return {
                appStore,
                userStore,
                teamStore,
            }
        },
        mounted() {
            if(this.teamStore.team.length == 0) {
                if (this.userStore.user == "") {
                    this.userStore.fetchUser().then(() => {
                        this.teamStore.fetchTeam(this.userStore.user.current_team.id);
                    });
                } else {
                    this.teamStore.fetchTeam(this.userStore.user.current_team.id);
                }
            }
        },
        data(){
            return {
                search: '',
                dialog: false,
                removeUserDialog: false,
                removeUser: {},
                deactivateUserDialog: false,
                deactivateUser: {},
                activateUserDialog: false,
                activateUser: {},
                deleteInvitationDialog: false,
                deleteInvitationObj: {},
                user: {
                    current_team: {},
                },
                loading: false,
                headers: [
                    { text: 'Name', value: 'name' },
                    { text: 'Email', value: 'email' },
                    { text: 'Role', value: '' },
                    { text: 'Status', value: 'pivot.active' },
                    { text: 'Joined', value: 'created_at' },
                    { text: 'Last Seen', value: 'last_active_at' },
                    { text: '', value: 'actions', sortable: false },
                ],
                users: [],
                tableOptions: {
                    page: 0,
                    itemsPerPage: 10,
                },
                footerOptions:
                {
                itemsPerPageOptions: [10, 25, 50, 100], // this is the proper name - not "items-per-page options" like what you're using
                },
                editDetailsDialog: false,       
            }
        },
        computed: {
            checkIfUserIsOwnerOfCurrentTeam(){
                // check if user is owner of current team
                // check exists
                if (this.user.current_team.owner_id == null) {
                    return false;
                }
                // check if user is owner
                if (this.user.current_team.owner_id == this.user.id) {
                    return true;
                }
                return false;
            },
        },
        methods: {
            addTeamMember(){
                this.loading = true;
                let route = '../api/teams/members/{team_id}';
                route = route.replace('{team_id}', this.user.current_team_id);
                let payload = {
                    email: this.email,
                }
                this.$http.post(route, payload, {withCredentials: true}).then((res) => {
                    this.getTeamMembers();
                    this.dialog = false;
                })
                .finally(() => {
                    this.loading = false;
                });
            },
            deactivateTeamMember(){
                this.loading = true;
                let route = '../api/teams/members/{team_id}/{user_id}';
                route = route.replace('{team_id}', this.user.current_team_id);
                route = route.replace('{user_id}', this.deactivateUser.id);
                this.$http.put(route, {withCredentials: true}).then((res) => {
                    this.getTeamMembers();
                    this.deactivateUserDialog = false;
                    this.deactivateUser = {};
                })
                .finally(() => {
                this.loading = false;
                });
            },
            activateTeamMember(){
                this.loading = true;
                let route = '../api/teams/members/{team_id}/{user_id}';
                route = route.replace('{team_id}', this.user.current_team_id);
                route = route.replace('{user_id}', this.activateUser.id);
                this.$http.put(route, {withCredentials: true}).then((res) => {
                    this.getTeamMembers();
                    this.activateUserDialog = false;
                    this.activateUser = {};
                })
                .finally(() => {
                this.loading = false;
                });
            },
            deleteInvitation(){
                this.loading = true;
                let route = '../api/teams/invitation/{team_id}/{invite_id}';
                route = route.replace('{team_id}', this.user.current_team_id);
                route = route.replace('{invite_id}', this.deleteInvitationObj.id);
                this.$http.delete(route, {withCredentials: true}).then((res) => {
                    this.getTeamMembers();
                    this.deleteInvitationDialog = false;
                    this.deleteInvitationObj = {};
                })
                .finally(() => {
                this.loading = false;
                });
            },
            // get random color for avatar
            getColor(name) {
                // list of bright orange colors
                const colors = [ this.appStore.primary_color];
                
                // get legth of name
                const nameLength = name.length;
                // get length of list and divide by name length to get remainder
                const colorIndex = nameLength % colors.length;

                // get color from list
                const color = colors[colorIndex];
                // return color
                return color;
            },
            formatDate(date){
                let d = new Date(date);
                let month = '' + (d.getMonth() + 1);
                let day = '' + d.getDate();
                let year = d.getFullYear();
                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;
                let hours = d.getHours();
                if (hours < 10) hours = '0' + hours;
                let minutes = d.getMinutes();
                if (minutes < 10) minutes = '0' + minutes;
                let seconds = d.getSeconds();
                if (seconds < 10) seconds = '0' + seconds;


                return [year, month, day].join('/') + ' ' + [hours, minutes, seconds].join(':');
            },
            formatLastSeenDate(date){
                let d = new Date(date);
                // how long ago was this date
                let timeAgo = this.timeSince(d);
                // make readable
                return timeAgo + ' ago';
            },
            timeSince(date) {
                var seconds = Math.floor((new Date() - date) / 1000);
                var interval = seconds / 31536000;
                if (interval > 1) {
                    return Math.floor(interval) + " years";
                }
                interval = seconds / 2592000;
                if (interval > 1) {
                    return Math.floor(interval) + " months";
                }
                interval = seconds / 86400;
                if (interval > 1) {
                    return Math.floor(interval) + " days";
                }
                interval = seconds / 3600;
                if (interval > 1) {
                    return Math.floor(interval) + " hrs";
                }
                interval = seconds / 60;
                if (interval > 1) {
                    return Math.floor(interval) + " mins";
                }
                return Math.floor(seconds) + " secs";
            },
            removeTeamMember(){
                this.loading = true;
                let route = '../api/teams/members/{team_id}/{user_id}';
                route = route.replace('{team_id}', this.user.current_team_id);
                route = route.replace('{user_id}', this.removeUser.id);
                this.$http.delete(route, {withCredentials: true}).then((res) => {
                    this.getTeamMembers();
                    this.removeUserDialog = false;
                })
                .finally(() => {
                    this.loading = false;
                });
            },
            
        }
    }
</script>

<style>
.square {
    width: 20%;
}

.square:after {
    content: "";
    display: block;
    padding-bottom: 100%;
    background-color: #BAEBFD;
    border-radius: 4px;
}

.square-2 {
    width: 20%;
}

.square-2:after {
    content: "";
    display: block;
    padding-bottom: 100%;
    background-color: #9CCCA6;
    border-radius: 4px;
    justify-content: center;
    align-items: center;
}

.square-3 {
    width: 20%;
}

.square-3:after {
    content: "";
    display: block;
    padding-bottom: 100%;
    background-color: #FCC693;
    border-radius: 4px;
}

.icon{
    position: absolute;
    top: 50%;
    left: 16%;
    transform: translate(-50%, -50%);
}

.v-input__slot{
    box-shadow: none !important;
}

/* change vuetify placeholder text size */
.v-text-field.v-text-field--solo .v-input__control input {
    font-size: 0.8125rem !important;
}

.v-text-field.v-text-field--solo .v-label {
    font-size: 0.8125rem !important;
}

.v-data-table-header{
    background-color: #F5F5F5;
}

.v-data-table__wrapper{
    border-radius: 8px;
}

.v-text-field > .v-input__control > .v-input__slot > .v-text-field__slot {
    font-size: 0.8125rem !important;
}

.v-application--is-ltr .v-text-field .v-label {
    font-size: 0.8125rem !important;
}

.v-menu__content{
      border-radius: 8px; 
      box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);
    }

</style>
