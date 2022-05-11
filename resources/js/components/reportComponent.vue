<template>
        <div class="row justify-content-center">
            <div class="col-12 pt-3 pb-0 d-flex justify-content-between align-items-center">
                <h5 style="color: dark-grey; margin-bottom: 0px">📋 <b><span>{{ timeText }}</span></b> Reports</h5>
                <div>
                    <v-btn-toggle class="mt-0 pt-0" v-model="timeText" tile color="#FB5F65" mandatory dense group>
                        <v-btn value="Weekly" style="font-size: 0.6rem;">
                        Weekly
                        </v-btn>

                        <v-btn value="Monthly" style="font-size: 0.6rem;">
                        Monthly
                        </v-btn>

                        <v-btn value="Yearly" style="font-size: 0.6rem;">
                        Yearly
                        </v-btn>
                    </v-btn-toggle>
                </div>
            </div>
            <div class="col-12 pt-3 pb-0">
                <h6 style="color: dark-grey; margin-bottom: 0px; opacity: 0.75;">Fan Performance:</h6>
            </div>
            <div class="col-4">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>🧑<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Total Paying Fans</span></b>
                    </div>
                </v-card>
            </div>
            <div class="col-4">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>🆕<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> New Paying Fans</span></b>
                    </div>
                </v-card>
            </div>
            <div class="col-4">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>💳<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Rebilled Fans</span></b>
                    </div>
                </v-card>
            </div>
            <div class="col-12 pt-3 pb-0">
                <h6 style="color: dark-grey; margin-bottom: 0px; opacity: 0.75;">Retention Performance:</h6>
            </div>
            <div class="col-6">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>🧑<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Average Retention Rate</span></b>
                    </div>
                </v-card>
            </div>
            <div class="col-6">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>🆕<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Average Reversal Rate</span></b>
                    </div>
                </v-card>
            </div>
            <div class="col-12 pt-3 pb-0">
                <h6 style="color: dark-grey; margin-bottom: 0px; opacity: 0.75;">Earning Performance:</h6>
            </div>
            <div class="col-6">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>⏱️<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Latest Earnings</span></b>
                    </div>
                </v-card>
            </div>
            <div class="col-6">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>🕵️<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Earnings Breakdown</span></b>
                    </div>
                </v-card>
            </div>
            <div class="col-12">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>📈<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Earnings</span></b>
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
