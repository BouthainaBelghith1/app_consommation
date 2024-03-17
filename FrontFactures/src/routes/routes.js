import DashboardLayout from '../layout/DashboardLayout.vue'
// GeneralViews
import NotFound from '../pages/NotFoundPage.vue'

// Admin pages
import Overview from 'src/pages/Overview.vue'
import Profile from 'src/pages/Profile.vue'
import Facture from 'src/pages/Facture.vue'
import Messages from 'src/pages/Messages.vue'
import Locaux from 'src/pages/Locaux.vue'
import Compteur from 'src/pages/Compteur.vue'
import Notifications from 'src/pages/Notifications.vue'
import LoginView from '../pages/Auth/LoginView.vue'
import Administration from '../pages/Administration.vue'
import Region from '../pages/Region.vue'
import Utilisateurs from '../pages/Utilisateurs.vue'
import Categorie from '../pages/Categorie.vue'

const routes = [
  {
    path: '/',
    redirect: '/LoginView' // Rediriger vers LoginView par défaut
  },
  {
    path: '/LoginView',
    component: LoginView,
    name: "LoginView"
  },
  {
    path: '/',
    component: DashboardLayout,
    redirect: '/overview',
    children: [
      {
        path: 'overview',
        name: 'Overview',
        component: Overview
      },
      {
        path: 'user',
        name: 'User',
        component: Profile
      },
      {
        path: 'Facture',
        name: 'Facture',
        component: Facture
      },
      {
        path: 'Messages',
        name: 'Messages',
        component: Messages
      },
      {
        path: 'Locaux',
        name: 'Locaux',
        component: Locaux
      },
      {
        path: 'Compteur',
        name: 'Compteur',
        component: Compteur
      },
      {
        path: 'notifications',
        name: 'Notifications',
        component: Notifications
      },
      {
        path: 'LoginView',
        name: 'Login',
        component: LoginView
      },
      {
        path: 'Administration',
        name: 'Administration',
        component: Administration
      },
      {
        path: 'Region',
        name: 'Region',
        component: Region
      },
      {
        path: 'Utilisateurs',
        name: 'Utilisateurs',
        component: Utilisateurs
      },
      {
        path: 'Categorie',
        name: 'Categorie',
        component: Categorie
      }
    ]
  },
  { path: '*', component: NotFound }
]

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * The specified component must be inside the Views folder
 * @param  {string} name  the filename (basename) of the view to load.
function view(name) {
   var res= require('../components/Dashboard/Views/' + name + '.vue');
   return res;
};**/

export default routes
