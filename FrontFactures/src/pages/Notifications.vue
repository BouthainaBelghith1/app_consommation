<template>
  <div class="content">
    <div class="container-fluid">
      <card>
        <h3>Notifications</h3>
        <div class="row">
          <div class="col-md-6" v-for="(column, index) in columns" :key="index">
            <div class="alert alert-info alert-with-icon" data-notify="container" v-for="(notification, i) in column" :key="i">
              <button type="button" aria-hidden="true" class="close" @click="removeNotification(index, i)">
                <i class="nc-icon nc-simple-remove"></i>
              </button>
              <span data-notify="icon" class="nc-icon nc-bell-55"></span>
              <span data-notify="message">{{ notification.description }}</span>
            </div>
          </div>
        </div>
        <br>
        <br>
      </card>
    </div>
  </div>
</template>

<script>
import Card from 'src/components/Cards/Card.vue'
import NotificationService from "../services/notifications.js";

export default {
  components: {
    Card
  },
  data () {
    return {
      type: ['', 'info', 'success', 'warning', 'danger'],
      notifications: {
        topCenter: false
      },
      notifs: [],
      columns: [[], []] 
    }
  },
  methods: {
    notifyVue (verticalAlign, horizontalAlign) {
      const color = Math.floor((Math.random() * 4) + 1)
      this.$notifications.notify(
        {
          message: `<span>Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer.</span>`,
          icon: 'nc-icon nc-app',
          horizontalAlign: horizontalAlign,
          verticalAlign: verticalAlign,
          type: this.type[color]
        })
    },
    getNotif() {
      NotificationService.getNotification().then((res) => {
        console.log(res.data.data);
        this.notifs = res.data.data;
        this.columns = this.chunkArray(this.notifs, 2);
      }).catch((error) => {
        console.error('Error fetching notifications:', error);
      });
    },
    chunkArray(arr, chunkSize) {
      const chunks = [];
      for (let i = 0; i < arr.length; i += chunkSize) {
        chunks.push(arr.slice(i, i + chunkSize));
      }
      return chunks;
    },
    removeNotification(columnIndex, notificationIndex) {
      this.columns[columnIndex].splice(notificationIndex, 1);
    }
  },
  created() {
    this.getNotif();
  }
}
</script>

<style lang="scss">

</style>
