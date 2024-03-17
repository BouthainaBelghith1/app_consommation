<template>
  <div class="content">
    <div class="container-fluid" v-if="view=='add'">
      <div>
        <AddLocal @chnagerView="chnagerView"></AddLocal>
      </div>
    </div>
    <div class="container-fluid" v-else-if="view=='affichage'">
      <button class="btn btn-primary" @click="chnagerView('add')" >Ajouter</button>
      <div class="row">
        <div class="col-12">
          <Card class="strpied-tabled-with-hover" body-classes="table-full-width table-responsive">
            <template slot="header">
              <h4 class="card-title">Locals</h4>
              <p class="card-category">Locals</p>
            </template>
            <table class="table table-hover table-striped">
              <thead>
                  <th>Nom Local</th>
                  <th>Adresse Local</th>
                  <th>Actions</th>
              </thead>
              <tbody>
                <tr v-for="local in locals" :key="local.id">
                  <td>
                    <span class="d-inline-block text-truncate" style="max-width: 150px;">
                      {{ local.nomLocal }}
                    </span>
                  </td>
                  <td>
                    <span class="d-inline-block text-truncate" style="max-width: 150px;">
                      {{ local.adresseLocal }}
                    </span>
                  </td>
                  <td>
                    <button class="btn btn-danger" @click="DeleteLocal(local.id)">
                          <i class="fa fa-trash"></i>
                      </button>

                      <button class="btn btn-warning" @click="edit(local.id)">
                          <i class="fa fa-edit"></i>
                      </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </Card>
        </div>
      </div>
    </div>
    <div class="container-fluid" v-else>
      <div>
        <UpdateLocal @chnagerView="chnagerView" :id="idSelected"></UpdateLocal>
      </div>
    </div>
  </div>
</template>

<script>
import LocalService from "../services/locals.js";
import LTable from 'src/components/Table.vue';
import Card from 'src/components/Cards/Card.vue';
import CategorieService from '../services/categories.js';
import UpdateLocal from '../components/Local/UpdateLocal.vue';
import AddLocal from "../components/Local/AddLocal.vue";

export default {
  created() {
    this.getLocal();
    this.connect();
    this.GetCategorie();
  },
  data() {
    return {
      locals: [],
      view: "affichage",
      id: null,
      idSelected: null,
      isAdmin: false,
      isChefRegion: false, 
      idRegion: null,
      idCateg: null,
    };
  },
  methods: {
    chnagerView(data) {
      this.view = data;
      this.getLocal();
    },
    getLocal() {
      LocalService.getLocal().then((res) => {
        this.locals = res.data.data;
      });
    },
    DeleteLocal(id) {
      LocalService.deleteLocal(id).then(() => {
        this.getLocal();
      });
    },
    edit(id) {
      this.idSelected = id;
      this.view = "update";
    },
    connect() {
      const userData = JSON.parse(localStorage.getItem('user'));
      if (userData && userData.role === 'admin') {
        this.isAdmin = true;
        this.getLocal();
      } else if(userData && userData.role === 'Chef Region') {
        this.isChefRegion = true;
        this.idRegion = userData.region_id;
        this.Filtrer(this.idRegion);
        console.log(this.locals);
      }
    },
    Filtrer(region_id) {
      LocalService.Filtrer(region_id).then((res) => {
        this.locals = res.data.data;
        console.log(res);
      });
    },
  },
  components: {
    LTable,
    Card,
    UpdateLocal,
    AddLocal,
  },
};
</script>

<style>

</style>
