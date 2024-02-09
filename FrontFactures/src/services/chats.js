import Axios from "axios";
import "../plugins/axios.js";

export default {
    getChat(){
        return Axios.get("/chat/getAll");
    },
    deleteChat(id){
        return Axios.delete(`/chat/destroy/${id}`);
    },
    createChat(data) {
        return Axios.post('/chatAddChat', data);
    },
    UpdateChat(id,data){
        return Axios.put(`/chat/update/${id}`,data);
    },
    FindByIdChat(id){
        return Axios.get(`/chat/finById/${id}`);
    },
}