<template>
    <div>
        <div id="mainLoading" v-show="this.loading == true" class="background"  style="text-align: center;">
            <div class="text-center" style="margin-top:25vh">
                <img width="150px"  src="HuntIntelLogo.png">
                <v-progress-linear indeterminate color="#44d62c" style="width: 150px; margin-left: auto; margin-right:auto; margin-top: 1.5rem;" height=3 background-opacity="0"></v-progress-linear>
            </div>
        </div>
        <!-- Overlay which dims the entire screen -->
            <v-overlay
                opacity="0.66"
                color="#000000"
                :value="searchDialog || addDialog || settingsDialog || showVKDialog"
            ></v-overlay>

            <!-- this is the dialog box itself the customDialog class gives you the ability to style it using custom css ensure the stlye tag isn't scoped -->
            <v-dialog
                v-model="searchDialog"
                content-class="customDialog noScroll"
                fullscreen
                transition="dialog-bottom-transition"
                dark
                color="#242424"
            >
                <!-- no shadow and no rounded corners on the card -->
                <v-card style="background-color: #242424;" class="rounded-0" elevation="0">
                    <!-- white "flat look" vuetify tool bar -->
                    <v-toolbar class="elevation-2 mb-3">
                        <!-- this is used as a spacer for the title -->
                        <div class="col-1 hidden-mobile padding-mobile" />

                        <!-- title of dialog box -->
                        <v-toolbar-title v-if="!twitterClicked"
                            ><strong style="color: white;"
                                >LOCATION SEARCH<span style="color: #44d62c">.</span></strong
                            >
                        </v-toolbar-title
                        >
                        <v-btn icon tile @click="twitterToggle()" v-if="twitterClicked">
                                <v-icon style="color: #44d62c;">mdi-arrow-left-bold</v-icon>
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-toolbar-title v-if="twitterClicked"
                            ><strong style="color: white;"
                                >FIND TWEETS<span style="color: #44d62c">.</span></strong
                            >
                        </v-toolbar-title
                        >
                        <v-toolbar-items v-if="!twitterClicked">
                            <!-- close button and icon -->
                            <v-btn icon @click="searchClose()">
                                <v-icon style="color: #44d62c;">mdi-close</v-icon>
                            </v-btn>
                        </v-toolbar-items>

                        <div class="col-1 hidden-mobile padding-mobile" />
                    </v-toolbar>

                    <div class="row m-0 p-2">
                        <!-- spacer for the dialog content -->
                        <div class="col-1 hidden-mobile padding-mobile" />

                        <div class="col-12 col-md-10 text-center padding-mobile" v-if="!twitterClicked">
                            <div class="col-12">
                            <p style="text-align: left; font-size: 0.75rem;"><b>Below is a list of geo-location tools used for OSINT.</b> Clicking on one of these tools will redirect you, in a new tab, to that tool for your chosen location.</p>
                            <v-divider class="my-6"></v-divider>
                            </div>
                            <!-- <div class="col-12">
                            <v-text-field dark clearable hide-details dense color="white" style="font-size: 0.75rem; margin: 0px; padding: 0px; font-color: white; margin-bottom: 1rem;" label="Search Tools" prepend-inner-icon="mdi-magnify" outlined></v-text-field>
                            </div> -->
                            <v-row style="padding: 12px;">
                            <div class="col-12 col-xl-6" style="padding: 12px; display: inline-block;  vertical-align: top;">
                                <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                                <div class="articleHeader" style="background-color: #5DA9DD">
                                    <div style="height: 100%; padding: 12px; background-color: transparent; border-radius: 50%; width: 12rem; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-right: auto;"><v-icon style="color: white !important; font-size: 3rem;">mdi-twitter</v-icon></div>
                                </div>

                                <div style="text-align: left; margin-top: 200px; padding: 12px">
                                        <h6 style="color: white;">Twitter</h6>
                                        <p style="color: white; font-size: 0.75rem;">Twitter is a free social networking microblogging service that allows registered members to broadcast short posts called tweets. Search these tweets based on your location.</p>
                                </div>
                                <v-btn class="toolButton" @click="twitterToggle()" tile style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
                                </v-card>
                            </div>
                            <div class="col-12 col-xl-6" style="padding: 12px; display: inline-block;  vertical-align: top;">
                                <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                                <div class="articleHeader" style="background-color: #f2ee00">
                                    <div style="height: 100%; padding: 12px; background-color: transparent; border-radius: 50%; width: 12rem; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-right: auto;"><img class="pinLogo" src="SnapMapsLogo.png"></div>
                                </div>

                                <div style="text-align: left; margin-top: 200px; padding: 12px">
                                        <h6 style="color: white;">SnapMaps</h6>
                                        <p style="color: white; font-size: 0.75rem;">On Snap Map, you can view Snaps submitted to Snap Map from all across the world — including sporting events, celebrations, breaking news, and more.</p>
                                </div>
                                <v-btn class="toolButton" tile @click="goToSnapMaps()" style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
                                </v-card>
                            </div>
                            <div class="col-12 col-xl-6" style="padding: 12px; display: inline-block;  vertical-align: top;">
                                <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                                <div class="articleHeader" style="background-color: #34A853">
                                    <div style="height: 100%; padding: 12px; background-color: transparent; border-radius: 50%; width: 12rem; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-right: auto;"><v-icon style="color: white !important; font-size: 3rem;">mdi-google-maps</v-icon></div>
                                </div>

                                <div style="text-align: left; margin-top: 200px; padding: 12px">
                                        <h6 style="color: white;">Google Maps</h6>
                                        <p style="color: white; font-size: 0.75rem;">Google Maps is a Web-based service that provides detailed information about geographical regions and sites around the world. Go to your location in Google Maps.</p>
                                </div>
                                <v-btn class="toolButton" @click="goToGoogleMaps()" tile style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
                                </v-card>
                            </div>
                            <!-- <div class="col-12 col-xxl-6" style="padding: 12px; display: inline-block;  vertical-align: top;">
                                <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                                <div class="articleHeader" style="background-color: #F6BC0C">
                                    <div style="height: 100%; padding: 12px; background-color: transparent; border-radius: 50%; width: 12rem; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-right: auto;"><v-icon style="color: white !important; font-size: 3rem;">mdi-google-street-view</v-icon></div>
                                </div>

                                <div style="text-align: left; margin-top: 200px; padding: 12px">
                                        <h6 style="color: white;">Google Street View</h6>
                                        <p style="color: white; font-size: 0.75rem;">Google Street View is a technology featured in Google Maps and Google Earth that provides interactive panoramas from positions along many streets in the world.</p>
                                </div>
                                <v-btn class="toolButton" tile style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
                                </v-card>
                            </div> -->
                            <div class="col-12 col-xl-6" style="padding: 12px; display: inline-block; vertical-align: top;">
                                <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                                <div class="articleHeader" style="background-color: #008272">
                                    <div style="height: 100%; padding: 12px; background-color: transparent; border-radius: 50%; width: 12rem; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-right: auto;"><v-icon style="color: white !important; font-size: 3rem;">mdi-microsoft-bing</v-icon></div>
                                </div>

                                <div style="text-align: left; margin-top: 200px; padding: 12px">
                                        <h6 style="color: white;">Bing Maps</h6>
                                        <p style="color: white; font-size: 0.75rem;">Bing Maps is a web mapping service provided as a part of Microsoft's Bing suite of search engines and powered by the Bing Maps for Enterprise framework.</p>
                                </div>
                                <v-btn class="toolButton" @click="goToBingMaps()" tile style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
                                </v-card>
                            </div>
                            <!-- <div class="col-12 col-xxl-6" style="padding: 12px; display: inline-block;  vertical-align: top;">
                                <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                                <div class="articleHeader" style="background-color: #FF5359">
                                    <div style="height: 100%; padding: 12px; background-color: transparent; border-radius: 50%; width: 12rem; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-right: auto;"><img class="pinLogo" :src="require('/public/BaiduMapsLogo.png')"></div>
                                </div>

                                <div style="text-align: left; margin-top: 200px; padding: 12px">
                                        <h6 style="color: white;">Baidu Maps</h6>
                                        <p style="color: white; font-size: 0.75rem;">Baidu Maps offs satellite imagery, street maps, street view and indoor view perspectives, as well as functions such as a route planner for traveling by foot, car, or with public transportation. Popular in China.</p>
                                </div>
                                <v-btn class="toolButton" tile @click="goToBaiduMaps()" style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
                                </v-card>
                            </div> -->
                            <div class="col-12 col-xl-6" style="padding: 12px; display: inline-block; vertical-align: top;">
                                <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                                <div class="articleHeader" style="background-color: #FEBD00">
                                    <div style="height: 100%; padding: 12px; background-color: transparent; border-radius: 50%; width: 12rem; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-right: auto;"><v-icon style="color: white !important; font-size: 3rem;">mdi-weather-sunny</v-icon></div>
                                </div>

                                <div style="text-align: left; margin-top: 200px; padding: 12px">
                                        <h6 style="color: white;">SunCalc</h6>
                                        <p style="color: white; font-size: 0.75rem;">SunCalc is a little app that shows sun movement and sunlight phases during the given day at the given location. Primarily used for Chronolocation.</p>
                                </div>
                                <v-btn class="toolButton" tile @click="goToSunCalc()" style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
                                </v-card>
                            </div>
                            <div class="col-12 col-xl-6" style="padding: 12px; display: inline-block; vertical-align: top;">
                                <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                                <div class="articleHeader" style="background-color: #FF4433">
                                    <div style="height: 100%; padding: 12px; background-color: transparent; border-radius: 50%; width: 12rem; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-right: auto;"><img class="pinLogo" src="YandexMapsLogo.png"></div>
                                </div>

                                <div style="text-align: left; margin-top: 200px; padding: 12px">
                                        <h6 style="color: white;">Yandex Maps</h6>
                                        <p style="color: white; font-size: 0.75rem;">Yandex.Maps is a Russian web mapping service developed by Yandex. The service provides detailed maps of the whole world. Yandex.Maps is the most popular cartographic service in Russia.</p>
                                </div>
                                <v-btn class="toolButton" tile  @click="goToYandexMaps()" style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
                                </v-card>
                            </div>
                            <div class="col-12 col-xl-6" style="padding: 12px; display: inline-block;  vertical-align: top;">
                                <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                                <div class="articleHeader" style="background-color: #33AA6A">
                                    <div style="height: 100%; padding: 12px; background-color: transparent; border-radius: 50%; width: 12rem; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-right: auto;"><img class="pinLogo" src="MapillaryLogo.png"></div>
                                </div>

                                <div style="text-align: left; margin-top: 200px; padding: 12px">
                                        <h6 style="color: white;">Mapillary</h6>
                                        <p style="color: white; font-size: 0.75rem;">Mapillary is the street-level imagery platform that scales and automates mapping using collaboration, cameras, and computer vision. Has good global coverage.</p>
                                </div>
                                <v-btn class="toolButton" tile @click="goToMapillary()" style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
                                </v-card>
                            </div>
                            <div class="col-12 col-xl-6" style="padding: 12px; display: inline-block;  vertical-align: top;">
                                <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                                <div class="articleHeader" style="background-color: #0C1C2C">
                                    <div style="height: 100%; padding: 12px; background-color: transparent; border-radius: 50%; width: 12rem; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-right: auto;"><img class="pinLogo" src="KartaViewLogo.png"></div>
                                </div>

                                <div style="text-align: left; margin-top: 200px; padding: 12px">
                                        <h6 style="color: white;">KartaView</h6>
                                        <p style="color: white; font-size: 0.75rem;">KartaView is a free and open platform for street level imagery. Anyone can contribute images with a smartphone and the open source apps.</p>
                                </div>
                                <v-btn class="toolButton" tile @click="goToKartaView()" style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
                                </v-card>
                            </div>
                            <div class="col-12 col-xl-6" style="padding: 12px; display: inline-block;  vertical-align: top;">
                                <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                                <div class="articleHeader" style="background-color: #ABBB2B">
                                    <div style="height: 100%; padding: 12px; background-color: transparent; border-radius: 50%; width: 12rem; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-right: auto;"><img class="pinLogo" src="SentinelHubLogo.png"></div>
                                </div>

                                <div style="text-align: left; margin-top: 200px; padding: 12px">
                                        <h6 style="color: white;">SentinelHub Playground</h6>
                                        <p style="color: white; font-size: 0.75rem;">We make satellite data (Sentinels, Landsat and other providers) easily accessible for you to be browsed or analyzed, within our cloud GIS or within your own browser.</p>
                                </div>
                                <v-btn class="toolButton" tile @click="goToSentinelHub()" style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
                                </v-card>
                            </div>
                            <div class="col-12 col-xl-6" style="padding: 12px; display: inline-block;  vertical-align: top;">
                                <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                                <div class="articleHeader" style="background-color: #ED1C24">
                                    <div style="height: 100%; padding: 12px; background-color: transparent; border-radius: 50%; width: 12rem; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-right: auto;"><img class="pinLogo" src="WikiMapiaLogo.png"></div>
                                </div>

                                <div style="text-align: left; margin-top: 200px; padding: 12px">
                                        <h6 style="color: white;">WikiMapia</h6>
                                        <p style="color: white; font-size: 0.75rem;">Wikimapia is a geographic online encyclopedia project. It utilizes Google Maps with a geographically-referenced wiki system, with the aim to mark and describe all geographical objects in the world.</p>
                                </div>
                                <v-btn class="toolButton" tile @click="goToWikiMapia()" style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
                                </v-card>
                            </div>
                            <div class="col-12 col-xl-6" style="padding: 12px; vertical-align: top;">
                                <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                                <div class="articleHeader" style="background-color: #5FCBD9">
                                    <div style="height: 100%; padding: 12px; background-color: transparent; border-radius: 50%; width: 12rem; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-right: auto;"><img class="pinLogo" src="PeakVisorLogo.png"></div>
                                </div>

                                <div style="text-align: left; margin-top: 200px; padding: 12px">
                                        <h6 style="color: white;">PeakVisor</h6>
                                        <p style="color: white; font-size: 0.75rem;">PeakVisor will make you a superhero of outdoor navigation by putting state-of-the-art 3D maps and mountain identification magic wand in your hand.</p>
                                </div>
                                <v-btn class="toolButton" tile @click="goToPeakVisor()" style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
                                </v-card>
                            </div>
                            </v-row>
                        </div>
                        <div class="col-12 col-md-10 text-center padding-mobile" v-if="twitterClicked">
                            <div class="col-12">
                            <p style="text-align: left; font-size: 0.75rem;"><b>Below is a list of geo-location tools used for OSINT.</b> Clicking on one of these tools will redirect you, in a new tab, to that tool for your chosen location.</p>
                            <v-divider class="my-6"></v-divider>
                            </div>
                            <div class="col-12">
                            <p class="mb-6" style="text-align: left; font-size: 0.75rem;"><b>FINAL STEP:</b><br><b>Choose the radius</b> in which you want your tweets to be. For example, within 10km of your chosen location.</p>
                            <v-slider color="#44d62c25" style="margin-top: 85px;" v-model="slider" label="Radius:" step="0.1" :thumb-size="50" min="0" max="25" thumb-label="always">
                                <template v-slot:thumb-label="{ value }">
                                    <span><strong style="color: #44d62c">{{ value }}{{ unit }}</strong></span>
                                </template>
                            </v-slider>
                            <p class="mb-6 mt-0" @click="resetOptions" style="text-align: right; text-decoration: none; cursor: pointer; color: #44d62c; font-size: 0.75rem;"><span v-if="!showOptions">Show</span><span v-else>Close</span> Advanced Options</p>
                            <div v-if="showOptions">
                            <v-expansion-panels multiple style="border: 1px solid #44d62c10; color: #242424;" flat>
                                <v-expansion-panel style="border: 1px solid #44d62c10;" flat>
                                <v-expansion-panel-header><b style="font-size: 0.75rem;">Search Queries</b>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <p class="my-6" style="text-align: left; font-size: 0.75rem;"><b>Add a search Query</b> to search your geo-filtered tweets. For example, 'Super Bowl Sunday'.</p>
                                    <v-text-field v-model="searchQuery" dark clearable hide-details dense color="white" placeholder="Example: Super Bowl Sunday"  style="font-size: 0.75rem; margin: 0px; padding: 0px; font-color: white; margin-bottom: 1rem;" label="Search Query (Optional)" outlined></v-text-field>
                                    <p class="my-6" style="text-align: left; font-size: 0.75rem;"><b>Search question tweets</b> - Find tweets that contain questions.</p>
                                    <v-checkbox color='#44d62c' v-model="question" label="Just Questions (Optional)"></v-checkbox>
                                </v-expansion-panel-content>
                                </v-expansion-panel>
                                <v-expansion-panel style="border: 1px solid #44d62c10;" flat>
                                <v-expansion-panel-header><b style="font-size: 0.75rem;">Media Filters</b>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <p class="my-6" style="text-align: left; font-size: 0.75rem;"><b>Search tweets by media type</b> - Find tweets that contain only images and videos, just images or just videos.</p>
                                    <v-radio-group v-model="filter">
                                    <template v-slot:label>
                                        <div><b style="font-size: 0.75rem;">Only find tweets that contain (Optional):</b></div>
                                    </template>
                                    <v-radio color="#44d62c" value=''>
                                        <template v-slot:label>
                                        <div>All Tweets</div>
                                        </template>
                                    </v-radio>
                                    <v-radio color="#44d62c" value="media">
                                        <template v-slot:label>
                                        <div>Just Images and Video</div>
                                        </template>
                                    </v-radio>
                                    <v-radio color="#44d62c" value="images">
                                        <template v-slot:label>
                                        <div>Just Images (including Instagram)</div>
                                        </template>
                                    </v-radio>
                                    <v-radio color="#44d62c" value="native_video">
                                        <template v-slot:label>
                                        <div>Just Video</div>
                                        </template>
                                    </v-radio>
                                    </v-radio-group>
                                </v-expansion-panel-content>
                                </v-expansion-panel>
                            <v-expansion-panel style="border: 1px solid #44444410;" flat>
                                <v-expansion-panel-header><b style="font-size: 0.75rem;">Tweet Details</b>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <p class="my-6" style="text-align: left; font-size: 0.75rem;"><b>Add a Minimum Like Count</b> to narrow down your geo-filtered tweets. For example, '100'.</p>
                                    <v-slider color="#44d62c25" style="margin-top: 85px;" v-model="minLikes" label="Minimum Likes:" step="1" :thumb-size="50" min="0" max="200" thumb-label="always">
                                        <template v-slot:thumb-label="{ value }">
                                            <strong style="color: #44d62c;">{{ value }}</strong>
                                        </template>
                                    </v-slider>
                                    <p class="my-6" style="text-align: left; font-size: 0.75rem;"><b>Add a Minimum Retweet Count</b> to filter your geo-filtered tweets. For example, '50'.</p>
                                    <v-slider color="#44d62c25" style="margin-top: 85px;" v-model="minRetweets" label="Minimum Retweets:" step="1" :thumb-size="50" min="0" max="100" thumb-label="always">
                                        <template v-slot:thumb-label="{ value }">
                                            <strong style="color: #44d62c;">{{ value }}</strong>
                                        </template>
                                    </v-slider>
                                </v-expansion-panel-content>
                                </v-expansion-panel>
                            </v-expansion-panels>
                            </div>
                                <div class="p-0 mt-6 m-0">
                                    <v-btn
                                        color="#44d62c"
                                        elevation="0"
                                        class="col-12 no-padding"
                                        :disabled="!slider"
                                        outlined
                                        @click="goToTwitterClicked()"
                                        ><span >Search For Tweets</span></v-btn>
                                    <v-alert text dense class="col-12 my-3 text-left" v-if="showRadiusWarning" type="warning">Please choose a radius</v-alert>
                                    <!-- adding space to the bottom of the dialog box -->
                                    <div class="buttonSpacer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </v-card>
            </v-dialog>

            <v-dialog
                v-model="addDialog"
                content-class="customDialog noScroll"
                fullscreen
                transition="dialog-bottom-transition"
                dark
                color="#242424"
            >
                <!-- no shadow and no rounded corners on the card -->
                <v-card style="background-color: #242424;" class="rounded-0" elevation="0">
                    <!-- white "flat look" vuetify tool bar -->
                    <v-toolbar class="elevation-2 mb-3">
                        <!-- this is used as a spacer for the title -->
                        <div class="col-1 hidden-mobile padding-mobile" />

                        <!-- title of dialog box -->
                        <v-toolbar-title v-if="!metaClicked && !vkClicked"
                            ><strong style="color: white;"
                                >ADD DATA<span style="color: #44d62c">.</span></strong
                            ></v-toolbar-title
                        >
                        <v-toolbar-items v-if="metaClicked">
                            <!-- close button and icon -->
                            <v-btn icon @click="metaBack()">
                                <v-icon style="color: #44d62c;">mdi-arrow-left-bold</v-icon>
                            </v-btn>
                        </v-toolbar-items>
                        <v-toolbar-items v-if="vkClicked">
                            <!-- close button and icon -->
                            <v-btn icon @click="vkBack()">
                                <v-icon style="color: #44d62c;">mdi-arrow-left-bold</v-icon>
                            </v-btn>
                        </v-toolbar-items>
                        <v-spacer></v-spacer>
                        <v-toolbar-title v-if="metaClicked">
                            <strong style="color: white;"
                                >FIND META PLACES<span style="color: #44d62c">.</span>
                            </strong>
                        </v-toolbar-title>
                        <v-toolbar-title v-if="vkClicked">
                            <strong style="color: white;"
                                >FIND VK PHOTOS<span style="color: #44d62c">.</span>
                            </strong>
                        </v-toolbar-title>
                        <v-toolbar-items v-if="!metaClicked && !vkClicked">
                            <!-- close button and icon -->
                            <v-btn icon @click="addClose()">
                                <v-icon style="color: #44d62c;">mdi-close</v-icon>
                            </v-btn>
                        </v-toolbar-items>
                        <div class="col-1 hidden-mobile padding-mobile" />
                    </v-toolbar>
                    <div class="row m-0 p-2">
                        <!-- spacer for the dialog content -->
                        <div class="col-1 hidden-mobile padding-mobile" />
                        <div class="col-12 col-md-10 text-center padding-mobile" v-if="!metaClicked && !vkClicked">
                            <div class="col-12">
                            <p style="text-align: left; font-size: 0.75rem;"><b>Below is a list of data that can be added to the Hunt Intelligence Map.</b> Clicking on one of these tools will direct you to instructions on how to add that data to your map.</p>
                            <v-divider class="my-6"></v-divider>
                            </div>
                            <!-- <div class="col-12"> -->
                            <!-- <v-text-field dark clearable hide-details dense color="white" style="font-size: 0.75rem; margin: 0px; padding: 0px; font-color: white; margin-bottom: 1rem;" label="Search Tools" prepend-inner-icon="mdi-magnify" outlined></v-text-field> -->
                            <!-- </div> -->
                            <v-row style="padding: 12px;">
                            <div class="col-12 col-xl-6" style="padding: 12px; display: inline-block; vertical-align: top;">
                                <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                                <div class="articleHeader" style="background-color: #0082FF">
                                    <div style="height: 100%; padding: 12px; background-color: transparent; border-radius: 50%; width: 12rem; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-right: auto;"><img class="pinLogo" src="metaLogo.png"></div>
                                </div>

                                <div style="text-align: left; margin-top: 200px; padding: 12px">
                                        <h6 style="color: white;">Meta Places</h6>
                                        <p style="color: white; font-size: 0.75rem;">Twitter is a free social networking microblogging service that allows registered members to broadcast short posts called tweets. Search these tweets based on your location.</p>
                                </div>
                                <v-btn @click="metaClick()" class="toolButton" tile style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
                                </v-card>
                            </div>
                            <div class="col-12 col-xl-6" style="padding: 12px; display: inline-block; vertical-align: top;">
                                <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                                <div class="articleHeader" style="background-color: #2787F5">
                                    <div style="height: 100%; padding: 12px; background-color: transparent; border-radius: 50%; width: 12rem; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-right: auto;"><img class="pinLogo" src="VKLogo.png"></div>
                                </div>

                                <div style="text-align: left; margin-top: 200px; padding: 12px">
                                        <h6 style="color: white;">VKontakte Photos</h6>
                                        <p style="color: white; font-size: 0.75rem;">VK is a Russian online social media and social networking service based in Saint Petersburg. VK is available in multiple languages but it is predominantly used by Russian speakers.</p>
                                </div>
                                <v-btn @click="vkClick()" class="toolButton" tile style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
                                </v-card>
                            </div>
                            </v-row>
                        </div>
                        <div class="col-12 col-md-10 text-center padding-mobile" v-if="metaClicked">
                            <div class="col-12">
                            <p style="text-align: left; font-size: 0.75rem;"><b>Meta Places requires you to have a Instagram account</b> - You will need to be logged in to Instagram on your browser and have cookies accepted. </p>
                            <v-divider class="my-6"></v-divider>
                            </div>
                            <div class="col-12">
                                <p style="text-align: left; font-size: 0.75rem;"><b>STEP 1:<br>Click the "Get Meta Place Data" button</b> - After clicking the button, if you are logged out, a new tab will open where you'll be re-directed to the Instagram log in page. Please log in and accept cookies. You'll then be re-directed to your "Place Data".</p>
                                <v-btn color="#44d62c" elevation="0" @click="openMetaData()" class="col-12 no-padding" outlined><span >Get Meta Place Data</span></v-btn>
                                <a id="link" target="_blank" :href="this.generatedLink" download hidden></a>
                            </div>
                            <div class="col-12">
                                <p style="text-align: left; font-size: 0.75rem;"><b>STEP 2:<br>Copy and paste the "Place Data"</b> - Copy the entirety of your place data and paste it into the box below.</p>
                                <v-textarea style="font-size: 0.75rem;" outlined v-model="placeData"></v-textarea>
                                <v-btn color="#44d62c" @click="submitMetaData()" :loading="metaLoading" elevation="0" :disabled="!jsonValidator" class="col-12 no-padding" outlined><span >Add Meta Places</span></v-btn>
                            </div>
                        </div>
                        <div class="col-12 col-md-10 text-center padding-mobile" v-if="vkClicked">
                            <div class="col-12">
                            <p style="text-align: left; font-size: 0.75rem;"><b>VK Photos requires you to have a VK account</b> - You will need to be logged in to VK and get an application API key to find photos.</p>
                            <v-divider class="my-6"></v-divider>
                            </div>
                            <div class="col-12">
                                <p style="text-align: left; font-size: 0.75rem;"><b>STEP 1:<br>Click the "Get Meta Place Data" button</b> - After clicking the button, if you are logged out, a new tab will open where you'll be re-directed to the Instagram log in page. Please log in and accept cookies. You'll then be re-directed to your "Place Data".</p>
                                <v-text-field v-model="vkAccessToken" dark hide-details append-outer-icon="mdi-content-save" @click:append-outer="saveVKAPIKey" dense color="white" placeholder="VK Secret API Key"  style="font-size: 0.75rem; margin: 0px; padding: 0px; font-color: white; margin-bottom: 1rem;" label="VK Secret API Key" outlined></v-text-field>
                            </div>
                            <div class="col-12">
                                <p style="text-align: left; font-size: 0.75rem;"><b>STEP 2:<br>Click the "Get VK Photo Data" button</b> - After clicking the button, if you are logged out, a new tab will open where you'll be re-directed to the Instagram log in page. Please log in and accept cookies. You'll then be re-directed to your "VK Photo Data".</p>
                                <v-btn color="#44d62c" elevation="0" @click="openVKData()" class="col-12 no-padding" outlined><span >Get VK Photo Data</span></v-btn>
                                <a id="vk-link" target="_blank" :href="this.generatedVKLink" download hidden></a>
                            </div>
                            <div class="col-12">
                                <p style="text-align: left; font-size: 0.75rem;"><b>STEP 3:<br>Copy and paste the "VK Photo Data"</b> - Copy the entirety of yourvk photo data and paste it into the box below.</p>
                                <v-textarea style="font-size: 0.75rem;" outlined v-model="vkPhotoData"></v-textarea>
                                <v-btn color="#44d62c" @click="submitVKData()" :loading="vkLoading" elevation="0" :disabled="!VKJsonValidator" class="col-12 no-padding" outlined><span >Add VK Photos</span></v-btn>
                            </div>
                        </div>
                    </div>
                </v-card>
            </v-dialog>

            <v-dialog
                v-model="settingsDialog"
                content-class="customDialog noScroll"
                fullscreen
                transition="dialog-bottom-transition"
                dark
                color="#242424"
            >
                <!-- no shadow and no rounded corners on the card -->
                <v-card style="background-color: #242424;" class="rounded-0" elevation="0">
                    <!-- white "flat look" vuetify tool bar -->
                    <v-toolbar class="elevation-2 mb-3">
                        <!-- this is used as a spacer for the title -->
                        <div class="col-1 hidden-mobile padding-mobile" />

                        <!-- title of dialog box -->
                        <v-toolbar-title
                            ><strong style="color: white;"
                                >LOCATION TOOL SETTINGS<span style="color: #44d62c">.</span></strong
                            ></v-toolbar-title
                        >
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <!-- close button and icon -->
                            <v-btn icon @click="settingsClose()">
                                <v-icon style="color: #44d62c;">mdi-close</v-icon>
                            </v-btn>
                        </v-toolbar-items>

                        <div class="col-1 hidden-mobile padding-mobile" />
                    </v-toolbar>

                    <div class="row m-0 p-2">
                        <!-- spacer for the dialog content -->
                        <div class="col-1 hidden-mobile padding-mobile" />

                        <div class="col-12 col-md-10 text-center padding-mobile">
                            <v-expansion-panels style="border: 1px solid #44d62c10; color: #242424;" flat accordion>
                                <v-expansion-panel style="border: 1px solid #44d62c10;" flat>
                                    <v-expansion-panel-header><b style="font-size: 0.75rem;">Map Settings</b></v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                        <p style="text-align: left; color: white; font-size: 0.75rem;"><b>Choose your map style</b> - Satellite is useful for precisely placing your marker on the map</p>
                                        <v-row class="my-6" justify="space-around">
                                            <v-chip-group v-model="mapStyle" mandatory color="#44d62c">
                                                <v-chip value="satellite">
                                                    Satellite
                                                </v-chip>
                                                <v-chip value="dark">
                                                    Dark
                                                </v-chip>
                                                <v-chip value="streets">
                                                    Streets
                                                </v-chip>
                                                <v-chip value="outdoor">
                                                    Outdoor
                                                </v-chip>
                                            </v-chip-group>
                                        </v-row>
                                        <p style="text-align: left; color: white; font-size: 0.75rem;"><b>Choose your unit of distance</b> - Select the unit your are most familiar with</p>
                                        <v-row class="my-6" justify="space-around">
                                            <v-chip-group v-model="disUnit" mandatory color="#44d62c">
                                                <v-chip value="kilometers">
                                                    KM
                                                </v-chip>
                                                <v-chip value="miles">
                                                    Miles
                                                </v-chip>
                                            </v-chip-group>
                                        </v-row>
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                                <v-expansion-panel style="border: 1px solid #44d62c10;" flat>
                                    <v-expansion-panel-header><b style="font-size: 0.75rem;">How to use our location tools</b></v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                                <v-expansion-panel style="border: 1px solid #44444410;" flat>
                                    <v-expansion-panel-header><b style="font-size: 0.75rem;">About our location tools</b></v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                            </v-expansion-panels>
                        </div>
                    </div>
                </v-card>
            </v-dialog>

            <v-dialog
                v-model="showVKDialog"
                content-class="customDialog noScroll"
                fullscreen
                transition="dialog-bottom-transition"
                dark
                color="#242424"
            >
                <!-- no shadow and no rounded corners on the card -->
                <v-card style="background-color: #242424;" class="rounded-0" elevation="0">
                    <!-- white "flat look" vuetify tool bar -->
                    <v-toolbar class="elevation-2 mb-3">
                        <!-- this is used as a spacer for the title -->
                        <div class="col-1 hidden-mobile padding-mobile" />

                        <!-- title of dialog box -->
                        <v-toolbar-title
                            ><strong style="color: white;"
                                >VK Photo<span style="color: #44d62c">.</span></strong
                            ></v-toolbar-title
                        >
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <!-- close button and icon -->
                            <v-btn icon @click="vkResultsClose()">
                                <v-icon style="color: #44d62c;">mdi-close</v-icon>
                            </v-btn>
                        </v-toolbar-items>

                        <div class="col-1 hidden-mobile padding-mobile" />
                    </v-toolbar>

                    <div class="row m-0 p-2">
                        <!-- spacer for the dialog content -->
                        <div class="col-1 hidden-mobile padding-mobile" />

                        <div class="col-12 col-md-10 text-center padding-mobile">
                                <v-card class="cardShadow" style="text-align: right;">
                                <img v-if="vkResultURL" :src="vkResultURL" width="100%" style="border-bottom: 2px solid #44d62c" />
                                <div v-if="vkResultDate" style="text-align: right; padding: 12px">
                                    <p style="color: white; font-size: 0.75rem; opacity: 0.5;">
                                        <b>Date:</b> {{vkResultDate}}
                                    </p>
                                </div>
                                <div v-if="vkResultText" style="text-align: left; padding: 12px">
                                    <p style="color: white; font-size: 0.75rem;"><b>Caption:</b></p>
                                    <p style="color: white; font-size: 0.75rem;">{{vkResultText}}</p>
                                </div>
                                <div style="text-align: left; padding: 12px; width: 100%; padding-top: 0px; font-size: 0.75rem;">
                                <p style="color: white; font-size: 0.75rem;"><b>VK Photo Links:</b></p>
                                <a @click="goToVKProfile()" style="color: #2787F5 !important; text-decoration: underline;">Go To Profile</a>
                                |
                                <a @click="goToVKPhoto()" style="color: #2787F5 !important; text-decoration: underline;">Go To Photo</a>
                                </div>
                                <div style="text-align: left; padding: 12px; width: 100%; margin-bottom: 1rem; padding-top: 0px; font-size: 0.75rem;">
                                <p style="color: white; font-size: 0.75rem;"><b>Reverse Image Search Tools:</b></p>
                                <a @click="googleReverseImageSearch()" style="color: #E94235 !important; text-decoration: underline;">Google Image Search</a>
                                |
                                <a @click="bingReverseImageSearch()" style="color: #007E6E !important; text-decoration: underline;">Bing Image Search</a>
                                |
                                <a @click="yandexReverseImageSearch()" style="color: #FFCC00 !important; text-decoration: underline;">Yandex Image Search</a>
                                |
                                <a @click="tinyeyeReverseImageSearch()" style="color: #2C71A1 !important; text-decoration: underline;">TinyEye Search</a>
                                </div>
                                </v-card>
                        </div>
                    </div>
                </v-card>
            </v-dialog>

            <v-speed-dial
                direction="bottom"
                transition="slide-y-reverse-transition"
                id="actionsBtn"
            >
                <template v-slot:activator>
                    <v-btn fab color="#44d62c" icon tile elevation="0" class="no-padding"><span><v-icon style="color: #1A1A1A !important;">mdi-menu</v-icon> </span></v-btn>
                </template>
                <v-btn
                    fab
                    dark
                    small
                    color="#44d62c"
                    style="box-shadow: 0px 0px 15px #1a1a1a;"
                    @click="searchClicked()"
                >
                    <v-icon style="color: #1a1a1a;">mdi-magnify</v-icon>
                </v-btn>
                <v-btn
                    fab
                    dark
                    small
                    v-if="$vuetify.breakpoint.smAndUp"
                    color="#44d62c"
                    style="box-shadow: 0px 0px 15px #1a1a1a;"
                    @click="addClicked()"
                >
                    <v-icon style="color: #1a1a1a;">mdi-plus</v-icon>
                </v-btn>
                <v-btn
                    fab
                    dark
                    small
                    color="#44d62c"
                    style="box-shadow: 0px 0px 15px #1a1a1a;"
                    @click="settingsClicked()"
                >
                    <v-icon style="color: #1a1a1a;">mdi-cog</v-icon>
                </v-btn>
            </v-speed-dial>
            <v-alert dense id="alert" v-if="errorMessage" type="error"><span class="hidden-mobile">No Location Selected! Please click on the map to s</span><span class="visible-mobile">S</span>elect a location to search for tweets</v-alert>
        <div id="map">
            <mapbox
                access-token="pk.eyJ1IjoiYmlyZGh1bnQiLCJhIjoiY2t6YThnY2FrMDlncjJ3czZjNTZ5YzBpNSJ9.72hEYWjdoe8avgkItuQBug"
                :map-options="{
                    style: 'mapbox://styles/birdhunt/ckzf3vnph000414ny5b52cb18',
                    center: ['0', '7'],
                    zoom: 1,
                }"
                :attribution-control="{
                    show: true,
                    position:'bottom-right'
                }"
                :geocoder-control="{
                    show: true,
                    position: 'top-right'
                }"
                :fullscreen-control="{
                    show: true,
                    position: 'bottom-right'
                }"
                @map-init="initialiseMap"
                @map-load="loaded"
                @map-click="mapClicked"
                @map-dblclick="doubleClicked"
                @map-mouseenter:meta-place-markers="mouseMetaEntered"
                @map-mouseleave:meta-place-markers="mouseMetaLeft"
                @map-click:meta-place-markers="mouseMetaClicked"
                @map-render="render"
                @map-mouseenter:vk-place-markers="vkMarkerEntered"
                @map-click:vk-place-markers="vkMarkerClicked"
            />
        </div>

    </div>
