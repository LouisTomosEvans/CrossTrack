<template>
        <div class="row justify-content-center">
            <div class="col-12">
                <b><span style="font-size: 1.25rem; color: #28323b;">Your Company Leads</span></b>
            </div>
            
            <div class="col-12 d-flex justify-content-between" style="padding-top: 0.5rem; min-height: 64px;">
                <div class="d-flex align-items-end" style="width: 75%;">
                    <span style="color: #28323b; font-size: 0.8125rem;">
                        Welcome to the Company Leads section! Here, you can view and manage all of your leads. You can easily filter your leads by criteria like geography, industry, and intent score. You can also view detailed company lead profiles and activity, so you can identify and target the most qualified leads.</span>
                </div>
                <!-- <div class="m-0 p-0 d-flex align-content-center">
                    <v-btn elevation=0 color="#f05628" style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <span style="color: #FFFFFF;">+ Add Segment</span>
                    </v-btn>
                </div> -->
            </div>

            <div class="col-12 d-flex justify-content-between" style="padding-top: 0.5rem;">
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
                    <v-btn text color="#28323b" elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none; margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon class="mr-1">mdi-filter-outline</v-icon>
                        <span>Filter</span>
                    </v-btn>
                    <v-btn text color="#28323b" elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon class="mr-1">mdi-pencil-outline</v-icon>
                        <span>Data points</span>
                    </v-btn>
                    <v-btn text color="#28323b" elevation=0 style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon class="mr-1">mdi-download-outline</v-icon>
                        <span>Download</span>
                    </v-btn>
                    <v-btn elevation=0 tile style="font-size: 0.7rem; font-weight: 700; text-decoration: none;  margin: 4px; text-transform: none !important; letter-spacing: 0; text-indent: 0;">
                        <v-icon color="#28323b">mdi-dots-vertical</v-icon>
                    </v-btn>
                </div>
                
            </div>
            <div class="col-12 d-flex justify-content-between align=content-center" style="padding-bottom: 0rem;">
                <div class="p-0 m-0" style="width: 35%;">
                    <v-text-field color="#f05628" label="Search your company leads ex. Amazon" clearable dense v-model="search" height="40px" solo elevation=0 append-icon="mdi-magnify" single-line hide-details style="width: 100%; border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1) !important;">
                        <template v-slot:label>
                            <strong>Search your company leads </strong>ex. Amazon
                        </template>
                    </v-text-field>
                </div>
                <div class="d-flex align-items-end">
                    <span style="color: #28323b; font-size: 0.8125rem;">Showing <b>100 most recent leads</b> of 1234 leads </span>
                </div>
            </div>
            <div class="col-12 d-flex ">
                <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1); width: 100%;">
                    <div class="p-0">
                        <!-- data table -->
                        <v-data-table
                        :headers="headers"
                        :items="desserts"
                        :search="search"
                        class="elevation-0"
                        color="#f05628"
                        style="border-radius: 8px;  border: thin solid rgba(0,0,0,.12);"
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
                            <div class="my-12">
                                <v-icon color="warning">mdi-alert</v-icon>
                                <p class="mt-2">
                                No Company Leads Found.
                                </p>
                            </div>
                            
                        </template>
                        </v-data-table>
                        <!-- data table -->

                    </div>
                </v-card>
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
            return {
                splineSeries: [{
                    name: 'series1',
                    data: [31, 40, 28, 51, 42, 109, 100]
                }],
                splineChartOptions: {
                    chart: {
                    height: 150,
                    type: 'area',
                    sparkline: {
                        enabled: true,
                    }
                    },
                    stroke: {
                        curve: 'smooth'
                    }
                },  
                series: [{
                    name: 'Companies Identified',
                    type: 'column',
                    data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
                }, {
                    name: 'Unique Visitors',
                    type: 'area',
                    data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
                }, {
                    name: 'Returning Visitors',
                    type: 'line',
                    data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
                }],
                chartOptions: {
                    chart: {
                    height: 350,
                    type: 'line',
                    stacked: false,
                    },
                    stroke: {
                    width: [0, 2, 5],
                    curve: 'smooth'
                    },
                    plotOptions: {
                    bar: {
                        columnWidth: '10%'
                    }
                    },
                    
                    fill: {
                    opacity: [0.85, 0.25, 1],
                    gradient: {
                        inverseColors: false,
                        shade: 'light',
                        type: "vertical",
                        opacityFrom: 0.85,
                        opacityTo: 0.55,
                        stops: [0, 100, 100, 100]
                    }
                    },
                    labels: ['01/01/2003', '02/01/2003', '03/01/2003', '04/01/2003', '05/01/2003', '06/01/2003', '07/01/2003',
                    '08/01/2003', '09/01/2003', '10/01/2003', '11/01/2003'
                    ],
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
                refferalSeries: [{
                    name: 'PRODUCT A',
                    data: [44, 55, 41, 67, 22, 43]
                }, {
                    name: 'PRODUCT B',
                    data: [13, 23, 20, 8, 13, 27]
                }, {
                    name: 'PRODUCT C',
                    data: [11, 17, 15, 15, 21, 14]
                }, {
                    name: 'PRODUCT D',
                    data: [21, 7, 25, 13, 22, 8]
                }],
                refferalChartOptions: {
                    chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                    toolbar: {
                        show: true
                    },
                    zoom: {
                        enabled: true
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
                    categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT',
                        '01/05/2011 GMT', '01/06/2011 GMT'
                    ],
                    },
                    legend: {
                    position: 'right',
                    offsetY: 40
                    },
                    fill: {
                    opacity: 1
                    }
                },
                headers: [
                    {
                        text: 'Company',
                        align: 'start',
                        sortable: false,
                        value: 'number',
                    },
                    { text: 'Visits', value: 'Visits' },
                    { text: 'Visitors', value: 'Visitors' },
                    { text: 'Pages Visited', value: 'Pages Visited' },
                    { text: 'Duration', value: 'Duration' },
                    { text: 'Location', value: 'Location' },
                    { text: 'Lead Score', value: 'LeadScore' },
                    { text: 'Last Seen', value: 'LastSeen' },
                    
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

.v-input__slot{
    box-shadow: none !important;
}

/* change vuetify placeholder text size */
.v-text-field.v-text-field--solo .v-input__control input {
    font-size: 0.8125rem !important;
}

.v-text-field.v-text-field--solo .v-label {
    font-size: 0.8125rem !important;
}

.v-data-table-header{
    background-color: #F5F5F5;
}

.v-data-table__wrapper{
    border-radius: 8px;
}

</style>
