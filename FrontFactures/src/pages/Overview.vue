<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-3 col-md-6">
          <stats-card>
            <div slot="header" class="icon-warning">
              <i class="nc-icon nc-compass-05 text-warning"></i>
            </div>
            <div slot="content">
              <p class="card-category">Compteurs</p>
              <h4 class="card-title">{{nbCompteurs}}</h4>
            </div>
            <div slot="footer">
              <i class="fa fa-refresh"></i>Updated now
            </div>
          </stats-card>
        </div>

        <div class="col-xl-3 col-md-6">
          <stats-card>
            <div slot="header" class="icon-success">
              <i class="nc-icon nc-single-02 text-success"></i>
            </div>
            <div slot="content">
              <p class="card-category">Utilisateurs</p>
              <h4 class="card-title">{{nbUser}}</h4>
            </div>
            <div slot="footer">
              <i class="fa fa-calendar-o"></i>Last day
            </div>
          </stats-card>
        </div>

        <div class="col-xl-3 col-md-6">
          <stats-card>
            <div slot="header" class="icon-danger">
              <i class="nc-icon nc-pin-3 text-primary"></i>
            </div>
            <div slot="content">
              <p class="card-category">Locals</p>
              <h4 class="card-title">{{nbLocal}}</h4>
            </div>
            <div slot="footer">
              <i class="fa fa-clock-o"></i>Last day
            </div>
          </stats-card>
        </div>

        <div class="col-xl-3 col-md-6">
          <stats-card>
            <div slot="header" class="icon-info">
              <i class="nc-icon nc-money-coins text-danger"></i>
            </div>
            <div slot="content">
              <p class="card-category">Factures non payées</p>
              <h4 class="card-title">{{ nbFact }}</h4>
            </div>
            <div slot="footer">
              <i class="fa fa-refresh"></i>Updated now
            </div>
          </stats-card>
        </div>

      </div>
      <div class="row">
        <div class="col-md-8">
          <chart-card :chart-data="lineChart.data"
                      :chart-options="lineChart.options"
                      :responsive-options="lineChart.responsiveOptions">
            <template slot="header">
              <h4 class="card-title">Total Consommation</h4>
              <p class="card-category">2024</p>
            </template>
            <template slot="footer">
              <div class="legend">
                <i class="fa fa-circle text-info"></i> Internet
                <i class="fa fa-circle text-danger"></i> Eau
                <i class="fa fa-circle text-warning"></i> Electricité
                <i class="fa fa-circle text-custom"></i> Gaz
              </div>
              <hr>
              <div class="stats">
                <i class="fa fa-history"></i> Updated 3 minutes ago
              </div>
            </template>
          </chart-card>
        </div>

        <div class="col-md-4">
          <chart-card :chart-data="pieChart.data" chart-type="Pie">
            <template slot="header">
              <h4 class="card-title">Les statistiques des factures</h4>
              <p class="card-category">Last Campaign Performance</p>
            </template>
            <template slot="footer">
              <div class="legend">
                <i class="fa fa-circle text-info"></i> Payées
                <i class="fa fa-circle text-danger"></i> Non Payées
              </div>
              <hr>
              <div class="stats">
                <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
              </div>
            </template>
          </chart-card>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <chart-card
            :chart-data="barChart.data"
            :chart-options="barChart.options"
            :chart-responsive-options="barChart.responsiveOptions"
            chart-type="Bar">
            <template slot="header">
              <h4 class="card-title">Nombres des compteurs 2024</h4>
              <p class="card-category">All products including Taxes</p>
            </template>
            <template slot="footer">
              <div class="legend">
                <i class="fa fa-circle text-info"></i> Internet
                <i class="fa fa-circle text-danger"></i> Eau
                <i class="fa fa-circle text-warning"></i> Electricité
                <i class="fa fa-circle text-custom"></i> Gaz
              </div>
              <hr>
              <div class="stats">
                <i class="fa fa-check"></i> Data information certified
              </div>
            </template>
          </chart-card>
        </div>

      </div>
    </div>
  </div>
