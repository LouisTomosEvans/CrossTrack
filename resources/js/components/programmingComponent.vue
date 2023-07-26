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
                <v-btn-toggle :color="appStore.primary_color" group style="background-color: white; border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);" class="d-flex" dense outlined mandatory>
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
                    <!-- add filter menu -->
                    <v-menu offset-y>
                        <template v-slot:activator="{ on }">
                            <v-btn text color="#28323b" elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none; margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;" v-on="on">
                                <v-icon class="mr-1">mdi-filter-outline</v-icon>
                                <span>Filter</span>
                            </v-btn>
                        </template>
                        <v-list dense class="mt-0 p-0">
                        <!-- heading -->
                        <v-list-item style="background-color: #F5F5F5;">
                        <v-list-item-content>
                            <v-list-item-title style="font-weight: 700;">Lead Filters</v-list-item-title>
                        </v-list-item-content>
                        </v-list-item>
                        <v-list-item  style="cursor: pointer;" @click="assignDialog = true; assignItem = leadItem">
                        <v-list-item-content>
                            <v-list-item-title>
                                Website
                            </v-list-item-title>
                        </v-list-item-content>
                        <v-list-item-icon>
                        <v-icon style="font-size: 1.2rem">mdi-chevron-right</v-icon>
                        </v-list-item-icon>
                        </v-list-item>
                        <v-list-item style="cursor: pointer;" @click="tagItem = leadItem; formatTags(tagItem.tags); tagDialog = true;">
                        <v-list-item-content>
                            <v-list-item-title>
                                Industry
                            </v-list-item-title>
                        </v-list-item-content>
                        <v-list-item-icon>
                        <v-icon style="font-size: 1.2rem">mdi-chevron-right</v-icon>
                        </v-list-item-icon>
                        </v-list-item>
                        <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title>
                                Tags
                            </v-list-item-title>
                        </v-list-item-content>
                        <v-list-item-icon>
                        <v-icon style="font-size: 1.2rem">mdi-chevron-right</v-icon>
                        </v-list-item-icon>
                        </v-list-item >
                        <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title>
                                Company Size
                            </v-list-item-title>
                        </v-list-item-content>
                        <v-list-item-icon>
                        <v-icon style="font-size: 1.2rem">mdi-chevron-right</v-icon>
                        </v-list-item-icon>
                        </v-list-item>
                        <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title>
                                Lead Score
                            </v-list-item-title>
                        </v-list-item-content>
                        <v-list-item-icon>
                        <v-icon style="font-size: 1.2rem">mdi-chevron-right</v-icon>
                        </v-list-item-icon>
                        </v-list-item>
                        </v-list>
                    </v-menu>
                    
                    <!-- <v-btn text color="#28323b" elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon class="mr-1">mdi-pencil-outline</v-icon>
                        <span>Data points</span>
                    </v-btn> -->
                    <v-btn text color="#28323b" elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon class="mr-1">mdi-download-outline</v-icon>
                        <span>Download</span>
                    </v-btn>
                    <v-btn elevation=0 tile style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon color="#28323b">mdi-dots-vertical</v-icon>
                    </v-btn>
                </div>
                
            </div>
            <v-dialog
                v-model="assignDialog"
                persistent
                max-width="550px"
                >
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                    <v-card-title style="border-bottom: solid 1px lightgrey; margin-bottom: 1rem;">
                        <b><span style="font-size: 1rem; color: #28323b;">Assign User to Lead</span></b>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="12">
                                <span style="color: #28323b; font-size: 0.8125rem;">To add a new team member, simply enter their email address, and select the role you want them to have. Once you've added the new team member, they'll receive an email with instructions to set up their account and confirm their membership.</span>
                            </v-col>
                        </v-row>
                        <v-row class="pt-0">
                            <v-col cols="12" class="pt-0">
                                <!-- drop down for category -->
                                <v-combobox
                                    :color="appStore.primary_color"
                                    :items="teamStore.members"
                                    v-model="assignItem.users"
                                    placeholder="Select users to assign to lead"
                                    dense
                                    elevation=0
                                    style="width: 100%;"
                                    item-text="name"
                                    item-value="id"
                                    multiple
                                    small-chips
                                    >
                                    <template v-slot:selection="data">
                                        <v-chip
                                            v-bind="data.attrs"
                                            :input-value="data.selected"
                                            close
                                            class="mb-2"
                                            :color="appStore.primary_color"
                                            text-color="white"
                                            dark
                                            @click:close="data.parent.selectItem(data.item)"
                                        >
                                            <span style="font-size: 0.8125rem; color: white; font-weight: 600;">
                                                {{ data.item.name }}
                                            </span>
                                            
                                        </v-chip>
                                    </template>
                                </v-combobox>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <v-card-actions class="pt-0 pb-4">
                    <v-spacer></v-spacer>
                    <v-btn @click="assignDialog = false; assignItem = {};" outlined elevation=0 :color="appStore.primary_color" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>Close</span>
                    </v-btn>
                    <v-btn @click="assignLead()" class="px-4" elevation=0 :color="appStore.primary_color" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span style="color: #FFFFFF;" >Save Changes</span>
                    </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog
                v-model="tagDialog"
                persistent
                max-width="550px"
                >
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                    <v-card-title style="border-bottom: solid 1px lightgrey; margin-bottom: 1rem;">
                        <b><span style="font-size: 1rem; color: #28323b;">Assign Tags to Lead</span></b>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="12">
                                <span style="color: #28323b; font-size: 0.8125rem;">To add a new team member, simply enter their email address, and select the role you want them to have. Once you've added the new team member, they'll receive an email with instructions to set up their account and confirm their membership.</span>
                            </v-col>
                        </v-row>
                        <v-row class="pt-0">
                            <v-col cols="12" class="pt-0">
                                <!-- drop down for category -->
                                <v-combobox
                                    :color="appStore.primary_color"
                                    v-model="tagItemTags"
                                    :search-input.sync="tagSearch"
                                    :filter="customFilter"
                                    placeholder="Select tags to assign to lead"
                                    :items="availableTags"
                                    dense
                                    elevation=0
                                    style="width: 100%;"
                                    multiple
                                    chips
                                    clearable
                                    hide-selected
                                    small-chips
                                    >
                                    <!-- <template v-slot:selection="data">
                                        <v-chip
                                            v-bind="data.attrs"
                                            :input-value="data.selected"
                                            close
                                            style="background-color: #f05628;"
                                            class="mb-1"
                                            @click:close="data.parent.selectItem(data.item)"
                                        >
                                            <span style="font-size: 0.8125rem; color: white; font-weight: 600;">
                                                {{ data.item.name[appStore.locale] }}
                                            </span>
                                            
                                        </v-chip>
                                    </template> -->
                                    <template v-slot:no-data>
                                        <v-list-item>
                                        <span style="font-size: 0.825rem; margin-right: 0.25rem;">Create</span>
                                        <v-chip
                                            :color="`${colors[noiceOver - 1]}`"
                                            label
                                            small
                                        >
                                            {{ tagSearch }}
                                        </v-chip>
                                        </v-list-item>
                                    </template>
                                    <template v-slot:item="{ index, item }">
                                    <v-chip
                                    :color="`${item.color}`"
                                    label
                                    small
                                    >
                                    {{ item.name[appStore.locale] }}
                                    </v-chip>
                                    </template>
                                    <template v-slot:selection="{ attrs, item, parent, selected }">
                                        <v-chip
                                        v-if="item == Object(item)"
                                        v-bind="attrs"
                                        :color="`${item.color}`"
                                        :input-value="selected"
                                        label
                                        small
                                        class="mb-2"
                                        >
                                        <span class="pr-2">
                                            {{ item.text }}
                                        </span>
                                        <v-icon
                                            small
                                            @click="parent.selectItem(item)"
                                        >
                                            $delete
                                        </v-icon>
                                        </v-chip>
                                    </template>
                                </v-combobox>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <v-card-actions class="pt-0 pb-4">
                    <v-spacer></v-spacer>
                    <v-btn @click="tagDialog = false; tagItem = {};" outlined elevation=0 :color="appStore.primary_color" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>Close</span>
                    </v-btn>
                    <v-btn @click="tagLead()" class="px-4" elevation=0 :color="appStore.primary_color" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span style="color: #FFFFFF;" >Save Changes</span>
                    </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <div class="col-12 d-flex justify-content-between align=content-center" style="padding-bottom: 0rem;">
                <div class="p-0 m-0" style="width: 35%;">
                    <v-text-field :color="appStore.primary_color" label="Search your company leads ex. Amazon" clearable dense v-model="search" height="40px" solo elevation=0 append-icon="mdi-magnify" single-line hide-details style="width: 100%; border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1) !important;">
                        <template v-slot:label>
                            <strong>Search your company leads </strong>ex. Amazon
                        </template>
                    </v-text-field>
                </div>
                <div class="d-flex align-items-end" v-if="leadStore.leads.length > tableOptions.itemsPerPage">
                    <span style="color: #28323b; font-size: 0.8125rem;">Showing <b>{{ tableOptions.itemsPerPage }} of your leads</b> out of {{leadStore.leads.length}}</span>
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
                        :items="leadStore.leads"
                        :search="search"
                        :options.sync="tableOptions"
                        :footer-props="footerOptions"
                        :custom-filter="customTableFilter"
                        class="elevation-0 custom-data-table"
                        :color="appStore.primary_color"
                        :loading="loading"
                        loading-text="Loading your leads... Please wait"
                        :checkbox-color="appStore.primary_color"
                        style="border-radius: 8px;  border: thin solid rgba(0,0,0,.12);"
                        >
                        <!-- loading -->
                        <template slot="progress">
                            <v-progress-linear :color="appStore.primary_color" indeterminate></v-progress-linear>
                        </template>
                        <template v-slot:item.name="{ item }">
                        <div v-if="item" class="d-flex align-items-center" style="width: fit-content">
                                <!-- website icon -->
                                <v-avatar class="mr-1" size="30" color="info" v-if="!item.logo">
                                    <!-- 0.75 size -->
                                    <v-icon color="white" style="font-size: 0.95rem;">mdi-web</v-icon>
                                </v-avatar>
                                <!-- show favicon -->
                                <div class="mr-1" style="height: 30px; width: 30px;" v-else>
                                    <!-- 0.75 size -->
                                    <img :src="getFaviconURL(item.logo)" style="width: 30px; height: 30px; border-radius: 4px;">
                                </div>
                                <div class="d-flex flex-wrap" style="width: fit-content">
                                    <span class="ml-1 w-100" style="color: #28323b; font-size: 0.8125rem;">{{ item.name }}</span>
                                    <a @click="goTo(item.domain)" class="ml-1" style="color: #2196F3; font-size: 0.75rem; opacity: 0.75;">{{ item.domain }}<v-icon class="ml-1" style="color: #2196F3 !important; font-size: 0.825rem; opacity: 0.75;">mdi-open-in-new</v-icon></a>
                                </div>
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
                                    <v-btn @click="dialog = true; leadItem = item" icon v-on="on">
                                        <v-icon>mdi-chevron-right</v-icon>
                                    </v-btn>
                        </template>
                        <!-- website -->
                        <template v-slot:item.website_name="{ item }">
                            <div v-if="item" class="d-flex align-items-center">
                                <!-- website icon -->
                                <v-avatar class="mr-1" rounded size="30" color="info" v-if="!item.website_favicon">
                                    <!-- 0.75 size -->
                                    <v-icon color="white" style="font-size: 0.95rem;">mdi-domain</v-icon>
                                </v-avatar>
                                <!-- show favicon -->
                                <div class="mr-1" style="height: 30px; width: 30px;" v-else>
                                    <!-- 0.75 size -->
                                    <img :src="getFaviconURL(item.website_favicon)" style="width: 30px; height: 30px; border-radius: 4px;">
                                </div>
                                <div class="d-flex flex-wrap" style="width: fit-content">
                                    <span class="ml-1 w-100" style="color: #28323b; font-size: 0.8125rem;">{{ item.website_name }}</span>
                                    <a @click="goTo(item.website_domain)" class="ml-1" style="color: #2196F3; font-size: 0.75rem; opacity: 0.75;">{{ item.website_domain }}<v-icon class="ml-1" style="color: #2196F3 !important; font-size: 0.825rem; opacity: 0.75;">mdi-open-in-new</v-icon></a>
                                </div>
                            </div>
                        </template>
                        <!-- location -->
                        <template v-slot:item.location="{ item }">
                            <div v-if="item">
                                <span  style="color: #28323b; font-size: 0.8125rem;">{{ item.location }}</span>
                            </div>
                        </template>
                        <!-- visits -->
                        <template v-slot:item.visit_count="{ item }">
                            <div v-if="item">
                                <span style="color: #28323b; font-size: 0.8125rem;">{{ item.visit_count }}</span>
                            </div>
                        </template>
                        <!-- lead score - linear bar -->
                        <template v-slot:item.lead_score="{ item }">
                            <div class="d-flex align-items-center justify-content-start" v-if="item">
                                <span class="mr-1" style="color: #28323b; font-size: 0.8125rem; width: 25px; text-align: right;">{{ float2int(item.lead_score.score) }}</span>
                                <v-progress-linear
                                :value="item.lead_score.score"
                                :color="getLeadScoreColor(item.lead_score.score)"
                                height="0.5rem"
                                :id="item.id"
                                rounded
                                class="mr-3"
                                style="width: 50px;"
                                ></v-progress-linear>
                            </div>
                        </template>

                        <template v-slot:item.users="{ item }">
                            <!-- for each users disply their avatar -->
                            <div v-if="item.users.length > 0" class="d-flex align-items-center">

                                <div v-for="(user, index) in item.users" :key="user.id" class="avatar-container" :class="{'avatar-overlap': index > 0}" :style="{left: index > 0 ? (-10 * index) + 'px' : ''}">
                                    <!-- show avatar -->
                                    <v-tooltip bottom>
                                        <template v-slot:activator="{ on, attrs }">
                                            <div class="avatar" v-bind="attrs" v-on="on">
                                                <!-- 0.75 size -->
                                                <img alt="Avatar" :src="getAvatar(user.name)">
                                            </div>
                                        </template>
                                        <span>{{ user.name }}</span>
                                    </v-tooltip>
                                </div>
                            </div>
                            <div v-else>
                                <!-- circle with plud in it to add users -->
                                <!-- 0.75 size -->
                                <v-icon @click="assignDialog = true; assignItem = item" :style="'font-size: 20px; cursor: pointer; color: ' + appStore.primary_color + '; opacity: 0.6 !important;'">mdi-plus-circle</v-icon>
                            </div>
                        </template>

                        <template v-slot:item.tags="{ item }">
                            <!-- for each users disply their avatar -->
                            <div v-if="item.tags.length > 0" class="d-flex align-items-center">

                                <div v-for="(tag, index) in item.tags" :key="tag.id">
                                    <!-- show avatar -->
                                    <v-chip label small class="mr-2" :color="`${tag.color}`" style="font-size: 0.75rem; font-weight: 400; text-decoration: none; border-radius: 8px;">
                                        {{ tag.name[appStore.locale] }}
                                    </v-chip>
                                </div>
                            </div>
                            <div v-else>
                                <!-- circle with plud in it to add users -->
                                <!-- 0.75 size -->
                                <v-icon @click="tagDialog = true; tagItem = item" :style="'font-size: 20px; cursor: pointer; color: ' + appStore.primary_color + '; opacity: 0.6 !important;'">mdi-plus-circle</v-icon>
                            </div>
                        </template>

                        </v-data-table>
                        <!-- data table -->

                    </div>
                </v-card>
            </div>

            <!-- v-overlay -->
            <v-overlay :value="dialog || filterDialog || assignDialog || tagDialog">
                
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
                        <v-btn @click="dialog=false" icon tile class="mr-3">
                            <v-icon>mdi-arrow-collapse-right</v-icon>
                        </v-btn>
                        <b><span style="font-size: 1rem; color: #28323b;">Lead Details</span></b>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="12">
                                <div style="margin-top: 1rem; border: thin solid whitesmoke; border-radius: 8px;">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-start justify-content-between" style="margin: 1rem; width: 100%;">
                                            <div class="m-0 p-0 d-flex" style="max-width: 75%;">
                                            <v-avatar rounded size="45" class="mr-1" color="info" v-if="!leadItem.logo">
                                                <!-- 0.75 size -->
                                                <v-icon color="white" style="font-size: 1.2rem;">mdi-domain</v-icon>
                                            </v-avatar>
                                            <!-- show favicon -->
                                            <div class="mr-1" style="height: 45px; width: 45px;" v-else>
                                                <!-- 0.75 size -->
                                                <img :src="getFaviconURL(leadItem.logo)" style="width: 45px; height: 45px; border-radius: 4px;">
                                            </div>
                                            <div class="d-flex flex-wrap align-self-center">
                                                <span class="ml-1 align-self-end" style="width: 100%; color: #28323b; font-weight: bold; font-size: 1.5rem;">{{ leadItem.name }}</span>
                                                <span class="ml-1 align-self-start" @click="formatDomain(leadItem.domain)" style="width: 100%; color: #2196F3; font-size: 0.8125rem; text-decoration: underline; cursor: pointer;">{{ leadItem.domain }}<v-icon class="ml-1" style="color: #2196F3 !important; font-size: 0.9rem;">mdi-open-in-new</v-icon></span>
                                            </div>
                                            </div>
                                            <!-- put in top right of parent element -->
                                            <div>
                                                <!-- more -->
                                                <v-menu offset-y nudge-left="150px">
                                                    <template v-slot:activator="{ on }">
                                                        <v-btn class="leadIcons mr-0" icon>
                                                            <v-icon v-on="on" style="font-size: 1rem;">mdi-dots-vertical</v-icon>
                                                        </v-btn>
                                                    </template>
                                                    <v-list dense class="mt-0 p-0">
                                                    <!-- heading -->
                                                    <v-list-item style="background-color: #F5F5F5;">
                                                    <v-list-item-content>
                                                        <v-list-item-title style="font-weight: 700;">Lead Actions</v-list-item-title>
                                                    </v-list-item-content>
                                                    </v-list-item>
                                                    <v-list-item  style="cursor: pointer;" @click="assignDialog = true; assignItem = leadItem">
                                                    <v-list-item-content>
                                                        <v-list-item-title>
                                                            Edit Lead Assignments
                                                        </v-list-item-title>
                                                    </v-list-item-content>
                                                    </v-list-item>
                                                    <v-list-item style="cursor: pointer;" @click="tagItem = leadItem; formatTags(tagItem.tags); tagDialog = true;">
                                                    <v-list-item-content>
                                                        <v-list-item-title>
                                                            Edit Lead Tags
                                                        </v-list-item-title>
                                                    </v-list-item-content>
                                                    </v-list-item>
                                                    <!-- divider -->
                                                    <v-divider class="my-1"></v-divider>
                                                    <v-list-item v-if="leadItem.active == 0" style="cursor: pointer;" @click="activateLeadDialog = true; activateLead = leadItem">
                                                    <v-list-item-content>
                                                        <v-list-item-title>
                                                            Un-Archive Lead
                                                        </v-list-item-title>
                                                    </v-list-item-content>
                                                    </v-list-item >
                                                    <v-list-item v-if="leadItem.active == 1" style="cursor: pointer;" @click="deactivateLeadDialog = true; deactivateLead = leadItem">
                                                    <v-list-item-content>
                                                        <v-list-item-title>
                                                            Archive Lead
                                                        </v-list-item-title>
                                                    </v-list-item-content>
                                                    </v-list-item>
                                                    </v-list>
                                                </v-menu>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap" style="border-top: thin solid whitesmoke;">
                                        <div class="d-flex flex-wrap align-content-start" style="padding: 1rem; width: 33.33%; border-right: thin solid whitesmoke;">
                                            <span style="width: 100%; color: rgb(40, 50, 59); font-size: 0.8125rem; height: 22px; opacity: 0.75;">
                                                Industry
                                            </span>
                                            <span v-if="leadItem.industry" style="width: 100%; color: rgb(40, 50, 59); font-size: 0.8125rem; font-weight: 600;">
                                                {{ readableIndustry(leadItem.industry) }}
                                            </span>
                                            <span v-else style="width: 100%; color: rgb(40, 50, 59); font-size: 0.8125rem; font-weight: 600;">
                                                Unknown
                                            </span>
                                        </div>
                                        <div class="d-flex flex-wrap align-content-start" style="padding: 1rem; width: 33.33%; border-right: thin solid whitesmoke;">
                                            <span style="width: 100%; color: rgb(40, 50, 59); font-size: 0.8125rem; height: 22px; opacity: 0.75;">
                                                Company Size
                                            </span>
                                            <span v-if="leadItem.size" style="width: 100%; color: rgb(40, 50, 59); font-size: 0.8125rem; font-weight: 600;">
                                                {{ leadItem.size }}
                                            </span>
                                            <span v-else style="width: 100%; color: rgb(40, 50, 59); font-size: 0.8125rem; font-weight: 600;">
                                                Unknown
                                            </span>
                                        </div>
                                        <div class="d-flex flex-wrap align-content-start" style="padding: 1rem; width: 33.33%;">
                                            <span v-if="leadItem.lead_score" style="width: 100%; color: rgb(40, 50, 59); font-size: 0.8125rem; height: 22px;">
                                                Lead Score
                                            </span>
                                            <span class="d-flex align-items-center" style="width: 100%; color: rgb(40, 50, 59); font-size: 0.8125rem;">
                                                <span class="mr-2" style="opacity: 0.75; font-weight: 600;">{{ float2int(leadItem.lead_score.score) }}</span>
                                                <!-- progress circular -->
                                                <v-progress-linear
                                                :value="leadItem.lead_score.score"
                                                :color="getLeadScoreColor(leadItem.lead_score.score)"
                                                height="0.5rem"
                                                rounded
                                                class="mr-3"
                                                style="width: 50px;"
                                                ></v-progress-linear>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between" v-if="leadItem.website" style="font-size: 0.8125rem; margin-top: 1rem;">
                                    <div>Website: {{ leadItem.website.name }}</div>
                                    <!-- <div class="mr-1" style="background-color: #4CAF50; border-radius: 50%; height: 10px; width: 10px;"></div> -->
                                    <div class="d-flex align-items-center ">Last Seen: {{ leadItem.last_seen }}</div>
                                </div>
                                <!-- divider -->
                                <v-divider class="my-3" style="width: 100%; color: whitesmoke;"></v-divider>
                                <div class="d-flex mb-6">
                                    <v-btn-toggle variant="outlined" v-model="toggle" active-class="transparent" mandatory :color="appStore.primary_color" style="width: 100%; border: thin solid whitesmoke;" group>
                                    <v-btn elevation="0" :value="0" active-class="transparent" class="m-0 mr-1 flex-grow-1 button-background" style="border-radius: 0px; font-size: 0.75rem; font-weight: 700; text-decoration: none; text-transform: none !important; letter-spacing: 0; text-indent: 0; height: 36px; ">
                                        Activity
                                    </v-btn>
                                    <v-btn elevation="0" :value="1" active-class="transparent" class="m-0 mx-1 flex-grow-1 button-background" style="border-radius: 0px; font-size: 0.75rem; font-weight: 700; text-decoration: none; text-transform: none !important; letter-spacing: 0; text-indent: 0; height: 36px; ">
                                        Contacts
                                    </v-btn>
                                    <v-btn elevation="0" :value="2" active-class="transparent" class="m-0 mx-1 flex-grow-1 button-background" style="border-radius: 0px; font-size: 0.75rem; font-weight: 700; text-decoration: none; text-transform: none !important; letter-spacing: 0; text-indent: 0; height: 36px; ">
                                        Company Details
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
                                    <div class="col-4 flex-grow-1 d-flex flex-wrap" style="border: thin solid whitesmoke; padding: 1rem; border-radius: 8px 0px 0px 8px;">
                                        <span style="width:100%; font-size: 0.8125rem; color: #28323b;">Visits</span>
                                        <span style="font-size: 2.5rem; color: #28323b; font-weight: 700; line-height: 3rem;">{{ leadItem.visit_count }}</span>
                                    </div>
                                    <div class="col-4 flex-grow-1 d-flex flex-wrap" style="border-top: thin solid whitesmoke; border-bottom: thin solid whitesmoke; padding: 1rem;">
                                        <span style="width:100%; font-size: 0.8125rem; color: #28323b;">Visitors</span>
                                        <span style="font-size: 2.5rem; color: #28323b; font-weight: 700; line-height: 3rem;">{{ leadItem.unique_visitors }}</span>
                                    </div>
                                    <div class="col-4 flex-grow-1 d-flex flex-wrap" style="border: thin solid whitesmoke; padding: 1rem; border-radius: 0px 8px 8px 0px;">
                                        <span style="width:100%; font-size: 0.8125rem; color: #28323b;">Total Duration</span>
                                        <span style="font-size: 2.5rem; color: #28323b; font-weight: 700; line-height: 3rem;">{{ formatActivityTime(leadItem.total_duration) }}</span>
                                    </div>   
                                </div>
                                <div style="margin-top: 1rem;" v-if="toggle == 0">
                                    <b><span style="font-size: 0.8125rem; color: #28323b;">Top 3 Pages Visited</span></b>
                                </div>
                                <div v-if="toggle == 0">
                                    <v-card style="margin-top: 1rem; border-radius: 8px;" elevation="0">
                                            <div>
                                                <div>
                                                    <!-- for each top_sources on lead item -->
                                                    <div v-for="(value, key) in leadItem.top_pages" :key="value.id" class="source-container">
                                                        <div class="grid-container">
                                                            <span class="truncate align-items-center" @click="goToLink(key)" style="cursor: pointer; font-size: 0.8125rem; font-weight: 600; text-decoration: underline; color: #2196F3;">{{ key }}<v-icon class="ml-1" style="color: #2196F3 !important; font-size: 0.9rem; ">mdi-open-in-new</v-icon></span>
                                                            <span style="font-size: 0.8125rem; color: #28323b;">{{ value }} Visits</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                    </v-card> 
                                </div>
                                <div style="margin-top: 1rem;" v-if="toggle == 0">
                                    <b><span style="font-size: 0.8125rem; color: #28323b;">Top 3 Sources</span></b>
                                </div>
                                <div v-if="toggle == 0">
                                    <v-card style="margin-top: 1rem; border-radius: 8px;" elevation="0">
                                            <div>
                                                <div>
                                                    <!-- for each top_sources on lead item -->
                                                    <div v-for="(value, key) in leadItem.top_sources" :key="value.id" class="source-container">
                                                        <div class="grid-container">
                                                            <span v-if="key != 'unknown'" class="truncate align-items-center" @click="goToLink(key)" style="cursor: pointer; font-size: 0.8125rem; color: #28323b; font-weight: 600; text-decoration: underline; color: #2196F3;">{{ key }}<v-icon class="ml-1" style="color: #2196F3 !important; font-size: 0.9rem; ">mdi-open-in-new</v-icon></span>
                                                            <span v-else class="truncate align-items-center" style="font-size: 0.8125rem; color: #28323b; font-weight: 600;">{{ key }}</span>
                                                            <span style="font-size: 0.8125rem; color: #28323b;">{{ value }} Visits</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                    </v-card> 
                                </div>

                                <div style="margin-top: 1rem;" v-if="toggle == 1">
                                    <b><span style="font-size: 1rem; color: #28323b;">Find Contacts</span></b>
                                    <!-- graphic and button centered on screen -->
                                    <div v-if="!contactsExist" class="d-flex align-items-center justify-content-center flex-wrap" style="margin-top: 3rem; width: 100%;">
                                        <div class="d-flex align-items-center justify-content-center" style="width: 100%;">
                                            <v-img src="https://cdn.vuetifyjs.com/images/cards/docks.jpg" max-width="300" max-height="300" contain></v-img>
                                        </div>
                                        <!-- copy -->
                                        <!-- <div class="d-flex align-items-center justify-content-center" style="width: 100%; margin-top: 1rem;">
                                            <span style="font-size: 0.8125rem; color: #28323b;">Search for contacts who work at this company.</span>
                                        </div> -->
                                        <v-btn @click="searchContacts()" elevation=0 :color="appStore.primary_color" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0; margin-top: 1rem;">
                                            <span style="color: #FFFFFF;">Search for Contacts Working at this Company</span>
                                        </v-btn>
                                    </div>
                                    <!-- if contacts exit list them with avataar name and email -->
                                    <div v-if="contactsExist" class="mt-3">
                                        <div class="pb-3" style="font-size: 0.8125rem; color: #28323b;">These are the contacts we found for <strong>{{ leadItem.domain }}</strong></div>
                                        <div v-for="(contact, index) in leadItem.contacts" :key="contact.id" class="d-flex justify-content-between" style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.5rem; border: thin solid whitesmoke; border-radius: 0px;">
                                            <div class="d-flex align-items-center" :id="'contact-' + index" style="width: 40% !important" >
                                                <div>
                                                    <v-avatar size="30" rounded class="mr-2">
                                                        <img :src="contactAvatar(contact)">
                                                    </v-avatar>
                                                </div>
                                                <div class="d-flex flex-wrap" style="width: fit-content">
                                                    <span v-if="contact.first_name && contact.last_name" class="w-100" style="line-height: 1; font-size: 0.8125rem; color: #28323b;">{{contact.first_name + " " + contact.last_name}}</span>
                                                    <span v-else class="w-100" style="line-height: 1; font-size: 0.8125rem; color: #28323b;">- -</span>
                                                    <span style="font-size: 0.75rem; opacity: 0.75; color: #28323b; line-height: 1.2;">{{contact.value}}</span><div v-if="contact.phone_number" style="font-size: 0.75rem; opacity: 0.75; color: #28323b; line-height: 1.2;" class="mx-1">|</div><span v-if="contact.phone_number" style="font-size: 0.75rem; opacity: 0.75; color: #28323b; line-height: 1.2;">{{ contact.phone_number }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center" style="width: 40% !important">
                                                <div  class="d-flex flex-wrap" style="width: fit-content">
                                                    <span v-if="contact.seniority || contact.position" class="w-100" style="line-height: 1; font-size: 0.8125rem; color: #28323b;">{{titleCase(contact.seniority + " " + contact.position)}}</span>
                                                    <span v-else class="w-100" style="line-height: 1; font-size: 0.8125rem; color: #28323b;">Position Unknown</span>
                                                    <span v-if="contact.department" style="font-size: 0.75rem; opacity: 0.75; color: #28323b; line-height: 1.2;">{{ titleCase(contact.department)}}</span>
                                                    <span v-if="!contact.department" class="w-100" style="line-height: 1; font-size: 0.8125rem; color: #28323b; opacity: 0.75;">Department Unknown</span>
                                                </div>
                                            </div>
                                            <!-- social icons -->
                                            <div class="d-flex align-items-center pr-3">
                                                <div @click="goTo(contact.linkedin)" class="m-1 p-1" :style="'background-color:' + (contact.linkedin ? '#0077B5;' : '#D3D3D3;') + 'border-radius: 4px; cursor: ' + (contact.linkedin ? 'pointer;' : 'unset;')">
                                                    <v-icon style="font-size: 1rem; color: #ffffff;">mdi-linkedin</v-icon>
                                                </div>
                                                <div @click="goTo(contact.twitter, 'twitter')" class="m-1 p-1 " :style="'background-color: '+ (contact.twitter ? '#1C9CEA;' : '#D3D3D3;') + 'border-radius: 4px; cursor: ' + (contact.twitter ? ' pointer;' : ' unset;')">
                                                    <v-icon style="font-size: 1rem; color: #ffffff;">mdi-twitter</v-icon>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-top: 1rem;" v-if="toggle == 2">
                                    <b><span style="font-size: 1rem; color: #28323b;">Company Details</span></b>
                                    <div class="mt-3">
                                        <!-- company name title -->
                                        <div style="font-size: 0.8125rem; color: #28323b;"><b>{{ leadItem.name }}</b></div>

                                        <!-- compnay descripiton title -->
                                        <div style="font-size: 0.8125rem; color: #28323b;">{{ leadItem.description }}</div>
                                    </div>
                                    <div class="mt-6">
                                        <!-- company socials title -->
                                        <div style="font-size: 0.8125rem; color: #28323b;"><b>Company Website</b></div>
                                        <div class="d-flex align-items-center">
                                            <div @click="goTo(leadItem.domain)" style="font-size: 0.8125rem; color: #2196F3; text-decoration: underline; cursor: pointer;">{{ leadItem.domain }}<v-icon class="ml-1" style="color: #2196F3 !important; font-size: 0.9rem; ">mdi-open-in-new</v-icon></div>
                                        </div>
                                    </div>
                                    <div class="mt-6">
                                        <!-- company socials title -->
                                        <div style="font-size: 0.8125rem; color: #28323b;"><b>Company Social Media</b></div>
                                        <div class="d-flex align-items-center">
                                            <div @click="goTo(leadItem.linkedin_url)" class="m-1 p-1 ml-0" :style="'background-color:' + (leadItem.linkedin_url ? '#0077B5;' : '#D3D3D3;') + 'border-radius: 4px; cursor: ' + (leadItem.linkedin_url ? 'pointer;' : 'unset;')">
                                                <v-icon style="font-size: 1rem; color: #ffffff;">mdi-linkedin</v-icon>
                                            </div>
                                            <div @click="goTo(leadItem.twitter_url)" class="m-1 p-1 " :style="'background-color: '+ (leadItem.twitter_url ? '#1C9CEA;' : '#D3D3D3;') + 'border-radius: 4px; cursor: ' + (leadItem.twitter_url ? ' pointer;' : ' unset;')">
                                                <v-icon style="font-size: 1rem; color: #ffffff;">mdi-twitter</v-icon>
                                            </div>
                                            <div @click="goTo(leadItem.facebook_url)" class="m-1 p-1 " :style="'background-color: '+ (leadItem.facebook_url ? '#3B5998;' : '#D3D3D3;') + 'border-radius: 4px; cursor: ' + (leadItem.facebook_url ? ' pointer;' : ' unset;')">
                                                <v-icon style="font-size: 1rem; color: #ffffff;">mdi-facebook</v-icon>
                                            </div>
                                            <div @click="goTo(leadItem.instagram_url)" class="m-1 p-1 " :style="'background-color: '+ (leadItem.instagram_url ? '#E1306C;' : '#D3D3D3;') + 'border-radius: 4px; cursor: ' + (leadItem.instagram_url ? ' pointer;' : ' unset;')">
                                                <v-icon style="font-size: 1rem; color: #ffffff;">mdi-instagram</v-icon>
                                            </div>
                                            <!-- youtube -->
                                            <div @click="goTo(leadItem.youtube_url)" class="m-1 p-1 " :style="'background-color: '+ (leadItem.youtube_url ? '#FF0000;' : '#D3D3D3;') + 'border-radius: 4px; cursor: ' + (leadItem.youtube_url ? ' pointer;' : ' unset;')">
                                                <v-icon style="font-size: 1rem; color: #ffffff;">mdi-youtube</v-icon>
                                            </div>
                                            <!-- tiktok -->
                                            <div @click="goTo(leadItem.tiktok_url)" class="m-1 p-1 " :style="'background-color: '+ (leadItem.tiktok_url ? '#000000;' : '#D3D3D3;') + 'border-radius: 4px; cursor: ' + (leadItem.tiktok_url ? ' pointer;' : ' unset;')">
                                                <v-icon style="font-size: 1rem; color: #ffffff;">mdi-music-note</v-icon>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-6">
                                        <!-- company socials title -->
                                        <div style="font-size: 0.8125rem; color: #28323b;"><b>Company Address</b></div>
                                        <div class="d-flex flex-wrap align-items-center">
                                            <div class="w-100" style="font-size: 0.8125rem; color: #28323b;">{{ leadItem.address }}</div>
                                            <!-- city -->
                                            <div class="w-100" style="font-size: 0.8125rem; color: #28323b;">{{ leadItem.city }}</div>
                                            <!-- state -->
                                            <div class="w-100" style="font-size: 0.8125rem; color: #28323b;">{{ leadItem.state }}</div>
                                            <!-- zip -->
                                            <div class="w-100" style="font-size: 0.8125rem; color: #28323b;">{{ leadItem.zip }}</div>
                                        </div>
                                    </div>


                                    
                                </div>
                                <div style="margin-top: 1rem;" v-if="toggle == 3">
                                    <b><span style="font-size: 1rem; color: #28323b;">Your Notes</span></b>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap" style="margin-top: 3rem; width: 100%;">
                                        <div class="d-flex align-items-center justify-content-center" style="width: 100%;">
                                            <v-img src="https://cdn.vuetifyjs.com/images/cards/docks.jpg" max-width="300" max-height="300" contain></v-img>
                                        </div>
                                        <!-- copy -->
                                        <div class="d-flex align-items-center justify-content-center" style="width: 100%; margin-top: 1rem;">
                                            <span style="font-size: 0.8125rem; color: #28323b;">Notes are coming soon!</span>
                                        </div>
                                    </div>
                                </div>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-dialog>
            <v-dialog
                v-model="filterDialog"
                persistent
                max-width="550px"
                >
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                    <v-card-title style="border-bottom: solid 1px lightgrey; margin-bottom: 1rem;">
                        <b><span style="font-size: 1rem; color: #28323b;">Filter by</span></b>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="12">
                                <span style="color: #28323b; font-size: 0.8125rem;">To add a new team member, simply enter their email address, and select the role you want them to have. Once you've added the new team member, they'll receive an email with instructions to set up their account and confirm their membership.</span>
                            </v-col>
                        </v-row>
                        <v-row class="pt-0">
                            <v-col cols="12" class="pt-0">
                                <!-- drop down for category -->
                                <v-combobox
                                    :color="appStore.primary_color"
                                    :items="teamStore.members"
                                    v-model="assignItem.users"
                                    placeholder="Select users to assign to lead"
                                    dense
                                    elevation=0
                                    style="width: 100%;"
                                    item-text="name"
                                    item-value="id"
                                    multiple
                                    small-chips
                                    >
                                    <template v-slot:selection="data">
                                        <v-chip
                                            v-bind="data.attrs"
                                            :input-value="data.selected"
                                            close
                                            class="mb-2"
                                            :color="appStore.primary_color"
                                            text-color="white"
                                            dark
                                            @click:close="data.parent.selectItem(data.item)"
                                        >
                                            <span style="font-size: 0.8125rem; color: white; font-weight: 600;">
                                                {{ data.item.name }}
                                            </span>
                                            
                                        </v-chip>
                                    </template>
                                </v-combobox>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <v-card-actions class="pt-0 pb-4">
                    <v-spacer></v-spacer>
                    <v-btn @click="filterDialog = false;" outlined elevation=0 :color="appStore.primary_color" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>Close</span>
                    </v-btn>
                    <v-btn @click="filterTabke()" class="px-4" elevation=0 :color="appStore.primary_color" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span style="color: #FFFFFF;" >Save Changes</span>
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
import { useLeadStore } from '../store/leadStore';
    export default {
        setup(){
            const appStore = useAppStore();
            const userStore = useUserStore();
            const teamStore = useTeamStore();
            const leadStore = useLeadStore();
            return { appStore, userStore, teamStore, leadStore };
        },
        mounted() {
            if(this.leadStore.leads.length == 0) {
                if (this.userStore.user == "") {
                    this.userStore.fetchUser().then(() => {
                        this.leadStore.fetchLeads(this.userStore.user.current_team.id);
                    });
                } else {
                    this.leadStore.fetchLeads(this.userStore.user.current_team.id);
                }
            }
            this.noice = this.randomIntFromInterval(1, 6);
        },
        // once loaded, edit the css
        updated() {
            if(this.leadStore.leads.length > 0) {
                this.$nextTick(() => {
                    // once leads are loaded, set the color of the lead score if its 100 using it's id
                    this.leadStore.leads.forEach(lead => {
                        if(lead.lead_score == 100) {
                            console.log(lead.id);
                            // add the rainbow class
                            document.getElementById(lead.id).classList.add("rainbow");
                        }
                    });
                });
            }
        },
        data(){
            return {
                toggle: 0,
                headers: [
                    {
                        text: 'Company Lead',
                        align: 'start',
                        sortable: false,
                        value: 'name',
                    },
                    { text: 'Visited', value: 'website_name'},
                    // { text: 'Num. visitors', value: 'unique_visitors' },
                    { text: 'Tags', value: 'tags' },
                    { text: 'Assigned to', value: 'users' },
                    { text: 'Lead Score', value: 'lead_score' },
                    // { text: 'Last Seen', value: 'last_seen' },
                    { text: '', value: 'details', sortable: false, align: 'end' },
                    
                ],
                search: '',
                dialog: false,
                user: {
                    current_team: {},
                },
                loading: false,
                leadItem: {lead_score: 0,
                    users: [],
                    website_name: '',
                    unique_visitors: 0,
                    last_seen: '',
                    name: '',
                    website_url: '',
                    address: '',
                    city: '',
                    state: '',
                    zip: '',
                    facebook_url: '',
                    industry: '',
                    instagram_url: '',
                    twitter_url: '',
                    linkedin_url: '',
                    youtube_url: '',
                    tiktok_url: '',
                    logo_url: '',
                    website_id: 0,
                    id: 0,
                },

                tableOptions: {
                    page: 0,
                    itemsPerPage: 10,
                },
                footerOptions:
                {
                itemsPerPageOptions: [10, 25, 50, 100], // this is the proper name - not "items-per-page options" like what you're using
                },
                contactsExist: false,
                assignDialog: false,
                assignItem: {
                    users: [],
                },
                tagDialog: false,
                tagItem: {
                    tags: [],
                },
                colors: ['#FFDAB9', '#B0E0E6', '#A8DBA8', '#FFFACD', '#E6E6FA', '#FFB6C1'],
                // random number 1-6
                noice: 1,
                tagSearch: '',
                tagItemTags: [],
                tagFilter: [],
                sectors: window.LaravelConstants.sectors,
            }
        },
        methods:{
            //  let route = '../api/teams/leads/{team_id}';
            // edit lead
            tagLead: function () {
                this.tagItem.tags = this.tagItemTags
                this.$http.put('/api/teams/leads/' + this.tagItem.id, {
                    lead: this.tagItem
                }).then(response => {
                    this.leadStore.fetchLeads(this.userStore.user.current_team_id);
                    this.tagDialog = false;
                    this.tagItem = {
                        users: [],
                    },
                    this.nonce = 1
                    this.tagSearch =''
                    this.tagItemTags = []
                }, response => {
                    console.log(response);
                });
            },

            assignLead: function () {
                this.$http.put('/api/teams/leads/' + this.assignItem.id, {
                    lead: this.assignItem
                }).then(response => {
                    this.leadStore.fetchLeads(this.userStore.user.current_team_id);
                    this.assignDialog = false;
                    this.assignItem = {
                        users: [],
                    }
                }, response => {
                    console.log(response);
                });
            },

            customFilter (item, queryText, itemText) {
                if (item.header) return false

                const hasValue = val => val != null ? val : ''

                const text = hasValue(item.name[this.appStore.locale])
                const query = hasValue(queryText)

                return text.toString()
                .toLowerCase()
                .indexOf(query.toString().toLowerCase()) > -1
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
            getLeadScoreColor(score){
                if(score < 50){
                    return 'red';
                } else if(score < 75){
                    return 'orange';
                } else if(score < 100){
                    return 'green';
                } else {
                    // return bright green
                    return '#00E676';
                }
            },
            getAvatar: function (name) {
                return "https://ui-avatars.com/api/?background=" + this.removeHash(this.appStore.primary_color) + "&color=fff&bold=true&name=" + name;
            },
            removeHash: function (hex) {
                return hex.replace('#', '');
            },
            // rand is not a function
            rand(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            },
            formatDomain(url) {
                // format the url to use in href
                let new_url = url.replace('https://', '').replace('http://', '').replace('www.', '').split(/[/?#]/)[0];
                // add the http://
                new_url = 'https://' + new_url;
                // return the url
                return new_url;
            },
            searchContacts(){
                // search the contacts
                // pass the current lead domain
                this.leadStore.fetchContacts(this.leadItem.domain).then(() => {
                    // open the dialog
                    this.leadItem.contacts = this.leadStore.contacts;
                    this.contactsExist = true;
                });
            },
            contactAvatar(contact){
                // return the avatar
                return "https://ui-avatars.com/api/?background=" + this.removeHash(this.appStore.primary_color) + "&color=fff&bold=true&name=" + contact.first_name + "+" + contact.last_name;
            },
            removeHash(color){
                // remove the hash
                return color.replace('#', '');
            },
            goTo(link, website = null){
                // go to the link
                if(website != null){
                    if (website == 'twitter') {
                        // add the twitter url
                        link = 'https://www.twitter.com/' + link;
                    }
                }
                // if not https:// or http:// add it
                if(!link.includes('https://') && !link.includes('http://')){
                    link = 'https://' + link;
                }
                window.open(link, '_blank');
            },
            titleCase(str) {
                // make the first letter of each word uppercase
                return str.toLowerCase().split(' ').map(function(word) {
                    return word.replace(word[0], word[0].toUpperCase());
                }).join(' ');
            },
            formatActivityTime(seconds){
                // format seconds into minutes or hours
                if(seconds < 60){
                    return seconds + 's';
                } else if(seconds < 3600){
                    return Math.floor(seconds / 60) + 'mins';
                } else {
                    return Math.floor(seconds / 3600) + 'hrs';
                }
            },
            float2int (value) {
                return value | 0;
            },
            readableIndustry(industry){
                // make the industry readable
                // replace all - with ' '
                let industryString = industry.replace(/-/g, ' ');

                // replace all ' and ' with ' & '
                industryString = industryString.replace(/ and /g, ' & ');
                
                // title case
                industryString = this.titleCase(industryString);
                return industryString;
            },
            goToLink(link){
                // go to the link
                window.open(link, '_blank');
            },
            formatTags(tags){
                // format the tags to array with text and color from the tag object
                let formattedTags = [];
                // loop through the tags
                tags.forEach(tag => {
                    // push the tag to the array
                    formattedTags.push({
                        text: tag.name[this.appStore.locale],
                        color: tag.color,
                    });
                });

                this.tagItemTags = formattedTags;
            },
            randomIntFromInterval(min,max)
            {
                // get a random int from min to max
                return Math.floor(Math.random()*(max-min+1)+min);
            },
            customTableFilter(value, search, item) {
            // Apply regular search filter
            const isSearchMatch = search
                ? value.toString().toLowerCase().includes(search.toLowerCase())
                : true;

            // Apply tag search filter
            const isTagSearchMatch = this.tagFilter
                ? item.tags.some((tag) =>
                    tag.id === this.tagFilter
                )
                : true;


            // apply industry filter
            // go through this.sectors and check if the item.industry is in which sector
            // if it is then check if the sector is in the industryFilter
            // if it is then return true
            // else return false
            let isIndustryFilterMatch = false;
            this.sectors.forEach(sector => {
                if(sector.industries.includes(item.industry)){
                    if(this.industryFilter.includes(sector.name)){
                        isIndustryFilterMatch = true;
                    }
                }
            });

            // lead score filter
            // if the lead score is inbetween the leadScoreFilter values then return true
            // else return false
            let isLeadScoreFilterMatch = false;
            if(item.lead_score >= this.leadScoreFilter[0] && item.lead_score <= this.leadScoreFilter[1]){
                isLeadScoreFilterMatch = true;
            }

            // wesbite filter
            // if the website is in the websiteFilter array then return true
            // else return false
            let isWebsiteFilterMatch = false;
            if(this.websiteFilter.includes(item.website.id)){
                isWebsiteFilterMatch = true;
            }

            // company size filter
            // if the company size is inbetween the companySizeFilter values then return true
            // else return false
            let isCompanySizeFilterMatch = false;
            if(item.company_size >= this.companySizeFilter[0] && item.company_size <= this.companySizeFilter[1]){
                isCompanySizeFilterMatch = true;
            }

            // return the match
            return isSearchMatch && isTagSearchMatch && isIndustryFilterMatch && isLeadScoreFilterMatch && isWebsiteFilterMatch && isCompanySizeFilterMatch;
            },
        },
        computed: {
            rainbowColor() {
                // change color every 100ms
                setInterval(() => {
                    // return a hex from color array in sequence
                    this.appStore.colorArray[this.appStore.colorIndex++ % this.appStore.colorArray.length];
                }, 100);
            },
            noiceOver() {
                // get the remainder of the noice and the length of color
                return (this.noice % this.colors.length) + 1

            },
            availableTags(){
                // all team tags minus the tags already assigned to the item or selected by the user using the combo box
                return this.appStore.tags.filter(tag => {
                    // return the tags that are not in the tagItemTags array based on text
                    if(tag.name){
                        return !this.tagItemTags.map(t => t.text).includes(tag.name[this.appStore.locale]);
                    }
                    
                });
            }
        },
        watch: {
            assignItem: function (val) {
                // assign the item
                if(this.teamStore.members.length == 0){
                    // fetch the team
                    this.teamStore.fetchTeam(this.userStore.user.current_team_id);
                }
            },
            tagItem: function (val) {
                // assign the item
                if(this.appStore.tags.length == 0){
                    // fetch the team
                    this.appStore.getTeamTags(this.userStore.user.current_team_id);
                }
            },
            tagItemTags: function (val, prev) {
                // assign the item
                if (val.length === prev.length) return

                this.tagItemTags = val.map(v => {
                    if (typeof v === 'string') {
                            v = {
                                text: v,
                                color: this.colors[this.noiceOver - 1],
                            }
                            this.appStore.tags.push(v)
                            this.noice++
                    } else if (typeof v === 'object') {
                        if (v.text && v.color) {
                            return v
                        } else if (v.name && v.color) {
                            return {
                                text: v.name[this.appStore.locale],
                                color: v.color,
                            }
                        }
                    }
                return v
                })

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

.v-btn-toggle--group > .v-btn.v-btn.button-background{
    background-color: #FFFFFF !important;
}

.v-btn-toggle--group > .v-btn.v-btn.transparent{
    background-color: transparent !important;

}

.custom-data-table .v-data-table__wrapper tbody tr:hover {
  background-color: transparent !important;
  cursor: default !important;
}

.avatar-container {
    position: relative;
}
.avatar {
    height: 24px;
    width: 24px;
    border-radius: 50% !important;
    border: 2px solid white;
}

.avatar img {
    width: 100%;
    height: 100%;
    border-radius: 50% !important;
}

.avatar-overlap-increasing {
    position: relative;
}

.truncate {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  display: inline-block;
}

.source-container {
  display: flex;
  align-items: center;
  padding: 0.5rem;
  border: thin solid whitesmoke;
  border-radius: 0;
}

.grid-container {
  display: grid;
  grid-template-columns: 1fr auto;
  gap: 1rem;
  align-items: center;
  width: 100%;
}


</style>
