<template>
    <card>
      <h4 slot="header" class="card-title">Modifier Local</h4>
      <form @submit.prevent="UpdateLocal()">
        <div class="row">
          <div class="col-md-12">
            <base-input type="text"
                      label="nom"
                      placeholder="nom"
                      v-model="local.nomLocal">
            </base-input>
          </div>
        </div>

        
        <div class="text-center">
          <button type="submit" class="btn btn-info btn-fill float-right" >
            Modifier Local
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
  import CategorieService from "../../services/categories.js";
  export default {
    props:{
        id:Number
    },
    created(){
        this.getById(),
        this.loadCategories()
    },
    components: {
      Card
    },
    data () {
      return {
        local: {
            nomLocal:"",
            adresseLocal:"",
            categorie_id:"",
        },
        categories:[]
      }
    },
    methods: {
        UpdateLocal(){
            LocalService.UpdateLocal(
                this.id,
                {
                  nomLocal:this.local.nomLocal,
                  adresseLocal:this.local.adresseLocal,
                  categorie_id:this.local.categorie_id,
                }
            ).then((res)=>{
                this.BackToAffiche();
            })
        },
        getById(){
            LocalService.FindByIdLocal(this.id).then((res)=>{
                this.local=res.data.data;
            })
        },
        BackToAffiche(){
            this.$emit("chnagerView",'affichage');
        },
        loadCategories() {
            CategorieService.getCategorie().then((res) => {
                this.categories = res.data.data;
            });
        },
    }
  }

</script>