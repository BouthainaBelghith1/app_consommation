<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row justify-content-center" v-if="view=='affichage'">
        <div class="col-md-4">
          <Card class="card-user">
            <img slot="image" src="../../public/img/login.jpg" alt="...">
            <div class="author">
              <a href="#">
                <img class="avatar" src="img/Avatar.jpg" alt="...">
                <h4 class="title">{{ user.nom }} {{ user.prenom }}<br>
                  <small>{{ user.role }}</small>
                </h4>
              </a>
            </div>
            <p class="description text-center">
              {{ user.email }} <br>
              Depuis : {{ user.created_at | formatDate }} <br>
            </p>
            <div class="text-center">
              <button class="btn btn-info btn-fill" @click="editProfile(user.id)">Modifier Profil</button>
            </div>
          </Card>
        </div>
      </div>
      <div v-else-if="view=='edit'">
        <UpdateUser :id="id" @chnagerView="chnagerView"></UpdateUser>
      </div>
    </div>
  </div>
</template>

<script>
import Card from 'src/components/Cards/Card.vue'
import UpdateUser from 'src/components/User/UpdateUser.vue'

export default {
  components: {
    Card,
    UpdateUser
  },
  data() {
    return {
      user: {},
      id: null,
      view: "affichage",
    };
  },
  created() {
    this.user = this.readLocalStorage("user");
  },
  methods: {
    chnagerView(data) {
      this.view = data;
    },
    readLocalStorage(key) {
      try {
        const data = localStorage.getItem(key);
        if (data) {
          return JSON.parse(data);
        } else {
          return null;
        }
      } catch (error) {
        console.error("Error reading local storage:", error);
        return null;
      }
    },
    editProfile(id) {
      this.id = id;
      this.view = "edit";
    }
  },
  filters: {
    formatDate(value) {
      if (!value) return '';
      const date = new Date(value);
      return date.toLocaleDateString();
    }
  },
}
</script>

<style scoped>
.card-user {
  border: none;
  box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14), 0 2px 4px -1px rgba(0, 0, 0, 0.12), 0 4px 5px 0 rgba(0, 0, 0, 0.2);
  transition: box-shadow 0.3s;
  margin-top: 50px; /* Espacement depuis le haut de la page */
}

.card-user:hover {
  box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 7px 10px -5px rgba(0, 0, 0, 0.15);
}

.card-user img {
  width: 100%;
  border-radius: 6px 6px 0 0;
}

.card-user .author {
  padding: 15px 60px;
}

.card-user .author h4.title {
  font-size: 1.5rem;
  margin-top: 10px;
  margin-bottom: 0;
}

.card-user .author h4 small {
  font-size: 0.875rem;
}

.card-user .description {
  padding: 0 20px;
  margin-bottom: 0;
  font-size: 14px;
  color: #888;
}

.card-user .footer {
  padding-top: 10px;
}

.card-user .btn-info {
  margin-top: 20px;
}

.card-user .btn-info:hover {
  background-color: #17a2b8;
}

.author img{
  border-radius: 50%;
}

</style>
