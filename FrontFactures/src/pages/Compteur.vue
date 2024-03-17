<template>
  <div class="content">
    <div class="container-fluid" v-if="view=='add'">
      <div>
        <AddCompteur @chnagerView="chnagerView"></AddCompteur>
      </div>
    </div>
    <div class="container-fluid" v-else-if="view=='voir'">
      <div>
        <AfficheCompteur :id="id"  @chnagerView="chnagerView"></AfficheCompteur>
      </div>
    </div>
    <div class="container-fluid" v-else-if="view=='affichage'">
      <button class="btn btn-primary" @click="chnagerView('add')" >Ajouter</button>
      <div class="row">
        <div class="col-12">
          <card class="strpied-tabled-with-hover" body-classes="table-full-width table-responsive">
            <template slot="header">
              <h4 class="card-title">Compteurs</h4>
              <p class="card-category">Gérer les compteurs</p>
            </template>
            <table class="table table-hover table-striped">
              <thead>
                  <th>Type</th>
                  <th>Consommation</th>
                  <th>Actions</th>
              </thead>
              <tbody>
                <tr v-for="compteur in compteurs" :key="compteur.id">
                  <td>{{ compteur.type }}</td>
                  <td>{{ compteur.consommation }}</td>
                  <td>
                    <button class="btn btn-danger" @click="DeleteCompteur(compteur.id)">
                        <i class="fa fa-trash"></i>
                    </button>
                    <button class="btn btn-dark" @click="voir(compteur.id)">
                        <i class="fa fa-eye"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </card>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CompteurService from "../services/compteurs.js";
import LTable from 'src/components/Table.vue';
import Card from 'src/components/Cards/Card.vue';
import LocalService from '../services/locals.js';
import AddCompteur from "../components/Compteur/AddCompteur.vue";
import AfficheCompteur from "../components/Compteur/AfficheCompteur.vue";

export default {
  created() {
    this.getCompteur();
    this.connect();
  },
  data() {
    return {
      compteurs: [],
      view: "affichage",
      id: null,
      idSelected: null,
      isAdmin: false,
      isChefRegion: false, 
    };
  },
  methods: {
    chnagerView(data) {
      this.view = data;
      this.getCompteur();
    },
    getCompteur() {
      CompteurService.getCompteur().then((res) => {
        this.compteurs = res.data.data;
      });
    },
    DeleteCompteur(id) {
      CompteurService.deleteCompteur(id).then(() => {
        this.getCompteur();
      });
    },
    connect() {
      const userData = JSON.parse(localStorage.getItem('user'));
      if (userData && userData.role === 'admin') {
        this.isAdmin = true;
        this.getLocal();
      } else if(userData && userData.role === 'Chef Region') {
        this.isChefRegion = true;
        this.idRegion = userData.region_id;
        this.Filtrer(this.idRegion);
        console.log(this.locals);
      }
    },
    voir(id) {
      this.id = id;
      this.view = "voir";
    },

    /*Filtrer(region_id) {
      LocalService.Filtrer(region_id).then((res) => {
        this.locals = res.data.data;
        console.log(res);
      });
    },*/
  },
  components: {
    LTable,
    Card,
    AddCompteur,
    AfficheCompteur
  },
};
</script>

<style>

</style>
