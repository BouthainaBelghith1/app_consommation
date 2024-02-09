<template>
    <card>
      <h4 slot="header" class="card-title">Modifier Utilisateur</h4>
      <form @submit.prevent="UpdateUser()">
        <div class="row">
          <div class="col-md-6">
            <base-input type="text"
                      label="nom"
                      placeholder="nom"
                      v-model="user.nom">
            </base-input>
          </div>
          <div class="col-md-6">
            <base-input type="text"
                      label="prenom"
                      placeholder="prenom"
                      v-model="user.prenom">
            </base-input>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <base-input type="text"
                      label="email"
                      placeholder="email"
                      v-model="user.email">
            </base-input>
          </div>
          <div class="col-md-6">
            <base-input type="password"
                      label="password"
                      placeholder="password"
                      v-model="user.password">
            </base-input>
          </div>
        </div>
  
        <div class="form-group">
          <label for="select">Sélectionner un Role</label>
          <select
            id="select"
            class="form-control"
            v-model="user.role">
            <option value="Chef Region">Chef Region</option>
            <option value="Agents de Saisie">Agents de saisie</option>
            <option value="Responsable Local" selected>Responsable Local</option>
          </select>
        </div>
  
        
        <div class="text-center">
          <button type="submit" class="btn btn-info btn-fill float-right" >
            Modifier Utilisateur
          </button>
          <button @click="BackToAffiche" class="btn btn-danger btn-fill float-right">cancel</button>
        </div>
        <div class="clearfix"></div>
      </form>
    </card>
  </template>
  <script>
  import Card from 'src/components/Cards/Card.vue';
  import UserService from "../../services/users.js";
  export default {
    props:{
        id:Number
    },
    created(){
        this.getById(),
        this.loadRegions()
    },
    components: {
      Card
    },
    data () {
      return {
        user: {
            nom:"",
            prenom:"",
            email:"",
            password:"",
            role:"",
        },
        regions: [],
      }
    },
    methods: {
        UpdateUser(){
            UserService.UpdateUser(
                this.id,
                {
                  nom:this.user.nom,
                  prenom:this.user.prenom,
                  email:this.user.email,
                  password:this.user.password,
                  role:this.user.role,
                }
            ).then((res)=>{
                this.BackToAffiche();
            })
        },
        getById(){
            UserService.FindByIdUser(this.id).then((res)=>{
                this.user=res.data.data;
            })
        },
        BackToAffiche(){
            this.$emit("chnagerView",'affichage');
        },
    }
  }

</script>