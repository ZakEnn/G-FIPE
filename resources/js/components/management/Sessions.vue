<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sessions</h3>
                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Add New</button>
                        </div>

                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive ">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Libelle</th>
                                <th>Formation Id</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Lieu</th>
                                <th>Formateur</th>
                                <th>Nbr participant</th>
                                <th>Participants</th>
                                <th>Modify</th>
                            </tr>

                            <tr v-for="Session in Sessions" :key="Session.id">
                                <td>{{Session.id}}</td>
                                <td>{{Session.libelle}}</td>
                                <td>{{Session.formation_id}}</td>
                                <td><span class="tag tag-success">{{Session.date | myDate}}</span>
                                <td><span class="tag tag-success">{{Session.heure| myTime }}</span></td>
                                <td><span class="tag tag-success">{{Session.lieu}}</span></td>
                                <td><span class="tag tag-success">{{Session.formateur}}</span></td>
                                <td><span class="tag tag-success">{{Session.nbr_participants}}</span></td>
                                <td>
                                    <button @click="sessionParticipants(Session.id)"  class="btn btn-outline-secondary text-center ">P</button>
                                </td>

                                <td>
                                    <button @click="editModal(Session)"  class="btn btn-primary text-center ">Edit</button>
                                    <button @click="removeSession(Session.id)"  class="btn btn-danger text-center ">Remove</button>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog"
             aria-labbeledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" v-show="!editMode"> Add Session </h4>
                        <h4 class="modal-title" v-show="editMode"> Update Session </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <form @submit.prevent="editMode ? updateSession(form.id) :createSession()">
                        <div class="modal-body">
                            <div>
                                <div class="form-group" style="display: none">
                                    <label>Id</label>
                                    <input v-model="form.id" type="text" name="id"
                                           placeholder="Id"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('id') }">
                                    <has-error :form="form" field="id"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Libelle</label>
                                    <input v-model="form.libelle" type="text" name="libelle"
                                           placeholder="Libelle"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('libelle') }">
                                    <has-error :form="form" field="libelle"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea v-model="form.description" type="text" name="description"
                                           placeholder="Description"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('description') } ">
                                    </textarea>
                                    <has-error :form="form" field="description"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Formation</label>
                                    <select name="formation_id" v-model="form.formation_id" class="form-control"
                                            :class="{'is-invalid':form.errors.has('formation_id')}">
                                        <option value=""> Select Formation ... </option>
                                        <option :value="formation.id" v-for="formation in formations" :key="formation.id">
                                            {{formation.libelle}}
                                        </option>

                                    </select>
                                    <has-error :form="form" field="formation_id"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Date</label>
                                    <input v-model="form.date" type="date" name="date"
                                           placeholder="Date"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('date') }">
                                    <has-error :form="form" field="date"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Heure</label>
                                    <input v-model="form.heure" type="time" name="heure"
                                           placeholder="Heure"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('heure') }">
                                    <has-error :form="form" field="heure"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Duree</label>
                                    <input v-model="form.duree" type="time" name="duree"
                                           placeholder="Duree"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('duree') }">
                                    <has-error :form="form" field="duree"></has-error>
                                </div>
                                <div class="form-group">
                                <label>Lieu</label>
                                    <input v-model="form.lieu" type="text" name="lieu"
                                           placeholder="Lieu"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('lieu') }">
                                    <has-error :form="form" field="lieu"></has-error>
                                 </div>

                                <div class="form-group">
                                    <label>Formateur</label>
                                    <select name="formateur" v-model="form.formateur" class="form-control"
                                            :class="{'is-invalid':form.errors.has('formateur')}">
                                        <option value=""> Select session Function ... </option>
                                        <option :value="f.name" v-for="f in formateurs" :key="f.id">
                                           {{f.name}}
                                        </option>
                                    </select>
                                    <has-error :form="form" field="function"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Nombre de participants</label>
                                    <input v-model="form.nbr_participants" type="number" name="nbr_participants"
                                           placeholder="nbr_participants"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('nbr_participants') }">
                                    <has-error :form="form" field="nbr_participants"></has-error>
                                </div>
                            </div>


                            <div class="modal-footer">
                                <button  type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
                                <button  v-show="editMode" type="submit"  class="btn btn-success" >Update</button>
                                <button  v-show="!editMode" type="submit"  class="btn btn-success" >Create</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <div class="modal fade" id="showParticipants"  role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" style="width:50%">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Participants</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-responsive form-group">
                            <tbody>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Function</th>
                                <th>Etat</th>
                                <th>Presence</th>
                                <th>Decision</th>
                            </tr>
                            <tr v-for="participant in participants" >
                                <td>{{participant.name}}</td>
                                <td>{{participant.email}}</td>
                                <td>{{participant.function}}</td>
                                <td>{{participant.pivot.etat?(participant.pivot.etat == 1)?'refusée':'accéptée':'en attente'}}</td>
                                <td><input type="checkbox"
                                           @change="participantPresent(participant.id,$event)"
                                           checked="participantPresent(participant.id,$event)"
                                           class="form-control" >
                                </td>

                                <td>
                                    <button @click="acceptParticipant(participant.id)"
                                            class="btn btn-success text-center ">
                                        Approve
                                    </button>

                                    <button @click="removeParticipant(participant.id)"
                                                     class="btn btn-danger text-center "
                                               >
                                         Decline
                                     </button>
                                </td>


                            </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import axios from "axios";
    import {Form} from "vform";

    export default {
        data(){
            return{
                editMode: false,
                formations:{},
                formateurs:[],
                participants:[],
                Sessions:{},
                session_id:'',
                form: new Form({
                    id:'',
                    libelle:'',
                    description:'',
                    formation_id:'',
                    date:'',
                    heure:'',
                    duree:'',
                    lieu:'',
                    formateur:'',
                    nbr_participants:'',
                }),

            }
        },

        props:['auth_user'],

        methods:{

            newModal(){
                this.editMode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            editModal(user){
                this.editMode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);

            },
            createSession(){
                this.$Progress.start();
                this.form.post('/blog/public/api/session').then((data)=>{
                    Fire.$emit('session_created');
                    $('#addNew').modal('hide');
                    toast({
                        type: 'success',
                        title: 'session added successfully'
                    });
                });
                this.$Progress.finish();
            },
            loadSessions(){
                axios.get("/blog/public/api/session").then(({ data }) =>(this.Sessions = data.data));
            },
            removeSession: function (id) {
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        Fire.$emit('session_removed');
                        axios.delete("/blog/public/api/session/"+id).then(( res ) => console.log(res));
                        Fire.$emit('session_removed');
                        swal(
                            'Deleted!',
                            'The Session has been deleted.',
                            'success'
                        )
                    }
                })


            },
            updateSession(id){
                this.$Progress.start();
                //console.log('editing data');
                this.form.put("/blog/public/api/session/"+id)
                    .then((data) => {
                        console.log(data);
                        Fire.$emit('session_updated');
                        $('#addNew').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Session updated successfully'
                        });
                        this.$Progress.finish();
                    })
                    .catch(()=> this.$Progress.fail());
            },
            sessionParticipants(id){
                $('#showParticipants').modal('show');
                 axios.get("/blog/public/api/participants/session/"+id).then(( data ) => {
                     this.participants = data.data;
                     this.session_id = id;
                 });

            },

            removeParticipant(id) {
                axios.get("/blog/public/api/session/declineParticipant/"+this.session_id+"/"+id).then(( ) => {
                    this.sessionParticipants(this.session_id);
                });

                toast({
                    type: 'success',
                    title: 'Demand has been rejected'
                });
            },


            acceptParticipant(id){
                 axios.get("/blog/public/api/session/approveParticipant/"+this.session_id+"/"+id).then(( ) => {
                     this.sessionParticipants(this.session_id);
                });
                toast({
                    type: 'success',
                    title: 'Demand has been approved'
                });
            },

            participantPresent(id,event){
                if (event.target.checked){
                    axios.get("/blog/public/api/session/presenceParticipant/"+this.session_id+"/"+id).then(( ) => {
                        this.sessionParticipants(this.session_id);

                    });
                }
                toast({
                    type: 'success',
                    title: 'Participant presence checked'
                });
            }

        },
        created(){
            axios.get("/blog/public/api/formation").then(({ data }) =>(this.formations = data.data));
            axios.get("/blog/public/api/user/formateurs").then(({ data }) => {
                this.formateurs = data;
            });
            this.loadSessions();
            Fire.$on('session_created', () => { this.loadSessions();})
            Fire.$on('session_removed', () => { this.loadSessions();})
            Fire.$on('session_updated', () => { this.loadSessions();})

            console.log('Component mounted');
        },

    }
</script>

<style scoped>

</style>


