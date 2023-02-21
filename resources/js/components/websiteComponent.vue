<template>
        <div class="row justify-content-center">
            <div class="col-12">
                <b><span style="font-size: 1.25rem; color: #28323b;">Your Websites</span></b>
            </div>
            <div class="col-12 d-flex justify-content-between" style="padding-top: 0.5rem;">
                <div class="d-flex align-items-end" style="width: 75%;">
                    <span style="color: #28323b; font-size: 0.8125rem;">Welcome to the Website section! Here, you can view and manage your websites. You can add new websites, view current websites, copy their tracking script and turn-off websites. With our intuitive interface, it's easy to stay on top of your website's performance and make any necessary adjustments. Take control of your online presence and optimize your websites with ease in this section.</span>
                </div>
                <div class="m-0 p-0 d-flex align-content-center">
                    <v-btn @click="dialog = true" elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span style="color: #FFFFFF;">+ Add Website</span>
                    </v-btn>
                </div>
                <v-dialog
                v-model="dialog"
                persistent
                max-width="550px"
                >
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                    <v-card-title>
                        <b><span style="font-size: 1.25rem; color: #28323b;">Add Website</span></b>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="12">
                                <span style="color: #28323b; font-size: 0.8125rem;">Adding a new website to your account has never been easier. Simply enter the name you want to call it and click the "Add Website" button, and you're good to go! Once they website has been created we will generate a tracking script for you to add to your website's code. This will allow you to gain valuable insights into your website's traffic and audience.</span>
                            </v-col>
                        </v-row>
                        <v-row class="pt-0">
                            <v-col cols="12" class="pt-0">
                                <v-text-field color="#f05628" dense v-model="name" height="40px" elevation=0 single-line hide-details style="width: 100%;">
                                    <template v-slot:label>
                                        <strong>Enter your website name</strong> ex. LeadRhino
                                    </template>
                                </v-text-field>
                            </v-col>
                        </v-row>
                        <v-row class="pt-0">
                            <v-col cols="12" class="pt-0">
                                <v-text-field prefix="https://" color="#f05628" dense v-model="domain" height="40px" elevation=0 single-line hide-details style="width: 100%;">
                                    <template v-slot:label>
                                        <strong>Enter your website domain</strong> ex. LeadRhino.io
                                    </template>
                                </v-text-field>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <v-card-actions class="pt-0 pb-4">
                    <v-spacer></v-spacer>
                    <v-btn @click="dialog = false" outlined elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>Close</span>
                    </v-btn>
                    <v-btn @click="addWebsite()" class="px-4" elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span style="color: #FFFFFF;" >+ Add Website</span>
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
                    <v-text-field color="#f05628" label="Search your company leads ex. Amazon" clearable dense v-model="search" height="40px" solo elevation=0 append-icon="mdi-magnify" single-line hide-details style="width: 100%; border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1) !important;">
                        <template v-slot:label>
                            <strong>Search your websites </strong>ex. LeadRhino
                        </template>
                    </v-text-field>
                </div>
                <div class="d-flex align-items-end" v-if="websites.length > tableOptions.itemsPerPage">
                    <span style="color: #28323b; font-size: 0.8125rem;">Showing <b>{{ tableOptions.itemsPerPage }} of your websites</b> out of {{websites.length}}</span>
                </div>
                <div class="d-flex align-items-end" v-else>
                    <span style="color: #28323b; font-size: 0.8125rem;"><b>Showing all of your websites</b></span>
                </div>
            </div>
            <div class="col-12 d-flex ">
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1); width: 100%;">
                    <div class="p-0">
                        <!-- data table -->
                        <v-data-table
                        :headers="headers"
                        :items="websites"
                        :search="search"
                        :options.sync="tableOptions"
                        :footer-props="footerOptions"
                        class="elevation-0"
                        color="#f05628"
                        :loading="loading"
                        loading-text="Loading your websites... Please wait"
                        checkbox-color="#f05628"
                        style="border-radius: 8px;  border: thin solid rgba(0,0,0,.12);"
                        >
                        <!-- change how the name is displayed -->
                        <template v-slot:item.name="{ item }">
                            <div v-if="item" class="d-flex align-items-center">
                                <!-- website icon -->
                                <v-avatar class="mr-1" size="24" color="info" v-if="!item.favicon">
                                    <!-- 0.75 size -->
                                    <v-icon color="white" style="font-size: 0.95rem;">mdi-web</v-icon>
                                </v-avatar>
                                <!-- show favicon -->
                                <div class="mr-1" style="height: 24px; width: 24px;" v-else>
                                    <!-- 0.75 size -->
                                    <img :src="getFaviconURL(item.favicon)" style="width: 24px; height: 24px; border-radius: 4px;">
                                </div>
                                <span class="ml-1" style="color: #28323b; font-size: 0.8125rem;">{{ item.name }}</span>
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
                        <template v-slot:item.active="{ item }">
                            <!-- small chip with transparent background -->
                            <!-- expand the code below for invited if the item.active == null -->
                            <v-chip label small :color="item.active == 1 ? '#E8F5E9' : '#FFEBEE'" :text-color="item.active == 1 ? 'success' : 'error'">
                                <span>{{ item.active == 1 ? 'Active' : 'De-Activated' }}</span>
                            </v-chip>
                        </template>

                        <!-- format status - active and de-active inside chip -->
                        <template v-slot:item.tracking_status="{ item }">
                            <!-- small chip with transparent background -->
                            <!-- expand the code below for invited if the item.active == null -->
                            <v-chip v-if="item.active == 0" label small color="#FFEBEE" text-color="error">
                                <span>Stopped</span>
                            </v-chip>
                            <v-chip v-else label small :color="item.tracking_status == 1 ? '#E8F5E9' : '#FFF3E0'" :text-color="item.tracking_status == 1 ? 'success' : 'warning'">
                                <!-- add blinking circle if tracking -->
                                <v-icon v-if="item.tracking_status == 1" class="blink" style="font-size: 0.75rem; margin-right: 4px;">mdi-circle</v-icon>
                                <span>{{ item.tracking_status == 1 ? 'Tracking' : 'Code Not Detected' }}</span>
                            </v-chip>
                        </template>

                        <!-- format actions - three vertical dots -->
                        <template v-slot:item.actions="{ item }">
                            <v-menu offset-y nudge-left="150px">
                                <template v-slot:activator="{ on }">
                                    <v-btn icon v-on="on">
                                        <v-icon>mdi-dots-vertical</v-icon>
                                    </v-btn>
                                </template>
                                <v-list dense class="mt-0 p-0">
                                <!-- heading -->
                                <v-list-item v-if="item" style="background-color: #F5F5F5;">
                                  <v-list-item-content>
                                    <v-list-item-title style="font-weight: 700;">Actions</v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item>
                                <v-list-item  style="cursor: pointer;" @click="editDetailsDialog = true; editItem = item">
                                  <v-list-item-content>
                                    <v-list-item-title>
                                        Edit Details
                                    </v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item>
                                <v-list-item style="cursor: pointer;" @click="trackingItem = item; getTrackingSnippet();">
                                  <v-list-item-content>
                                    <v-list-item-title>
                                        Copy Tracking Script
                                    </v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item>
                                <v-list-item v-if="item.active == 0" style="cursor: pointer;" @click="activateWebsiteDialog = true; activateWebsite = item">
                                  <v-list-item-content>
                                    <v-list-item-title>
                                        Activate Website
                                    </v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item >
                                <v-list-item v-if="item.active == 1" style="cursor: pointer;" @click="deactivateWebsiteDialog = true; deactivateWebsite = item">
                                  <v-list-item-content>
                                    <v-list-item-title>
                                        De-activate Website
                                    </v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item>
                                <v-list-item v-if="item" style="cursor: pointer;" @click="deleteWebsiteDialog = true; deleteWebsite = item">
                                  <v-list-item-content>
                                    <v-list-item-title style="color: #FF5252; text-decoration: underline;">Delete website</v-list-item-title>
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
                                No Websites Found.
                                </p>
                            </div>
                            
                        </template>
                        <template slot="progress">
                            <v-progress-linear color="#f05628" indeterminate></v-progress-linear>
                        </template>
                        </v-data-table>
                        <!-- data table -->

                    </div>
                </v-card>
            </div>

            <!-- dialog -->
      <v-dialog
      v-model="deleteWebsiteDialog"
      persistent
      max-width="550px"
      >
      <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
          <v-card-title>
              <b><span style="font-size: 1.25rem; color: #28323b;">Delete Website</span></b>
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
          <v-btn @click="deleteWebsiteDialog = false" outlined elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span>Close</span>
          </v-btn>
          <v-btn @click="deleteWebsiteFunction()" elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span style="color: #FFFFFF;" class="px-4">Delete Website</span>
          </v-btn>
          </v-card-actions>
      </v-card>
      </v-dialog>

      <v-dialog
      v-model="deactivateWebsiteDialog"
      persistent
      max-width="550px"
      >
      <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
          <v-card-title>
              <b><span style="font-size: 1.25rem; color: #28323b;">De-activate Website</span></b>
          </v-card-title>
          <v-card-text>
              <v-row>
                  <v-col cols="12">
                      <span style="color: #28323b; font-size: 0.8125rem;">To deactivate a website from your team, simply click the "De-activate Website" button below. We will no longer track your leads for this website until you re-activate it.</span>
                  </v-col>
              </v-row>
          </v-card-text>
          <v-card-actions class="pt-0 pb-4">
          <v-spacer></v-spacer>
          <v-btn @click="deactivateWebsiteDialog = false" outlined elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span>Close</span>
          </v-btn>
          <v-btn @click="deactivateWebsiteFunction()" elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span style="color: #FFFFFF;" class="px-4">De-activate Website</span>
          </v-btn>
          </v-card-actions>
      </v-card>
      </v-dialog>

      <v-dialog
      v-model="activateWebsiteDialog"
      persistent
      max-width="550px"
      >
      <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
          <v-card-title>
              <b><span style="font-size: 1.25rem; color: #28323b;">Activate Website</span></b>
          </v-card-title>
          <v-card-text>
              <v-row>
                  <v-col cols="12">
                      <span style="color: #28323b; font-size: 0.8125rem;">To activate a website, simply click the "Activate Website" button below. We will continue to add your leads to your dashboard.</span>
                  </v-col>
              </v-row>
          </v-card-text>
          <v-card-actions class="pt-0 pb-4">
          <v-spacer></v-spacer>
          <v-btn @click="activateWebsiteDialog = false" outlined elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span>Close</span>
          </v-btn>
          <v-btn @click="activateWebsiteFunction()" elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
              <span style="color: #FFFFFF;" class="px-4">Activate Website</span>
          </v-btn>
          </v-card-actions>
      </v-card>
      </v-dialog>

      <v-dialog
                v-model="editDetailsDialog"
                persistent
                max-width="550px"
                >
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                    <v-card-title>
                        <b><span style="font-size: 1.25rem; color: #28323b;">Edit Website</span></b>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="12">
                                <span style="color: #28323b; font-size: 0.8125rem;">Adding a new website to your account has never been easier. Simply enter the name you want to call it and click the "Add Website" button, and you're good to go! Once they website has been created we will generate a tracking script for you to add to your website's code. This will allow you to gain valuable insights into your website's traffic and audience.</span>
                            </v-col>
                        </v-row>
                        <v-row class="pt-0">
                            <v-col cols="12" class="pt-0">
                                <v-text-field color="#f05628" dense v-model="editItem.name" height="40px" elevation=0 single-line hide-details style="width: 100%;">
                                    <template v-slot:label>
                                        <strong>Change your websites name</strong> ex. LeadRhino
                                    </template>
                                </v-text-field>
                            </v-col>
                        </v-row>
                        <v-row class="pt-0">
                            <v-col cols="12" class="pt-0">
                                <v-text-field prefix="https://" color="#f05628" dense v-model="editItem.domain" height="40px" elevation=0 single-line hide-details style="width: 100%;">
                                    <template v-slot:label>
                                        <strong>Change your websites domain</strong> ex. LeadRhino.io
                                    </template>
                                </v-text-field>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <v-card-actions class="pt-0 pb-4">
                    <v-spacer></v-spacer>
                    <v-btn @click="editDetailsDialog = false" outlined elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>Close</span>
                    </v-btn>
                    <v-btn @click="editWebsite()" class="px-4" elevation=0 color="#f05628" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span style="color: #FFFFFF;" >Edit Website</span>
                    </v-btn>
                    </v-card-actions>
                </v-card>
                </v-dialog>

                <v-snackbar v-model="snackbar" :timeout="5000" :color="snackbarColor" style="justify-content: center;">
                    <b style="font-size: 0.8125rem;">{{ snackbarText }}</b>
                </v-snackbar>
        </div>
