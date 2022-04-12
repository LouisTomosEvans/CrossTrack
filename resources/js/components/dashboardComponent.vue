<template>
  <v-container fluid class="col-12 mainContainer" style="padding: 24px; padding-top: 12px; justify-content: space-between;">
        <v-row style=" margin-top: 1rem;">
            <div v-if="showTrialBanner">
                <v-alert dense type="warning" class="col-12" style="font-size: 0.75rem;">You are currently within your free trial period. Your trial will expire on <b>{{ this.endDate }}</b>.</v-alert>
            </div>
          <div class="col-12 col-lg-12" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center; overflow: hidden;" height="300px">
              <img class="banner" src="HuntIntelBlackLogo.png"/>
              <!-- <img class="bannerRight" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMUAAABTCAMAAAAY2TOcAAABAlBMVEUAAADtj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj50b0aftj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj53tj50b0acb0acb0aftj53tj53tj53tj53/vAEb0af/vAEb0aftj50b0acb0acb0af/vAEb0af/vAEb0af/vAEb0acb0af/vAH/vAH/vAH/vAH/vAH/vAEb0af/vAEb0af4qz7/vAHtj50b0af/vAFW6jjPAAAAU3RSTlMAAvcI/RXta/IF3tfCWUnStU8sIOF86L2ml4LNuHE3EAySU5wpKCQbsY5hRfnIq6Iy5NaxnYiFdz708uBkQQtbTph5IBT56MXw4puXSEY9IpIxHhHzkVEAAAVwSURBVHja7dtpV9pAGAXgmz00gOyL7CKyKWC12s1q7b4vL/3/f6U0CBPizICVWNLj88GPntzhvZkJJ4DsSgShR0SlKsKOJvRiDeGm0x+5GELNpqn8HkLMpitqVkNo2TTn9BFWNnkUDISTTV6mpSCMbFp0MEIIZchHb9QROhm65nAHYZMhjkQa4ZIhHvV0Q4+Ir14+e/Ps0095CsZ5jA30+cmvP558WZKCGRoIELlwM98mIVzvX2GBQ0JmT8HMZqT4+GvmJTzi2CIxPYuZzUjxYZ7iGWaUZIkkKTLZ8s78w9iMFL/m3swyxCYBhCnUQl/BAT2wNExtRAr/ZxHpOUTCFCWrhokhEZnb05JvRIrFXmhWhkiUwmyMMJWdfizFFrAZKbz3qHolR1dyKPkKnY+xGYrRlN5ZunlcHr+4gxRsv6hlTZpLILpQ6O00PEY0dyAv+sV4/HA36BRs7/5xYpPHtieFOoj7rrROzKTodYjsPh2Px0/PcTfaXZsWJOcptio1XHO4WJgTQdFfPxy72FQFKF1Uyac9TWEXR+CJ0iK1mQLH0djFpio4reE++eXcC42yQvs06ZrEGWegHs5ivEOgUgWdrksAhe09CJ0SRykWgc+L47Hr7WsEqNohrm3I7RBXpnKt6Oduv4McqMdlEtiBXIoEzEdtzlRdIDDxKAmlIafpJLI/TPmn6hIB0OKNApIlEjNXeJ6VKPcRsFalrBJZOHsguwwskyepUgyBqe00p2uo1gCtq5PICZYpkpTZHCEISvU0Or/swvQGtSUrt1yFJB7sFCd/ulUFa2XECjnyOIMrklXF5ZaLk5BZiVwdeg8bZ+sKEnl8UtJ9a6XMW3IgLLdciwT0ogHAYKMVj+C20r2BTddkMadYtqDcchFBqcopuDzDag6TGv6a1u86xKO3F4ImyO8RluPe4pw4rnTJyx7E6n93Q02oJJDAopjJLbdcmTOIFhueJPmonV4NN1FPFv0rJb9Io8Art1yDfPa7NTB1nbOrly0DK3tEUjlO3ZKHnHJLWbRo4DsBHxCPHrXakDFS8d5poxB1CrB0Ylab+lqR5vJgVrzVls7gc0IiB6dpf4PT1aS13eyUDvfnA7gHJG0SawkOuA6LuYI0MTnO97Z9kjhxFy7Vj1W6hbxjih4NqjkSiUJAe6SvXm4obNlO6rz/ppKIainAUJXu/tp0qRwS6EFoND3n7mEVDk0V0jc8L26l3ALkSCI5G/Q8cdl1iEVOVSJTwSo60yGvQiBLfA3taoIl5U2wKxoSTxNSe9Hl5Wb7WiYmTlwlnlxc9uzOqj2nbBNHFXKKlcVKLLKlL4hEbN4iG5hTOiSwDa/e/vWhxLqcNduQSvBrzdQeyKrN9G3yqeDOVDi1XjRSZdVmUoe+Q4CBOzPi1NrHklabaW+R1wB3RzF9teYoSKvN1MvkEccdGizWmqfuSKvNRJo0l1Fwh6yFWvOlbHm1mawnZ3CeH73Aopan1kKxJdVmYiq59DQC85zz9f4huboaJIpLqs08Nv3P0+sPMfH0AguGrNZiWmlJtZmWu8HEEJjLsesSXj0i6hhYIm3SqiNvHBCZGoJz8XQ88RxebVZrmeSyajNahxoI0u7DWQhmkLrZI3YSyyiNFAL14ug5/k4kOqt2qLVzbrVD/S74RF93qx122Um1Q/w6+xWlTEmEn1HEvXv37v2P+vmw/lLHw9LJ2cgYu8dHWFGkSBNOG5vm659X3M6xEiNPrjzWp5qP47bO393kvbAEuaLrG6nWYB1HuuPx1DFWYTg00YxgXRo6TWRxS6/fTl80vFhxpLZIr6z1cD2hF28/UpMMR1+xKoNN8TpoDlEnhds7+r6Lfyce3bhftf8GxgHAIi+xyUgAAAAASUVORK5CYII="/> -->
              <div class="dashboardContent">
              <div style="z-index: 1; position: absolute; left: 50%; transform: translate(-50%, -50%); align-items: center;" >
                <div class="mt-4" style="padding: 12px; background-color: #242424; border-radius: 50%; width: 4rem; height: 4rem; display: flex; align-items: center; justify-content: center; box-shadow: 0px 0px 25px #44d62c25;  margin-left: auto; margin-right: auto;"><v-icon style="color: #44d62c !important;">mdi-thumb-up</v-icon></div>
                <h4 class="mt-5" style="color: white;" v-if="user"><b>Welcome Back {{user.name}}!</b></h4>
                <p style="color: white; font-size: 0.75rem;">Thank you for using Hunt Intelligence!</p>
              </div>
              </div>

            </v-card>
          </div>
          <!-- <div class="col-12 col-lg-6" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center; background-color: #283046;" height="200px">
              <div class="d-flex" style="height: 50%">
              <div class="col-6" style="display: inline-block;">
                <v-list-item class="displayCard">
                  <div style="padding: 12px; background-color: #28C76F25; border-radius: 50%; width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center; "><v-icon style="color: #28C76F !important;">mdi-map-marker-question</v-icon></div>
                  <v-list-item-content style="text-align:left; padding-left: 12px;">
                    <v-list-item-title style="color: #28C76F;"><b>32,031</b></v-list-item-title>
                    <v-list-item-subtitle style="color: white; font-size: 0.75rem;"><b>LOCATIONS EXPLORED<span style="color: #44d62c;">.</span></b></v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </div>
              <div class="col-6" style="display: inline-block;">
                <v-list-item class="displayCard">
                  <div style="padding: 12px; background-color: #7367F025; border-radius: 50%; width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center; "><v-icon style="color: #7367F0 !important;">mdi-image</v-icon></div>
                  <v-list-item-content style="text-align:left; padding-left: 12px;">
                    <v-list-item-title style="color: #7367F0;"><b>??</b></v-list-item-title>
                    <v-list-item-subtitle style="color: white; font-size: 0.75rem;"><b>MORE TOOLS COMING SOON...</b></v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </div>
              </div>
              <div class="d-flex" style="height: 50%">
              <div class="col-6" style="display: inline-block;">
                <v-list-item class="displayCard">
                  <div style="padding: 12px; background-color: #D4101C25; border-radius: 50%; width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center; "><v-icon style="color: #D4101C !important;">mdi-account</v-icon></div>
                  <v-list-item-content style="text-align:left; padding-left: 12px;">
                    <v-list-item-title style="color: #D4101C;"><b>??</b></v-list-item-title>
                    <v-list-item-subtitle style="color: white; font-size: 0.75rem;"><b>MORE TOOLS COMING SOON...</b></v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </div>
              <div class="col-6" style="display: inline-block;">
                <v-list-item class="displayCard">
                  <div style="padding: 12px; background-color: #FF9F4325; border-radius: 50%; width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center; "><v-icon style="color: #FF9F43 !important;">mdi-content-save</v-icon></div>
                  <v-list-item-content style="text-align:left; padding-left: 12px;">
                    <v-list-item-title style="color: #FF9F43;"><b>??</b></v-list-item-title>
                    <v-list-item-subtitle style="color: white; font-size: 0.75rem;"><b>MORE TOOLS COMING SOON...</b></v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </div>
              </div>
           </v-card>
          </div> -->
        </v-row>
        <v-row>
          <div class="col-12">
            <v-divider style="color:white;"></v-divider>
          </div>
          <div class="col-12" style="padding: 12px;">
            <h5 style="color:white;">
              <b>
              OSINT TOOLKIT<span style="color: #44d62c;">.</span>
              </b>
            </h5>
          </div>
        </v-row>
        <v-row class="mb-6">
          <!-- <div class="col-12 col-lg-6 col-xxl-4" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center; background-color: #283046;" height="250px">
              <div class="col-10">
              <v-list-item class="displayCard">
                  <div style="padding: 12px; background-color: #1b9df025; border-radius: 50%; width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center; "><v-icon style="color: #1b9df0 !important;">mdi-account-search</v-icon></div>
                  <v-list-item-content style="text-align:left; padding-left: 12px;">
                    <v-list-item-title style="color: #1b9df0;"><b>ACCOUNT FINDER</b></v-list-item-title>
                    <v-list-item-subtitle style="color: white; font-size: 0.75rem;"><b>Search Usernames Across The Internet<span style="color: #44d62c;">.</span></b></v-list-item-subtitle>
                  </v-list-item-content>
              </v-list-item>
              <div class="mt-1" style="text-align: left; margin-left: calc(12px + 3rem);">
                    <p style="color: white; font-size: 0.75rem;">Lorem ipsum, dolor sit amet consectetur adcing elit. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. voluptates. </p>
              </div>
              </div>
              <v-btn class="toolButton" :to="'/account-finder'" tile style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
           </v-card>
          </div> -->
          <div class="col-12 col-lg-6 col-xxl-4" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center; background-color: #283046;" height="250px">
              <div class="col-10">
              <v-list-item class="displayCard">
                  <div style="padding: 12px; background-color: #28C76F25; border-radius: 50%; width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center; "><v-icon style="color: #28C76F !important;">mdi-map-marker-question</v-icon></div>
                  <v-list-item-content style="text-align:left; padding-left: 12px;">
                    <v-list-item-title style="color: #28C76F;"><b>LOCATION TOOLS</b></v-list-item-title>
                    <v-list-item-subtitle style="color: white; font-size: 0.75rem;"><b>GEOINT & Geo-Locate<span style="color: #44d62c;">.</span></b></v-list-item-subtitle>
                  </v-list-item-content>
              </v-list-item>
              <div class="mt-1" style="text-align: left; margin-left: calc(12px + 3rem);">
                    <p style="color: white; font-size: 0.75rem;">Advanced filters let you find important information fast. You can ensure that no intelligence goes un-noticed. Allowing you and your team to find geographical and social media information quickly all from one map based tool.</p>
              </div>
              </div>
              <v-btn class="toolButton" :to="'/location-tools'" tile style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
           </v-card>
          </div>
          <!-- <div class="col-12 col-lg-6 col-xxl-4" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center; background-color: #283046;" height="250px">
              <div class="col-10">
              <v-list-item class="displayCard">
                  <div style="padding: 12px; background-color: #EA545525; border-radius: 50%; width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center; "><v-icon style="color: #EA5455 !important;">mdi-account-tie</v-icon></div>
                  <v-list-item-content style="text-align:left; padding-left: 12px;">
                    <v-list-item-title style="color: #EA5455;"><b>PERSON FINDER</b></v-list-item-title>
                    <v-list-item-subtitle style="color: white; font-size: 0.75rem;"><b>Find Personal Info & Background<span style="color: #44d62c;">.</span></b></v-list-item-subtitle>
                  </v-list-item-content>
              </v-list-item>
              <div class="mt-1" style="text-align: left; margin-left: calc(12px + 3rem);">
                    <p style="color: white; font-size: 0.75rem;">Lorem ipsum, dolor sit amet consectetur adcing elit. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. voluptates. </p>
              </div>
              </div>
              <v-btn class="toolButton" tile style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
           </v-card>
          </div>
          <div class="col-12 col-lg-6 col-xxl-4" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center; background-color: #283046;" height="250px">
              <div class="col-10">
              <v-list-item class="displayCard">
                  <div style="padding: 12px; background-color: #FF9F4325; border-radius: 50%; width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center; "><v-icon style="color: #FF9F43 !important;">mdi-text-box-search</v-icon></div>
                  <v-list-item-content style="text-align:left; padding-left: 12px;">
                    <v-list-item-title style="color: #FF9F43;"><b>TEXT ANALYSER</b></v-list-item-title>
                    <v-list-item-subtitle style="color: white; font-size: 0.75rem;"><b>Pluck Personal Info From Text<span style="color: #44d62c;">.</span></b></v-list-item-subtitle>
                  </v-list-item-content>
              </v-list-item>
              <div class="mt-1" style="text-align: left; margin-left: calc(12px + 3rem);">
                    <p style="color: white; font-size: 0.75rem;">Lorem ipsum, dolor sit amet consectetur adcing elit. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. voluptates. </p>
              </div>
              </div>
              <v-btn class="toolButton" :to="'/text-analyser'" tile style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
           </v-card>
          </div>
          <div class="col-12 col-lg-6 col-xxl-4" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center; background-color: #283046;" height="250px">
              <div class="col-10">
              <v-list-item class="displayCard">
                  <div style="padding: 12px; background-color: #7367F025; border-radius: 50%; width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center; "><v-icon style="color: #7367F0 !important;">mdi-image</v-icon></div>
                  <v-list-item-content style="text-align:left; padding-left: 12px;">
                    <v-list-item-title style="color: #7367F0;"><b>IMAGE ANALYSER</b></v-list-item-title>
                    <v-list-item-subtitle style="color: white; font-size: 0.75rem;"><b>Discover Image Info<span style="color: #44d62c;">.</span></b></v-list-item-subtitle>
                  </v-list-item-content>
              </v-list-item>
              <div class="mt-1" style="text-align: left; margin-left: calc(12px + 3rem);">
                    <p style="color: white; font-size: 0.75rem;">Lorem ipsum, dolor sit amet consectetur adcing elit. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. voluptates. </p>
              </div>
              </div>
              <v-btn class="toolButton" :to="'/image-analyser'" tile style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
           </v-card>
          </div> -->
          <!-- <div class="col-12 col-lg-6 col-xxl-4" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center; background-color: #283046;" height="250px">
              <div class="col-10">
              <v-list-item class="displayCard">
                  <div style="padding: 12px; background-color: #F35B0425; border-radius: 50%; width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center; "><v-icon style="color: #F35B04 !important;">mdi-image</v-icon></div>
                  <v-list-item-content style="text-align:left; padding-left: 12px;">
                    <v-list-item-title style="color: #F35B04;"><b>VIDEO ANALYSER</b></v-list-item-title>
                    <v-list-item-subtitle style="color: white; font-size: 0.75rem;"><b>Discover Video Info<span style="color: #44d62c;">.</span></b></v-list-item-subtitle>
                  </v-list-item-content>
              </v-list-item>
              <div class="mt-1" style="text-align: left; margin-left: calc(12px + 3rem);">
                    <p style="color: white; font-size: 0.75rem;">Lorem ipsum, dolor sit amet consectetur adcing elit. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. voluptates. </p>
              </div>
              </div>
              <v-btn class="toolButton" tile style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
           </v-card>
          </div> -->
        <!-- <div class="col-12 col-lg-6 col-xxl-4" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center; background-color: #283046;" height="250px">
              <div class="col-10">
              <v-list-item class="displayCard">
                  <div style="padding: 12px; background-color: #F35B0425; border-radius: 50%; width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center; "><v-icon style="color: #F35B04 !important;">mdi-water-outline</v-icon></div>
                  <v-list-item-content style="text-align:left; padding-left: 12px;">
                    <v-list-item-title style="color: #F35B04;"><b>LEAK FINDER</b></v-list-item-title>
                    <v-list-item-subtitle style="color: white; font-size: 0.75rem;"><b>Search Emails in Leaked Databases<span style="color: #44d62c;">.</span></b></v-list-item-subtitle>
                  </v-list-item-content>
              </v-list-item>
              <div class="mt-1" style="text-align: left; margin-left: calc(12px + 3rem);">
                    <p style="color: white; font-size: 0.75rem;">Lorem ipsum, dolor sit amet consectetur adcing elit. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. voluptates. </p>
              </div>
              </div>
              <v-btn class="toolButton" :to="'/leak-finder'" tile style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
           </v-card>
          </div> -->
          <div class="col-12 col-lg-6 col-xxl-4" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center; background-color: #283046;" height="250px">
              <div class="col-10">
              <v-list-item class="displayCard">
                  <div style="padding: 12px; background-color: #EAD20225; border-radius: 50%; width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center; "><v-icon style="color: #EAD202 !important;">mdi-lightbulb-outline</v-icon></div>
                  <v-list-item-content style="text-align:left; padding-left: 12px;">
                    <v-list-item-title style="color: #EAD202;"><b>TOOL IDEA</b></v-list-item-title>
                    <v-list-item-subtitle style="color: white; font-size: 0.75rem;"><b>Know What Tool You Want To See Next?<span style="color: #44d62c;">.</span></b></v-list-item-subtitle>
                  </v-list-item-content>
              </v-list-item>
              <div class="mt-1" style="text-align: left; margin-left: calc(12px + 3rem);">
                    <p style="color: white; font-size: 0.75rem;">Do you have an idea for a tool but don't know how to make it? Can you think of a way to make this product better? Message me on twitter explaining your tool idea and you'll be using it very soon!</p>
              </div>
              </div>
              <v-btn class="toolButton" href="https://twitter.com/LouisTomosEvans" target="_blank" tile style="background-color: #1D9BF025; color: #1D9BF0 !important;" icon><v-icon style="color: #1D9BF0 !important;">mdi-twitter</v-icon></v-btn>
           </v-card>
          </div>
        </v-row>
    </v-container>