</template>

<script>
import Mapbox from "mapbox-gl-vue";
import MapboxGeocoder from '@mapbox/mapbox-gl-geocoder';
import '@mapbox/mapbox-gl-geocoder/dist/mapbox-gl-geocoder.css';
import mapboxgl from 'mapbox-gl/dist/mapbox-gl';
import PopupContent from './PopupContent.vue';
//import * as PopupContent from './PopupContent.vue';
//const PopupContent = require('./PopupContent.vue');


export default {

    name: 'locationToolsComponent',

    components:{
        Mapbox
    },

    data(){
        return {
            loading: true,
            marker: null,
            popup: null,
            addDialog: false,
            searchDialog: false,
            settingsDialog: false,
            dbl: false,
            clicked: false,
            errorMessage: false,
            url: null,
            lat: null,
            lon: null,
            markers: [],
            featureList: [],

            // Twitter Variables //
            twitterClicked: false,
            showOptions: false,
            searchQuery: '',
            filter: null,
            question: false,
            minLikes: null,
            minRetweets:null,
            unit: 'KM',
            disMult: 1,
            disUnit: 'KM',
            mapStyle: 'satellite',
            slider: null,
            sliderSub: null,

             // Meta Variables //
            metaClicked: false,
            placeData: null,
            dataObject: null,
            markerClicked: false,
            dataPresent: false,
            lastLat: null,
            lastLon: null,
            doubleCheckError: false,
            errorMessageSubmit: false,
            metaPlaceSearch: null,
            metaLoading: false,

            // VK Variables //
            vkClicked: false,
            vkAccessToken: '8533818c8533818c8533818cd28548f057885338533818ce72f847d397ac1962d011695',
            vkPhotoObject: null,
            dataObject: null,
            vkPhotoSearch: null,
            vkPhotoData: null,
            markersVK: {},
            clusterMarkersOnScreenVK: {},
            clusterMarkersVK: {},
            markersOnScreenVK: {},
            featureListVK: [],
            vkResult: null,
            showVKDialog: false,
            vkResultURL: null,
            vkResultOwnerID: null,
            vkResultDate: null,
            vkResultText: null,
            vkResultID: null,
            vkLoading: false,
        }
    },
    mounted() {
        this.getVKKey();
    },
    methods: {
        loaded: function(map) {
            this.loading = false;
            this.map.on('idle',function(){
                map.resize()
            })
        },
        initialiseMap: function(map) {
            map._isVue = true;
            this.map = map;
            const geocoder = new MapboxGeocoder({
                accessToken: "pk.eyJ1IjoiYmlyZGh1bnQiLCJhIjoiY2t6YThnY2FrMDlncjJ3czZjNTZ5YzBpNSJ9.72hEYWjdoe8avgkItuQBug",
                mapboxgl: Mapbox,
            })

            this.map.addControl(
                geocoder
            );

            geocoder.on('result', (event) => {
                if(this.marker){
                    this.marker.remove();
                }
                const el = document.createElement('div');
                el.className = 'marker';
                var coordinates = event.result.geometry.coordinates;
                this.marker = new mapboxgl.Marker({ element: el, anchor: 'bottom'});
                this.marker.setLngLat(coordinates).addTo(this.map);
                this.clicked = true;
                this.errorMessage = false;
            });
        },
        mapClicked: function(map, e){
            this.dbl = false;

            setTimeout(() => {
            if (!this.dbl && !this.markerClicked) {
                if(this.marker){
                    this.marker.remove();
                }
                const el = document.createElement('div');
                el.className = 'marker';
                var coordinates = e.lngLat;
                this.marker = new mapboxgl.Marker(
                    { element: el, anchor: 'bottom'}
                );
                this.marker.setLngLat(coordinates).addTo(this.map);

                this.clicked = true;
                this.errorMessage = false;
                this.doubleCheckError = false;
                if(this.popup){
                    this.popup.remove();
                    this.popup = null;
                }
                this.metaPlaceSearch = null;
            }
            }, 500)
        },
        doubleClicked: function(){
            this.dbl = true;
        },
        searchClicked: function(){
            if(this.clicked){
                this.lat = this.marker._lngLat.lat;
                this.lon = this.marker._lngLat.lng;
                this.searchDialog = true;

            } else {
                this.errorMessage = true;
            }

        },
        settingsClicked: function(){
            this.settingsDialog = true;
        },
        addClicked: function(){
            if(this.clicked){
                this.lat = this.marker._lngLat.lat;
                this.lon = this.marker._lngLat.lng;
                this.addDialog = true;
            } else {
                this.errorMessage = true;
            }
        },
        render: function(map){
                if(this.map.getSource('vk-places')){
                    if (!this.map.isSourceLoaded('vk-places')) return;
                    this.updateVKMarkers();
                }
                if(this.map.getSource('meta-places')){
                    if (!this.map.isSourceLoaded('meta-places')) return;
                    this.markers = this.updateMetaMarkers(this.markers);
                }
                return
            ;
        },

        // VK Functions //
        vkMarkerClicked(map, e){
            console.log(e.features[0].properties.cluster);
            if(!e.features[0].properties.cluster){
                this.showVKResult(e);
                this.vkResult = e;
            }
        },
        vkMarkerEntered(map, e){
            if(this.popup){
                this.popup.remove();
                this.popup = null;
            }
        },
        getVKKey(){
            let route = '../api/vkkey/index';
            this.$http.get(route, {withCredentials: true}).then((res) => {
                this.vkAccessToken = res.data;
            })
        },
        showVKResult(e){
            this.vkResultURL = e.features[0].properties.preview_URL;
            this.vkResultText = e.features[0].properties.text;
            this.vkResultDate = new Date(e.features[0].properties.date*1000);
            this.showVKDialog = true;
            this.vkResultOwnerID = e.features[0].properties.owner;
            this.vkResultID = e.features[0].properties.id;
            //window.open(e.features[0].properties.preview_URL);
            //this.VKResults
        },
        vkResultsClose(){
            this.vkResult = null;
            this.vkResultURL = null;
            this.vkResultText = null;
            this.vkResultOwnerID = null;
            this.showVKDialog = false;
            this.vkResultID = null;
        },
        vkClick(){
            this.vkClicked = true;
        },
        vkBack(){
            this.vkClicked = false;
        },
        openVKData(){
            this.submitVKPhotoSearch();
            document.getElementById('vk-link').click();
            //window.open(this.generatedLink, '_system');
            //https://api.vk.com/method/photos.search?lat=51.481583&long=-3.179090&radius=1&count=1000&offset=0&access_token=8533818c8533818c8533818cd28548f057885338533818ce72f847d397ac1962d011695&v=6.0
        },
        saveVKAPIKey(){
            let route = '../api/vkkey/store';
            let payload = {
                'key': this.vkAccessToken,
            }
            this.$http.post(route, payload, {withCredentials: true}).then(res => {
                console.log(res.data);
            });

        },
        submitVKPhotoSearch(){
            let route = '../api/vkphotosearch/create';
            let payload = {
                'lat': this.lat,
                'lon': this.lon,
                'url': this.generatedVKLink,
            }
            this.$http.post(route, payload, {withCredentials: true}).then(res => {
                console.log(res.data);
                this.vkPhotoSearch = res.data;
            });
        },
        submitVKData(){
            this.errorMessageSubmit = false;
            this.vkLoading = true;
            this.dataObject = JSON.parse(this.vkPhotoData);
            this.vkPhotoObjects = [];
            if(this.dataObject.response.items){
                let visualisationData = {};
                for (var i = 0; i < this.dataObject.response.items.length; i++) {
                    let vkPhotoObject = this.dataObject.response.items[i];
                    if(!this.markersVK[(String(vkPhotoObject.id) + String([vkPhotoObject.long, vkPhotoObject.lat]))]){
                        if(vkPhotoObject.sizes){
                            vkPhotoObject.preview_URL =  (vkPhotoObject.sizes[vkPhotoObject.sizes.length - 1]).url;
                            vkPhotoObject.sizes = null;
                        }
                        vkPhotoObject.photo_id = vkPhotoObject.id;


                        visualisationData = {
                        // extract required data from the location objects
                            type: "Feature",
                            geometry: {
                                type: "Point",
                                coordinates: [vkPhotoObject.long, vkPhotoObject.lat]
                            },
                            properties: {
                                owner: vkPhotoObject.owner_id,
                                date: vkPhotoObject.date,
                                id: vkPhotoObject.id,
                                text: vkPhotoObject.text,
                                has_tags: vkPhotoObject.has_tags,
                                album_id: vkPhotoObject.album_id,
                                post_id: vkPhotoObject.post_id,
                                preview_URL: vkPhotoObject.preview_URL,
                            }
                        };
                        this.featureListVK.push(visualisationData);
                        this.vkPhotoObjects.push(vkPhotoObject);
                    }
                }
                let route = '../api/vkphoto/create';
                let payload = {
                    'VKPhotoObjects': this.vkPhotoObjects,
                    'VKPhotoSearch': this.vkPhotoSearch,
                }
                this.$http.post(route, payload, {withCredentials: true}).then(res => {
                    this.lastLat = this.lat;
                    this.lastLon = this.lon;
                    this.dataPresent = true;
                    this.loadedCheck = true;
                    this.addVKMarkersToMap();
                    this.vkPhotoData = null;
                    this.close();
                    this.vkBack();
                });
            } else {
                this.errorMessageSubmit = true;
            }
            this.vkLoading = false;
        },
        googleReverseImageSearch(){
            let url = 'https://www.google.com/searchbyimage?image_url=' + encodeURIComponent(this.vkResultURL);
            window.open(url);
        },
        yandexReverseImageSearch(){
            let url = 'https://yandex.com/images/search?rpt=imageview&url=' + encodeURIComponent(this.vkResultURL);
            window.open(url);
        },
        bingReverseImageSearch(){
            let url = 'https://www.bing.com/images/searchbyimage?cbir=ssbi&pageurl=http%3A%2F%2Fwww.huntintel.io&imgurl=' + encodeURIComponent(this.vkResultURL);
            window.open(url);
        },
        tinyeyeReverseImageSearch(){
            let url = 'https://tineye.com/search/?url=' + encodeURIComponent(this.vkResultURL);
            window.open(url);
        },

        goToVKPhoto(){
            if(this.vkResultOwnerID < 0){
                let positive = this.vkResultOwnerID*-1;
                let id = String(positive);
                let url = 'https://vk.com/photo-' + id + '_' + this.vkResultID;
                window.open(url);
            }
            else {
                let id = String(this.vkResultOwnerID);
                let url = 'https://vk.com/photo' + id + '_' + this.vkResultID;
                window.open(url);
            }
        },
        goToVKProfile(){
            if(this.vkResultOwnerID < 0){
                let positive = this.vkResultOwnerID*-1;
                let id = String(positive);
                let url = 'https://vk.com/public' + id;
                window.open(url);
            }
            else {
                let id = String(this.vkResultOwnerID);
                let url = 'https://vk.com/id' + id;
                window.open(url);
            }
        },

        // Meta Functions //
        metaClick(){
            this.metaClicked = true;
        },
        metaBack(){
            this.metaClicked = false;
        },
        openMetaData(){
            this.submitMetaPlaceSearch();
            document.getElementById('link').click();
            //window.open(this.generatedLink, '_system');
        },
        submitMetaPlaceSearch(){
            let route = '../api/metaplacesearch/create';
            let payload = {
                'lat': this.lat,
                'lon': this.lon,
                'url': this.generatedLink,
            }
            this.$http.post(route, payload, {withCredentials: true}).then(res => {
                console.log(res.data);
                this.metaPlaceSearch = res.data;
            });
        },
        submitMetaData(){
            this.metaLoading = true;
            this.errorMessageSubmit = false;
            this.dataObject = JSON.parse(this.placeData);
            this.placeObjects = [];
            if(this.dataObject.venues){
                let visualisationData = {};
                for (var i = 0; i < this.dataObject.venues.length; i++) {
                    let placeObject = this.dataObject.venues[i];
                    if(!this.markers[placeObject.external_id]){
                        visualisationData = {
                        // extract required data from the location objects
                            type: "Feature",
                            geometry: {
                                type: "Point",
                                coordinates: [placeObject.lng, placeObject.lat]
                            },
                            properties: {
                                name: placeObject.name,
                                address: placeObject.address,
                                id: placeObject.external_id,
                                id_source: placeObject.external_id_source,
                                minimum_age: placeObject.minimum_age,
                            }
                        };
                        this.featureList.push(visualisationData);
                        this.placeObjects.push(placeObject);
                    }
                }
                let route = '../api/metaplace/create';
                let payload = {
                    'placeObjects': this.placeObjects,
                    'metaPlaceSearch': this.metaPlaceSearch,
                }
                this.$http.post(route, payload, {withCredentials: true}).then(res => {
                    this.lastLat = this.lat;
                    this.lastLon = this.lon;
                    this.dataPresent = true;
                    this.loadedCheck = true;
                    this.addMetaMarkersToMap();
                    this.placeData = null;
                    this.close();

                });
            } else {
                this.errorMessageSubmit = true;
            }
            this.metaLoading = false;
        },

        // VK Map Functions //
        addVKMarkersToMap: function(){
            if(this.map.getSource('vk-places')){
                var data = {
                    type: "FeatureCollection",
                    features: this.featureListVK
                }
                this.map.getSource('vk-places').setData(data);
            } else {
                this.map.addSource("vk-places", {
                type: "geojson",
                data: {
                    type: "FeatureCollection",
                    features: this.featureListVK
                },
                cluster: true,
                clusterRadius: 30                                //If the data is a collection of point features, setting this to true clusters the points by radius into groups. Cluster groups become new Point features                          // Max zoom to cluster points on
                });
            }


            if(this.map.getLayer('vk-clusters')){
                //console.log('exists');
            } else {
                this.map.addLayer({
                id: 'vk-clusters',
                type: 'circle',
                source: 'vk-places',
                'paint': {
                    'circle-color': 'transparent',
                    'circle-radius': 30,
                    'circle-stroke-color': 'transparent'
                }
                });
            }

            if(this.map.getLayer('vk-place-markers')){
                //console.log('exists');
            } else {
                this.map.addLayer({
                id: "vk-place-markers",
                type: "circle",
                source: "vk-places",
                'paint': {
                    'circle-color': 'transparent',
                    'circle-radius': 30,
                    'circle-stroke-color': 'transparent'
                }
                });
            }

        },
        updateVKMarkers() {
            let [newMarkers, newClusterMarkers ] = [ {}, {} ];
            if(this.map.getSource('vk-places')){
                const places = this.map.querySourceFeatures('vk-places', 'vk-place-markers');
                places.forEach( ({geometry, properties}) => {
                    if(!properties.cluster){                         // if this feature isn't a cluster...
                    let id = String(properties.id) + String(geometry.coordinates);                    // get the feature's id
                    if (!this.markersVK[id]) {                                   // if the marker val is falsey (i.e. the marker isn't yet in our local marker object of markers)
                        const el = document.createElement('div');
                        el.className = 'vk-marker-place marker-vk';
                        //console.log(el.className);                        // Create a HTML marker element
                        this.markersVK[id] = new mapboxgl.Marker({element: el}).setLngLat(geometry.coordinates);         // create the mapbox marker object
                    }
                    newMarkers[id] = this.markersVK[id];                                                    // Add the marker to a newMarkers object (why are we doing this if AND if not the marker already exists on the markers object?)
                    if (!this.markersOnScreenVK[id]){                                           // if the marker isn't already on the map..
                        this.markersVK[id].addTo(this.map);                                               // add it to the map.
                    }
                }
                })

                for (const id in this.markersOnScreenVK) {
                if (!newMarkers[id]) {
                    //let markersToGo = document.querySelectorAll('.id-' + String(id));
                    //console.log(markersToGo);
                    //markersToGo[0].parentNode.removeChild(markersToGo[0]);
                    this.markersOnScreenVK[id].remove();
                }
                }
                this.markersOnScreenVK = newMarkers;

                const placesForCluster = this.map.querySourceFeatures('vk-places', 'vk-clusters');
                placesForCluster.map( ({geometry, properties}) => {
                if(properties.cluster){
                    let cId = properties.cluster_id;
                    if (!this.clusterMarkersVK[cId]) {
                        const el = document.createElement('div');
                        el.className = 'vk-marker-place marker-vk-cluster';
                        this.clusterMarkersVK[cId] = new mapboxgl.Marker({element: el}).setLngLat(geometry.coordinates);
                    }
                    newClusterMarkers[cId] = this.clusterMarkersVK[cId];

                    if (!this.clusterMarkersOnScreenVK[cId]){
                        this.clusterMarkersVK[cId].addTo(this.map);
                    }
                }
                });

                // for every marker we've added previously, remove those that are no longer visible
                for (const c_id in this.clusterMarkersOnScreenVK) {
                    if (!newClusterMarkers[c_id])
                        this.clusterMarkersOnScreenVK[c_id].remove();
                }
                this.clusterMarkersOnScreenVK = newClusterMarkers;

                // for (const feature of features) {
                //     const coords = feature.geometry.coordinates;
                //     const props = feature.properties;
                //     const id = props.id;
                //     //console.log(markers[id]);
                //     let marker = markers[id];
                //     if (!marker) {
                //         const el = document.createElement('div');
                //         el.className = 'vk-marker-place marker-vk';
                //         marker = markers[id] = new mapboxgl.Marker({element: el}).setLngLat(coords);
                //         marker.addTo(this.map);
                //     }
                // }

            }
        },

        // Meta Map Functions //
        addMetaMarkersToMap: function(){
            if(this.map.getSource('meta-places')){
                var data = {
                    type: "FeatureCollection",
                    features: this.featureList
                }
                this.map.getSource('meta-places').setData(data);
            } else {
                this.map.addSource("meta-places", {
                type: "geojson",
                data: {
                    type: "FeatureCollection",
                    features: this.featureList
                },
                });
            }

            if(this.map.getLayer('meta-place-markers')){
                console.log('exists');
            } else {
                this.map.addLayer({
                id: "meta-place-markers",
                type: "circle",
                source: "meta-places",
                'paint': {
                    'circle-color': 'transparent',
                    'circle-radius': 40,
                    'circle-stroke-color': 'transparent'
                }
                });
            }
        },
        clearMetaPlaces(){
            this.dataPresent = false;
            this.map.removeLayer('meta-place-markers');
            let markersToGo = document.querySelectorAll('.meta-marker-place');
            for (var i = 0; i < markersToGo.length; i++) {
                markersToGo[i].parentNode.removeChild(markersToGo[i]) //or images[i].remove()
            }
            this.markers = [];
            this.featureList = [];
            if(this.popup){
                this.popup.remove();
                this.popup = null;
            }
            this.errorMessage = false;
            this.doubleCheckError = false;
            //this.clearMarkersFromMap();
        },
        mouseMetaEntered(map, e) {
            if(this.popup){
                this.popup.remove();
                this.popup = null;
            }
            this.map.getCanvas().style.cursor = 'pointer'
            var coordinates = e.features[0].geometry.coordinates.slice();
            //var description = e.features[0].properties.description;
            //var postcode = e.features[0].properties.postcode;

            while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                coordinates[0] +=
                e.lngLat.lng > coordinates[0] ? 360 : -360;
            }

            // Populate the popup and set its coordinates
            // based on the feature found.
            this.popup = new mapboxgl.Popup({ offset: [0, -30], className: "popupStyle", maxWidth: '300px', closeButton: false }).setLngLat(coordinates).setHTML('<div id="vue-meta-popup-content"></div>').addTo(map);
            new PopupContent({propsData: { feature: e },}).$mount('#vue-meta-popup-content');
            this.popup._update();
        },
        mouseMetaLeft() {
            this.map.getCanvas().style.cursor = '';
        },
        mouseMetaClicked() {
            this.markerClicked = true;
            //let url = 'https://www.instagram.com/explore/locations/' + e.features[0].properties.id;
            //window.open(url, '_blank');
        },
        toTitleCase(str) {
        return str.replace(
            /\w\S*/g,
            function(txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            }
        );
        },
        updateMetaMarkers(markers) {
            if(this.map.getSource('meta-places')){
                const places = this.map.querySourceFeatures('meta-places', 'meta-place-markers');
                const features = places;
                for (const feature of features) {
                    const coords = feature.geometry.coordinates;
                    const props = feature.properties;
                    const id = props.id;
                    //console.log(markers[id]);
                    let marker = markers[id];
                    if (!marker) {
                        const el = document.createElement('div');
                        el.className = 'meta-marker-place marker-meta';
                        marker = markers[id] = new mapboxgl.Marker({element: el}).setLngLat(coords);
                        marker.addTo(this.map);
                    }
                }
                return markers;
            }
        },
        close(){
            this.addDialog = false;
            this.metaClicked = false;
            this.placeData = null;
            this.lat = null;
            this.lon = null;
            this.errorMessageSubmit = false;
        },


        // Twitter Functions //
        twitterToggle(){
            this.twitterClicked = !this.twitterClicked;
        },
        goToTwitterClicked(){
            this.url = 'https://twitter.com/search?q=' + this.searchQuery + ' geocode%3A' + this.lat + '%2C' + this.lon + '%2C'
            if(this.disUnit == 'miles'){
                this.url = this.url + (Math.round((this.slider * 1.609344)* 100)/100) + 'km'
            } else {
                this.url = this.url + this.slider + 'km'
            }
            if(this.filter){
                this.url = this.url + ' ' + 'filter:' + this.filter;
            }
            if(this.question){
                this.url = this.url + ' ' + '?';
            }
            if(this.minLikes){
                this.url = this.url + ' ' + 'min_faves:' + this.minLikes;
            }
            if(this.minRetweets){
                this.url = this.url + ' ' + 'min_retweets:' + this.minRetweets;
            }
            this.url = this.url + '&src=typed_query&f=live'
            this.submitTwitterSearch(this.url);
            window.open(this.url);
        },
        submitTwitterSearch(url){
            let route = '../api/twittersearch/create';
            if(this.disUnit == 'miles'){
                this.sliderSub = (Math.round((this.slider * 1.609344)* 100)/100);
            } else {
                this.sliderSub = this.slider;
            }
            let payload = {
                'lat': this.lat,
                'lon': this.lon,
                'url': url,
                'twitter_media_id': this.filter,
                'keywords': this.searchQuery,
                'min_retweets': this.minRetweets,
                'question': this.question,
                'min_likes': this.minLikes,
                'radius': this.sliderSub,


            }
            this.$http.post(route, payload, {withCredentials: true})
        },

        searchClose(){
            this.searchDialog = false;
        },
        addClose(){
            this.addDialog = false;
            this.lat = null;
            this.lon = null;
        },
        settingsClose(){
            this.settingsDialog = false;
        },
        resetOptions(){
            this.searchQuery = '';
            this.showOptions = !this.showOptions;
            this.filter = null;
            this.question = false;
            this.minLikes = null;
            this.minRetweets = null;
        },

        // Map Search Options //
        goToGoogleMaps(){
            this.url = 'https://www.google.co.uk/maps/@' + this.lat + ',' + this.lon + ',17z';
            this.submitSearch(this.url, 'google_maps');
            window.open(this.url);
        },
        goToBingMaps(){
            this.url = 'https://www.bing.com/maps?cp=' + this.lat + '~' + this.lon + '&lvl=17';
            this.submitSearch(this.url, 'bing_maps');
            window.open(this.url);
        },
        // goToBaiduMaps(){
        //     var lat = ((this.lat*2) + 90) * 100000;
        //     var lon = ((this.lon*2) + 180) * 100000;
        //     this.url = 'http://map.baidu.com/?l=13&tn=B_NORMAL_MAP&c=' + lat + ',' + lon + '&s=gibberish';
        //     window.open(this.url);
        // },
        goToSunCalc(){
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            var hh = today.getHours(); // => 9
            var min = today.getMinutes(); // =>  30
            var time =  hh+ ':' + min;
            var date = yyyy + '.' + mm + '.' + dd;
            this.url = 'https://www.suncalc.org/#/' + this.lat + ',' + this.lon + ',17/' + date + '/' + time + '/8/1';
            this.submitSearch(this.url, 'sunCalc');
            window.open(this.url);
        },
        goToYandexMaps(){
            this.url = 'https://yandex.com/maps/?ll=' + this.lon + '%2C' + this.lat + '&z=17';
            this.submitSearch(this.url, 'yandex_maps');
            window.open(this.url);
        },
        goToMapillary(){
            this.url = 'https://www.mapillary.com/app/?menu=false&lat=' + this.lat + '&lng=' + this.lon + '&z=17&mapStyle=Mapillary+satellite';
            this.submitSearch(this.url, 'mapillary');
            window.open(this.url);
        },
        goToKartaView(){
            this.url = 'https://kartaview.org/map/@' + this.lat + ',' + this.lon + ',17z';
            this.submitSearch(this.url, 'kartaView');
            window.open(this.url);
        },
        goToSentinelHub(){
            this.url = 'https://apps.sentinel-hub.com/sentinel-playground/?source=S2L2A&lat=' + this.lat + '&lng=' + this.lon + '&zoom=17';
            this.submitSearch(this.url, 'sentinelHub_playground');
            window.open(this.url);
        },
        goToWikiMapia(){
            this.url = 'https://wikimapia.org/#lang=en&lat=' + this.lat + '&lon=' + this.lon + '&z=17&m=h';
            this.submitSearch(this.url, 'wikiMapia');
            window.open(this.url);
        },
        goToPeakVisor(){
            this.url = 'https://peakvisor.com/panorama.html?lat=' + this.lat + '&lng=' + this.lon + '&alt=100';
            this.submitSearch(this.url, 'peakVisor');
            window.open(this.url);
        },
        goToSnapMaps(){
            this.url = 'https://map.snapchat.com/@' + this.lat + ',' + this.lon + ',17.00z';
            this.submitSearch(this.url, 'snap_maps');
            window.open(this.url);
        },
        submitSearch(url, websiteId){
            let route = '../api/mapsearch/create';
            let payload = {
                'lat': this.lat,
                'lon': this.lon,
                'url': url,
                'website_id': websiteId,
            }
            this.$http.post(route, payload, {withCredentials: true})
        },
    },
    computed: {
        showRadiusWarning() {
            if(this.slider){
                return false;
            } else {
                if(this.filter || this.question || this.searchQuery || this.minLikes || this.minRetweets){
                    return true;
                } else {
                    return false;
                }
            }
        },
        generatedLink(){
            return 'https://www.instagram.com/location_search/?latitude=' + this.lat + '+&longitude=' + this.lon;
        },
        generatedVKLink(){
            return 'https://api.vk.com/method/photos.search?lat=' + this.lat + '&long=' + this.lon + '&radius=800&count=1000&offset=0&sort=0&access_token=' + this.vkAccessToken + '&v=6.0';
        },
        jsonValidator(){
            if(this.placeData){
                try {
                    JSON.parse(this.placeData);
                } catch (e) {
                    return false;
                }
                return true;
            } else {
                return false;
            }
        },
        VKJsonValidator(){
            if(this.vkPhotoData){
                try {
                    JSON.parse(this.vkPhotoData);
                } catch (e) {
                    return false;
                }
                return true;
            } else {
                return false;
            }
        }
    },
    watch : {
        mapStyle(){
            if(this.mapStyle == 'satellite'){
                this.map.setStyle('mapbox://styles/birdhunt/ckzf3vnph000414ny5b52cb18');
            } else if(this.mapStyle == 'dark') {
                this.map.setStyle('mapbox://styles/birdhunt/ckza8kmwp002r15pcg5x6pf0c');
            } else if(this.mapStyle == 'streets') {
                this.map.setStyle('mapbox://styles/birdhunt/ckzwour4e000c14kc8bpq9wcc');
            } else if(this.mapStyle == 'outdoor') {
                this.map.setStyle('mapbox://styles/birdhunt/ckzwp545b006114ngz3jvasa2');
            }
        },
        disUnit(){
            if(this.disUnit == 'kilometers'){
                this.unit = 'KM';
            } else {
                this.unit = 'mi.';
            }

        }
    }
}
</script>

