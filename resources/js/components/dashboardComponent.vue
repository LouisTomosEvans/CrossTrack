<template>
        <div class="row justify-content-center">

            <!-- button toggle date selector -->
            <div class="col-12 d-flex justify-content-between">
                <v-btn-toggle color="#f05628" group style="background-color: white; border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);" class="d-flex" dense outlined mandatory>
                    <v-btn elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none; background-color: white; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon class="mr-1">mdi-calendar</v-icon>
                        <span>Custom</span>
                    </v-btn>
                    <v-btn elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  background-color: white; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>Today</span>
                    </v-btn>
                    <v-btn elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  background-color: white; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>Yesterday</span>
                    </v-btn>
                    <v-btn elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  background-color: white; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>7D</span>
                    </v-btn>
                    <v-btn elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  background-color: white; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>30D</span>
                    </v-btn>
                    <v-btn elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  background-color: white; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span>3M</span>
                    </v-btn>
                </v-btn-toggle>
                <div class="m-0 p-0 d-flex align-content-center">
                    <v-btn text color="#f05628" elevation=0 style="font-size: 0.8125rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon class="mr-1">mdi-download-outline</v-icon>
                        <span>Download PDF Report</span>
                    </v-btn>
                </div>
                
            </div>

            <div class="p-0 m-0 d-flex">
                <div class="col-4 d-flex">
                    <!-- add shadow to card -->
                    <v-card style="width: 100%; border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                        <div class="p-3">
                            <!-- dashboard cards -->
                            <!-- number of companies discovered -->
                            <div class="d-flex">
                                <!-- add heading -->
                                <div class="col-12 p-0 d-flex flex-wrap">
                                    <div class="d-flex justify-content-between" style="width: 100%;">
                                        <b><span style="font-size: 1rem; color: #28323b;">Companies Identified</span></b>
                                        <v-icon style="font-size: 1.5rem; color: #28323b;">mdi-dots-vertical</v-icon>
                                    </div>
                                    <div style="width: 100%;" >
                                        <span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;">This Month</span>
                                    </div>
                                    <div class="p-0 align-items-end d-flex" style="margin-top: 2rem;">
                                        <span style="font-size: 3rem; color: #28323b; font-weight:bolder; line-height: 2.3rem;">{{ appStore.dashboardData.new_leads_this_month }}</span>
                                        <!-- add badge -->
                                        <span class="badge badge-pill badge-success ml-2" style="font-size: 0.75rem; color: #6ec59e; background-color: #6ec59e20;">+33% vs last month</span>

                                    </div>
                                </div>

                            <!-- add spark line from apex charts -->
                                <div id="chart" style="position: absolute; left: 42%; bottom: 1rem; width: calc(58% - 1rem);">
                                    <apexchart type="area" height="50%" v-if="this.appStore.dashboardData.labels" :key="companiesIdentifiedSpline.length" :options="splineChartOptions" :series="companiesIdentifiedSpline"></apexchart>
                                </div>
                            </div>
                        </div>
                    </v-card>
                </div>
                <div class="col-4 d-flex">
                    <v-card style="width: 100%; border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                        <div class="p-3">
                            <!-- dashboard cards -->
                            <!-- number of companies discovered -->
                            <div class="d-flex">
                                <!-- add heading -->
                                <div class="col-12 p-0 d-flex flex-wrap">
                                    <div class="d-flex justify-content-between" style="width: 100%;">
                                        <b><span style="font-size: 1rem; color: #28323b;">Unique Visitors</span></b>
                                        <v-icon style="font-size: 1.5rem; color: #28323b;">mdi-dots-vertical</v-icon>
                                    </div>
                                    <div style="width: 100%;" >
                                        <span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;">This Month</span>
                                    </div>
                                    <div class="p-0 align-items-end d-flex" style="margin-top: 2rem;">
                                        <span style="font-size: 3rem; color: #28323b; font-weight:bolder; line-height: 2.3rem;">{{ appStore.dashboardData.unique_visitors_this_month }}</span>
                                        <!-- add badge -->
                                        <span class="badge badge-pill badge-success ml-2" style="font-size: 0.75rem; color: #f05628; background-color: #f0562820;">+33% vs last month</span>

                                    </div>
                                </div>

                            <!-- add spark line from apex charts -->
                                <div id="chart" style="position: absolute; left: 42%; bottom: 1rem; width: calc(58% - 1rem);">
                                    <apexchart type="area" height="50%" v-if="this.appStore.dashboardData.labels" :options="splineChartOptions" :series="uniqueVisitorsSpline"></apexchart>
                                </div>
                            </div>
                        </div>
                    </v-card>
                </div>
                <div class="col-4 d-flex">
                    <v-card style="width: 100%; border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                        <div class="p-3">
                            <!-- dashboard cards -->
                            <!-- number of companies discovered -->
                            <div class="d-flex">
                                <!-- add heading -->
                                <div class="col-12 p-0 d-flex flex-wrap">
                                    <div class="d-flex justify-content-between" style="width: 100%;">
                                        <b><span style="font-size: 1rem; color: #28323b;">Returning Companies</span></b>
                                        <v-icon style="font-size: 1.5rem; color: #28323b;">mdi-dots-vertical</v-icon>
                                    </div>
                                    <div style="width: 100%;" >
                                        <span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;">This Month</span>
                                    </div>
                                    <div class="p-0 align-items-end d-flex" style="margin-top: 2rem;">
                                        <span style="font-size: 3rem; color: #28323b; font-weight:bolder; line-height: 2.3rem;">{{ appStore.dashboardData.returning_leads_this_month }}</span>
                                        <!-- add badge -->
                                        <span class="badge badge-pill badge-success ml-2" style="font-size: 0.75rem; color: #f05628; background-color: #f0562820;">+33% vs last month</span>

                                    </div>
                                </div>

                            <!-- add spark line from apex charts -->
                                <div id="chart" style="position: absolute; left: 42%; bottom: 1rem; width: calc(58% - 1rem);">
                                    <apexchart type="area" height="50%" v-if="this.appStore.dashboardData.labels" :options="splineChartOptions" :series="returningLeadsSpline"></apexchart>
                                </div>
                            </div>
                        </div>
                    </v-card>
                </div>
            </div>
            <div class="col-12">
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                    <div class="p-3 m-0 justify-content-between d-flex">
                        <b class="d-flex align-items-center"><span style="font-size: 1rem; color: #28323b;">Your overview</span></b>
                    <v-spacer></v-spacer>
                    <div class="d-flex" >
                        <v-btn
                        color="#f05628"
                        @click="selected = null"
                        elevation=0
                        text
                        >
                        <span style="font-size: 0.7rem !important; font-weight: bold; color: #f05628;">Actions</span>
                        </v-btn>
                    </div>
                    </div>
                    
                    <div class="p-3 pt-0">
                        <div id="chart">
                            <apexchart type="line" height="350" :options="chartOptions" v-if="this.appStore.dashboardData.labels" :series="series"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="col-12">
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                    <div class="p-3 m-0 justify-content-between d-flex">
                        <b class="d-flex align-items-center"><span style="font-size: 1rem; color: #28323b;">How do you acquire users?</span></b>
                    <v-spacer></v-spacer>
                    <div class="d-flex" >
                        <v-btn
                        color="#f05628"
                        @click="selected = null"
                        elevation=0
                        text
                        >
                        <span style="font-size: 0.7rem !important; font-weight: bold; color: #f05628;">Actions</span>
                        </v-btn>
                    </div>
                    </div>
                    
                    <div class="p-3 pt-0">
                        <div id="chart">
                            <apexchart v-if="this.appStore.dashboardData.top_referrers_this_month_data" type="bar" height="350" :options="refferalChartOptions" :series="refferalSeries"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="d-flex p-0 m-0">
            <div class="col-6 d-flex ">
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1); width: 100%;">
                    <div class="p-3 m-0 justify-content-between d-flex">
                        <b class="d-flex align-items-center"><span style="font-size: 1rem; color: #28323b;">What companies are looking at your website?</span></b>
                    <v-spacer></v-spacer>
                    <div class="d-flex" >
                        <v-btn
                        color="#f05628"
                        elevation=0
                        text
                        :to="'/companies'"
                        >
                        <span style="font-size: 0.7rem !important; font-weight: bold; color: #f05628;">View Lead List</span>
                        </v-btn>
                    </div>
                    </div>
                    
                    <div class="p-3 pt-0">
                        <!-- data table -->
                        <v-data-table
                        :headers="headers"
                        :items="desserts"
                        :search="search"
                        class="elevation-0"
                        :hide-default-footer="true"
                        >
                        <template v-slot:item.actions="{ item }">
                            <v-icon
                            small
                            class="mr-2"
                            @click="editItem(item)"
                            >
                            mdi-pencil
                            </v-icon>
                            <v-icon
                            small
                            @click="deleteItem(item)"
                            >
                            mdi-delete
                            </v-icon>
                        </template>
                        <template v-slot:no-data>
                            <div class="mt-8">
                                <v-icon color="warning">mdi-alert</v-icon>
                                <p class="mt-2">
                                No matching records found.
                                </p>
                            </div>
                            
                        </template>
                        </v-data-table>
                        <!-- data table -->

                    </div>
                </v-card>
            </div>
            <div class="col-6 d-flex">
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1); width: 100%;">
                    <div class="p-3 m-0 justify-content-between d-flex">
                        <b class="d-flex align-items-center"><span style="font-size: 1rem; color: #28323b;">Where are your visitors from?</span></b>
                    <v-spacer></v-spacer>
                    <div class="d-flex" >
                        <v-btn
                        color="#f05628"
                        @click="selected = null"
                        elevation=0
                        text
                        >
                        <span style="font-size: 0.7rem !important; font-weight: bold; color: #f05628;">View Lead Map</span>
                        </v-btn>
                    </div>
                    </div>
                    
                    <div class="p-3 pt-0">
                        <!-- data table -->
                        <v-data-table
                        :headers="headers"
                        :items="desserts"
                        :search="search"
                        class="elevation-0"
                        :hide-default-footer="true"
                        >
                        <template v-slot:item.actions="{ item }">
                            <v-icon
                            small
                            class="mr-2"
                            @click="editItem(item)"
                            >
                            mdi-pencil
                            </v-icon>
                            <v-icon
                            small
                            @click="deleteItem(item)"
                            >
                            mdi-delete
                            </v-icon>
                        </template>
                        <template v-slot:no-data>
                            <div class="mt-8">
                                <v-icon color="warning">mdi-alert</v-icon>
                                <p class="mt-2">
                                No matching records found.
                                </p>
                            </div>
                            
                        </template>
                        </v-data-table>
                        <!-- data table -->

                    </div>
                </v-card>
            </div>
            </div>
        </div>
