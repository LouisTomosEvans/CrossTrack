<template>
        <div class="row justify-content-center">
            <div class="col-12">
                <b><span style="font-size: 1.25rem; color: #28323b;">Your Company Leads</span></b>
            </div>
            
            <div class="col-12 d-flex justify-content-between" style="padding-top: 0.5rem; min-height: 64px;">
                <div class="d-flex align-items-end" style="width: 75%;">
                    <span style="color: #28323b; font-size: 0.8125rem;">
                        Welcome to the Company Leads section! Here, you can view and manage all of your leads. You can easily filter your leads by criteria like geography, industry, and intent score. You can also view detailed company lead profiles and activity, so you can identify and target the most qualified leads.</span>
                </div>
                <!-- <div class="m-0 p-0 d-flex align-content-center">
                    <v-btn elevation=0 color="#f05628" style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span style="color: #FFFFFF;">+ Add Segment</span>
                    </v-btn>
                </div> -->
            </div>

            <div class="col-12 d-flex justify-content-between" style="padding-top: 0.5rem;">
                <v-btn-toggle color="#f05628" group style="background-color: white; border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);" class="d-flex" dense outlined mandatory>
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
                </v-btn-toggle>
                <div class="m-0 p-0 d-flex align-content-center">
                    <v-btn text color="#28323b" elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none; margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon class="mr-1">mdi-filter-outline</v-icon>
                        <span>Filter</span>
                    </v-btn>
                    <v-btn text color="#28323b" elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon class="mr-1">mdi-pencil-outline</v-icon>
                        <span>Data points</span>
                    </v-btn>
                    <v-btn text color="#28323b" elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon class="mr-1">mdi-download-outline</v-icon>
                        <span>Download</span>
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
                            <strong>Search your company leads </strong>ex. Amazon
                        </template>
                    </v-text-field>
                </div>
                <div class="d-flex align-items-end" v-if="leads.length > tableOptions.itemsPerPage">
                    <span style="color: #28323b; font-size: 0.8125rem;">Showing <b>{{ tableOptions.itemsPerPage }} of your leads</b> out of {{leads.length}}</span>
                </div>
                <div class="d-flex align-items-end" v-else>
                    <span style="color: #28323b; font-size: 0.8125rem;"><b>Showing all of your leads</b></span>
                </div>
            </div>
            <div class="col-12 d-flex ">
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1); width: 100%;">
                    <div class="p-0">
                        <!-- data table -->
                        <v-data-table
                        :headers="headers"
                        :items="leads"
                        :search="search"
                        :options.sync="tableOptions"
                        :footer-props="footerOptions"
                        class="elevation-0"
                        color="#f05628"
                        :loading="loading"
                        loading-text="Loading your leads... Please wait"
                        checkbox-color="#f05628"
                        style="border-radius: 8px;  border: thin solid rgba(0,0,0,.12);"
                        >
                        <!-- loading -->
                        <template slot="progress">
                            <v-progress-linear color="#f05628" indeterminate></v-progress-linear>
                        </template>
                        <template v-slot:item.name="{ item }">
                        <div v-if="item" class="d-flex align-items-center">
                                <!-- website icon -->
                                <v-avatar class="mr-1" size="24" color="info" v-if="!item.logo">
                                    <!-- 0.75 size -->
                                    <v-icon color="white" style="font-size: 0.95rem;">mdi-web</v-icon>
                                </v-avatar>
                                <!-- show favicon -->
                                <div class="mr-1" style="height: 24px; width: 24px;" v-else>
                                    <!-- 0.75 size -->
                                    <img :src="getFaviconURL(item.logo)" style="width: 24px; height: 24px; border-radius: 4px;">
                                </div>
                                <span class="ml-1" style="color: #28323b; font-size: 0.8125rem;">{{ item.name }}</span>
                        </div>
                        </template>
                        <template v-slot:no-data>
                            <div class="my-12">
                                <v-icon color="warning">mdi-alert</v-icon>
                                <p class="mt-2">
                                No Company Leads Found.
                                </p>
                            </div>
                            
                        </template>
                        <template v-slot:item.last_seen="{ item }">
                             <!-- if not null -->
                             <span v-if="item.last_seen !== null" style="color: #28323b; font-size: 0.8125rem;">{{ formatLastSeenDate(item.last_seen) }}</span>
                            <!-- if null -->
                            <span v-else style="color: #28323b; font-size: 0.8125rem;">-</span>
                        </template>
                        <template v-slot:item.total_duration="{ item }">
                            <!-- if not null -->
                            <span v-if="item.total_duration !== null" style="color: #28323b; font-size: 0.8125rem;">{{item.total_duration + ' secs'}}</span>
                        </template>
                        <template v-slot:item.details="{ item }">
                                    <v-btn @click="dialog = true;" icon v-on="on">
                                        <v-icon>mdi-chevron-right</v-icon>
                                    </v-btn>
                        </template>
                        <!-- website -->
                        <template v-slot:item.website_name="{ item }">
                            <div v-if="item">
                                <span class="ml-1" style="color: #28323b; font-size: 0.8125rem;">{{ item.website_name}}</span>
                            </div>
                        </template>
                        <!-- location -->
                        <template v-slot:item.location="{ item }">
                            <div v-if="item">
                                <span class="ml-1" style="color: #28323b; font-size: 0.8125rem;">{{ item.location }}</span>
                            </div>
                        </template>
                        <!-- visits -->
                        <template v-slot:item.visit_count="{ item }">
                            <div v-if="item">
                                <span class="ml-1" style="color: #28323b; font-size: 0.8125rem;">{{ item.visit_count }}</span>
                            </div>
                        </template>
                        </v-data-table>
                        <!-- data table -->

                    </div>
                </v-card>
            </div>

            <!-- v-overlay -->
            <v-overlay :value="dialog">
                
            </v-overlay>

            <v-dialog
                v-model="dialog"
                content-class="halfDialog"
                persistent
                fullscreen
                max-width="550px"
                transition="slide-x-reverse-transition"
                >
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1); min-height: 100%; border-radius: 0px !important;">
                    <v-card-title style="border-bottom: solid 1px lightgrey; margin-bottom: 1rem; height: 64px;">
                        <v-btn @click="dialog=false" icon tile class="mr-3" v-on="on">
                            <v-icon>mdi-arrow-collapse-right</v-icon>
                        </v-btn>
                        <b><span style="font-size: 1rem; color: #28323b;">Lead Details</span></b>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="12">
                                <div style="margin-top: 1rem; border: thin solid rgba(0, 0, 0, 0.12); border-radius: 8px; box-shadow: rgba(40, 50, 59, 0.1) 0px 0px 5px 0px !important;">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-start justify-content-between" style="margin: 1rem; width: 100%;">
                                            <div class="m-0 p-0 d-flex">
                                            <v-avatar size="60" color="info" v-if="!leads[0].logo">
                                                <!-- 0.75 size -->
                                                <v-icon color="white" style="font-size: 0.95rem;">mdi-company</v-icon>
                                            </v-avatar>
                                            <!-- show favicon -->
                                            <div class="mr-1" style="height: 60px; width: 60px;" v-else>
                                                <!-- 0.75 size -->
                                                <img :src="getFaviconURL(leads[0].logo)" style="width: 60px; height: 60px; border-radius: 4px;">
                                            </div>
                                            <div class="d-flex flex-wrap align-self-center">
                                                <span class="ml-1 align-self-end" style="width: 100%; color: #28323b; font-weight: bold;">{{ leads[0].name }}</span>
                                                <span class="ml-1 align-self-start" style="line-height: 12px; width: 100%; color: #28323b; font-size: 0.8125rem;">{{ leads[0].name }}</span>
                                            </div>
                                            </div>
                                            <!-- put in top right of parent element -->
                                            <div>
                                                <v-btn class="leadIcons" @click="dialog = true;" icon v-on="on" style="">
                                                    <v-icon style="font-size: 1rem;">mdi-tag-plus-outline</v-icon>
                                                </v-btn>
                                                <!--  email button -->
                                                <v-btn class="leadIcons" @click="dialog = true;" icon v-on="on">
                                                    <v-icon style="font-size: 1rem;">mdi-account-plus-outline</v-icon>
                                                </v-btn>
                                                <!--  phone button -->
                                                <v-btn class="leadIcons" @click="dialog = true;" icon v-on="on">
                                                    <v-icon style="font-size: 1rem;">mdi-account-search-outline</v-icon>
                                                </v-btn>
                                                <!-- more -->
                                                <v-menu offset-y>
                                                    <template v-slot:activator="{ on }">
                                                        <v-btn class="leadIcons mr-0" icon v-on="on">
                                                            <v-icon style="font-size: 1rem;">mdi-dots-vertical</v-icon>
                                                        </v-btn>
                                                    </template>
                                                    <v-list>
                                                        <v-list-item @click="dialog = true;">
                                                            <v-list-item-title>View Profile</v-list-item-title>
                                                        </v-list-item>
                                                        <v-list-item @click="dialog = true;">
                                                            <v-list-item-title>View Website</v-list-item-title>
                                                        </v-list-item>
                                                        <v-list-item @click="dialog = true;">
                                                            <v-list-item-title>View Social Media</v-list-item-title>
                                                        </v-list-item>
                                                    </v-list>
                                                </v-menu>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap" style="border-top: thin solid rgba(0, 0, 0, 0.12);">
                                        <div class="d-flex flex-wrap" style="padding: 1rem; width: 33.33%; border-right: thin solid rgba(0, 0, 0, 0.12);">
                                            <span style="width: 100%; color: rgb(40, 50, 59); font-size: 0.8125rem;">
                                                Industry
                                            </span>
                                            <span style="width: 100%; color: rgb(40, 50, 59); font-size: 0.8125rem;">
                                                <b>{{ leads[0].industry }}</b>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-wrap" style="padding: 1rem; width: 33.33%; border-right: thin solid rgba(0, 0, 0, 0.12);">
                                            <span style="width: 100%; color: rgb(40, 50, 59); font-size: 0.8125rem;">
                                                Company Size
                                            </span>
                                            <span style="width: 100%; color: rgb(40, 50, 59); font-size: 0.8125rem;">
                                                <b>{{ leads[0].companySize }}</b>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-wrap" style="padding: 1rem; width: 33.33%;">
                                            <span style="width: 100%; color: rgb(40, 50, 59); font-size: 0.8125rem;">
                                                Lead Score
                                            </span>
                                            <span style="width: 100%; color: rgb(40, 50, 59); font-size: 0.8125rem;">
                                                <b>{{ leads[0].leadScore }}</b>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between" style="font-size: 0.8125rem; margin-top: 1rem;">
                                    <div>Website: <b>{{ leads[0].website.name }}</b></div>
                                    <div class="d-flex align-items-center "><div class="mr-1" style="background-color: #4CAF50; border-radius: 50%; height: 10px; width: 10px;"></div>Last Seen: {{ leads[0].lastSeen }}</div>
                                </div>
                                <v-divider style="color: rgba(0, 0, 0, 0.12);"></v-divider>
                                <div class="d-flex">
                                    <v-btn-toggle variant="outlined" v-model="toggle" mandatory color="#f05628" style="width: 100%;" group>
                                    <v-btn elevation="0" :value="0" active-class="transparent" class="m-0 mr-1 flex-grow-1 button-background" style="border-radius: 0px; font-size: 0.75rem; font-weight: 700; text-decoration: none; text-transform: none !important; letter-spacing: 0; text-indent: 0; height: 36px; ">
                                        Activity
                                    </v-btn>
                                    <v-btn elevation="0" :value="1" active-class="transparent" class="m-0 mx-1 flex-grow-1 button-background" style="border-radius: 0px; font-size: 0.75rem; font-weight: 700; text-decoration: none; text-transform: none !important; letter-spacing: 0; text-indent: 0; height: 36px; ">
                                        Contacts
                                    </v-btn>
                                    <v-btn elevation="0" :value="2" active-class="transparent" class="m-0 mx-1 flex-grow-1 button-background" style="border-radius: 0px; font-size: 0.75rem; font-weight: 700; text-decoration: none; text-transform: none !important; letter-spacing: 0; text-indent: 0; height: 36px; ">
                                        More Info
                                    </v-btn>
                                    <v-btn elevation="0" :value="3" active-class="transparent" class="m-0 ml-1 flex-grow-1 button-background" style="border-radius: 0px; font-size: 0.75rem; font-weight: 700; text-decoration: none; text-transform: none !important; letter-spacing: 0; text-indent: 0; height: 36px; ">
                                        Your Notes
                                    </v-btn>
                                    </v-btn-toggle>
                                </div>
                                <div style="margin-top: 1rem;" v-if="toggle == 0">
                                    <b><span style="font-size: 1rem; color: #28323b;">Visitor Activity</span></b>
                                </div>
                                <div class="d-flex mt-3" style="border-radius: 8px;" v-if="toggle == 0">
                                    <!-- 3 metrics blocks -->
                                    <div class="col-4 flex-grow-1 d-flex flex-wrap" style="border: thin solid rgba(0, 0, 0, 0.12); padding: 1rem; border-radius: 8px 0px 0px 8px;">
                                        <span style="width:100%; font-size: 0.8125rem; color: #28323b;">Visits</span>
                                        <span style="font-size: 3rem; color: #28323b; font-weight: 700; line-height: 3rem;">{{ leads[0].visit_count }}</span>
                                    </div>
                                    <div class="col-4 flex-grow-1" style="border-top: thin solid rgba(0, 0, 0, 0.12); border-bottom: thin solid rgba(0, 0, 0, 0.12); padding: 1rem;">
                                        <span style="width:100%; font-size: 0.8125rem; color: #28323b;">Visitors</span>
                                        <span style="font-size: 3rem; color: #28323b; font-weight: 700; line-height: 3rem;">{{ leads[0].visitors }}</span>
                                    </div>
                                    <div class="col-4 flex-grow-1" style="border: thin solid rgba(0, 0, 0, 0.12); padding: 1rem; border-radius: 0px 8px 8px 0px;">
                                        <span style="width:100%; font-size: 0.8125rem; color: #28323b;">Total Duration</span>
                                        <span style="font-size: 3rem; color: #28323b; font-weight: 700; line-height: 3rem;">{{ leads[0].totalDuration }}</span>
                                    </div>   
                                </div>
                                <div style="margin-top: 1rem;" v-if="toggle == 0">
                                    <b><span style="font-size: 0.8125rem; color: #28323b;">Top Pages Visited</span></b>
                                </div>
                                <div v-if="toggle == 0">
                                    <v-card style="margin-top: 1rem; border-radius: 8px;" elevation="0">
                                            <div>
                                                <div>
                                                    <div class="d-flex align-items-center" style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.5rem; border: thin solid rgba(0, 0, 0, 0.12); border-radius: 8px 8px 0px 0px;">
                                                        <div>
                                                            <span style="font-size: 0.8125rem; text-decoration: underline; font-weight: bold; color: #2196F3; cursor: pointer;">/Pricing</span>
                                                            <v-icon style="font-size:  0.8125rem; color: #2196F3; cursor: pointer;">mdi-open-in-new</v-icon>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center" style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.5rem; border: thin solid rgba(0, 0, 0, 0.12); border-radius: 0px 0px 0px 0px; border-bottom: 0px; border-top: 0px;">
                                                        <div>
                                                            <span style="font-size: 0.8125rem; text-decoration: underline; font-weight: bold; color: #2196F3; cursor: pointer;">/Demo</span>
                                                            <v-icon style="font-size:  0.8125rem; color: #2196F3; cursor: pointer;">mdi-open-in-new</v-icon>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center" style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.5rem; border: thin solid rgba(0, 0, 0, 0.12); border-radius: 0px 0px 8px 8px;">
                                                        <div>
                                                            <span style="font-size: 0.8125rem; text-decoration: underline; font-weight: bold; color: #2196F3; cursor: pointer;">/Contact-Us</span>
                                                            <!-- icon for new tab -->
                                                            <v-icon style="font-size:  0.8125rem; color: #2196F3; cursor: pointer;">mdi-open-in-new</v-icon>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </v-card> 
                                </div>
                                <div style="margin-top: 1rem;" v-if="toggle == 0">
                                    <b><span style="font-size: 0.8125rem; color: #28323b;">Top Sources</span></b>
                                </div>
                                <div v-if="toggle == 0">
                                    <v-card style="margin-top: 1rem; border-radius: 8px;" elevation="0">
                                            <div>
                                                <div>
                                                    <div class="d-flex align-items-center" style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.5rem; border: thin solid rgba(0, 0, 0, 0.12); border-radius: 8px 8px 0px 0px;">
                                                        <div>
                                                            <span style="font-size: 0.8125rem; font-weight: bold; color: #28323b;">Google</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center" style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.5rem; border: thin solid rgba(0, 0, 0, 0.12); border-radius: 0px 0px 0px 0px; border-bottom: 0px; border-top: 0px;">
                                                        <div>
                                                            <span style="font-size: 0.8125rem; font-weight: bold; color: #28323b;">Facebook</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center" style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.5rem; border: thin solid rgba(0, 0, 0, 0.12); border-radius: 0px 0px 8px 8px;">
                                                        <div>
                                                            <span style="font-size: 0.8125rem; font-weight: bold; color: #28323b;">Direct</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </v-card> 
                                </div>

                                <div style="margin-top: 1rem;" v-if="toggle == 1">
                                    <b><span style="font-size: 1rem; color: #28323b;">Find Contacts</span></b>
                                </div>
                                <div style="margin-top: 1rem;" v-if="toggle == 2">
                                    <b><span style="font-size: 1rem; color: #28323b;">Company Information</span></b>
                                </div>
                                <div style="margin-top: 1rem;" v-if="toggle == 3">
                                    <b><span style="font-size: 1rem; color: #28323b;">Your Notes</span></b>
                                </div>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-dialog>
        </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            this.getUserDetails();
        },
        data(){
            return {
                toggle: 0,
                headers: [
                    {
                        text: 'Company',
                        align: 'start',
                        sortable: false,
                        value: 'name',
                    },
                    { text: 'Visits', value: 'visit_count' },
                    { text: 'Website', value: 'website_name' },
                    { text: 'Location', value: 'location' },
                    { text: 'Lead Score', value: 'LeadScore' },
                    { text: 'Last Seen', value: 'last_seen' },
                    { text: '', value: 'details', sortable: false, align: 'end' },
                    
                ],
                search: '',
                dialog: true,
                user: {
                    current_team: {},
                },
                loading: false,
                leads: [],
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
        methods:{
            getUserDetails(){
                this.loading = true;
                let route = '../api/app/';
                this.$http.get(route, {withCredentials: true}).then((res) => {
                    this.user = res.data[0];
                    this.getLeads();
                })
            },
            getLeads(){
                this.loading = true;
                // append id from user object to route
                let route = '../api/teams/leads/{team_id}';

                // replace team_id with id from user object
                route = route.replace('{team_id}', this.user.current_team_id);
                
                this.$http.get(route, {withCredentials: true}).then((res) => {
                    this.leads = res.data;
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

.halfDialog{
    width: 40% !important;
    position: absolute;
    top: 0px !important;
    right: 0px !important;
    bottom: 0px !important;
    margin: 0px !important;
    min-height: 100vh !important;
    height: 100% !important;
    max-width: 650px !important;
}

.v-dialog--fullscreen{
    width: 50%;
    position: absolute;
    top: 0px;
    right: 0px;
    bottom: 0px;
    margin: 0px;
    min-height: 100vh;
    height: 100% !important;
    left: unset !important;
}

.leadIcons{
    width: 30px !important;
    height: 30px !important;
    border: thin solid lightgrey !important;
    margin-right: 0.25rem;
}

.v-btn-toggle--group > .v-btn.v-btn.button-background{
    background-color: #F5F5F5 !important;
}

.v-btn-toggle--group > .v-btn.v-btn.transparent{
    background-color: transparent !important;
}


</style>
