<template>
    <div class="content">
      <div class="container-fluid" v-if="view=='voir'" >
        <div>
          <AfficheFacture :id="id" @chnagerView="chnagerView"></AfficheFacture>
        </div>
      </div>
      <div class="container-fluid" v-else-if="view=='add'" >
        <div>
          <AddRegion @chnagerView="chnagerView"></AddRegion>
        </div>
      </div>
      <div class="container-fluid" v-else-if="view=='affichage'">
        <button class="btn btn-primary" @click="chnagerView('add')">Ajouter</button>
        <div class="row" >
          <div class="col-12">
            <card class="strpied-tabled-with-hover" body-classes="table-full-width table-responsive">
              <template slot="header">
                <h4 class="card-title">Regions</h4>
                <p class="card-category">Gérer les regions</p>
              </template>
              <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nom Region</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="region in Regions" :key="region.id">
                      <td>{{ region.id }}</td>
                      <td>{{ region.nomRegion }}</td>
                      <td>
                        <button  class="btn btn-danger" @click="DeleteRegion(region.id)"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-warning" @click="edit(region.id)"><i class="fa fa-edit"></i></button>
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
          <UpdateRegion  @chnagerView="chnagerView" :id="idSelected"></UpdateRegion>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import RegionService from "../services/regions.js";
  import UserService from "../services/users.js";
  import LocalService from "../services/locals.js";
  import AddRegion from "../components/Region/AddRegion.vue";
  import UpdateRegion from "../components/Region/UpdateRegion.vue";
  
  export default {
   created(){
     this.GetRegions();
   },
   data(){
     return {
       Regions:[],
       idSelected:null,
       view:"affichage",
     }
   },
   methods:{
     chnagerView(data){
       this.view=data;
       this.GetRegions();
     },
     GetRegions(){
       RegionService.getRegion().then((res)=>{
         this.Regions=res.data.data;
       })
     },
     DeleteRegion(id){
       RegionService.deleteRegion(id).then((res)=>{
         this.GetRegions();
         console.log(res);
       })
     },
     edit(id){
       this.idSelected=id;
       this.view="update";
     },
   },
   components:{
     AddRegion,UpdateRegion
   }
  }
  </script>