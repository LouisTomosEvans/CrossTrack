<template>
        <div class="row justify-content-center">
            <div class="col-12 pt-4 pb-0">
                <h5 style="color: dark-grey;">🔭 <span>Insights</span></h5>
            </div>
            <div class="col-12">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>⌛ <span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;">Average Earnings By Hour:</span></b>
                        <div id="chart">
                            <apexchart type="bar" height="350" :options="chartOptions" :series="series"></apexchart>
                        </div>
                    </div>
                </v-card>
            </div>
            <div class="col-12">
                <v-card elevation=0>
                    <div class="p-4">
                        <b>📅 <span style="font-size: 0.75rem; color: dark-gray; opacity: 0.75;">Average Earnings By Day:</span></b>
                        <div id="chart">
                            <apexchart type="bar" height="350" :options="chartOptions" :series="series"></apexchart>
                        </div>
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
    import VueApexCharts from 'vue-apexcharts';
    export default {
        components: {
            apexchart: VueApexCharts,
        },
        data(){
            return{
                timeText: 'Weekly',
                series: [{
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
          chartOptions: {
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
            }},
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