</template>

<script>
    export default {
        mounted() {
            this.getUserDetails();
            console.log('Component mounted.')
        },
        data(){
            return {
                search: '',
                dialog: false,
                user: {
                    current_team: {},
                },
                loading: false,
                headers: [
                    { text: 'Name', value: 'name' },
                    { text: 'Tracking Status', value: 'tracking_status' },
                    { text: 'Website Status', value: 'active' },
                    { text: 'Date Created', value: 'created_at' },
                    { text: 'Last Event', value: 'last_active_at' },
                    { text: '', value: 'actions', sortable: false },
                ],
                websites: [],
                deactivateWebsiteDialog: false,
                deactivateWebsite: {},
                activateWebsiteDialog: false,
                activateWebsite: {},
                deleteWebsiteDialog: false,
                deleteWebsite: {},
                editDetailsDialog: false,
                editItem: {},
                snackbar: false,
                snackbarText: '',
                snackbarColor: '',
                trackingItem: {},
                name: '',
                domain: '',
                tableOptions: {
                    page: 0,
                    itemsPerPage: 10,
                },
                footerOptions:
                {
                itemsPerPageOptions: [10, 25, 50, 100], // this is the proper name - not "items-per-page options" like what you're using
                }       
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
            getUserDetails(){
                this.loading = true;
                let route = '../api/app/';
                this.$http.get(route, {withCredentials: true}).then((res) => {
                    this.user = res.data[0];
                    this.getWebsites();
                })
            },
            getWebsites(){
                this.loading = true;
                // append id from user object to route
                let route = '../api/teams/websites/{team_id}';

                // replace team_id with id from user object
                route = route.replace('{team_id}', this.user.current_team_id);
                
                this.$http.get(route, {withCredentials: true}).then((res) => {
                    this.websites = res.data;
                })
                .finally(() => {
                    this.loading = false;
                });
            },
            addWebsite(){
                this.loading = true;
                let route = '../api/teams/websites/{team_id}';
                route = route.replace('{team_id}', this.user.current_team_id);
                let payload = {
                    name: this.name,
                    domain: this.domain,
                }
                this.$http.post(route, payload, {withCredentials: true}).then((res) => {
                    this.getWebsites();
                    this.dialog = false;
                })
                .finally(() => {
                    this.loading = false;
                });
            },
            deactivateWebsiteFunction(){
                this.loading = true;
                let route = '../api/teams/websites/{team_id}/{website_id}';
                route = route.replace('{team_id}', this.user.current_team_id);
                route = route.replace('{website_id}', this.deactivateWebsite.id);
                this.$http.put(route, {withCredentials: true}).then((res) => {
                    this.getWebsites();
                    this.deactivateWebsiteDialog = false;
                    this.deactivateWebsite = {};
                })
                .finally(() => {
                this.loading = false;
                });
            },
            activateWebsiteFunction(){
                this.loading = true;
                let route = '../api/teams/websites/{team_id}/{website_id}';
                route = route.replace('{team_id}', this.user.current_team_id);
                route = route.replace('{website_id}', this.activateWebsite.id);
                this.$http.put(route, {withCredentials: true}).then((res) => {
                    this.getWebsites();
                    this.activateWebsiteDialog = false;
                    this.activateWebsite = {};
                })
                .finally(() => {
                this.loading = false;
                });
            },
            deleteWebsiteFunction(){
                this.loading = true;
                let route = '../api/teams/websites/{team_id}/{website_id}';
                route = route.replace('{team_id}', this.user.current_team_id);
                route = route.replace('{website_id}', this.deleteWebsite.id);
                this.$http.delete(route, {withCredentials: true}).then((res) => {
                    this.getWebsites();
                    this.deleteWebsiteDialog = false;
                    this.deleteWebsite = {};
                })
                .finally(() => {
                    this.loading = false;
                });
            },
            editWebsite(){
                this.loading = true;
                let route = '../api/teams/websites/{team_id}/{website_id}';
                route = route.replace('{team_id}', this.user.current_team_id);
                route = route.replace('{website_id}', this.editItem.id);
                let payload = {
                    name: this.editItem.name,
                    domain: this.editItem.domain,
                }
                this.$http.post(route, payload, {withCredentials: true}).then((res) => {
                    this.getWebsites();
                    this.editDetailsDialog = false;
                    this.editItem = {};
                })
                .finally(() => {
                    this.loading = false;
                });
            },
            getTrackingSnippet(){
                let route = '../api/teams/websites/{team_id}/{website_id}/tracking-snippet';
                route = route.replace('{team_id}', this.user.current_team_id);
                route = route.replace('{website_id}', this.trackingItem.id);
                this.$http.get(route, {withCredentials: true}).then((res) => {
                    let tracking_snippet = res.data.trackingSnippet;
                    // add to users clipboard
                    this.$copyText(tracking_snippet);
                    this.trackingItem = {};
                    // show snack bar
                    this.snackbarText = 'Tracking Script copied to clipboard';
                    this.snackbarColor = 'success';
                    this.snackbar = true;

                })
                .finally(() => {
                    this.loading = false;
                });
            },
            $copyText(text) {
                const textarea = document.createElement('textarea');
                textarea.value = text;
                textarea.setAttribute('readonly', '');
                textarea.style.position = 'absolute';
                textarea.style.left = '-9999px';
                document.body.appendChild(textarea);
                textarea.select();
                const result = document.execCommand('copy');
                document.body.removeChild(textarea);
                return result;
            },
            // get random color for avatar
            getColor(name) {
                // list of bright orange colors
                const colors = ['#FF5722', '#FF9800', '#FFC107', '#FFEB3B', '#FFC107', '#FF9800', '#FF5722'];
                
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
            getFaviconURL(url) {
                // remove the public and replace it with storage
                url = url.replace('public', 'storage');
                // return the url
                return url;
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

.blink{
    animation: blinker 2s linear infinite;
}

@keyframes blinker {  
    50% { opacity: 0.2; }
}

.v-snack__wrapper{
    margin-bottom: 0px;
}
.v-sheet.v-snack__wrapper{
    box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);
    /* 8px on top corners */
    border-radius: 20px 20px 0px 0px !important;
}
.v-snack__content{
    padding: 8px 12px !important;
    /* alig text in center */
    display: flex;
    align-items: center;
    justify-content: center;
}

</style>
