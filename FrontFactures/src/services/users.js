import Axios from "axios";
import "../plugins/axios.js";

export default {
    getUser(){
        return Axios.get("/user/getAll");
    },
    deleteUser(id){
        return Axios.delete(`/user/destroy/${id}`);
    },
    createUser(data) {
        return Axios.post('/user/AddUser', data);
    },
    UpdateUser(id,data){
        return Axios.put(`/user/update/${id}`,data);
    },
    FindByIdUser(id){
        return Axios.get(`/user/finById/${id}`);
    },
    Count(){
        return Axios.get("/user/count")
    }
}