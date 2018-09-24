<template>
    <div class="container">
        <div class="container-fluid">
            <div class="row mt-4">
                <span class="col-lg-6" v-for="session in sessions">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h5 class="m-0">Le : {{session.date |myDate}} A {{session.heure |myTime}} <span class="float-right">  Durée : 2h</span></h5>
                        </div>
                        <div class="card-body table-info">
                            <h7 class="card-title text-bold" style="color:#761b18" > Session : {{session.libelle}}</h7>
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
                                    <td><span class="text-bold" style="color:#002752;">Formatteur </span></td>
                                    <td>  {{session.formatteur}}</td>
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
                            <a href="#" class="btn btn-success">S'inscrire</a>
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
            }
        },

        created(){
            axios.get("/blog/public/api/session")
                .then(({data}) =>{this.$data.sessions = data.data });
        },

    }
</script>

<style scoped>

</style>