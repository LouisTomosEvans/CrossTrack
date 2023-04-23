<template>
        <div class="row justify-content-center">
            <div class="col-12">
                <b><span style="font-size: 1.25rem; color: #28323b;">Your Segments</span></b>
            </div>
            <div class="col-12 d-flex justify-content-between" style="padding-top: 0.5rem;">
                <div class="d-flex align-items-end" style="width: 75%;">
                    <span style="color: #28323b; font-size: 0.8125rem;">Welcome to the Lead Segmentation section! Here, you can create and manage segments of your leads. You can easily classify your leads into different categories, based on criteria like geography, industry, size and behaviour. This is a great way to ensure you are targeting the right people with the right message.</span>
                </div>
                <div class="m-0 p-0 d-flex align-content-center">
                    <v-btn @click="dialog = true" elevation=0 :color="appStore.primary_color" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span style="color: #FFFFFF;">+ Add Segment</span>
                    </v-btn>
                </div>
            </div>
            <v-dialog
                v-model="dialog"
                persistent
                max-width="750px"
                >
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                    <v-card-title style="border-bottom: solid 1px lightgrey; margin-bottom: 1rem;">
                        <b><span style="font-size: 1rem; color: #28323b;">Add Segment</span></b>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="12">
                                <span style="color: #28323b; font-size: 0.8125rem;">Adding a new segment to your account has never been easier. Simply enter the name you want to call it, the criteria and click the "Add Segment" button, and you're good to go! This will allow you to gain valuable insights into your website's traffic and audience.</span>
                            </v-col>
                        </v-row>
                        <v-row class="pt-0">
                            <v-col cols="12" class="pt-0 pb-0">
                                <!-- title -->
                                <span style="color: #28323b; font-size: 0.8125rem; font-weight: 600;">1. Name your new segment.</span>
                            </v-col>
                            <v-col cols="6" class="pt-0">
                                <v-text-field  :color="appStore.primary_color"  dense v-model="name" height="40px" elevation=0 single-line hide-details style="width: 100%;">
                                    <template v-slot:label>
                                        Enter your segment name ex. Tech Start-ups
                                    </template>
                                </v-text-field>
                            </v-col>
                        </v-row>
                        <v-row class="pt-3">
                            <v-col cols="12" class="pt-0">
                                <!-- title -->
                                <span style="color: #28323b; font-size: 0.8125rem; font-weight: 600;">2. Select the website you want to use to create your segment.</span>
                            </v-col>
                            <v-col cols="4" class="pt-0">
                                <!-- drop down for category -->
                                <v-select
                                    :color="appStore.primary_color" 
                                    :items="websiteStore.websites"
                                    v-model="website"
                                    placeholder="Select a website"
                                    dense
                                    elevation=0
                                    style="width: 100%;"
                                    item-text="name"
                                    item-value="id"
                                    >
                                </v-select>
                            </v-col>
                        </v-row>
                        <v-row class="pt-0">
                            <v-col cols="12" class="pt-0">
                                <!-- title -->
                                <span style="color: #28323b; font-size: 0.8125rem; font-weight: 600;">3. Select the criteria you want to use to create your segment.</span>
                            </v-col>
                            <div class="d-flex flex-wrap m-0 p-0"  v-for="criteria in criterias">
                                
                                <v-col cols="12" class="pt-0">
                                <!-- drop down for category -->
                                <v-select
                                    :color="appStore.primary_color" 
                                    :items="links"
                                    v-model="criteria.link"
                                    v-if="criteria.link != null"
                                    placeholder="Select a category"
                                    dense
                                    elevation=0
                                    style="width: 16%;"
                                    item-text="title"
                                    item-value="value"
                                    >
                                </v-select>
                            </v-col>
                                <v-col cols="4" class="pt-0">
                                <!-- drop down for category -->
                                <v-select
                                    :color="appStore.primary_color" 
                                    :items="categories"
                                    v-model="criteria.category"
                                    placeholder="Select a category"
                                    dense
                                    elevation=0
                                    style="width: 100%;"
                                    item-text="title"
                                    item-value="value"
                                    >
                                </v-select>
                            </v-col>
                            <v-col cols="4" class="pt-0">
                                <!-- drop down for logical operator -->
                                <v-select
                                    :color="appStore.primary_color" 
                                    :items="logicalOperatorSelector(criteria.category)"
                                    v-model="criteria.logical_operator"
                                    placeholder="Select a logical operator"
                                    dense
                                    elevation=0
                                    style="width: 100%;"
                                    item-text="title"
                                    item-value="value"
                                    >
                                </v-select>
                            </v-col>
                            <v-col cols="4" class="pt-0">
                                <!-- drop down for country -->
                                <v-select
                                    :color="appStore.primary_color" 
                                    :items="valueSelector(criteria.category)"
                                    v-model="criteria.value"
                                    placeholder="Select a value"
                                    dense
                                    elevation=0
                                    style="width: 100%;"
                                    item-text="title"
                                    item-value="value"
                                    >
                                </v-select>
                            </v-col>
                            </div>
                            <!-- add another criteria -->
                            <v-col cols="12" class="pt-0 d-flex justify-content-end mt-0 pt-0">
                                <v-btn @click="addCriteria()" outlined text elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                                    <span>+ Add another criteria</span>
                                </v-btn>
                            </v-col>
                        </v-row>
                        <v-row class="pt-0">
                            <v-col cols="12" class="pt-0">
                                <!-- title -->
                                <span style="color: #28323b; font-size: 0.8125rem; font-weight: 600;">4. Automatically assign segment leads to these users.</span>
                            </v-col>
                            <v-col cols="8" class="pt-0">
                                <!-- drop down for category -->
                                <v-combobox
                                    :color="appStore.primary_color" 
                                    :items="teamStore.members"
                                    v-model="users"
                                    placeholder="Select users to assign to segment"
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
                                            :color="appStore.primary_color" 
                                            text-color="white"
                                            class="mb-2"
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
                    <v-btn @click="dialog = false" outlined elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>Close</span>
                    </v-btn>
                    <v-btn @click="submitSegment()" class="px-4" elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span style="color: #FFFFFF;" >+ Add Segment</span>
                    </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog
                v-model="editDetailsDialog"
                persistent
                max-width="750px"
                >
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                    <v-card-title style="border-bottom: solid 1px lightgrey; margin-bottom: 1rem;">
                        <b><span style="font-size: 1rem; color: #28323b;">Add Segment</span></b>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="12">
                                <span style="color: #28323b; font-size: 0.8125rem;">Adding a new segment to your account has never been easier. Simply enter the name you want to call it, the criteria and click the "Add Segment" button, and you're good to go! This will allow you to gain valuable insights into your website's traffic and audience.</span>
                            </v-col>
                        </v-row>
                        <v-row class="pt-0">
                            <v-col cols="12" class="pt-0 pb-0">
                                <!-- title -->
                                <span style="color: #28323b; font-size: 0.8125rem; font-weight: 600;">1. Name your new segment.</span>
                            </v-col>
                            <v-col cols="6" class="pt-0">
                                <v-text-field  :color="appStore.primary_color"  dense v-model="editItem.name" height="40px" elevation=0 single-line hide-details style="width: 100%;">
                                    <template v-slot:label>
                                        Enter your segment name ex. Tech Start-ups
                                    </template>
                                </v-text-field>
                            </v-col>
                        </v-row>
                        <v-row class="pt-3">
                            <v-col cols="12" class="pt-0">
                                <!-- title -->
                                <span style="color: #28323b; font-size: 0.8125rem; font-weight: 600;">2. Select the website you want to use to create your segment.</span>
                            </v-col>
                            <v-col cols="4" class="pt-0">
                                <!-- drop down for category -->
                                <v-select
                                    :color="appStore.primary_color" 
                                    :items="websiteStore.websites"
                                    v-model="editItem.website"
                                    placeholder="Select a website"
                                    dense
                                    elevation=0
                                    style="width: 100%;"
                                    item-text="name"
                                    item-value="id"
                                    >
                                </v-select>
                            </v-col>
                        </v-row>
                        <v-row class="pt-0">
                            <v-col cols="12" class="pt-0">
                                <!-- title -->
                                <span style="color: #28323b; font-size: 0.8125rem; font-weight: 600;">3. Select the criteria you want to use to create your segment.</span>
                            </v-col>
                            <div class="d-flex flex-wrap m-0 p-0"  v-for="criteria in editItem.criteria">
                                
                                <v-col cols="12" class="pt-0">
                                <!-- drop down for category -->
                                <v-select
                                    :color="appStore.primary_color" 
                                    :items="links"
                                    v-model="criteria.link"
                                    v-if="criteria.link != null"
                                    placeholder="Select a category"
                                    dense
                                    elevation=0
                                    style="width: 16%;"
                                    item-text="title"
                                    item-value="value"
                                    >
                                </v-select>
                            </v-col>
                                <v-col cols="4" class="pt-0">
                                <!-- drop down for category -->
                                <v-select
                                    :color="appStore.primary_color" 
                                    :items="categories"
                                    v-model="criteria.category"
                                    placeholder="Select a category"
                                    dense
                                    elevation=0
                                    style="width: 100%;"
                                    item-text="title"
                                    item-value="value"
                                    >
                                </v-select>
                            </v-col>
                            <v-col cols="4" class="pt-0">
                                <!-- drop down for logical operator -->
                                <v-select
                                    :color="appStore.primary_color" 
                                    :items="logicalOperatorSelector(criteria.category)"
                                    v-model="criteria.logical_operator"
                                    placeholder="Select a logical operator"
                                    dense
                                    elevation=0
                                    style="width: 100%;"
                                    item-text="title"
                                    item-value="value"
                                    >
                                </v-select>
                            </v-col>
                            <v-col cols="4" class="pt-0">
                                <!-- drop down for country -->
                                <v-select
                                    :color="appStore.primary_color" 
                                    :items="valueSelector(criteria.category)"
                                    v-model="criteria.value"
                                    placeholder="Select a value"
                                    dense
                                    elevation=0
                                    style="width: 100%;"
                                    item-text="title"
                                    item-value="value"
                                    >
                                </v-select>
                            </v-col>
                            </div>
                            <!-- add another criteria -->
                            <v-col cols="12" class="pt-0 d-flex justify-content-end mt-0 pt-0">
                                <v-btn @click="addEditCriteria()" outlined text elevation=0  :color="appStore.primary_color" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                                    <span>+ Add another criteria</span>
                                </v-btn>
                            </v-col>
                        </v-row>
                        <v-row class="pt-0">
                            <v-col cols="12" class="pt-0">
                                <!-- title -->
                                <span style="color: #28323b; font-size: 0.8125rem; font-weight: 600;">4. Automatically assign segment leads to these users.</span>
                            </v-col>
                            <v-col cols="8" class="pt-0">
                                <!-- drop down for category -->
                                <v-combobox
                                    :color="appStore.primary_color" 
                                    :items="teamStore.members"
                                    v-model="editItem.users"
                                    placeholder="Select users to assign to segment"
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
                                            :color="appStore.primary_color" 
                                            text-color="white"
                                            class="mb-2"
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
                    <v-btn @click="editDetailsDialog = false" outlined elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>Close</span>
                    </v-btn>
                    <v-btn @click="editSegment()" class="px-4" elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span style="color: #FFFFFF;" >Save Changes</span>
                    </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>

            <v-dialog
                v-model="deleteSegmentDialog"
                persistent
                max-width="550px"
                >
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                    <v-card-title style="border-bottom: solid 1px lightgrey; margin-bottom: 1rem;">
                        <b><span style="font-size: 1rem; color: #28323b;">Delete Segment</span></b>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="12">
                                <span style="color: #28323b; font-size: 0.8125rem;">
                                    Are you sure you want to delete this segment from your account? You will no longer automatically assign leads to your team members based on this segment.
                                </span>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <v-card-actions class="pt-0 pb-4">
                    <v-spacer></v-spacer>
                    <v-btn @click="deleteSegmentDialog = false" outlined elevation=0  :color="appStore.primary_color"  style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>Close</span>
                    </v-btn>
                    <v-btn @click="deleteSegment()" elevation=0  :color="appStore.primary_color" style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span style="color: #FFFFFF;" class="px-4">Delete Segment</span>
                    </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>

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
                            <strong>Search your segments </strong>ex. agri-tech over 100M in funding
                        </template>
                    </v-text-field>
                </div>
                <div class="d-flex align-items-end">
                    <span style="color: #28323b; font-size: 0.8125rem;">Showing <b>100 most recent segments</b> of 1234 segments </span>
                </div>
            </div>
            <div class="col-12 d-flex ">
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1); width: 100%;">
                    <div class="p-0">
                        <!-- data table -->
                        <v-data-table
                        :headers="headers"
                        :items="segmentStore.segments"
                        :search="search"
                        class="elevation-0 custom-data-table"
                        :color="appStore.primary_color" 
                        style="border-radius: 8px;  border: thin solid rgba(0,0,0,.12);"
                        >
                        <template v-slot:item.website.name="{ item }">
                            <div v-if="item" class="d-flex align-items-center">
                                <!-- website icon -->
                                <v-avatar class="mr-1" size="30" color="info" v-if="!item.website.favicon">
                                    <!-- 0.75 size -->
                                    <v-icon color="white" style="font-size: 0.95rem;">mdi-web</v-icon>
                                </v-avatar>
                                <!-- show favicon -->
                                <div class="mr-1" style="height: 30px; width: 30px;" v-else>
                                    <!-- 0.75 size -->
                                    <img :src="getFaviconURL(item.website.favicon)" style="width: 30px; height: 30px; border-radius: 4px;">
                                </div>
                                <div class="d-flex flex-wrap" style="width: fit-content">
                                    <span class="ml-1 w-100" style="color: #28323b; font-size: 0.8125rem;">{{ item.website.name }}</span>
                                    <a @click="goTo(item.website.domain)" class="ml-1" style="color: #2196F3; font-size: 0.75rem; opacity: 0.75;">{{ item.website.domain }}<v-icon class="ml-1" style="color: #2196F3 !important; font-size: 0.825rem; opacity: 0.75;">mdi-open-in-new</v-icon></a>
                                </div>
                            </div>
                        </template>
                        <template v-slot:item.name="{ item }">
                            <span style="color: #28323b; font-size: 0.8125rem;">{{ item.name }}</span>
                        </template>

                        <template v-slot:item.created_at="{ item }">
                            <span style="color: #28323b; font-size: 0.8125rem;">{{ formatDate(item.created_at) }}</span>
                        </template>

                        <template v-slot:item.criteria="{ item }">
                            <span style="color: #28323b; font-size: 0.8125rem;">{{ formatCriteria(item.criteria) }}</span>
                        </template>

                        <template v-slot:item.users="{ item }">
                            <!-- for each users disply their avatar -->
                            <div v-if="item.users" class="d-flex align-items-center">

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
                        </template>

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
                                    <v-list-item-title style="font-weight: 700;">Quick Actions</v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item>
                                <v-list-item  style="cursor: pointer;" link target="_blank">
                                  <v-list-item-content>
                                    <v-list-item-title>
                                        View Segment Leads
                                    </v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item>
                                <v-list-item  style="cursor: pointer;" link target="_blank" :href="formatWebsiteRedirect(item.website.domain)">
                                  <v-list-item-content>
                                    <v-list-item-title>
                                        Go To Website
                                        <v-icon style="font-size: 0.8125rem; margin-left: 4px;">mdi-open-in-new</v-icon>
                                    </v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item>
                                <v-list-item  style="cursor: pointer;" @click="editDetailsDialog = true; editItem = item">
                                  <v-list-item-content>
                                    <v-list-item-title>
                                        Edit Segment
                                    </v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item>
                                <!-- divider -->
                                <v-divider class="my-1"></v-divider>
                                <v-list-item v-if="item" style="cursor: pointer;" @click="deleteSegmentDialog = true; editItem = item">
                                  <v-list-item-content>
                                    <v-list-item-title style="color: #FF5252; text-decoration: underline;">Delete Segment</v-list-item-title>
                                  </v-list-item-content>
                                </v-list-item>
                                </v-list>
                                
                            </v-menu>
                        </template>

                        <template v-slot:no-data>
                            <div class="my-12">
                                <v-icon color="warning">mdi-alert</v-icon>
                                <p class="mt-2">
                                No Segments Found.
                                </p>
                            </div>
                            
                        </template>
                        </v-data-table>
                        <!-- data table -->

                    </div>
                </v-card>
            </div>
        </div>