<style>
#mainLoading { z-index: 4; position: absolute; width: 100%;  height: 100% !important; overflow-y: hidden !important;}
#map { z-index: 0 !important; position: absolute !important; width: 100% !important; height: 100% !important; border-width: unset !important; border-style: unset !important; border-color: unset !important; overflow-y: hidden !important;}

.marker {
    background-image: url('/BirdHuntPin.png');
    background-size: cover;
    width: 45px;
    height: 62px;
    cursor: pointer;
}
.marker-meta {
    background-image: url('/metaMarker.png');
    background-size: cover;
    width: 45px;
    height: 62px;
}
.marker-vk {
    background-image: url('/vkMarker.png');
    background-size: cover;
    width: 45px;
    height: 62px;
    cursor: pointer;
}
.marker-vk-cluster {
    background-image: url('/vkMarkerCluster.png');
    background-size: cover;
    width: 45px;
    height: 62px;
    cursor: pointer;
}
.customDialog.v-dialog--fullscreen {
    width: 41.66%;
    right: 0px;
    left: unset;
    border-radius: 0px;
}
.buttonSpacer {
    margin-top: 20vh;
}
.pinLogo{
    max-width: 3rem;
    max-height: 3rem;
}
.theme--dark.v-expansion-panels .v-expansion-panel {
    background-color: #242424 !important;
}
#actionsBtn{z-index: 3 !important; position: absolute !important; margin-top: 10px; margin-left: 10px; background-color: #44d62c !important;}
#alert{z-index: 3 !important; position: absolute !important; margin-bottom: 30px; width: calc(100% - 580px); margin-top:10px; margin-right: calc(10px + 240px + 10px); margin-left: calc(310px + 10px); height: 36px;}

