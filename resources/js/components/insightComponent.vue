<template>
  <div class="row justify-content-center">
      <div class="col-12">
        <b><span style="font-size: 1.25rem; color: #28323b;">Your Insights</span></b>
      </div>
      <div class="col-12">
          <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
              <div class="p-3 m-0 justify-content-between d-flex">
                  <b><span style="font-size: 1rem; color: #28323b;">Your overview</span></b>
              <v-spacer></v-spacer>
              <div class="d-flex" >
                  <v-btn
                  color="#f05628"
                  @click="selected = null"
                  elevation=0
                  outlined
                  >
                  <span style="font-size: 0.75rem !important; font-weight: bold; color: #f05628;">Actions</span>
                  </v-btn>
              </div>
              </div>
              
              <div class="p-3">
                  <div id="chart">
                      <apexchart type="line" height="350" :options="chartOptions" :series="series"></apexchart>
                  </div>
              </div>
          </v-card>
      </div>
      <div class="d-flex p-0 m-0">
      <div class="col-6 d-flex ">
          <v-card style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1); width: 100%;">
              <div class="p-3 m-0 justify-content-between d-flex">
                  <b><span style="font-size: 1rem; color: #28323b;">What industries are your leads in?</span></b>
              <v-spacer></v-spacer>
              <div class="d-flex" >
                  <v-btn
                  color="#f05628"
                  elevation=0
                  outlined
                  :to="'/companies'"
                  >
                  <span style="font-size: 0.75rem !important; font-weight: bold; color: #f05628;">View Full List</span>
                  </v-btn>
              </div>
              </div>
              
              <div class="p-3">
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
                  <b><span style="font-size: 1rem; color: #28323b;">What pages are your leads visiting?</span></b>
              <v-spacer></v-spacer>
              <div class="d-flex" >
                  <v-btn
                  color="#f05628"
                  @click="selected = null"
                  elevation=0
                  outlined
                  >
                  <span style="font-size: 0.75rem !important; font-weight: bold; color: #f05628;">Actions</span>
                  </v-btn>
              </div>
              </div>
              
              <div class="p-3">
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
              colors: ['#6ec59e'],
              type: 'area',
              sparkline: {
                  enabled: true,
              }
              },
              stroke: {
                  curve: 'smooth',
                  colors: ['#6ec59e']
              },
              fill: {
                  colors: ['#6ec59e']
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
