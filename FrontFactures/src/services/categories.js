import Axios from "axios";
import "../plugins/axios.js";

export default {
    getCategorie(){
        return Axios.get("/categorie/getAll");
    },
    deleteCategorie(id){
        return Axios.delete(`/categorie/destroy/${id}`);
    },
    createCategorie(data) {
        return Axios.post('/categorie/AddCategorie', data);
    },
    UpdateCategorie(id,data){
        return Axios.put(`/categorie/update/${id}`,data);
    },
    FindByIdCategorie(id){
        return Axios.get(`/categorie/finById/${id}`);
    }
}