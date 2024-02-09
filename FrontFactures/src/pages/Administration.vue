<template>
  <div class="content">
    <div class="container-fluid">
      <card>
        <div class="places-buttons">
          <div class="row justify-content-center">
            <div class="col-12 text-center">
              <h3>Gestion de l'administration</h3>
              <p class="text-muted">Utilisez les boutons ci-dessous pour gérer l'administration</p>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-4">
              <button class="btn btn-primary btn-block" @click="changerView('user')">Utilisateurs</button>
            </div>
            <div class="col-md-4">
              <button class="btn btn-primary btn-block" @click="changerView('region')">Regions</button>
            </div>
            <div class="col-md-4">
              <button class="btn btn-primary btn-block" @click="changerView('categorie')">Catégories</button>
            </div>
          </div>
        </div>
      </card>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      
    }
  },
  methods: {
    changerView(page){
      if(page === 'region'){
        this.$router.push("/Region");
      } else if(page === 'user'){
        this.$router.push("/Utilisateurs");
      } else if (page === 'categorie') {
        this.$router.push("/Categorie");
      }
    },
  }
}
</script>

<style scoped>
.places-buttons {
  margin-top: 30px;
}

.card-title {
  margin-bottom: 0;
}

.card-category {
  font-size: 14px;
  color: #999;
}

.btn {
  margin-top: 10px;
}
</style>
