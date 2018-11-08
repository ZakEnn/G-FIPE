<template>
    <div class="container">
        <div class="container-fluid">
            <div class="row mt-4 ">
                <span class=" col-lg-6" v-for="(session, index) in sessions">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Le : {{session.date |myDate}} A {{session.heure |myTime}} <span class="float-right">  Durée :  {{session.duree |formatTime}}</span></h5>
                        </div>
                        <div class="card-body table-bordered">
                            <table class="table  table-responsive ">
                                <tr>
                                    <td><span class="text-bold" style="color:#002752;">Session </span></td>
                                    <td>{{session.libelle}}</td>
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
                            <hr>
                            <div v-if="presence[index] && !ratedSession.includes(session.id)">
                                <div class="row" >
                                    <div class="col-md-4" style=" margin-top:7%">
                                        <h5 class="text-bold " style="color:#002752;">Donnez votre note sur cette session:</h5>
                                    </div>
                                    <div class="col-md-5">
                                        <br>
                                          <star-rating v-model="rating[index]"
                                                       :increment=0.5
                                                       text-class="custom-text"
                                          >
                                          </star-rating>
                                        <br>
                                        <button @click="setRating(session.id,rating,index)" class="btn btn-primary">Valider</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </span>

            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
    import StarRating from "vue-star-rating/src/star-rating";
    export default {
        components: {StarRating},
        data(){
            return {
                sessions:{},
                rating:[],
                presence:[],
                ratedSession:[],
            }
        },

        props:['auth_user'],

        methods:{

            inscription(s_id){
                this.sessid.push(s_id);
                this.state = true;
                axios.get("/blog/public/api/session/participants/"+s_id+"/"+JSON.parse(this.auth_user)["id"]).then(( data ) => {
                    console.log(data);
                });
            },

            setRating(s_id,rating,index){
                swal({
                    title: 'êtes-vous sûr de votre vote ?',
                    text: "veuillez confirmer !",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, je confirme!'
                }).then((result) => {
                    if (result.value) {

                        axios.post("/blog/public/api/session/participantRating/"+s_id+"/"+JSON.parse(this.auth_user)["id"],
                            {'rating':this.rating[index]}).then(( data ) => {
                            console.log(data);
                            this.loadVoted();
                        });

                        swal(
                            'Transmis!',
                            'Votre vote est envoyé.',
                            'success'
                        )
                    }
                })

            },
            loadVoted(){
                axios.get("/blog/public/api/user/rating/"+JSON.parse(this.auth_user)["id"]).then(( data ) => {
                    let $ratings = data.data;

                    for (let $i = 0; $i < $ratings.length; $i++) {
                        let $sessionId = $ratings[$i].session_id;
                        this.ratedSession.push($sessionId);
                    }
                    console.log( this.ratedSession);
                });
            }


        },

        created(){

            axios.get("/blog/public/api/user/sessions/"+JSON.parse(this.auth_user)["id"])
                .then(({data}) =>{
                    this.presence = [];
                    this.$data.sessions = data;
                    for(let $i=0;$i<Object.keys(this.sessions).length;$i++){
                            console.log('presence'+this.$data.sessions[$i].pivot.presence);
                            if(this.$data.sessions[$i].pivot.presence == 1){
                                this.presence.push(true);
                            }else{
                                this.presence.push(false);
                            }
                    }
                });

            this.loadVoted();

        },

    }

</script>

<style scoped>

</style>