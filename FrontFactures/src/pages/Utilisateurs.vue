<template>
    <div class="content">
      <div class="container-fluid" v-if="view=='voir'" >
        <div>
          <AfficheUser :id="id" @chnagerView="chnagerView"></AfficheUser>
        </div>
      </div>
      <div class="container-fluid" v-else-if="view=='add'" >
        <div>
          <AddUser @chnagerView="chnagerView"></AddUser>
        </div>
      </div>
      <div class="container-fluid" v-else-if="view=='affichage'">
        <button class="btn btn-primary" @click="chnagerView('add')">Ajouter</button>
        <div class="row" >
          <div class="col-12">
            <card class="strpied-tabled-with-hover" body-classes="table-full-width table-responsive">
              <template slot="header">
                <h4 class="card-title">Utilisateurs</h4>
                <p class="card-category">Gérer les Utilisateurs</p>
              </template>
              <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Role</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users" :key="user.id">
                      <td>{{ user.id }}</td>
                      <td>{{ user.nom }}</td>
                      <td>{{ user.prenom }}</td>
                      <td>{{ user.role }}</td>
                      <td>
                        <button  class="btn btn-danger" @click="DeleteUser(user.id)"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-warning" @click="edit(user.id)"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-dark" @click="voir(user.id)"><i class="fa fa-eye"></i></button>
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
          <UpdateUser  @chnagerView="chnagerView" :id="idSelected"></UpdateUser>
        </div>
      </div>
    </div>
  </template>
  <script>
    import AfficheUser from "../components/User/AfficheUser.vue";
    import LTable from 'src/components/Table.vue';
    import Card from 'src/components/Cards/Card.vue';
    import AddUser from "../components/User/AddUser.vue";
    import UserService from "../services/users.js";
    import UpdateUser from "../components/User/UpdateUser.vue";
    export default {
      created(){
        this.getUser();
      },
      data () {
        return {
          users: [],
          view:"affichage",
          id: null,
          idSelected: null,
        }
      },
      methods:{
        chnagerView(data){
          this.view=data;
          this.getUser();
        },
        getUser(){
          UserService.getUser().then((res)=>{
            this.users=res.data.data;
          })
        },
        voir(id){
          this.id=id;
          this.view="voir";
        },
        DeleteUser(id){
          UserService.deleteUser(id).then((res)=>{
            this.getUser();
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
      AfficheUser,
      AddUser,
      UpdateUser
  },
    }
  </script>
  <style>
  </style>
  