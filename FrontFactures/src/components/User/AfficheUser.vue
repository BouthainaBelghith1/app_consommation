<template>
    <div class="user-profile">
      <card class="card-user">
        <div slot="header" class="header">
          <img class="background-image" src="../../../public/img/login.jpg" alt="Background Image"/>
        </div>
        <div class="avatar">
            <img src="../../../public/img/Avatar.jpg" alt="Background Image"/>
        </div>
        <div class="user-info">
          <h4 class="user-name">{{ user.nom }} {{ user.prenom }}</h4>
          <p class="user-details">Email : {{ user.email }}</p>
          <p class="user-details">Role : {{ user.role }}</p>
        </div>
        <div class="action-buttons">
          <button @click="BackToAffiche" class="btn btn-danger btn-fill">Annuler</button>
        </div>
      </card>
    </div>
  </template>
  
  <script>
  import Card from 'src/components/Cards/Card.vue';
  import UserService from "../../services/users.js";
  
  export default {
    components: {
      Card
    },
    props: {
      id: Number
    },
    data() {
      return {
        user: {}
      };
    },
    methods: {
      async getById() {
        try {
          const res = await UserService.FindByIdUser(this.id);
          this.user = res.data.data;
        } catch (error) {
          console.error("Error fetching data:", error);
        }
      },
      BackToAffiche() {
        this.$emit("chnagerView", 'affichage');
      },
    },
    created() {
      this.getById();
    },
  };
  </script>
  
  <style scoped>
  .user-profile {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
  }
  
  .card-user {
    max-width: 400px;
  }
  
  .header {
    position: relative;
  }
  
  .background-image {
    width: 100%;
    height: auto;
    border-radius: 5px 5px 0 0;
  }
  
  .avatar {
    margin-top: -50px;
    text-align: center;
  }
  
  .avatar img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 2px solid #fff;
  }
  
  .user-info {
    text-align: center;
    padding: 20px;
    margin-top: -50px;
  }
  
  .user-name {
    margin-bottom: 5px;
  }
  
  .user-details {
    margin-bottom: 10px;
  }
  
  .action-buttons {
    text-align: center;
    margin-top: 20px;
  }
  
  .btn-fill {
    margin-right: 10px;
  }
  </style>
  