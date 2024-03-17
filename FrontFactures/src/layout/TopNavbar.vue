<template>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#" @click="dash()">Dashboard</a>

      <div class="collapse navbar-collapse justify-content-end">
        <ul class="nav navbar-nav mr-auto">
          <li class="nav-item" >
            <input type="text" class="form-control search-input" placeholder="Search" v-model="searchQuery" @keyup.enter="search" required>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" @click="profile()">
              Account
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" @click="Logout()">
              Log out
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
<script>
  export default {
    created(){
      this.connect();
    },
    computed: {
      routeName () {
        const {name} = this.$route
        return this.capitalizeFirstLetter(name)
      },
    },
    data () {
      return {
        activeNotifications: false,
        searchQuery: '',
        isAdmin: false,
        isChefRegion: false,
        isAgent: false,
      }
    },
    methods: {
      capitalizeFirstLetter (string) {
        return string.charAt(0).toUpperCase() + string.slice(1)
      },
      toggleNotificationDropDown () {
        this.activeNotifications = !this.activeNotifications
      },
      closeDropDown () {
        this.activeNotifications = false
      },
      toggleSidebar () {
        this.$sidebar.displaySidebar(!this.$sidebar.showSidebar)
      },
      hideSidebar () {
        this.$sidebar.displaySidebar(false)
      },
      Logout(){
        localStorage.removeItem("user");
        this.$router.push("/LoginView");
      },
      profile(){
        this.$router.push("/user");
      },
      dash(){
        this.$router.push("/overview")
      },
      search() {
        if (this.searchQuery.toLowerCase() === 'compteur' || this.searchQuery.toLowerCase() === 'compteurs') {
          this.$router.push('/Compteur');
        } else if (this.searchQuery.toLowerCase() === 'facture' || this.searchQuery.toLowerCase() === 'factures'){
          this.$router.push('/Facture');
        } else if (this.searchQuery.toLowerCase() === 'message' || this.searchQuery.toLowerCase() === 'messages'){
          this.$router.push('/Messages');
        } else if (this.searchQuery.toLowerCase() === 'local' || this.searchQuery.toLowerCase() === 'locaux'){
          this.$router.push('/Locaux');
        } else if (this.searchQuery.toLowerCase() === 'notification' || this.searchQuery.toLowerCase() === 'notifications'){
          this.$router.push('/Notification');
        } else if (this.searchQuery.toLowerCase() === 'administration' || this.searchQuery.toLowerCase() === 'administrations' && this.isAdmin){
          this.$router.push('/Administration');
        }  
        this.searchQuery = '';
      },
      connect(){
        const userData = JSON.parse(localStorage.getItem('user'));
        if (userData && userData.role === 'admin') {
          this.isAdmin = true;
        } else if (userData && userData.role === 'Chef Region') {
          this.isChefRegion = true;
        } else if(userData && userData.role === 'Agents de Saisie'){
          this.isAgent = true;
        }
      },
    }
  }

</script>
<style scoped>
.search-input {
  border-radius: 20px; /* Bordures arrondies */
  border: 1px solid #ced4da; /* Couleur de la bordure */
  padding: 10px 15px; /* Espacement intérieur */
  font-size: 14px; /* Taille de la police */
  width: 300px; /* Largeur de la zone de recherche */
  margin-left: 20px;
}

</style>
