<template>
  <div class="content">
    <div class="container-fluid" v-if="view === 'voir'" >
      <div>
        <AfficheFacture :id="id" @chnagerView="chnagerView"></AfficheFacture>
      </div>
    </div>
    <div class="container-fluid" v-else-if="view === 'add'" >
      <div>
        <AddFacture @chnagerView="chnagerView"></AddFacture>
      </div>
    </div>
    <div class="container-fluid" v-else-if="view === 'affichage'">
      <button class="btn btn-primary" @click="chnagerView('add')">Ajouter</button>
      <div class="row">
        <div class="col-md-12">
          <card class="strpied-tabled-with-hover" body-classes="table-full-width">
            <template slot="header">
              <h4 class="card-title">Liste des factures</h4>
              <p class="card-category">Gérez vos factures ici</p>
            </template>
            <div class="table-responsive-sm">
              <table class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>Montant de la facture</th>
                    <th>Adresse</th>
                    <th>Statut</th>
                    <th>Date limite de paiement</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="facture in Factures" :key="facture.id">
                    <td>{{ facture.montantTotale }}</td>
                    <td class="col-2 text-truncate">
                      <span class="d-inline-block text-truncate" style="max-width: 150px;">
                        {{ facture.adresse }}
                      </span>
                    </td>
                    <td>
                      <i class="fa fa-check text-success" v-if="facture.isPaid"></i>
                      <i class="fa fa-times text-danger" v-else></i>
                    </td>
                    <td>{{ facture.dateLimitePaiement }}</td>
                    <td>
                      <button class="btn btn-danger" @click="DeleteFacture(facture.id)">
                          <i class="fa fa-trash"></i>
                      </button>

                      <button class="btn btn-warning" @click="edit(facture.id)">
                          <i class="fa fa-edit"></i>
                      </button>

                      <button class="btn btn-dark" @click="voir(facture.id)">
                          <i class="fa fa-eye"></i>
                      </button>

                      <button class="btn btn-success" @click="payer(facture.id)" v-if="facture.isPaid == false">
                          <i class="fa fa-dollar"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </card>
        </div>
      </div>
    </div>
    <div class="container-fluid" v-else>
      <div>
        <UpdateFacture @chnagerView="chnagerView" :id="idSelected"></UpdateFacture>
      </div>
    </div>
  </div>
</template>

<script>
import FactureService from "../services/factures.js";
import AfficheFacture from "../components/Facture/AfficheFacture.vue";
import LTable from 'src/components/Table.vue';
import Card from 'src/components/Cards/Card.vue';
import UpdateFacture from '../components/Facture/UpdateFacture.vue';
import AddFacture from "../components/Facture/AddFacture.vue";
export default {
  created() {
    this.getFacture();
    this.connect();
    this.payer();
  },
  data() {
    return {
      Factures: [],
      view: "affichage",
      id: null,
      idSelected: null,
      idUser: null,
      isAdmin: null,
      isChefRegion: null,
      facture: null,
    }
  },
  methods: {
    chnagerView(data) {
      this.view = data;
      this.getFacture();
    },
    getFacture() {
      FactureService.getFacture().then((res) => {
        this.Factures = res.data.data;
      })
    },
    connect() {
      const userData = JSON.parse(localStorage.getItem('user'));
      if (userData && userData.role === 'admin') {
        this.isAdmin = true;
        this.getLocal();
      } else if (userData && userData.role === 'Chef Region') {
        this.isChefRegion = true;
        this.idRegion = userData.region_id;
        this.Filtrer(this.idRegion);
      }
    },
    voir(id) {
      this.id = id;
      this.view = "voir";
    },
    DeleteFacture(id) {
      FactureService.deleteFacture(id).then((res) => {
        this.getFacture();
      })
    },
    edit(id) {
      this.idSelected = id;
      this.view = "update";
    },
    payer(id){
      FactureService.Payer(id).then(()=>{
          this.getFacture();
      });
    }

  },
  components: {
    LTable,
    Card,
    AfficheFacture,
    UpdateFacture,
    AddFacture
  },
  mounted(){
    window.Echo.channel('public').listen('Fact', (e) => {
      this.getFacture();
    });
  }
}
</script>

<style>
.content {
  padding: 20px;
}

.container-fluid {
  margin-bottom: 20px;
}

.card-title {
  font-size: 1.5rem;
}

.card-category {
  font-size: 1rem;
  color: #888;
}

.btn {
  margin-right: 10px;
}

@media (max-width: 768px) {
  .table-responsive-sm {
    overflow-x: auto;
  }
}
</style>
