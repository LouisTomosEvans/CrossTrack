<template>
        <div class="row justify-content-center">
            <div class="col-12 py-4 d-flex justify-content-between align-items-center">
                <h5 style="color: dark-grey; margin-bottom: 0px">📋 Accounts</h5>
            </div>
            <div class="col-12 pt-2">
                <v-card elevation=0>
                    <div class="p-4">
                        <div class="col-12 d-flex justify-content-end">
                            <v-btn elevation=0 color="#95aba3"><span style="color: white">
                                    + Add Account
                                </span>
                            </v-btn>
                        </div>
                        <v-data-table class="col-12"
                            v-model="selected"
                            :headers="headers"
                            :items="accounts"
                            item-key="username"
                            hide-default-header
                            show-select>
                        </v-data-table>
                    </div>
                </v-card>
            </div>




            <div class="col-12">
                <v-divider></v-divider>
            </div>
            <div class="col-12 py-0" style="font-size: 0.75rem; color: dark-gray; opacity: 0.6;">
                <b>Copyright © 2022 Peached Ltd</b>
            </div>
            <div class="col-12 py-0 pb-3" style="font-size: 0.75rem; color: dark-gray; opacity: 0.3;">
            <br>
            <b>
                DISCLAIMER: Peached is not affiliated with OnlyFans.com in any way. <br> OnlyFans is a trademark of FENIX INTERNATIONAL LIMITED.
            </b>
            </div>
        </div>
</template>

<script>
    import VueApexCharts from 'vue-apexcharts';
    export default {
        components: {
            apexchart: VueApexCharts,
        },
        data(){
            return{
                tableData: [
                    {
                        number: 159,
                        type: 'New Subs',
                        proportion: '34.23%',
                        money: '+£534.23',
                    },
                    {
                        number: 159,
                        type: 'New Subs',
                        proportion: '34.23%',
                        money: '+£534.23',
                    },
                    {
                        number: 159,
                        type: 'New Subs',
                        proportion: '34.23%',
                        money: '+£534.23',
                    },
                    {
                        number: 159,
                        type: 'New Subs',
                        proportion: '34.23%',
                        money: '+£534.23',
                    },
                    {
                        number: 159,
                        type: 'New Subs',
                        proportion: '34.23%',
                        money: '+£534.23',
                    },
                    {
                        number: null,
                        type: null,
                        proportion: 'Total:',
                        money: '+£4534.23',
                    },
                ],
        }},
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped>
</style>
