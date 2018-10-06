<template>
    <div class="container">
        <div class="container-fluid">
            <div class="row mt-4 ">
                <span class=" col-lg-6" v-for="(session, index) in sessions">
                    <div class="card card-warning right">
                        <div class="card-header">
                            <h5 class="m-0">Le : {{session.date |myDate}} A {{session.heure |myTime}} <span class="float-right">  Durée : {{session.duree |formatTime}}</span></h5>
                        </div>
                        <div class="card-body table-info">
                            <h6 class="card-title text-bold" style="color:#761b18" > Session : {{session.libelle}}</h6>
                            <hr>
                            <table class="table">
                                  <tr>
                                    <td><span class="text-bold" style="color:#002752;">Formation </span></td>
                                    <td> {{session.formation.libelle}}</td>
                                </tr>
                                  <tr>
                                    <td><span class="text-bold" style="color:#002752;">Lieu </span></td>
                                    <td>{{session.lieu}}</td>
                                </tr>
                                  <tr>
                                    <td><span class="text-bold" style="color:#002752;">Formateur </span></td>
                                    <td>  {{session.formateur}}</td>
                                </tr>
                                   <tr>
                                    <td><span class="text-bold" style="color:#002752;">Description </span></td>
                                    <td>
                                        <p class="card-text">
                                            {{session.description}}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                         <hr>
                        <InscriptionState :session_id="session.id" :auth_user="auth_user"></InscriptionState>
                        </div>
                    </div>
                </span>

            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data(){
            return {
                sessions:{},
                state:false,
                sessid:[],
            }
        },

        props:['auth_user'],

        methods:{

        },

        created(){

            axios.get("/blog/public/api/session")
                .then(({data}) =>{this.$data.sessions = data.data });

        },


    }
</script>

<style scoped>

</style>