</template>

<script>
    import { useAppStore } from '../store/appStore';
    import { useUserStore } from '../store/userStore';
    import { useWebsiteStore } from '../store/websiteStore';
    import { useTeamStore } from '../store/teamStore';
    import { useSegmentStore } from '../store/segmentStore';
    export default {
        setup(){
            const appStore = useAppStore();
            const userStore = useUserStore();
            const websiteStore = useWebsiteStore();
            const teamStore = useTeamStore();
            const segmentStore = useSegmentStore();
            return { appStore, userStore, websiteStore, teamStore, segmentStore };
        },
        mounted() {
            console.log('Component mounted.')
            // fetch segment data if not already fetched
            if(this.segmentStore.segments.length == 0) {
                this.segmentStore.fetchSegments();
            }
            // fetch website data if not already fetched
            if(this.websiteStore.websites.length == 0) {
                if (this.userStore.user == "") {
                    this.userStore.fetchUser().then(() => {
                        this.websiteStore.fetchWebsites(this.userStore.user.current_team.id);
                    });
                } else {
                    this.websiteStore.fetchWebsites(this.userStore.user.current_team.id);
                }
            }
            // fetch team
            if (this.userStore.user == "") {
                this.userStore.fetchUser().then(() => {
                    this.teamStore.fetchTeam(this.userStore.user.current_team.id);
                });
            } else {
                this.teamStore.fetchTeam(this.userStore.user.current_team.id);
            }

        },
        data(){
            return {
                search: '',
                website: null,
                editDetailsDialog: false,
                editItem: {
                    "criterias": [
                    {
                        "category": null,
                        "logical_operator": null,
                        "value": null,
                        "link": null,
                    }
                ],
                },
                deleteSegmentDialog: false,
                users: [],
                criterias: [
                    {
                        "category": null,
                        "logical_operator": null,
                        "value": null,
                        "link": null,
                    }
                ],
                dialog: false,
                selectedCategory: null,
                headers: [
                    {
                        text: 'Name',
                        align: 'start',
                        sortable: false,
                        value: 'name',
                    },
                    { text: 'Website', value: 'website.name' },
                    { text: 'Criteria', value: 'criteria' },
                    { text: 'Assign segment leads to', value: 'users' },
                    { text: 'Created at', value: 'created_at' },
                    { text: '', value: 'actions', sortable: false },
                    
                ],
                links: [
                    'and', 'or'
                ],
                items: [
                    {
                        title: 'Total Subs',
                        value: '1,245',
                        icon: 'mdi mdi-account-multiple',
                        color: 'primary',
                    },
                    {
                        title: 'New Subs',
                        value: '1,245',
                        icon: 'mdi mdi-account-multiple',
                        color: 'success',
                    },
                    {
                        title: 'Total Revenue',
                        value: '1,245',
                        icon: 'mdi mdi-account-multiple',
                        color: 'info',
                    },
                    {
                        title: 'New Revenue',
                        value: '1,245',
                        icon: 'mdi mdi-account-multiple',
                        color: 'warning',
                    },
                ],
                categories: [
                    {
                        title: "Industry",
                        value: "industry",
                    },
                    {
                        title: "Location",
                        value: "location",
                    },
                    {
                        title: "Company size",
                        value: "company_size",
                    },
                    {
                        title: "Lead score",
                        value: "lead_score",
                    },
                    {
                        title: "Visits",
                        value: "visits",
                    },
                    {
                        title: "Visitors",
                        value: "visitors",
                    },
                    {
                        title: "Pages Visited",
                        value: "pages_visited",
                    },
                    {
                        title: "Duration",
                        value: "duration",
                    },
                ],
                industryLogicalOperators: [
                    {
                        title: "is",
                        value: "equals",
                    },
                    {
                        title: "is not",
                        value: "not_equals",
                    }
                ],
                industryValues: [
                {
                title: "Education",
                value: "education",
                },
                {
                title: "Construction",
                value: "construction",
                },
                {
                title: "Design",
                value: "design",
                },
                {
                title: "Corporate Services",
                value: "corporate_services",
                },
                {
                title: "Retail",
                value: "retail",
                },
                {
                title: "Energy & Mining",
                value: "energy_mining",
                },
                {
                title: "Manufacturing",
                value: "manufacturing",
                },
                {
                title: "Finance",
                value: "finance",
                },
                {
                title: "Recreation & Travel",
                value: "recreation_travel",
                },
                {
                title: "Arts",
                value: "arts",
                },
                {
                title: "Health Care",
                value: "health_care",
                },
                {
                title: "Hardware & Networking",
                value: "hardware_networking",
                },
                {
                title: "Real Estate",
                value: "real_estate",
                },
                {
                title: "Legal",
                value: "legal",
                },
                {
                title: "Consumer Goods",
                value: "consumer_goods",
                },
                {
                title: "Agriculture",
                value: "agriculture",
                },
                {
                title: "Media & Communications",
                value: "media_communications",
                },
                {
                title: "Nonprofit",
                value: "nonprofit",
                },
                {
                title: "Software & IT Services",
                value: "software_it_services",
                },
                {
                title: "Transportation & Logistics",
                value: "transportation_logistics",
                },
                {
                title: "Entertainment",
                value: "entertainment",
                },
                {
                title: "Wellness & Fitness",
                value: "wellness_fitness",
                },
                {
                title: "Public Safety",
                value: "public_safety",
                },
                {
                title: "Public Administration",
                value: "public_administration",
                },
                ],
                companySizeLogicalOperators: [
                    {
                        title: "is greater than",
                        value: "gt",
                    },
                    {
                        title: "is less than",
                        value: "lt",
                    },
                    {
                        title: "equals",
                        value: "equals",
                    },
                    {
                        title: "does not equal",
                        value: "not_equals",
                    },
                ],
                companySizeValues: [
                    {
                        title: "1-10",
                        value: "1-10",
                    },
                    {
                        title: "11-50",
                        value: "11-50",
                    },
                    {
                        title: "51-100",
                        value: "51-100",
                    },
                    {
                        title: "101-500",
                        value: "101-500",
                    },
                    {
                        title: "501-1000",
                        value: "501-1000",
                    },
                    {
                        title: "1001-5000",
                        value: "1001-5000",
                    },
                    {
                        title: "5001-10000",
                        value: "5001-10000",
                    },
                    {
                        title: "10001+",
                        value: "10001+",
                    },
                ],
                leadScoreLogicalOperators: [
                    {
                        title: "Greater than",
                        value: "gt",
                    },
                    {
                        title: "Less than",
                        value: "lt",
                    },
                    {
                        title: "Equals",
                        value: "equals",
                    },
                    {
                        title: "Not equals",
                        value: "not_equals",
                    },
                    {
                        title: "Between",
                        value: "between",
                    },
                ],
                visitsLogicalOperators: [
                    {
                        title: "Greater than",
                        value: "gt",
                    },
                    {
                        title: "Less than",
                        value: "lt",
                    },
                    {
                        title: "Equals",
                        value: "equals",
                    },
                    {
                        title: "Not equals",
                        value: "not_equals",
                    },
                    {
                        title: "Between",
                        value: "between",
                    },
                ],
                visitorsLogicalOperators: [
                    {
                        title: "Greater than",
                        value: "gt",
                    },
                    {
                        title: "Less than",
                        value: "lt",
                    },
                    {
                        title: "Equals",
                        value: "equals",
                    },
                    {
                        title: "Not equals",
                        value: "not_equals",
                    },
                    {
                        title: "Between",
                        value: "between",
                    },
                ],
                pagesVisitedLogicalOperators: [
                    {
                        title: "Greater than",
                        value: "gt",
                    },
                    {
                        title: "Less than",
                        value: "lt",
                    },
                    {
                        title: "Equals",
                        value: "equals",
                    },
                    {
                        title: "Not equals",
                        value: "not_equals",
                    },
                    {
                        title: "Between",
                        value: "between",
                    },
                ],
                durationLogicalOperators: [
                    {
                        title: "Greater than",
                        value: "gt",
                    },
                    {
                        title: "Less than",
                        value: "lt",
                    },
                    {
                        title: "Between",
                        value: "between",
                    },
                ],
            
            }
        },
        methods: {
            logicalOperatorSelector: function (category) {
                if (category == "industry") {
                    return this.industryLogicalOperators;
                } else if (category == "company_size") {
                    return this.companySizeLogicalOperators;
                } else if (category == "lead_score") {
                    return this.leadScoreLogicalOperators;
                } else if (category == "visits") {
                    return this.visitsLogicalOperators;
                } else if (category == "visitors") {
                    return this.visitorsLogicalOperators;
                } else if (category == "pages_visited") {
                    return this.pagesVisitedLogicalOperators;
                } else if (category == "duration") {
                    return this.durationLogicalOperators;
                }
            },
            valueSelector: function (category) {
                if (category == "industry") {
                    return this.industryValues;
                } else if (category == "company_size") {
                    return this.companySizeValues;
                } 
            },
            addCriteria: function () {
                this.criterias.push({
                    category: null,
                    logical_operator: null,
                    value: null,
                    link: 'and'
                });
            },
            addEditCriteria: function (index) {
                this.editItem.criteria.push({
                    category: null,
                    logical_operator: null,
                    value: null,
                    link: 'and'
                });
            },
            getAvatar: function (name) {
                return "https://ui-avatars.com/api/?background=" + this.removeHash(this.appStore.primary_color) + "&color=fff&bold=true&name=" + name;
            },
            removeHash: function (hex) {
                return hex.replace('#', '');
            },
            submitSegment: function () {
                this.$http.post('/api/teams/segments', {
                    name: this.name,
                    website: this.website,
                    criterias: this.criterias,
                    users: this.users,
                }).then(response => {
                    this.segmentStore.fetchSegments();
                    this.dialog = false;
                    this.name = '';
                    this.website = null;
                    criterias = [
                    {
                        "category": null,
                        "logical_operator": null,
                        "value": null,
                        "link": null,
                    }
                    ],
                    this.users = [];
                }, response => {
                    console.log(response);
                });
            },
            editSegment: function () {
                this.$http.put('/api/teams/segments/' + this.editItem.id, {
                    segment: this.editItem
                }).then(response => {
                    this.segmentStore.fetchSegments();
                    this.editDetailsDialog = false;
                    this.editItem = {
                        name: '',
                        website: null,
                        criteria: [
                            {
                                "category": null,
                                "logical_operator": null,
                                "value": null,
                                "link": null,
                            }
                        ],
                        users: [],
                    }
                }, response => {
                    console.log(response);
                });
            },
            deleteSegment: function () {
                this.$http.delete('/api/teams/segments/' + this.editItem.id).then(response => {
                    this.segmentStore.fetchSegments();
                    this.deleteSegmentDialog = false;
                    this.editItem = {
                        name: '',
                        website: null,
                        criteria: [
                            {
                                "category": null,
                                "logical_operator": null,
                                "value": null,
                                "link": null,
                            }
                        ],
                        users: [],
                    }
                }, response => {
                    console.log(response);
                });
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
            getFaviconURL(url) {
                // remove the public and replace it with storage
                url = url.replace('public', 'storage');
                // return the url
                return url;
            },
            formatCriteria: function (criteria) {
                let criteriaString = '';
                // loop through the criterias
                for (let i = 0; i < criteria.length; i++) {
                    // if the category is industry
                    if (criteria[i].category == 'industry') {
                        // loop through the industry values
                        for (let j = 0; j < this.industryValues.length; j++) {
                            // if the value is equal to the value in the criteria
                            if (criteria[i].value == this.industryValues[j].value) {
                                // add the title to the criteria string
                                criteriaString += "Industry";
                                // find logical operator title from the logical operator value
                                for (let k = 0; k < this.industryLogicalOperators.length; k++) {
                                    if (criteria[i].logical_operator == this.industryLogicalOperators[k].value) {
                                        criteriaString += ' ' + this.industryLogicalOperators[k].title + ' ';
                                    }
                                }

                                // add the value to the criteria string
                                criteriaString += this.industryValues[j].title;
                            }
                        }
                    }
                    // if the category is company size
                    if (criteria[i].category == 'company_size') {
                        // loop through the industry values
                        for (let j = 0; j < this.companySizeValues.length; j++) {
                            // if the value is equal to the value in the criteria
                            if (criteria[i].value == this.companySizeValues[j].value) {
                                // add the title to the criteria string
                                criteriaString += "Company Size";
                                // find logical operator title from the logical operator value
                                for (let k = 0; k < this.companySizeLogicalOperators.length; k++) {
                                    if (criteria[i].logical_operator == this.companySizeLogicalOperators[k].value) {
                                        criteriaString += ' ' + this.companySizeLogicalOperators[k].title + ' ';
                                    }
                                }

                                // add the value to the criteria string
                                criteriaString += this.companySizeValues[j].title;
                            }
                        }
                    }

                    // add the next criteria link
                    if (criteria[i + 1]) {
                        criteriaString += ' ' + criteria[i + 1].link + ' ';
                    }
                }
                return criteriaString;
                
            },
            readableLogicalOperator: function (logicalOperator) {
                if (logicalOperator == 'gt') {
                    return '>';
                } else if (logicalOperator == 'lt') {
                    return '<';
                } else if (logicalOperator == 'equals') {
                    return '=';
                } else if (logicalOperator == 'not_equals') {
                    return '!=';
                } else if (logicalOperator == 'between') {
                    return 'between';
                }
            },
            formatWebsiteRedirect(redirect){
                // check if the redirect is a full url
                if(redirect.includes('http')){
                    // return the redirect
                    return redirect;
                }
                // add the http to the redirect
                redirect = 'https://' + redirect;

                // return the url
                return redirect;
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

.v-select .v-label {
    font-size: 0.8125rem !important;
}

.v-input{
    font-size: 0.825rem !important;
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

</style>