</template>

<script>
export default {

    data(){
    return{
        user: '',
        plan: '',
    }},
    mounted() {
        this.getUser();
        this.getPlan();
    },
    methods:{
        getUser(){
            this.loading = true;

            let route = '../api/user/';
            this.$http.get(route, {withCredentials: true}).then((res) => {
                this.user = res.data;
            })
            .finally(() => {
            this.loading = false;
            });
        },
        getPlan(){
            this.loading = true;

            let route = '../api/plan/';
            this.$http.get(route, {withCredentials: true}).then((res) => {
                this.plan = res.data[0];
                if(res.data[1]){
                    this.endDate = res.data[1];
                }
            })
            .finally(() => {
            this.loading = false;
            });
        }
    },
    computed: {
        showTrialBanner() {
            if(this.plan == 'Free Trial'){
                return true;
            }
            return false;
        }
    }

}
</script>

<style>
    .background{
        background-color: #242424 !important;
    }
    .background-main{
        background-color: #1A1A1A !important;
    }
    .displayCardBackground{
      background-image: linear-gradient(45deg, #242424, #2f2f2f);
    }
    .v-list-item__content.header{
        padding: 0.5rem;
    }
    .v-list-item__content.navbar{
        padding: 0rem;
    }
    .v-list-item.displayCard{
        padding: 0rem;
    }
    .home{
        background-color: rgb(0,0,0,0.12);
        cursor: pointer;
        height: 60px;
    }
    .banner{
      position: absolute;
      left: 50%;
      top: 50%;
      z-index: 0;
      width: 120%;
      transform: translate(-50%, -50%);
      opacity: 0.1;
    }
    .cardShadow{
      box-shadow: 0px 0px 15px rgb(0,0,0,0.40) !important;
    }
    .welcomeBack{
      background-image: linear-gradient(45deg, #44d62c, #70dc60);
    }
    .toolButton{
      position: absolute !important;
      right: 24px;
      bottom: 24px;
    }
    .dashboardContent{
        z-index: 2;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%);
        width: 100%;
    }

</style>
