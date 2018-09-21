<template >
    <div class="container" >
        <div class="container-fluid">
            <div class="row mt-4">
                <span class="col-lg-6" v-for="session in sessions">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Le : {{session.date}} A 9H00 <span class="float-right">  Durée : 2h</span></h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title text-bold" style="color: #1f6fb2" > {{session.libelle}}</h6>
                            <h7 class="text-bold">Lieu : {{session.lieu}}</h7><br>
                            <h7 class="text-bold">Formatteur : {{session.formatteur}}</h7><br>
                            <hr>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">S'inscrire</a>
                        </div>
                    </div>
                </span>

            </div>
        </div>
            <!-- /.row -->
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

        created(){
            axios.get("/blog/public/api/sessions/formation",{
                params:{
                    id : this.$route.params.id,
                }
            }).then(({data}) =>{ console.log('do it plz')  ; this.$data.sessions = data });
        },

    }
</script>

<style scoped>

</style>