@media (min-width: 767px) and (max-width: 1140px) {
    #alert{z-index: 3 !important; position: absolute !important; margin-bottom: 30px; width: calc(100% - 550px); margin-top:10px; margin-right: calc(10px + 240px + 10px); margin-left: calc(280px + 10px); height: 36px;}
}

@media (max-width: 767px) {
        .visible-mobile{
            display: inline;
        }
        .hidden-mobile {
            display: none;
        }
        #submissionBtn{z-index: 3 !important; position: fixed !important; bottom: 0px; width: 100vw !important; margin-bottom: 10px; margin-left: 10px; max-width: calc(100vw - 20px);}
        .customDialog.v-dialog--fullscreen {
            width: 100%;
            right: 0px;
            left: 0px;
            border-radius: 0px;
        }
        #map{ z-index: 0 !important; position: fixed !important; width: 100vw !important; height: 100vh !important; border-width: unset !important; border-style: unset !important; border-color: unset !important; overflow-y: hidden !important;}
        #alert{z-index: 3 !important; position: fixed !important; bottom: 30px; width: 100vw !important; max-width: calc(100vw - 20px); margin-top:unset; margin-right: 10px; margin-left: 10px; height: unset;}
        .noScroll{
            position: fixed;
        }
}

@media (min-width: 767px) {
    .visible-mobile{
        display: none;
    }

}

</style>
