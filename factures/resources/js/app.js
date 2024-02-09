import './bootstrap';
// resources/js/app.js

import Vue from 'vue';

new Vue({
    created() {
        window.Echo.channel('real-time-channel')
            .listen('RealTimeEvent', (event) => {
                console.log(event.message);
                // Faites quelque chose avec les données en temps réel ici
            });
    },
});

// ... (le reste de votre fichier)
