<template >
    <div class="container" >
        <div class="container-fluid">
            <div class="row mt-4">
                <span class="col-lg-6" v-for="session in sessions">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Le : {{session.date |myDate }} A {{session.heure | myTime}} <span class="float-right">  Durée :  {{session.duree |formatTime}}</span></h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title text-bold" style="color: #1f6fb2" > {{session.libelle}}</h6>
                            <h6 class="text-bold">Lieu : {{session.lieu}}</h6>
                            <h6 class="text-bold">Formateur : {{session.formateur}}</h6>
                            <hr>
                            <p class="card-text">{{session.description}}</p>
                          <InscriptionState :session_id="session.id" :auth_user="authUser"></InscriptionState>
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
                sessions:[],
            }
        },

        props:['authUser'],

        created(){
            axios.get("/blog/public/api/sessions/formation",{
                params:{
                    id : this.$route.params.id,
                }
            }).then(({data}) =>{ this.$data.sessions = data });
        },


    }
</script>

<style scoped>

</style>