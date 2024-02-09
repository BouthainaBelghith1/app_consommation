import Axios from "axios";
import "../plugins/axios.js";

export default {
    getFacture(){
        return Axios.get("/facture/getAll");
    },
    deleteFacture(id){
        return Axios.delete(`/facture/destroy/${id}`);
    },
    createFacture(data) {
        return Axios.post('/facture/AddFacture', data);
    },
    UpdateFacture(id,data){
        return Axios.put(`/facture/update/${id}`,data);
    },
    FindByIdFacture(id){
        return Axios.get(`/facture/finById/${id}`);
    },
    Payer(id){
        return Axios.put(`/facture/payer/${id}`);
    },
    countNonPayer(){
        return Axios.get("/facture/countNonPaye");
    },
    countPayer(){
        return Axios.get("/facture/countPaye");
    },
    countFacture(){
        return Axios.get("/facture/count");
    }
    /*GetMontantTotal(){
        return Axios.get('/facture/getMontantTotal');
    }*/
}