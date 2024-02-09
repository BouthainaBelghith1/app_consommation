<template>
    <card>
      <h4 slot="header" class="card-title">Ajouter Facture</h4>
      <form @submit.prevent="AddFacture">
        
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
    
  
      
      <hr class="my-4"/>

        
        <div class="text-center">
          <button type="submit" class="btn btn-info btn-fill float-right">
            Ajouter Facture
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
    created(){
        this.loadCompteurs()
    },
    components: {
      Card
    },
    data () {
      return {
        facture: {
          periode:"",
          adresse:"",
          dateFinConsommation:"",
          prixUnitaire:"",
          quantite:"",
          isPaid:"",
          montantTotale:"",
          dateLimitePaiement:"",
          compteur_id:""
        },
        compteurs: [],
      }
    },
    methods: {
        AddFacture(){
            FactureService.createFacture(
                {
                  periode:this.facture.periode,
                  adresse:this.facture.adresse,
                  isPaid:this.facture.isPaid,
                  dateFinConsommation:this.facture.dateFinConsommation,
                  prixUnitaire:this.facture.prixUnitaire,
                  quantite:this.facture.quantite,
                  montantTotale:this.facture.montantTotale,
                  dateLimitePaiement:this.facture.dateLimitePaiement,
                  compteur_id:this.facture.compteur_id,
                }
            ).then((res)=>{
                this.BackToAffiche();
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