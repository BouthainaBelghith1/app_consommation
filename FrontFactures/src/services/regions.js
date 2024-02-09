import Axios from "axios";
import "../plugins/axios.js";

export default {
    getRegion(){
        return Axios.get("/region/getAll");
    },
    deleteRegion(id){
        return Axios.delete(`/region/destroy/${id}`);
    },
    createRegion(data) {
        return Axios.post('/region/AddRegion', data);
    },
    UpdateRegion(id,data){
        return Axios.put(`/region/update/${id}`,data);
    },
    FindByIdRegion(id){
        return Axios.get(`/region/finById/${id}`);
    }
}