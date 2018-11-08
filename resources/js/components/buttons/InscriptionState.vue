<template>
    <div style="text-align: center">
        <button
                class="btn btn-default"
                disabled="true"
                v-if="this.etat == 0">
            En Attente
        </button>

        <button class="btn btn-danger"
                v-else-if="this.etat == 1"
                disabled="true">
            Inscription refusée
        </button>
        <button class="btn btn-success"
                disabled="true"
                v-else-if="this.etat == 2">
            Inscription acceptée
        </button>

        <button  @click="inscription(session_id)"
                 class="btn btn-primary"
                 v-else>
            S'inscrire
        </button>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                state:false,
                sessid:[],
                etat: null,
                declined:[],
                presence:[],
                approved:[],
            }
        },
        props:['auth_user', 'session_id'],

        methods: {
            checking(){
                 console.log(JSON.parse(this.auth_user)["id"]);
                axios.get("/blog/public/api/checkingButton/"+JSON.parse(this.auth_user)["id"]+"/"+this.session_id).then(( data ) => {
                    console.log(data.data.pivot.etat);
                    this.etat = data.data.pivot.etat;
                });
            },
            inscription(s_id){
                swal({
                    title: 'êtes-vous sûr de vouloir s\'inscrire ?',
                    text: "veuillez confirmer votre demande !",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, je confirme!'
                }).then((result) => {
                    if (result.value) {

                        axios.get("/blog/public/api/session/participants/"+s_id+"/"+JSON.parse(this.auth_user)["id"]).then(( data ) => {
                            console.log(data);
                            this.checking() ;
                        });

                        swal(
                            'Transmis!',
                            'Votre demande est envoyé.',
                            'success'
                        )
                    }
                })



            }
        },
        created(){

            this.checking() ;

        },
    }
</script>

<style scoped>

</style>