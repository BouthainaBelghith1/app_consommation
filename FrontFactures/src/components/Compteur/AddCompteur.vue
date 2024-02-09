<template>
    <card>
      <h4 slot="header" class="card-title">Ajouter un Compteur</h4>
      <form @submit.prevent="AddCompteur()">
        <div class="form-group">
            <label for="counter">Sélectionner un Type</label>
            <select
                id="counter"
                class="form-control"
                v-model="compteur.type" required>
                <option value="gaz">Gaz</option>
                <option value="eau">Eau</option>
                <option value="internet">Internet</option>
                <option value="électricité">Électricité</option>
            </select>
        </div>

        <div class="row">
          <div class="col-md-6">
            <base-input type="text"
                      label="Num Serie"
                      placeholder="Num Serie"
                      v-model="compteur.numSerie">
            </base-input>
          </div>
          <div class="col-md-6">
            <base-input type="text"
                      label="modele"
                      placeholder="modele"
                      v-model="compteur.modele" required>
            </base-input>
          </div>
        </div>
  
        
        <div class="form-group">
          <label for="counterSelect">Sélectionner un local</label>
          <select
            id="counterSelect"
            class="form-control"
            v-model="compteur.local_id" required>
            <option v-for="local in locals" :key="local.id" :value="local.id">
              {{ local.nomLocal }}
            </option>
          </select>
        </div>
        
        <div class="text-center">
          <button type="submit" class="btn btn-info btn-fill float-right">
            Ajouter Compteur
          </button>
          <button @click="BackToAffiche" class="btn btn-danger btn-fill float-right">cancel</button>
        </div>
        <div class="clearfix"></div>
      </form>
    </card>
  </template>
  <script>
  import Card from 'src/components/Cards/Card.vue';
  import LocalService from "../../services/locals.js";
  import CompteurService from "../../services/compteurs.js";
  export default {
    created(){
        this.loadLocals();
    },
    components: {
      Card
    },
    data () {
      return {
        compteur: {
          type:"",
          numSerie:"",
          modele:"",
          local_id:"",
          consommation:0,
          unite: " ",
        },
        locals: [],
        typescompteurs: [],
      }
    },
    methods: {
        AddCompteur(){
            CompteurService.createCompteur(
                {
                  consommation:this.compteur.consommation,
                  numSerie:this.compteur.numSerie,
                  modele:this.compteur.modele,
                  type:this.compteur.type,
                  marque:this.compteur.marque,
                  local_id:this.compteur.local_id,
                  unite: this.compteur.unite
                }
            ).then((res)=>{
                this.BackToAffiche();
            })
        },
        BackToAffiche(){
            this.$emit("chnagerView",'affichage');
        },
        loadLocals() {
            LocalService.getLocal().then((res) => {
                this.locals = res.data.data;
            });
        }
    }
  }

</script>