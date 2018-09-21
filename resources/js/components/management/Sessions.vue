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
                            <tbody><tr>
                                <th>ID</th>
                                <th>Libelle</th>
                                <th>Formation Id</th>
                                <th>Date</th>
                                <th>Lieu</th>
                                <th>Formatteur</th>
                                <th>Nbr participant</th>
                                <th>Register</th>
                                <th>Modify</th>
                            </tr>
                            <tr v-for="Session in Sessions" :key="Session.id">
                                <td>{{Session.id}}</td>
                                <td>{{Session.libelle}}</td>
                                <td>{{Session.formation_id}}</td>
                                <td><span class="tag tag-success">{{Session.date }}</span>
                                <td><span class="tag tag-success">{{Session.lieu}}</span></td>
                                <td><span class="tag tag-success">{{Session.formatteur}}</span></td>
                                <td><span class="tag tag-success">{{Session.nbr_participants}}</span></td>
                                <td><span class="tag tag-success">{{Session.created_at | myDate }}</span></td>
                                <td >
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
                        <h4 class="modal-title" v-show="editMode"> Update Session </h4>                        <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                <label>Lieu</label>
                                    <input v-model="form.lieu" type="text" name="lieu"
                                           placeholder="Lieu"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('lieu') }">
                                    <has-error :form="form" field="lieu"></has-error>
                                 </div>


                                <div class="form-group">
                                    <label>Formatteur</label>
                                    <select name="formatteur" v-model="form.formatteur" class="form-control"
                                            :class="{'is-invalid':form.errors.has('formatteur')}">
                                        <option value=""> Select session Function ... </option>
                                        <option :value="f.name" v-for="f in formatteurs" :key="f.id">
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
                                <button  v-show="!editMode" type="submit"  class="btn btn-success" >Create</button>                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import axios from "axios";
    import Datepicker from 'vuejs-datepicker';
    export default {
        components:{
          Datepicker,
        },
        data(){
            return{
                editMode: false,
                formations:{},
                formatteurs:[],
                Sessions:{},
                form: new Form({
                    id:'',
                    libelle:'',
                    formation_id:'',
                    date:'',
                    lieu:'',
                    formatteur:'',
                    nbr_participants:'',
                }),

            }
        },

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
                    console.log(data);
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


            }
        },
        created(){
            axios.get("/blog/public/api/formation").then(({ data }) =>(this.formations = data.data));
            axios.get("/blog/public/api/user/formatteurs").then(({ data }) => {
                this.formatteurs = data;
            });
            this.loadSessions();
            Fire.$on('session_created', () => { this.loadSessions();})
            Fire.$on('session_removed', () => { this.loadSessions();})
            Fire.$on('session_updated', () => { this.loadSessions();})

            console.log('Component mounted');
        }

    }
</script>

<style scoped>

</style>

