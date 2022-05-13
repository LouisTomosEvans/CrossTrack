<template>
        <div class="row justify-content-center">
            <div class="col-12 pt-4 pb-0">
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
            <div class="d-flex p-0 m-0">
            <div class="col-6" style="height: 100%">
                <v-card elevation=0 style="height: 100%; min-height: 400px;">
                    <div class="p-4">
                        <b>📈<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Earnings</span></b>
                        <div id="chart">
                            <apexchart type="pie" width="100%" :options="piechartOptions" :series="pieseries"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="col-6" style="height: 100%">
                <v-card elevation=0 style="height: 100%; min-height: 400px;">
                    <div class="p-4 pb-0">
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
            <div class="col-8" style="height: 100%">
                <v-card elevation=0 style="height: 100%; min-height: 350px;">
                    <div class="p-4 pb-0">
                        <b>⏱️<span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;"> Latest Earnings</span></b>
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
                            <td>{{ item.proportion }}</td>
                            <td>{{ item.money }}</td>
                            </tr>
                        </tbody>
                        </template>
                    </v-simple-table>
                    </div>
                </v-card>
            </div>
            <div class="col-4" style="height: 100%;">
                <v-card elevation=0 style="height: 100%; min-height: 400px;">
                    <div class="p-4">
                        <b>😏 <span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;">Monthly Fan Retention Rate</span></b>
                        <div id="chart">
                            <apexchart type="line" height="100%" :options="lineChartOptions" :series="lineSeries"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
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
                lineSeries: [{
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                }],
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
    justify-content: center;
    align-items: center;
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
    left: 16%;
    transform: translate(-50%, -50%);
}
</style>
