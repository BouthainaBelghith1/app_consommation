<template>
    <card>
      <h4 slot="header" class="card-title">Modifier Region</h4>
      <form @submit.prevent="UpdateRegion">
        <div class="row">
          <div class="col-md-12">
            <base-input type="text"
                      label="Nom Region"
                      placeholder="Nom Region"
                      v-model="region.nomRegion">
            </base-input>
          </div>
        </div>
        <div class="form-group">
            <label for="counter">Sélectionner un utilisateur</label>
            <select
                id="counter"
                class="form-control"
                v-model="region.user_id">
                <option v-for="user in users" :key="user.id" :value="user.id">
                {{ user.nom }} {{ user.prenom }}
                </option>
            </select>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-info btn-fill float-right">
            Modifier Region
          </button>
          <button @click="BackToAffiche" class="btn btn-danger btn-fill float-right">cancel</button>
        </div>
        <div class="clearfix"></div>
      </form>
    </card>
</template>

<script>
import RegionService from "../../services/regions.js"
import UserService from "../../services/users.js";
export default {
    props:{
        id:Number
    },
    created(){
        this.getById(),
        this.GetUser()
    },
    data(){
        return {
            region:{
                nomRegion: "",
                local_id:null,
                user_id:null,
            },
            locals:[],
            users:[]
        }
    },
    methods:{
        UpdateRegion(){
            RegionService.UpdateRegion(
                this.id,
                {
                    nomRegion:this.region.nomRegion,
                    user_id:this.region.user_id,
                    local_id:this.region.local_id,
                }
            ).then((res)=>{
                this.BackToAffiche();
            })
        },
        getById(){
            RegionService.FindByIdRegion(this.id).then((res)=>{
                this.region=res.data.data;
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
     }
}

</script>