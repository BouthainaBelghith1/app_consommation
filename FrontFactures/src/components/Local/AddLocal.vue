<template>
    <card>
      <h4 slot="header" class="card-title">Ajouter Local</h4>
      <form @submit.prevent="AddLocal()">
        <div class="row">
          <div class="col-md-6">
            <base-input type="text"
                      label="Nom Local"
                      placeholder="Nom Local"
                      v-model="local.nomLocal" required>
            </base-input>
          </div>
          <div class="col-md-6">
            <base-input type="adress"
                      label="adresse Local"
                      placeholder="adresse Local"
                      v-model="local.adresseLocal" required>
            </base-input>
          </div>
        </div>
  
        <div class="form-group">
            <label for="region">Sélectionner une catégorie</label>
            <select
                id="region"
                class="form-control"
                v-model="local.categorie_id">
                <option v-for="categorie in categories" :key="categorie.id" :value="categorie.id">
                {{ categorie.nomCategorie }}
                </option>
            </select>
        </div>
        
        <div class="text-center">
          <button type="submit" class="btn btn-info btn-fill float-right" >
            Ajouter Local
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
        AddLocal(){
            LocalService.createLocal(
                {
                  nomLocal:this.local.nomLocal,
                  adresseLocal:this.local.adresseLocal,
                  categorie_id:this.local.categorie_id,
                }
            ).then((res)=>{
                this.BackToAffiche();
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