</template>

<script>
import { useAppStore } from '../store/appStore';
import { useUserStore } from '../store/userStore';
import { useTeamStore } from '../store/teamStore';
import { useLeadStore } from '../store/leadStore';
import VueApexCharts from 'vue-apexcharts';
    export default {
        components: {
            apexchart: VueApexCharts,
        },
        setup() {
            const appStore = useAppStore();
            const userStore = useUserStore();
            const teamStore = useTeamStore();
            const leadStore = useLeadStore();
            return {
                appStore,
                userStore,
                teamStore,
                leadStore,
            }
        },
        mounted() {
            console.log('Component mounted.')
            // chart.windowResizeHandler();
            //  get data from api
            // if there is no user got user 
            if (!this.userStore.user) {
                this.userStore.fetchUser().then(() => {
                    this.appStore.setDashboardData(this.userStore.user.current_team_id);
                });
            } else {
                this.appStore.setDashboardData(this.userStore.user.current_team_id).then(() => {
                    console.log('Dashboard data set.')
                    // reload chart
                    // this.chart.windowResizeHandler();
                });
            }
        },
        computed: {
            series() {
                return [{
                    name: 'Companies Identified',
                    type: 'column',
                    data: this.appStore.dashboardData.leads_this_month ?? []
                }, {
                    name: 'Unique Visitors',
                    type: 'area',
                    data: this.appStore.dashboardData.visits_this_month ?? []
                }]
            },
            companiesIdentifiedSpline() {
                return [{
                    name: 'Companies Identified',
                    data: this.appStore.dashboardData.leads_this_month ?? []
                }]
            },
            uniqueVisitorsSpline() {
                return [{
                    name: 'Unique Visitors',
                    data: this.appStore.dashboardData.visits_this_month ?? []
                }]
            },
            returningLeadsSpline() {
                return [{
                    name: 'Returning Companies',
                    data: this.appStore.dashboardData.returning_leads_this_month_data ?? []
                }]
            },
            chartOptions() {
                return {
                        events: {
                            mounted: (chart) => {
                            chart.windowResizeHandler();
                            }
                        },
                        animations: {
                            enabled: false,
                        },
                    height: 350,
                    type: 'area',
                    stacked: false,
                    colors: ['#f05628', '#96C5F7'],
                    zoom: {
                        enabled: false
                    },
                    stroke: {
                        width: [0, 2, 2],
                        curve: 'smooth',
                        colors: ['#f05628','#96C5F7']
                    },
                    plotOptions: {
                    bar: {
                        columnWidth: '30%'
                    }
                    },
                    stroke: {
                        curve: 'straight',
                        colors: ['', '#96C5F7']
                    },
                    fill: {
                        type: ['solid', 'gradient'],
                        gradient: {
                            shade: 'light',
                            type: "vertical",
                            opacityFrom: 0.70,
                            opacityTo: 0.1,
                            stops: [0, 100, 100, 100]
                        },
                        colors: ['#f05628', '#96C5F7']
                    },
                    labels: this.appStore.dashboardData.labels ?? [],
                    markers: {
                    size: 0
                    },
                    xaxis: {
                    type: 'datetime'
                    },
                    yaxis: {
                    title: {
                        text: 'Points',
                    },
                    min: 0
                    },
                    tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function (y) {
                        if (typeof y !== "undefined") {
                            return y.toFixed(0) + " points";
                        }
                        return y;
                    
                        }
                    }
                    }
                }
            },
            refferalChartOptions() {
                return {
                    chart: {
                        animations: {
                            enabled: false,
                        },
                        events: {
                            mounted: (chart) => {
                                chart.windowResizeHandler();
                            }
                        },
                    type: 'bar',
                    height: 350,
                    stacked: true,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                    },
                    responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                        }
                    }
                    }],
                    plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 10
                    },
                    },
                    xaxis: {
                        type: 'datetime',
                        categories: this.appStore.dashboardData.labels ?? [],
                    },
                    legend: {
                        show: false
                    },
                    fill: {
                        colors: ['#e74645', '#F2AC39', '#74D3AE', '#2D7DD2']
                    },
                }
            },
            refferalSeries() {
                return this.appStore.dashboardData.top_referrers_this_month_data
            },
        },
        data(){
            return {
                splineSeries: [{
                    name: 'series1',
                    data: [31, 40, 28, 51, 42,  100, 31, 40,42, 109, 100, 31, 40, 28, 51,28, 51, 42, 109, 100, 31, 40, 28, 51, 109,  42, 109, 100]
                }],
                splineChartOptions: {
                    chart: {
                        events: {
                            mounted: (chart) => {
                            chart.windowResizeHandler();
                            }
                        },
                        animations: {
                            enabled: false,
                        },
                    height: 150,
                    colors: ['#74D3AE'],
                    type: 'area',
                    sparkline: {
                        enabled: true,
                    }
                    },
                    stroke: {
                        curve: 'straight',
                        colors: ['#74D3AE']
                    },
                    fill: {
                        colors: ['#74D3AE']
                    }
                },  
                pieseries: [44, 55, 13, 43, 22],
                piechartOptions: {
                    chart: {
                    width: 380,
                    type: 'pie',
                    },
                    fill: {
                        colors: ['#FFAE03', '#96C5F7', '#FFAE03', '#7E5A9B', '#6EC59E']
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
                                colors: ['#FFAE03', '#2D7DD2', '#FFAE03','#7E5A9B', '#6EC59E']
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
                        events: {
                            mounted: (chart) => {
                            chart.windowResizeHandler();
                            }
                        },
                        animations: {
                            enabled: false,
                        },
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
                headers: [
                    {
                        text: 'Number',
                        align: 'start',
                        sortable: false,
                        value: 'number',
                    },
                    { text: 'Type', value: 'type' },
                    { text: 'Proportion', value: 'proportion' },
                    { text: 'Money', value: 'money' },
                ],
                items: [
                    {
                        title: 'Total Subs',
                        value: '1,245',
                        icon: 'mdi mdi-account-multiple',
                        color: 'primary',
                    },
                    {
                        title: 'New Subs',
                        value: '1,245',
                        icon: 'mdi mdi-account-multiple',
                        color: 'success',
                    },
                    {
                        title: 'Total Revenue',
                        value: '1,245',
                        icon: 'mdi mdi-account-multiple',
                        color: 'info',
                    },
                    {
                        title: 'New Revenue',
                        value: '1,245',
                        icon: 'mdi mdi-account-multiple',
                        color: 'warning',
                    },
                ],  

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
