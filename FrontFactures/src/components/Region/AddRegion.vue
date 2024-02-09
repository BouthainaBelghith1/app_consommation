<template>
    <card>
      <h4 slot="header" class="card-title">Ajouter Region</h4>
      <form @submit.prevent="AddRegion">
        <div class="row">
          <div class="col-md-12">
            <base-input type="text"
                      label="Nom Region"
                      placeholder="Nom Region"
                      v-model="nomRegion" required>
            </base-input>
          </div>
        </div>
        <div class="form-group">
            <label for="counterSelect">Sélectionner un local</label>
            <select
                id="counterSelect"
                class="form-control"
                v-model="local_id">
                <option v-for="local in locals" :key="local.id" :value="local.id">
                {{ local.nomLocal }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="counter">Sélectionner un utilisateur</label>
            <select
                id="counter"
                class="form-control"
                v-model="user_id">
                <option v-for="user in users" :key="user.id" :value="user.id">
                {{ user.nom }} {{ user.prenom }}
                </option>
            </select>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-info btn-fill float-right">
            Ajouter Region
          </button>
          <button @click="BackToAffiche" class="btn btn-danger btn-fill float-right">cancel</button>
        </div>
        <div class="clearfix"></div>
      </form>
    </card>
</template>

<script>
import RegionService from "../../services/regions.js";
import UserService from "../../services/users.js";
import LocalService from "../../services/locals.js";
export default {
    data(){
        return {
            nomRegion: "",
            local_id:null,
            user_id:null,
            locals:[],
            users:[]
        }
    },
    methods:{
        AddRegion(){
            RegionService.createRegion(
                {
                  nomRegion:this.nomRegion,
                  local_id:this.local_id,
                  user_id:this.user_id
                }
            ).then((res)=>{
                this.BackToAffiche();
            })
        },
        BackToAffiche(){
            this.$emit("chnagerView",'affichage');
        },
        GetUser(){
            UserService.getUser().then((res)=>{
                this.users = res.data.data;
                console.log(this.users);
            })
        },
        GetLocal(){
            LocalService.getLocal().then((res)=>{
                this.locals = res.data.data;
            })
        }
     },
     created(){
        this.GetUser(),
        this.GetLocal()
     }
}

</script>