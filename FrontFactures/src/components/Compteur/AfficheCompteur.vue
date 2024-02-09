<template>
    <div class="compteur-details">
      <div class="card">
        <h5 class="card-header">Détails du Compteur</h5>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <p><strong>Numéro de Série:</strong> {{ compteur.numSerie }}</p>
              <p><strong>Modèle:</strong> {{ compteur.modele }}</p>
              <p><strong>Type:</strong> {{ compteur.type }}</p>
            </div>
            <div class="col-md-6">
              <p><strong>Local:</strong> {{ local.nomLocal }}</p>
              <p><strong>Consommation:</strong> {{ compteur.consommation }} {{ compteur.unite }}</p>
              <p><strong>Dernière Installation:</strong> {{ compteur.created_at | formatDate}} </p>
            </div>
          </div>
        </div>
      </div>
      <button @click="BackToAffiche" class="btn btn-danger btn-fill float-right">cancel</button>
    </div>
  </template>
  
  <script>
  import CompteurService from  '../../services/compteurs';
  import LocalService from  '../../services/locals.js';
  export default {
    created(){
        this.GetById();
    },
    props: {
      id:Number
    },
    data(){
        return{
            compteur:{},
            local:{}
        }
    },
    methods: {
      async GetById(){
        try {
            const res = await CompteurService.FindByIdCompteur(this.id)
            this.compteur = res.data.data;
            
            const response = await LocalService.FindByIdLocal(this.compteur.local_id)
            this.local = response.data.data;
        } catch (error) {
            console.error("Error fetching data:", error);
        }
      },
      BackToAffiche(){
        this.$emit("chnagerView",'affichage');
      },
    },
    filters: {
        formatDate(value) {
            if (!value) return '';
            const date = new Date(value);
            return date.toLocaleDateString(); 
        }
    },
  }
  </script>
  
  <style scoped>

  </style>
  