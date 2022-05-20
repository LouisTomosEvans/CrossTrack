<template>
        <div class="row justify-content-center">
            <div class="col-12 py-4 d-flex justify-content-between align-items-center">
                <h5 style="color: dark-grey; margin-bottom: 0px">📋 Reports</h5>
            </div>
            <div class="col-12 pt-1 pb-0 d-flex">
                <v-card elevation=0 class="col-12 p-4 d-flex justify-content-between align-items-center">
                    <div class="col-6 p-0 d-flex">
                <v-menu
                ref="menuFrom"
                v-model="menuFrom"
                :close-on-content-click="false"
                transition="scale-transition"
                offset-y
                min-width="auto"
                style="z-index: 99;"
                >
                <template v-slot:activator="{ on, attrs }">
                <v-text-field
                    outlined
                    label="From"
                    append-icon="mdi-calendar"
                    class="col-6 mr-3"
                    hide-details
                    dense
                    readonly
                    v-bind="attrs"
                    v-on="on"
                    color="#95aba3"
                    single-line
                    v-model="dateFrom"
                ></v-text-field>
                </template>
                <v-date-picker
                    v-model="dateFrom"
                    :active-picker.sync="activePicker"
                    :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                    min="1950-01-01"
                    color="#95aba3"
                >
                <v-spacer></v-spacer>
                <v-btn
                    color="#95aba3"
                    @click="menuFrom = false"
                    elevation="0"
                ><span style="color: white;">
                    Cancel
                </span>
                </v-btn>
                <v-btn
                    color="#95aba3"
                    elevation="0"
                    @click="$refs.menuFrom.save(dateFrom)"
                >
                <span style="color: white;">
                OK
                </span>
                </v-btn>
                </v-date-picker>
                </v-menu>
                <v-icon>mdi-arrow-right-thick</v-icon>
                <v-menu
                ref="menuTo"
                v-model="menuTo"
                :close-on-content-click="false"
                transition="scale-transition"
                offset-y
                min-width="auto"
                >
                <template v-slot:activator="{ on, attrs }">
                <v-text-field
                    outlined
                    label="To"
                    append-icon="mdi-calendar"
                    class="col-6 ml-3"
                    hide-details
                    dense
                    readonly
                    v-bind="attrs"
                    v-on="on"
                    color="#95aba3"
                    single-line
                    v-model="dateTo"
                ></v-text-field>
                </template>
                <v-date-picker
                    v-model="dateTo"
                    :active-picker.sync="activePicker"
                    :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                    min="1950-01-01"
                    color="#95aba3"
                >
                <v-spacer></v-spacer>
                <v-btn
                    text
                    color="#95aba3"
                    @click="menuTo = false"
                >
                    Cancel
                </v-btn>
                <v-btn
                    text
                    color="#95aba3"
                    @click="$refs.menuTo.save(dateTo)"
                >
                    OK
                </v-btn>
                </v-date-picker>
                </v-menu>
                </div>
                <v-btn elevation=0 color="#95aba3"><span style="color: white">
                    <v-icon left dark>
                        mdi-file-download
                    </v-icon>
                    Download Report
                    </span>
                </v-btn>

                </v-card>
                <!-- <div>
                    <v-btn-toggle class="mt-0 pt-0" v-model="timeText" tile rounded color="#FB5F65" mandatory dense group>
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
                </div> -->

                <!-- <v-btn elevation=0 color="#95aba3"><span style="color: white">
                    <v-icon left dark>
                        mdi-file-download
                    </v-icon>
                    Download Report
                    </span>
                </v-btn> -->
            </div>
            <div class="col-12">
                <v-divider></v-divider>
            </div>
            <div class="col-12 pt-3 pb-0">
                <h6 style="color: dark-grey; margin-bottom: 0px; opacity: 0.75;">Fan Performance:</h6>
            </div>
            <div class="col-4">
                <v-card elevation=0>
                    <div class="p-4">
                        <div class="d-flex align-items-center">
                            <div class="square">
                                <p class="icon" style="font-size: 2em;">🧑</p>
                            </div>
                            <div class="ml-3">
                                <div><b><span style="font-size: 0.75rem; color: dark-gray; opacity: 0.6;">Total Paying Fans</span></b></div>
                                <div><b><h6 style="color: dark-grey; margin-bottom: 0px;">35 Fans</h6></b></div>
                            </div>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="col-4">
                <v-card elevation=0>
                    <div class="p-4">
                        <div class="d-flex align-items-center">
                            <div class="square-2">
                                <p class="icon" style="font-size: 2em;">🆕</p>
                            </div>
                            <div class="ml-3">
                                <div><b><span style="font-size: 0.75rem; color: dark-gray; opacity: 0.6;">New Paying Fans</span></b></div>
                                <div><b><h6 style="color: dark-grey; margin-bottom: 0px;">£35,589 GBP</h6></b></div>
                            </div>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="col-4">
                <v-card elevation=0>
                    <div class="p-4">
                        <div class="d-flex align-items-center">
                            <div class="square-3">
                                <p class="icon" style="font-size: 2em;">💳</p>
                            </div>
                            <div class="ml-3">
                                <div><b><span style="font-size: 0.75rem; color: dark-gray; opacity: 0.6;">Rebilled Fans</span></b></div>
                                <div><b><h6 style="color: dark-grey; margin-bottom: 0px;">£35 GBP</h6></b></div>
                            </div>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="d-flex p-0 m-0">
            <div class="col-6" style="height: 100%">
                <v-card elevation=0 style="height: 100%; min-height: 350px; max-height: 600px;">
                    <div class="p-4">
                        <b>🧑<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Paying Fans</span></b>
                        <div id="chart">
                            <apexchart type="line" height="100%" style="max-height: 500px;" :options="lineChartOptions" :series="lineSeries"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="col-6" style="height: 100%">
                <v-card elevation=0 style="height: 100%; min-height: 350px; max-height: 600px;">
                    <div class="p-4">
                        <b>🏦<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Earnings Per Fan</span></b>
                        <div id="chart">
                            <apexchart type="line" height="100%" style="max-height: 500px;" :options="lineChartOptions" :series="lineSeries"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
            </div>

            <div class="col-12 pt-3 pb-0">
                <h6 style="color: dark-grey; margin-bottom: 0px; opacity: 0.75;">Retention Performance:</h6>
            </div>
            <div class="d-flex p-0 m-0">
            <div class="col-6" style="height: 100%">
                <v-card elevation=0 style="height: 100%; min-height: 350px; max-height: 600px;">
                    <div class="p-4">
                        <b>🧑<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Average Retention Rate</span></b>
                        <div id="chart">
                            <apexchart type="line" height="100%" style="max-height: 500px;" :options="lineChartOptions" :series="lineSeries"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="col-6" style="height: 100%">
                <v-card elevation=0 style="height: 100%; min-height: 350px; max-height: 600px;">
                    <div class="p-4">
                        <b>🆕<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Average Reversal Rate</span></b>
                        <div id="chart">
                            <apexchart type="line" height="100%" style="max-height: 500px;" :options="lineChartOptions" :series="lineSeries"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
            </div>
            <div class="col-12 pt-3 pb-0">
                <h6 style="color: dark-grey; margin-bottom: 0px; opacity: 0.75;">Earning Performance:</h6>
            </div>
            <div class="col-12">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>✨<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Earnings Overview</span></b>
                        <div id="chart">
                            <apexchart type="line" height="350" :options="chartOptions" :series="series"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="d-flex p-0">
            <div class="col-6" style="height: 100%;">
                <v-card elevation=0 style="height: 100%; min-height: 350px;">
                    <div class="p-4">
                        <b>📈<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Earnings</span></b>
                        <div id="chart">
                            <apexchart type="pie" height="100%" :options="piechartOptions" :series="pieseries"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="col-6" style="height: 100%;">
                <v-card elevation=0 style="height: 100%; min-height: 350px;">
                    <div class="p-4">
                        <b>🕵️<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Earnings Breakdown</span></b>
                        <v-simple-table style="max-height: 325px; min-height: 325px;">
                        <template v-slot:default>
                        <thead>
                            <tr>
                            <th class="text-left">
                                Number
                            </th>
                            <th class="text-left">
                                Type
                            </th>
                            <th class="text-left">
                                Proportion
                            </th>
                            <th class="text-left">
                                Money
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                            v-for="item in tableData"
                            :key="item.name"
                            >
                            <td>{{ item.number }}</td>
                            <td>{{ item.type }}</td>
                            <td><span v-if="item.proportion == 'Total:'"><b>{{ item.proportion }}</b></span><span v-else>{{ item.proportion }}</span></td>
                            <td><span v-if="item.proportion == 'Total:'" style="color: #34a853"><b>{{ item.money }}</b></span><span style="color: #34a853" v-else>{{ item.money }}</span></td>
                            </tr>
                        </tbody>
                        </template>
                    </v-simple-table>
                    </div>
                </v-card>
            </div>
            </div>
            <div class="d-flex p-0 m-0">
            <div class="col-4" style="height: 100%">
                <v-card elevation=0 style="height: 100%; min-height: 350px; max-height: 600px;">
                    <div class="p-4">
                        <b>💬<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Message Unlocks</span></b>
                        <div id="chart">
                            <apexchart type="line" height="100%" style="max-height: 500px;" :options="lineChartOptions" :series="lineSeries"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="col-4" style="height: 100%">
                <v-card elevation=0 style="height: 100%; min-height: 350px; max-height: 600px;">
                    <div class="p-4">
                        <b>🔓<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Post Unlocks</span></b>
                        <div id="chart">
                            <apexchart type="line" height="100%" style="max-height: 500px;" :options="lineChartOptions" :series="lineSeries"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="col-4" style="height: 100%">
                <v-card elevation=0 style="height: 100%; min-height: 350px; max-height: 600px;">
                    <div class="p-4">
                        <b>🪙<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Tips</span></b>
                        <div id="chart">
                            <apexchart type="line" height="100%" style="max-height: 500px;" :options="lineChartOptions" :series="lineSeries"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
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
                date: new Date().toISOString().substr(0, 7),
                menu: false,
                modal: false,
                timeText: 'Weekly',
                lineSeries: [{
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                }],
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
                lineChartOptions: {
                    chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                    },
                    dataLabels: {
                    enabled: false
                    },
                    stroke: {
                    curve: 'straight'
                    },
                    grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                    },
                    xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    }
                },
                series: [{
                    name: 'Sales',
                    data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7, 5]
                }],
                chartOptions: {
                    chart: {
                        height: 350,
                        type: 'line',
                    },
                    stroke: {
                        width: 3,
                        curve: 'smooth'
                    },
                    xaxis: {
                        type: 'datetime',
                        categories: ['1/11/2000', '2/11/2000', '3/11/2000', '4/11/2000', '5/11/2000', '6/11/2000', '7/11/2000', '8/11/2000', '9/11/2000', '10/11/2000', '11/11/2000', '12/11/2000', '1/11/2001', '2/11/2001', '3/11/2001','4/11/2001' ,'5/11/2001' ,'6/11/2001'],
                        tickAmount: 10,
                        labels: {
                            formatter: function(value, timestamp, opts) {
                            return opts.dateFormatter(new Date(timestamp), 'dd MMM')
                            }
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 0.5,
                            type: 'horizontal',
                            opacityFrom: 1,
                            gradientFromColors:  ['#9ccca6'],
                            gradientToColors:  ['#95aba3'],
                            opacityTo: 1,
                            stops: [0, 100],
                        },
                    },
                    yaxis: {
                        min: -10,
                        max: 40
                    }
                },
                pieseries: [44, 55, 13, 43, 22],
                piechartOptions: {
                    chart: {
                    width: 380,
                    type: 'pie',
                    },
                    fill: {
                        colors: ['#9ccca6', '#fcc693', '#baebfd', '#95aba3', '#fcb3c0']
                    },
                    legend: {
                        position: 'bottom'
                    },
                    labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
                    responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                        width: 200
                        },
                        legend: {
                        position: 'bottom'
                        },
                        dataLabels: {
                            style: {
                                colors: ['#9ccca6', '#fcc693', '#baebfd','#95aba3', '#fcb3c0']
                            }
                        },
                    }
                    }]
                },
        }},
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped>
    .v-btn-toggle{
        border: 2px #fb5f65 solid;
        border-radius: 6px;
    }
    .theme--light.v-text-field--outlined{
        color: #fb5f65
    }
</style>
