<template>
  <div class="wrapper">
    <side-bar>
      <mobile-menu slot="content"></mobile-menu>
      <sidebar-link to="/Compteur">
        <i class="nc-icon nc-compass-05"></i>
        <p>Compteurs</p>
      </sidebar-link>
      <sidebar-link to="/Facture">
        <i class="nc-icon nc-notes"></i>
        <p>Factures</p>
      </sidebar-link>
      <sidebar-link to="/Messages">
        <i class="nc-icon nc-send"></i>
        <p>Messages</p>
      </sidebar-link>
      <sidebar-link to="/Locaux">
        <i class="nc-icon nc-bank"></i>
        <p>Locaux</p>
      </sidebar-link>
      <sidebar-link to="/notifications">
        <i class="nc-icon nc-bell-55"></i>
        <p>Notifications</p>
      </sidebar-link>
      <sidebar-link to="/Administration" v-if="isAdmin">
        <i class="nc-icon nc-preferences-circle-rotate"></i>
        <p>Administration</p>
      </sidebar-link>
    </side-bar>
    <div class="main-panel">
      <top-navbar></top-navbar>

      <dashboard-content @click="toggleSidebar">

      </dashboard-content>

      <content-footer></content-footer>
    </div>
  </div>
</template>
<style lang="scss">

</style>
<script>
  import TopNavbar from './TopNavbar.vue'
  import ContentFooter from './ContentFooter.vue'
  import DashboardContent from './Content.vue'
  import MobileMenu from './MobileMenu.vue'
  export default {
    created(){
      this.connect();
    },
    components: {
      TopNavbar,
      ContentFooter,
      DashboardContent,
      MobileMenu
    },
    data() {
      return {
        isAdmin: false,
        isChefRegion: false,
        isAgent: false, 
      };
    },
    methods: {
      toggleSidebar () {
        if (this.$sidebar.showSidebar) {
          this.$sidebar.displaySidebar(false)
        }
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

