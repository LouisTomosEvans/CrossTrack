<template>
  <v-container class="col-12 mainContainer" style="padding: 24px; padding-top: 12px; justify-content: space-between;">
        <v-row>
          <div class="col-12" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center; overflow-y: hidden;" height="400px">
              <img class="knowledgeBaseHeader" src="https://images.pexels.com/photos/247899/pexels-photo-247899.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260">
              <div class="knowledgeBaseContent">
              <div style="padding: 12px; background-color: #242424; border-radius: 50%; width: 4rem; height: 4rem; display: flex; align-items: center; justify-content: center; box-shadow: 0px 0px 25px #44d62c25; margin-left: auto; margin-right: auto;"><v-icon style="color: #44d62c !important;">mdi-school</v-icon></div>
              <h4 class="mt-7" style="color: white;"><b>Knowledge Base</b></h4>
              <p style="color: white; font-size: 0.75rem;">The Knowledge Base is where we will share Tools, Tips, Guides, Interviews and Tutorials about all things OSINT</p>
              <!-- <v-text-field dark clearable hide-details dense color="white" style="font-size: 0.75rem; margin: 0px; padding: 0px; font-color: white; margin-top: 1rem;" label="Search Knowledge Base" outlined></v-text-field> -->
              </div>
            </v-card>
          </div>
        </v-row>
        <v-row>
          <div class="col-12">
          <v-divider style="color: white;" class="my-6"></v-divider>
          </div>
        </v-row>
        <v-row>
          <div class="col-12 col-lg-6" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                <div class="articleHeader d-flex justify-content-center align-items-center" style="background-color: #1d9bf0;">
                <img class="articleHeaderLogo" style="height: 60px;" src="/BirdHuntLogo.png">
                </div>
                <div style="text-align: left; margin-top: 200px; padding: 12px">
                    <h6 style="color: white;">BirdHunt</h6>
                    <p style="color: white; font-size: 0.75rem;">BirdHunt is a Free OSINT tool to find tweets based on a location. BirdHunt uses Twitter's GeoCoded tweet search to find tweets based on their location. BirdHunt is simple to use and designed for OSINT researchers.</p>
                </div>
              <v-btn class="toolButton" tile style="background-color: #44d62c25; color: #44d62c !important;" href="https://birdhunt.co/" target="_blank" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
            </v-card>
          </div>
          <div class="col-12 col-lg-6" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
                <div class="articleHeader d-flex justify-content-center align-items-center" style="background-color: #e10367;">
                <img class="articleHeaderLogo" style="height: 60px;" src="/InstaHuntLogo.png">
                </div>
               <div style="text-align: left; margin-top: 200px; padding: 12px">
                    <h6 style="color: white;">InstaHunt</h6>
                    <p style="color: white; font-size: 0.75rem;">InstaHunt is a Free OSINT tool to find Instagram Places and Posts based on a location. InstaHunt uses Instagram Places and Posts to search and find Instagram posts based on their location. InstaHunt is simple to use and designed for OSINT Researchers and Journalists.</p>
              </div>
              <v-btn class="toolButton" tile style="background-color: #44d62c25; color: #44d62c !important;" href="https://instahunt.co/" target="_blank" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
            </v-card>
          </div>
          <!-- <div class="col-12 col-lg-6" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
               <img class="articleHeader" src="https://images.pexels.com/photos/270404/pexels-photo-270404.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260">

               <div style="text-align: left; margin-top: 200px; padding: 12px">
                    <h6 style="color: white;">ARTICLE TITLE</h6>
                    <p style="color: white; font-size: 0.75rem;">Lorem ipsum, dolor sit amet consectetur adcing elit. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. voluptates...</p>
              </div>
              <v-btn class="toolButton" tile style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
            </v-card>
          </div> -->
          <!-- <div class="col-12 col-lg-6" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
               <img class="articleHeader" src="https://images.pexels.com/photos/270360/pexels-photo-270360.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260">

               <div style="text-align: left; margin-top: 200px; padding: 12px">
                    <h6 style="color: white;">ARTICLE TITLE</h6>
                    <p style="color: white; font-size: 0.75rem;">Lorem ipsum, dolor sit amet consectetur adcing elit. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. voluptates...</p>
              </div>
              <v-btn class="toolButton" tile style="background-color: #44d62c25; color: #44d62c !important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
            </v-card>
          </div> -->
          <!-- <div class="col-12 col-lg-6" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center;" height="400px">
               <img class="articleHeader" src="https://images.pexels.com/photos/177598/pexels-photo-177598.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260">

               <div style="text-align: left; margin-top: 200px; padding: 12px">
                    <h6 style="color: white;">ARTICLE TITLE</h6>
                    <p style="color: white; font-size: 0.75rem;">Lorem ipsum, dolor sit amet consectetur adcing elit. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. Fugit exercitationem nobis aut sapiente vero voluptates beatae sunt, cumque ex. voluptates...</p>
              </div>
              <v-btn class="toolButton" tile style="background-color: #44d62c25; color: #44d62c!important;" icon><v-icon style="color: #44d62c !important;">mdi-arrow-right-bold</v-icon></v-btn>
            </v-card>
          </div> -->
        </v-row>
    </v-container>
</template>

<script>
export default {

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
    .knowledgeBaseHeader{
      position: absolute;
      left: 0px;
      bottom: 0px;
      width: 100%;
      opacity: 0.1;
      z-index: 0;
      min-height: 100%;
    }
    .knowledgeBaseContent{
      z-index: 2;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 35%;
    }
    .articleHeader{
      position: absolute;
      left: 0px;
      top: 0px;
      height: 200px;
      width: 100%;
      border-bottom: 1px solid #44d62c;
    }

</style>
