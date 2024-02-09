import Axios from "axios";
import "../plugins/axios.js";

export default {
    getNotification(){
        return Axios.get("/notification/getAll");
    },
    deleteNotification(id){
        return Axios.delete(`/notification/destroy/${id}`);
    },
    createNotification(data) {
        return Axios.post('/notification/AddNotification', data);
    },
    UpdateNotification(id,data){
        return Axios.put(`/notification/update/${id}`,data);
    },
    FindByIdNotification(id){
        return Axios.get(`/notification/finById/${id}`);
    },
}