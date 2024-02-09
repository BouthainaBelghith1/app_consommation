<template>
    <card>
      <h4 slot="header" class="card-title">Ajouter une catégorie</h4>
      <form @submit.prevent="AddCategorie()">
        <div class="row">
          <div class="col-md-12">
            <base-input type="text"
                      label="Nom Catégorie"
                      placeholder="Nom Catégorie"
                      v-model="nomCategorie">
            </base-input>
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-info btn-fill float-right">
            Ajouter une Catégorie
          </button>
          <button @click="BackToAffiche" class="btn btn-danger btn-fill float-right">cancel</button>
        </div>
        <div class="clearfix"></div>
      </form>
    </card>
</template>

<script>

import CategorieService from '../../services/categories.js'
export default {
    data(){
        return {
            nomCategorie: '',
        }
    },
    methods:{
        AddCategorie(){
            CategorieService.createCategorie(
                {
                  nomCategorie:this.nomCategorie,
                }
            ).then((res)=>{
                this.BackToAffiche();
            })
        },
        BackToAffiche(){
            this.$emit("chnagerView",'affichage');
        },
     }
}

</script>