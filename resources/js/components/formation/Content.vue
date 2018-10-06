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
                            <h7 class="text-bold">Lieu : {{session.lieu}}</h7><br>
                            <h7 class="text-bold">Formateur : {{session.formateur}}</h7><br>
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
                state:false,
                sessid:[],
            }
        },

        props:['authUser'],

        methods:{
            isDisable(sid) {
                for (let i=0;i<this.sessid.length;i++)  {
                    if(this.sessid[i] == sid){
                        return this.state;
                    }
                }

            },
            inscription(s_id){
                this.sessid.push(s_id);
                this.state = true;
                axios.get("/blog/public/api/session/participants/"+s_id+"/"+JSON.parse(this.authUser)["id"]).then(( data ) => {
                    console.log(data);
                    //   this.participants = data.data;
                });
                localStorage.setItem(s_id+'_'+JSON.parse(this.authUser)["id"], s_id);
            }
        },
        created(){
            axios.get("/blog/public/api/sessions/formation",{
                params:{
                    id : this.$route.params.id,
                }
            }).then(({data}) =>{ this.$data.sessions = data });
        },

        beforeMount(){
            console.log(localStorage);
            for (var i = 0; i < localStorage.length; i++) {
                if((localStorage.key(i).split('_'))[1] == JSON.parse(this.authUser)["id"]){
                    this.sessid.push(localStorage.getItem(localStorage.key(i)));
                }
            }
            this.state = true;
        },

    }
</script>

<style scoped>

</style>