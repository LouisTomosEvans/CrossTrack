<template>
  <v-container class="col-12" style="padding: 24px; padding-top: 12px; justify-content: space-between;">
        <v-row>
          <div class="col-12" style="padding: 12px;">
            <h5 style="color:white;">
              <b>
              <v-icon style="color: white; font-size: 1.2rem; margin-bottom: 0.3rem;">mdi-content-save</v-icon> MY RECORDS<span style="color: #44d62c;">.</span>
              </b>
            </h5>
          </div>
        </v-row>
        <v-row class="mb-6">
          <div class="col-12" style="padding: 12px;">
            <v-card class="cardShadow displayCardBackground" style="padding: 12px; text-align: center; background-color: #283046;">
              <div class="col-12 d-flex pb-0 mt-0 mb-0">
                <div class="col-6 d-flex">

                </div>
                <div class="col-6 d-flex pr-0">
                    <v-text-field dark  hide-details dense color="white" style="font-size: 0.75rem; margin: 0px; padding: 0px; font-color: white; margin-right: 0.75rem;" label="Search Records" outlined></v-text-field>
                    <v-select dark class="select" :items="items" hide-details dense color="white" style="font-size: 0.75rem; margin: 0px; padding: 0px; font-color: white;" label="Select Record Type" outlined></v-select>
                </div>
              </div>
              <div class="col-12 d-flex mt-0 mb-1 pt-0">
                    <v-data-table
                        :headers="headers"
                        :items="desserts"
                        :sort-by="['calories', 'fat']"
                        :sort-desc="[false, true]"
                        show-select
                        item-key="id"
                        style="width: 100%; border: 1px solid #ffffff50;"
                        dark
                        elevation=0
                    >
                    <template v-slot:[`item.type`]="{ item }">
                        <div v-if="item.type == 'Person Finder'">
                            <span style="background-color: #EA545525; color: #EA5455; padding: 4px; border-radius: 25px; padding-left: 10px; padding-right: 10px;">
                                Person Finder
                            </span>
                        </div>
                        <div v-if="item.type == 'Image Analysis'">
                            <span style="background-color: #7367F025; color: #7367F0; padding: 4px; border-radius: 25px; padding-left: 10px; padding-right: 10px;">
                                <i id="inspected-icon" class="fas fa-check-circle"></i>
                                Image Analysis
                            </span>
                        </div>
                        <div v-if="item.type == 'Account Finder'">
                            <span style="background-color: #1b9df025; color: #1b9df0; padding: 4px; border-radius: 25px; padding-left: 10px; padding-right: 10px;">
                                Account Finder
                            </span>
                        </div>
                        <div v-if="item.type == 'Text Analysis'">
                            <span style="background-color: #FF9F4325; color: #FF9F43; padding: 4px; border-radius: 25px; padding-left: 10px; padding-right: 10px;">
                                Text Analysis
                            </span>
                        </div>
                        <div v-if="item.type == 'Location Tool'">
                            <span style="background-color:  #28C76F25; color:  #28C76F; padding: 4px; border-radius: 25px; padding-left: 10px; padding-right: 10px;">
                                Location Tool
                            </span>
                        </div>
                    </template>
                    </v-data-table>
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
        filterValue: "",
        items: [ 'Person Finder', 'Account Finder', 'Location Tool', 'Image Analysis', 'Text Analysis' ],
        headers: [
          { text: 'RECORD TITLE', value: 'title', sortable: false },
          { text: 'DESCRIPTION', value: 'desc',  sortable: false },
          { text: 'TYPE', value: 'type',  sortable: false  },
          { text: 'SAVED ON', value: 'searched_on',  sortable: false },
        ],
        desserts: [
          {
            title: 'Person X',
            desc: 'Investigating who organised the rele...',
            type: 'Person Finder',
            searched_on: '23/12/2021 12:12AM',
            id: "1"
          },
          {
            title: 'Person X - Profile Picture',
            desc: 'Investigating who organised the rele...',
            type: 'Image Analysis',
            searched_on: '23/12/2021 12:12AM',
            id: "2"
          },
          {
            title: 'Person X - Suspected Location',
            desc: 'Investigating who organised the rele...',
            type: 'Location Tool',
            searched_on: '23/12/2021 12:12AM',
            id: "3"
          },
          {
            title: 'Person X - Social Media Accounts',
            desc: 'Investigating who organised the rele...',
            type: 'Account Finder',
            searched_on: '23/12/2021 12:12AM',
            id: "4"
          },
          {
            title: 'Person X',
            desc: 'Investigating who organised the rele...',
            type: 'Text Analysis',
            searched_on: '23/12/2021 12:12AM',
            id: "5"
          },
          {
            title: 'Jane Smith',
            desc: 'Investigating the money laundering th...',
            type: 'Person Finder',
            searched_on: '23/12/2021 12:12AM',
            id: "6"
          },
          {
            title: 'Jane Smith',
            desc: 'Investigating the money laundering th...',
            type: 'Account Finder',
            searched_on: '23/12/2021 12:12AM',
            id: "7"
          },
          {
            title: 'Joe Smith - Holiday Picture',
            desc: 'Husband of Jane Smith that made over £1,000,0...',
            type: 'Image Analysis',
            searched_on: '23/12/2021 12:12AM',
            id: "8"
          },
          {
            title: 'Jack Smith',
            desc: 'Finding the social media accounts of Jack Gareth Smit...',
            type: 'Account Finder',
            searched_on: '23/12/2021 12:12AM',
            id: "9"
          },
          {
            title: 'Person Z',
            desc: 'Investigating who started a disinformation campaign...',
            type: 'Person Finder',
            searched_on: '23/12/2021 12:12AM',
            id: "10"
          },
          {
            title: 'Person X',
            desc: 'Investigating who organised the rele...',
            type: 'Person Finder',
            searched_on: '23/12/2021 12:12AM',
            id: "11"
          },
          {
            title: 'Person X - Profile Picture',
            desc: 'Investigating who organised the rele...',
            type: 'Image Analysis',
            searched_on: '23/12/2021 12:12AM',
            id: "12"
          },
          {
            title: 'Person X - Suspected Location',
            desc: 'Investigating who organised the rele...',
            type: 'Location Tool',
            searched_on: '23/12/2021 12:12AM',
            id: "13"
          },
          {
            title: 'Person X - Social Media Accounts',
            desc: 'Investigating who organised the rele...',
            type: 'Account Finder',
            searched_on: '23/12/2021 12:12AM',
            id: "14"
          },
          {
            title: 'Person X',
            desc: 'Investigating who organised the rele...',
            type: 'Text Analysis',
            searched_on: '23/12/2021 12:12AM',
            id: "15"
          },
          {
            title: 'Jane Smith',
            desc: 'Investigating the money laundering th...',
            type: 'Person Finder',
            searched_on: '23/12/2021 12:12AM',
            id: "16"
          },
          {
            title: 'Jane Smith',
            desc: 'Investigating the money laundering th...',
            type: 'Account Finder',
            searched_on: '23/12/2021 12:12AM',
            id: "17"
          },
          {
            title: 'Joe Smith - Holiday Picture',
            desc: 'Husband of Jane Smith that made over £1,000,0...',
            type: 'Image Analysis',
            searched_on: '23/12/2021 12:12AM',
            id: "18"
          },
          {
            title: 'Jack Smith',
            desc: 'Finding the social media accounts of Jack Gareth Smit...',
            type: 'Account Finder',
            searched_on: '23/12/2021 12:12AM',
            id: "19"
          },
          {
            title: 'Person Z',
            desc: 'Investigating who started a disinformation campaign...',
            type: 'Person Finder',
            searched_on: '23/12/2021 12:12AM',
            id: "20"
          },
        ],
      }
    },
    methods: {
        setFilter(filterVal) {
            if (this.filterValue == filterVal) {
                this.filterValue = "";
            } else {
                this.filterValue = filterVal;
            }

            this.params.status = this.filterValue;
        },
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
        color: white;
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