</template>
<script>
  import ChartCard from 'src/components/Cards/ChartCard.vue'
  import StatsCard from 'src/components/Cards/StatsCard.vue'
  import LTable from 'src/components/Table.vue'
  import CompteurService from '../services/compteurs.js'
  import UserService from '../services/users.js'
  import LocalService from '../services/locals.js'
  import FactureService from '../services/factures.js'

  export default {
    components: {
      LTable,
      ChartCard,
      StatsCard
    },
    data () {
      return {
        nbCompteurs:null,
        nbUser: null,
        nbLocal:null,
        nbFact:null,
        paidPercentage:null,
        unpaidPercentage:null,
        factTotale:null,
        editTooltip: 'Edit Task',
        deleteTooltip: 'Remove',
        pieChart: {
          data: {
            labels: ['', ''],
            series: []
          }
        },
        lineChart: {
          data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [
              [],
              [],
              [],
              []
            ]
          },
          options: {
            low: 0,
            showArea: false,
            height: '245px',
            axisX: {
              showGrid: false
            },
            lineSmooth: true,
            showLine: true,
            showPoint: true,
            fullWidth: true,
            chartPadding: {
              right: 50
            }
          },
          responsiveOptions: [
            ['screen and (max-width: 640px)', {
              axisX: {
                labelInterpolationFnc (value) {
                  return value[0]
                }
              }
            }]
          ]
        },
        barChart: {
          data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [
              [],
              []
            ]
          },
          options: {
            seriesBarDistance: 10,
            axisX: {
              showGrid: false
            },
            height: '245px'
          },
          responsiveOptions: [
            ['screen and (max-width: 640px)', {
              seriesBarDistance: 5,
              axisX: {
                labelInterpolationFnc (value) {
                  return value[0]
                }
              }
            }]
          ]
        },
      }
    },
    methods:{
      fetchCountsByMonth() {
        CompteurService.countByMonth().then(response => {
          const counts = response.data;
          this.barChart.data.series[0] = counts.internet;
          this.barChart.data.series[1] = counts.eau;
          this.barChart.data.series[2] = counts.electricite;
          this.barChart.data.series[3] = counts.gaz;
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
      },
      fetchConsomByMonth() {
        CompteurService.totalConsommation().then(response => {
          const counts = response.data;
          this.lineChart.data.series[0] = counts.internet;
          this.lineChart.data.series[1] = counts.eau;
          this.lineChart.data.series[2] = counts.electricite;
          this.lineChart.data.series[3] = counts.gaz;
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
      },
      updateChartData() {
        FactureService.countPayer().then(res => {
          this.paidPercentage = (res.data.count / this.factTotale) * 100;
          this.unpaidPercentage = 100 - this.paidPercentage;
          this.pieChart.data.labels = [`${this.paidPercentage.toFixed(0)}%`, `${this.unpaidPercentage.toFixed(0)}%`];
          this.pieChart.data.series = [this.paidPercentage, this.unpaidPercentage];
        })
        .catch(error => {
          console.error("Error fetching data:", error);
        });
      },
      countCompteur() {
        CompteurService.Count().then((res) => {
          this.nbCompteurs = res.data.count;
        }).catch((error) => {
          console.error('Erreur lors de la récupération du nombre de compteurs :', error);
        });
      },
      countUsers(){
        UserService.Count().then((res)=> {
          this.nbUser=res.data.count;
        });
      },
      countLocal(){
        LocalService.Count().then((res)=>{
          this.nbLocal = res.data.count;
        })
      },
      countNonPaye(){
        FactureService.countNonPayer().then((res) =>{
          this.nbFact = res.data.count;
        })
      },
      countPaye(){
        FactureService.countPayer().then((res) =>{
          return (res.data.count);
        })
      },
      countFactures(){
        FactureService.countFacture().then((res) =>{
          this.factTotale = res.data.count;
        })
      }
    },
    created() {
      this.countCompteur();
      this.countUsers();
      this.countLocal();
      this.countFactures();
      this.updateChartData();
      this.countNonPaye();
      this.fetchCountsByMonth();
      this.fetchConsomByMonth();
    }
  }
</script>
<style>

</style>
