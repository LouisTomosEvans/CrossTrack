<template>
  <v-container class="col-12" style="padding: 24px; padding-top: 12px; justify-content: space-between;">
        <v-row>  
          <div class="col-12" style="padding: 12px;">
            <h5 style="color:white;">
              <b>
                <v-icon style="color: white; font-size: 1.2rem; margin-bottom: 0.3rem;">mdi-water-outline</v-icon> LEAK FINDER<span style="color: #44d62c;">.</span>
              </b>
            </h5>
          </div>
        </v-row>
        <v-row class="mb-6">
          <div class="col-12" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center; overflow-y: hidden;" height="400px">
              <img class="accountFinderHeader" src="https://www.privacysharks.com/wp-content/uploads/2021/06/linkedin_leak_raw-1.png">
              <div class="accountFinderContent">
              <div style="padding: 12px; background-color: #242424; border-radius: 50%; width: 4rem; height: 4rem; display: flex; align-items: center; justify-content: center; box-shadow: 0px 0px 25px #44d62c25; margin-left: auto; margin-right: auto;"><v-icon style="color: #44d62c !important;">mdi-water-outline</v-icon></div>
              <h4 class="mt-7" style="color: white;"><b>Leak Finder</b></h4>
              <p style="color: white; font-size: 0.75rem;">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <div class="d-flex justify-content-center">
                <v-text-field dark clearable hide-details dense color="white" style="font-size: 0.75rem; margin: 0px; padding: 0px; font-color: white; margin-top: 5px; display: inline-block;" label="Search Email" outlined></v-text-field>
                <v-btn icon tile @click="searchClicked()" style="display: inline-block; height: 45px; width: 45px; margin-left: 0.5rem; background-color: #44d62c25 !important;"><v-icon style="color: #44d62c !important">mdi-magnify</v-icon></v-btn>
              </div>
              </div>
            </v-card>
          </div>
        </v-row>
    </v-container>
</template>

<script>
  export default {
    data () {
      return {
        filelist: [], // Store our uploaded files
        section: "PDF",
        }
    },
    methods: {
    onChange() {
      this.filelist = [...this.$refs.file.files];
    },
    remove(i) {
      this.filelist.splice(i, 1);
    },
    dragover(event) {
      event.preventDefault();
      // Add some visual fluff to show the user can drop its files
      if (!event.currentTarget.classList.contains('bg-green-300')) {
        event.currentTarget.classList.remove('bg-gray-100');
        event.currentTarget.classList.add('bg-green-300');
      }
    },
    dragleave(event) {
      // Clean up
      event.currentTarget.classList.add('bg-gray-100');
      event.currentTarget.classList.remove('bg-green-300');
    },
    drop(event) {
      event.preventDefault();
      this.$refs.file.files = event.dataTransfer.files;
      this.onChange(); // Trigger the onChange event manually
      // Clean up
      event.currentTarget.classList.add('bg-gray-100');
      event.currentTarget.classList.remove('bg-green-300');
    },
    addFilesClicked(){
        document.getElementById("assetsFieldHandle").click();
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
    .v-label--active{
        display: none !important;
    }
    .theme--light.v-input input::placeholder, .theme--light.v-input textarea::placeholder{
        color: white !important;
    }
    .theme--light.v-icon{
        color:  white !important;
    }
    .v-input .v-label {
        font-size: 0.75rem;
    }
    .theme--dark.v-data-table {
        background-color: #242424 !important;
        color: #FFFFFF;
    }
    .v-select-list.theme--light.v-list {
        background-color: #242424 !important;
        color: #FFFFFF;
    }
    .v-data-table > .v-data-table__wrapper > table > tbody > tr > td, .v-data-table > .v-data-table__wrapper > table > thead > tr > td, .v-data-table > .v-data-table__wrapper > table > tfoot > tr > td{
        font-size: 0.75rem !important;
    }
    .v-data-table > .v-data-table__wrapper > table > thead, .v-data-table > .v-data-table__wrapper > table > thead{
        font-size: 0.75rem !important;
        background-color: #00000020 !important;
        color: white;
    }
    .v-data-table > .v-data-table__wrapper > table > tbody > tr:hover {
        background-color: #00000010 !important;
        cursor: pointer;
    }
    .v-list-item--dense .v-list-item__title, .v-list-item--dense .v-list-item__subtitle, .v-list--dense .v-list-item .v-list-item__title, .v-list--dense .v-list-item .v-list-item__subtitle {
        color: white;
        font-size: 0.75rem;
    }
    .v-list-item .v-list-item__title, .v-list-item .v-list-item__subtitle{
        color: white;
        font-size: 0.75rem;
    }
    .theme--dark.v-data-table tbody tr.v-data-table__selected{
        background-color: #00000010 !important;
    }
    .accountFinderHeader{
      position: absolute;
      left: 0px;
      bottom: 0px;
      width: 100%;
      opacity: 0.05;
      z-index: 0;
      min-height: 100%;
    }
    .accountFinderContent{
      z-index: 2;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 35%;
    }

</style>