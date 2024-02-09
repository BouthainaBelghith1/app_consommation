<template>
    <card>
      <h4 slot="header" class="card-title">Modifier une Catégorie</h4>
      <form @submit.prevent="UpdateCategorie()">
        <div class="row">
          <div class="col-md-12">
            <base-input type="text"
                      label="nom Catégorie"
                      placeholder="nom Catégorie"
                      v-model="nomCategorie">
            </base-input>
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-info btn-fill float-right">
            Modifier une Catégorie
          </button>
          <button @click="BackToAffiche" class="btn btn-danger btn-fill float-right">cancel</button>
        </div>
        <div class="clearfix"></div>
      </form>
    </card>
</template>

<script>
import CategorieService from "../../services/categories.js"
export default {
    props:{
        id:Number
    },
    created(){
        this.getById()
    },
    data(){
        return {
            nomCategorie: '',
        }
    },
    methods:{
        UpdateCategorie(){
            CategorieService.UpdateCategorie(
                this.id,
                {
                  nomCategorie:this.nomCategorie,

                }
            ).then((res)=>{
                this.BackToAffiche();
            })
        },
        getById(){
            CategorieService.FindByIdCategorie(this.id).then((res)=>{
                this.nomCategorie=res.data.data['nomCategorie'];
            })
        },
        BackToAffiche(){
            this.$emit("chnagerView",'affichage');
        },
     }
}

</script>