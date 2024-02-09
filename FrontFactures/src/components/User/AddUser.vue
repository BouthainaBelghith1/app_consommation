<template>
    <card>
      <h4 slot="header" class="card-title">Ajouter un Utilisateur</h4>
      <form @submit.prevent="AddUser()" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6">
            <base-input type="text"
                        label="Nom"
                        placeholder="Nom"
                        v-model="user.nom" required>
            </base-input>
          </div>
          <div class="col-md-6">
            <base-input type="text"
                        label="Prénom"
                        placeholder="Prénom"
                        v-model="user.prenom" required>
            </base-input>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <base-input type="email"
                        label="Email"
                        placeholder="Email"
                        v-model="user.email" required>
            </base-input>
          </div>
          <div class="col-md-6">
            <base-input type="password"
                        label="Mot de passe"
                        placeholder="Mot de passe"
                        v-model="user.password" max="20" min="8" required>
            </base-input>
          </div>
        </div>
        <div class="form-group">
          <label for="select">Sélectionner un rôle</label>
          <select id="select"
                  class="form-control"
                  v-model="user.role" required>
            <option value="">Sélectionner un rôle</option>
            <option value="Chef Region">Chef de Région</option>
            <option value="Agents de Saisie">Agent de Saisie</option>
            <option value="Responsable Local">Responsable Local</option>
          </select>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-info btn-fill">
            Ajouter Utilisateur
          </button>
          <button @click="BackToAffiche" class="btn btn-danger btn-fill">Annuler</button>
        </div>
      </form>
    </card>
  </template>
  
  <script>
  import Card from 'src/components/Cards/Card.vue';
  import UserService from "../../services/users.js";
  
  export default {
    components: { Card },
    data() {
      return {
        user: {
          nom: "",
          prenom: "",
          email: "",
          password: "",
          role: "",
        },
      };
    },
    methods: {
      AddUser() {
        UserService.createUser(this.user)
          .then(() => {
            this.BackToAffiche();
          })
          .catch(error => {
            console.error("Erreur lors de l'ajout de l'utilisateur :", error);
          });
      },
      BackToAffiche() {
        this.$emit("chnagerView", "affichage");
      },
    },
  };
  </script>
  
  <style scoped>
  </style>
  