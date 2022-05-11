<template>
        <div class="row justify-content-center">
            <div class="col-12 pt-6 pb-0">
                <h5 style="color: dark-grey;">🔭 <span>Insights</span></h5>
            </div>
            <div class="col-12">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>⌛ <span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;">Average Earnings By Hour:</span></b>
                    </div>
                </v-card>
            </div>
            <div class="col-12">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>📅 <span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;">Average Earnings By Day:</span></b>
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
                DISCLAIMER: Peached is not affiliated with OnlyFans.com in any way. OnlyFans is a trademark of FENIX INTERNATIONAL LIMITED.
            </b>
            </div>
        </div>
</template>

<script>
    export default {
        data(){
            return{
                timeText: 'Weekly',
        }},
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
