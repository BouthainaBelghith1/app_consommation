import Axios from "axios";
import "../plugins/axios.js";

export default {
    getCompteur(){
        return Axios.get("/compteur/getAll");
    },
    deleteCompteur(id){
        return Axios.delete(`/compteur/destroy/${id}`);
    },
    createCompteur(data) {
        return Axios.post('/compteur/AddCompteur', data);
    },
    UpdateCompteur(id,data){
        return Axios.put(`/compteur/update/${id}`,data);
    },
    FindByIdCompteur(id){
        return Axios.get(`/compteur/finById/${id}`);
    },
    Count(){
        return Axios.get(`/compteur/count`);
    },
    countInternet(month){
        return Axios.get(`/compteur/countInternet/${month}`);
    },
    countEau(month){
        return Axios.get(`/compteur/countEau/${month}`);
    },
    countElectricite(month){
        return Axios.get(`/compteur/countElectricite/${month}`);
    },
    countGaz(month){
        return Axios.get(`/compteur/countGaz/${month}`);
    },
    countConsommation(month, type){
        return Axios.get(`/compteur/countConsommation/${month}/${type}`);
    },
    countByMonth(){
        return Axios.get(`/compteur/countByMonth`);
    },
    totalConsommation(){
        return Axios.get(`/compteur/totalConsommation`);
    }
    /*CountByLocal(id){
        return Axios.get(`/compteur/countByLocal/${id}`);
    },
    getConsommationTotale() {
        return Axios.get('/compteur/getConsommationTotale');
    }*/
}