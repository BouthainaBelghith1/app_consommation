<template>
    <div>
        <div class="invoice-container">
        <table class="invoice-header">
            <tbody>
                <tr>
                    <td width="5px" style="padding: 0;"></td>
                    <td style="clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 10px 0;">
                        <table width="100%" cellspacing="0" style="border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <td style="padding: 0;">
                                        <img src="../../../public/img/steg.png" alt="type.com" style="height: 50px; max-width: 100%; width: 157px;" height="50" width="157" v-if="compteur.type === 'gaz'"/> 
                                        <img src="../../../public/img/steg.png" alt="type.com" style="height: 50px; max-width: 100%; width: 157px;" height="50" width="157" v-if="compteur.type === 'électricité'"/>
                                        <img src="../../../public/img/internet.png" alt="type.com" style="height: 50px; max-width: 100%; width: 157px;" height="50" width="157" v-if="compteur.type === 'internet'"/>
                                        <img src="../../../public/img/sonede.png" alt="type.com" style="height: 50px; max-width: 100%; width: 157px;" height="50" width="157" v-if="compteur.type === 'eau'"/>                               
                                    </td>
                                    <td style="color: #999; font-size: 12px; padding: 0; text-align: right;" :align="right">
                                        Facture #{{facture.id}}<br/>
                                        {{facture.dateFinConsommation}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="5px" style="padding: 0;"></td>
                </tr>
            </tbody>
        </table>

        <table class="invoice-body">
            <tbody>
                <tr>
                    <td width="5px" style="padding: 0;"></td>
                    <td background-color="#FFFFFF" style="border: 1px solid #000; clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
                        <table width="100%" style="background: #f9f9f9; border-bottom: 1px solid #eee; border-collapse: collapse; color: #999;">
                            <tbody>
                                <tr>
                                    <td width="50%" style="padding: 20px;"><strong style="color: #333; font-size: 24px;">{{ facture.montantTotale }}DT</strong></td>
                                    <td :align="right" width="50%" style="padding: 20px;color:limegreen;" v-if="facture.isPaid">Payée</td>
                                    <td :align="right" width="50%" style="padding: 20px;color:red;" v-else>Non Payée</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="padding: 0;"></td>
                    <td width="5px" style="padding: 0;"></td>
                </tr>
                <tr>
                    <td width="5px" style="padding: 0;"></td>
                    <td style="border: 1px solid #000; border-top: 0; clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
                        <table cellspacing="0" style="border-collapse: collapse; border-left: 1px solid #000; margin: 0 auto; max-width: 600px;">
                            <tbody>
                                <tr>
                                    <td valign="top" style="padding: 20px;">
                                        <h3 style="border-bottom: 1px solid #000; color: #000; font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif; font-size: 18px; font-weight: bold; line-height: 1.2; margin: 0; margin-bottom: 15px; padding-bottom: 5px;">Facture de {{ compteur.type }}</h3>
                                        <table cellspacing="0" style="border-collapse: collapse; margin-bottom: 40px;">
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 5px 0;">Prix Unité</td>
                                                    <td align="right" style="padding: 5px 0;"> ({{facture.prixUnitaire}} mill/{{ compteur.unite }})</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 5px 0;">Periode </td>
                                                    <td align="right" style="padding: 5px 0;">{{facture.periode}} mois</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 5px 0;">Quantité</td>
                                                    <td align="right" style="padding: 5px 0;">{{facture.quantite}} {{ compteur.unite }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-bottom: 2px solid #000; border-top: 2px solid #000; font-weight: bold; padding: 5px 0;">Montant Facture</td>
                                                    <td align="right" style="border-bottom: 2px solid #000; border-top: 2px solid #000; font-weight: bold; padding: 5px 0;">{{ facture.montantTotale }}DT</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="5px" style="padding: 0;"></td>
                </tr>
                <tr style="color: #666; font-size: 12px;">
                    <td width="5px" style="padding: 10px 0;"></td>
                    <td style="clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 10px 0;">
                        <table width="100%" cellspacing="0" style="border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <td width="40%" valign="top" style="padding: 10px 0;">
                                        <h5 style="margin: 0;font-family: bold;">Dernière Date pour payer :</h5>
                                        <p style="color: #666; font-size: 14px; font-weight: normal; margin-bottom: 10px;">{{facture.dateLimitePaiement}}</p>
                                    </td>
                                    <td width="10%" style="padding: 10px 0;">&nbsp;</td>
                                    <td width="40%" valign="top" style="padding: 10px 0;">
                                        <p style="color: #666; font-size: 14px; font-weight: normal; margin-bottom: 10px;"><a href="#">{{facture.adresse}}</a></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="5px" style="padding: 10px 0;"></td>
                </tr>
            </tbody>
        </table>
        <button @click="BackToAffiche" class="btn btn-danger btn-fill float-right">cancel</button>
    </div>
    </div>

</template>
<script>
import FactureService from "../../services/factures.js";
import CompteurService from "../../services/compteurs.js";
export default {
    name: 'AfficheFacture',
    props:{
        id:Number
    },
    data(){
        return {
            facture: {},
            compteur:{},
        }
    },
    methods:{
        getById(){
            console.log(this.id);
            FactureService.FindByIdFacture(this.id).then((res)=>{
                this.facture=res.data.data;
                this.getByIdC();
            })
        },
        getByIdC(){
            CompteurService.FindByIdCompteur(this.facture.compteur_id).then((res)=>{
                this.compteur=res.data.data;
            })
        },
        BackToAffiche(){
            this.$emit("chnagerView",'affichage');
        },
    },
    created() {
        this.getById();
    },
}
</script>
<style>
    body {
        font-family: Arial, sans-serif;
        }

        .water-invoice {
        width: 80%;
        margin: 0 auto;
        border: 1px solid #ccc;
        padding: 20px;
        }

        .invoice-header {
        text-align: center;
        margin-bottom: 20px;
        }

        .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        }

        .invoice-table th, .invoice-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        }

        .invoice-total {
        margin-top: 20px;
        text-align: right;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .invoice-container {
            background-color: #f6f6f6;
            color: #333;
            height: 100%;
            width: 100%;
        }

        .invoice-header,
        .invoice-body,
        .invoice-footer {
            border-collapse: collapse;
            margin: 0 auto;
            max-width: 600px;
            width: 100%;
        }

        .invoice-header td,
        .invoice-body td,
        .invoice-footer td {
            padding: 0;
        }

        .invoice-header img {
            height: 50px;
            max-width: 100%;
            width: 157px;
        }

        .invoice-header td:last-child {
            color: #999;
            font-size: 12px;
            text-align: right;
        }

        .invoice-body {
            background: #ffffff;
            border: 1px solid #000;
        }

        .invoice-footer td {
            color: #666;
            font-size: 12px;
        }
  </style>