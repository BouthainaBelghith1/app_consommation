<template>
    <card>
      <h4 slot="header" class="card-title">Modifier Facture</h4>
      <form @submit.prevent="UpdateFacture()">

        <div class="row">
          <div class="col-md-12">
            <base-input type="text"
                      label="Prix Unitaire"
                      placeholder="Prix Unitaire"
                      v-model="facture.prixUnitaire">
            </base-input>
          </div>
        </div>
        
        <div class="form-group">
          <label for="counterSelect">Sélectionner un compteur</label>
          <select
            id="counterSelect"
            class="form-control"
            v-model="facture.compteur_id">
            <option v-for="compteur in compteurs" :key="compteur.id" :value="compteur.id">
              {{ compteur.type }}
            </option>
          </select>
        </div>
        
        <div class="text-center">
          <button type="submit" class="btn btn-info btn-fill float-right" >
            Modifier Facture
          </button>
          <button @click="BackToAffiche" class="btn btn-danger btn-fill float-right">cancel</button>
        </div>
        <div class="clearfix"></div>
      </form>
    </card>
  </template>
  <script>
  import Card from 'src/components/Cards/Card.vue';
  import FactureService from "../../services/factures.js";
  import CompteurService from "../../services/compteurs.js";
  export default {
    props:{
        id:Number
    },
    created(){
        this.getById(),
        this.loadCompteurs()
    },
    components: {
      Card
    },
    data () {
      return {
        facture: {
          prixUnitaire:"",
          compteur_id:""
        },
        compteurs: [],
      }
    },
    methods: {
        UpdateFacture(){
            FactureService.UpdateFacture(
                this.id,
                {
                  prixUnitaire:this.facture.prixUnitaire,
                  compteur_id:this.facture.compteur_id,
                }
            ).then((res)=>{
                this.BackToAffiche();
            })
        },
        getById(){
            FactureService.FindByIdFacture(this.id).then((res)=>{
                this.facture=res.data.data;
            })
        },
        BackToAffiche(){
            this.$emit("chnagerView",'affichage');
        },
        loadCompteurs() {
            CompteurService.getCompteur().then((res) => {
                this.compteurs = res.data.data;
            });
        },
    }
  }

</script>