<template>
        <div class="row justify-content-center">
            <div class="col-12 pt-6 pb-0">
                <h5 style="color: dark-grey">🍑 Dashboard</h5>
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
                                <p class="icon" style="font-size: 2em;">💰</p>
                            </div>
                            <div class="ml-3">
                                <div><b><span style="font-size: 0.75rem; color: dark-gray; opacity: 0.6;">Monthly Earning Rate</span></b></div>
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
                                <p class="icon" style="font-size: 2em;">💸</p>
                            </div>
                            <div class="ml-3">
                                <div><b><span style="font-size: 0.75rem; color: dark-gray; opacity: 0.6;">Earnings Per Fan</span></b></div>
                                <div><b><h6 style="color: dark-grey; margin-bottom: 0px;">£35 GBP</h6></b></div>
                            </div>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="col-12">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>✨<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.6;"> Earnings Overview</span></b>
                        <div id="chart">
                            <apexchart type="line" height="350" :options="chartOptions" :series="series"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="col-4">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>📈<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Earnings</span></b>
                        <div id="chart">
                            <apexchart type="pie" width="380" :options="piechartOptions" :series="pieseries"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="col-8">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>🕵️<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Earnings Breakdown</span></b>
                    </div>
                </v-card>
            </div>
            <div class="col-8">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>⏱️<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Latest Earnings</span></b>
                    </div>
                </v-card>
            </div>
            <div class="col-4">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>😏 <span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;">Monthly Fan Retention Rate</span></b>
                    </div>
                </v-card>
            </div>
            <div class="col-12 ">
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
    import VueApexCharts from 'vue-apexcharts';
    export default {
        components: {
            apexchart: VueApexCharts,
        },
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return{
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
                            shade: 'dark',
                            gradientToColors: [ '#95aba3'],
                            shadeIntensity: 1,
                            type: 'horizontal',
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 100, 100, 100]
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
                        }
                    }
                    }]
                },
            }
        }
    }
</script>

<style>
.square {
    width: 20%;
}

.square:after {
    content: "";
    display: block;
    padding-bottom: 100%;
    background-color: #BAEBFD;
    border-radius: 4px;
}

.square-2 {
    width: 20%;
}

.square-2:after {
    content: "";
    display: block;
    padding-bottom: 100%;
    background-color: #9CCCA6;
    border-radius: 4px;
}

.square-3 {
    width: 20%;
}

.square-3:after {
    content: "";
    display: block;
    padding-bottom: 100%;
    background-color: #FCC693;
    border-radius: 4px;
}

.icon{
    position: absolute;
    top: 50%;
    left: 15%;
    transform: translate(-50%, -50%);
}
</style>
