<template>
    <div class="content">
      <div class="container-fluid" v-if="view=='add'" >
        <div>
          <AddCategorie @chnagerView="chnagerView"></AddCategorie>
        </div>
      </div>
      <div class="container-fluid" v-else-if="view=='affichage'">
        <button class="btn btn-primary" @click="chnagerView('add')">Ajouter</button>
        <div class="row" >
          <div class="col-12">
            <card class="strpied-tabled-with-hover" body-classes="table-full-width table-responsive">
              <template slot="header">
                <h4 class="card-title">Catégories</h4>
                <p class="card-category">Gérer les Catégories</p>
              </template>
              <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nom Catégorie</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="categorie in Categories" :key="categorie.id">
                      <td>{{ categorie.id }}</td>
                      <td>{{ categorie.nomCategorie }}</td>
                      <td>
                        <button  class="btn btn-danger" @click="DeleteCategorie(categorie.id)"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-warning" @click="edit(categorie.id)"><i class="fa fa-edit"></i></button>
                      </td>
                    </tr>
                  </tbody>
              </table>
            </card>
          </div>
        </div>
      </div>
      <div class="container-fluid" v-else>
        <div>
          <UpdateCategorie  @chnagerView="chnagerView" :id="idSelected"></UpdateCategorie>
        </div>
      </div>
    </div>
  </template>
  <script>
    import LTable from 'src/components/Table.vue';
    import Card from 'src/components/Cards/Card.vue';
    import CategorieService from '../services/categories.js'
    import UpdateCategorie from '../components/Categorie/UpdateCategorie.vue';
    import AddCategorie from "../components/Categorie/AddCategorie.vue";
    export default {
      created(){
        this.getCategorie();
      },
      data () {
        return {
          Categories: [],
          view:"affichage",
          id: null,
          idSelected: null,
        }
      },
      methods:{
        chnagerView(data){
          this.view=data;
          this.getCategorie();
        },
        getCategorie(){
          CategorieService.getCategorie().then((res)=>{
            this.Categories=res.data.data;
          })
        },
        DeleteCategorie(id){
          CategorieService.deleteCategorie(id).then((res)=>{
            this.getCategorie();
          })
        },
        edit(id){
          this.idSelected=id;
          this.view="update";
        }
      },
      components: {
      LTable,
      Card,
      UpdateCategorie,
      AddCategorie
  },
    }
  </script>
  <style>
  </style>
  