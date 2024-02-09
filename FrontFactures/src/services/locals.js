import Axios from "axios";
import "../plugins/axios.js";

export default {
    getLocal(){
        return Axios.get("/local/getAll");
    },
    deleteLocal(id){
        return Axios.delete(`/local/destroy/${id}`);
    },
    createLocal(data) {
        return Axios.post('/local/AddLocal', data);
    },
    UpdateLocal(id,data){
        return Axios.put(`/local/update/${id}`,data);
    },
    FindByIdLocal(id){
        return Axios.get(`/local/finById/${id}`);
    },
    Count(){
        return Axios.get(`/local/count`);
    },
    /*Filtrer(region_id){
        return Axios.get(`/local/filtrer/${region_id}`);
    }*/
}