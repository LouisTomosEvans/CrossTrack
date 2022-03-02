<template>
  <v-container class="col-12" style="padding: 24px; padding-top: 12px; justify-content: space-between;">
        <v-row>  
          <div class="col-12" style="padding: 12px;">
            <h5 style="color:white;">
              <b>
              <v-icon style="color: white; font-size: 1.2rem; margin-bottom: 0.3rem;">mdi-image</v-icon> IMAGE ANALYSER<span style="color: #44d62c;">.</span>
              </b>
            </h5>
          </div>
        </v-row>
        <v-row class="mb-6">
          <div class="col-12" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center; background-color: #283046;">
              <div class="col-12 d-flex mt-0 mb-0">
                <div class="p-12 d-flex justify-items-center align-items-center" style="width: 100%; border: 2px dashed #44d62c; height: 650px;" @dragover="dragover" @dragleave="dragleave" @drop="drop">
    <input type="file" name="fields[assetsFieldHandle][]" id="assetsFieldHandle" class="w-px h-px opacity-0 overflow-hidden absolute" @change="onChange" ref="file" accept=".pdf,.jpg,.jpeg,.png" />
    <label for="assetsFieldHandle" class="block cursor-pointer">
            <div  v-if="!this.filelist.length" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                <h5>
                <strong style="color: white;">
                  DRAG & DROP AN IMAGE HERE OR <br>CLICK THE BUTTON BELOW
                </strong>
                </h5>
                <v-btn title="Add image" elevation=0 outlined color="#44d62c" @click='addFilesClicked()'>Add Image</v-btn>
            </div>
            </label>
            <div style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);" v-if="this.filelist.length" v-cloak>
              <div class="mt-4" v-if="this.filelist.length" v-cloak>
                <h5 class="mb-3"><strong style="color: white;">ARE YOU SURE YOU WANT<br>TO UPLOAD THIS FILE?</strong></h5>
                <h5 class="text-sm p-1" v-for="file in filelist" v-bind:key="file.id">
                <strong style="color: #44d62c;">
                  {{ file.name }}
                </strong>
                <button type="button" class="ml-3" @click="remove(filelist.indexOf(file))" title="Remove file" style="color: red;">x</button>
                <div class="mt-3">
                  <v-btn class="mt-3" elevation=0 title="Upload file" outlined color="#44d62c" @click='fileConfirmationClicked()'>Upload</v-btn>
                </div>
              </h5>
            </div>
            </div>
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

</style>