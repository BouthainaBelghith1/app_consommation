<template>
  <div>
    <div class="container">
      <div class="chat" style="height: 440px; overflow-y: auto;">
        <div class="chat-history">
          <ul>
            <li v-for="message in messages" :key="message.id" :class="{'clearfix': message.emetteur_id !== currentUser.id}">
              <div v-if="message.emetteur_id !== currentUser.id" class="message-data">
                <span class="message-data-name">{{ message.emetteur_id }}</span>
              </div>
              <div :class="{'message': true, 'other-message': message.emetteur_id !== currentUser.id, 'my-message': message.emetteur_id === currentUser.id}">
                {{ message.message }}
              </div>
            </li>
          </ul>
        </div>

        
      </div>
    </div>
    <div class="chat-message clearfix">
      <input name="message" v-model="newMessage" class="form-control float-left" placeholder="Type your message" rows="3" >
      <button @click="sendMessage" class="btn btn-primary float-right">Send</button>
    </div>
  </div>
</template>

<script>
import ChatService from "../services/chats.js";
import UserService from "../services/users.js";
export default {
  data() {
    return {
      currentUser: { }, 
      messages: [
      ],
      newMessage: "" ,
    };
  },
  methods: {
    sendMessage() {
      const msg = {
        message: this.newMessage,
        emetteur_id: this.currentUser.id,
        recepteur_id: 4,
      };
      ChatService.createChat(msg)
        .then((response) => {
          this.messages.push(msg);
          this.newMessage = "";
        })
        .catch((error) => {
          console.error("Error sending message:", error);
        });
    },
    getChat() {
      ChatService.getChat().then((res) => {
        this.messages = res.data.data;
      }).catch((error) => {
        console.error('Error fetching messages:', error);
      });
    },
    connect(){
      const userData = JSON.parse(localStorage.getItem('user'));
      this.currentUser =  userData;
    },
  },
  created() {
    this.getChat();
    this.connect();
  }
};
</script>

<style>

.chat-history ul {
  list-style-type: none;
  padding: 0;
}

.chat-history li {
  margin-bottom: 15px;
}

.message-data {
  color: #999;
  margin-right: 10px;
}

.message-data-name {
  font-weight: bold;
}

.message-data-time {
  font-size: 10px;
}

.message {
  padding: 10px;
  border-radius: 5px;
}

.my-message {
  background-color: #DCF8C6;
  float: right;
  margin: 10px 15px;
  clear: both;
}

.other-message {
  background-color: #E6E6E6;
  float: left;
}

.chat-message input {
  resize: none;
  width: calc(100% - 80px);
  margin-right: 0px;
  margin-left: 5px;
  width: 90%;
  margin-bottom: 0;
  margin-top: 10px;
}

.clearfix{
  margin-bottom: 0;
  padding-bottom: 0;
}

.float-right{
  margin-top: 8px;
}

</style>
