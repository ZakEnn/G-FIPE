<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                            <h3 class="card-title">Agents</h3>
                            <div class="card-tools">
                              <button class="btn btn-success" @click="newModal">Add New</button>
                            </div>

                    </div>

                <!-- /.card-header -->
                    <div class="card-body table-responsive ">
                        <table class="table table-hover">
                            <tbody><tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Fonction</th>
                                <th>Register</th>
                                <th>Modify</th>
                            </tr>
                            <tr v-for="user in users" :key="user.id">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td><span class="tag tag-success">{{user.type}}</span>
                                <td><span class="tag tag-success">{{user.function}}</span></td>
                                <td><span class="tag tag-success">{{user.created_at | myDate }}</span></td>
                                <td >
                                        <button @click="editModal(user)"  class="btn btn-primary text-center ">Edit</button>
                                        <button @click="removeUser(user.id)"  class="btn btn-danger text-center ">Remove</button>
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
                    <h4 class="modal-title" v-show="!editMode"> Add Agent </h4>
                    <h4 class="modal-title" v-show="editMode"> Update Agent </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form @submit.prevent="editMode ? updateUser(form.id) :createUser()">
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
                            <label>Username</label>
                            <input v-model="form.name" type="text" name="name"
                                   placeholder="Name"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input v-model="form.email" type="text" name="email"
                                   placeholder="Email"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select name="type" v-model="form.type" class="form-control"
                                    :class="{'is-invalid':form.errors.has('type')}">
                                <option value=""> Select Agent Role ... </option>
                                <option value="admin">Administrator </option>
                                <option value="participant">Participant</option>
                                <option value="instructor">Instructor</option>

                            </select>
                            <has-error :form="form" field="type"></has-error>
                        </div>
                         <div class="form-group">
                             <label>Function</label>
                             <select name="type" v-model="form.function" class="form-control"
                                     :class="{'is-invalid':form.errors.has('function')}">
                                 <option value=""> Select Agent Function ... </option>
                                 <option value="agent_std">Agent Standard </option>
                                 <option value="rh">Ressources humaines</option>
                                 <option value="Calcul et Statistiques">Calcul et Statistiques</option>

                             </select>
                             <has-error :form="form" field="function"></has-error>
                         </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input v-model="form.password" type="text" name="password"
                                   placeholder="Password"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
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

    </div>
</template>

<script>
    import axios from "axios";
    export default {
        data(){
            return{
                editMode: false,
                users:{},
                form: new Form({
                    id:'',
                    name:'',
                    email:'',
                    password:'',
                    type:'',
                    function:'',
                }),

            }
        },

        methods:{
            updateUser(id){
                this.$Progress.start();
                //console.log('editing data');
                this.form.put("/blog/public/api/user/"+id)
                     .then((data) => {
                         console.log(data);
                         Fire.$emit('agent_updated');
                         $('#addNew').modal('hide');
                         toast({
                             type: 'success',
                             title: 'Agent updated successfully'
                         });
                         this.$Progress.finish();
                     })
                     .catch(()=> this.$Progress.fail());

            },
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
            createUser(){
                this.$Progress.start();
                this.form.post('/blog/public/api/user').then((data)=>{
                    console.log(data);
                    Fire.$emit('agent_created');
                    $('#addNew').modal('hide');
                    toast({
                        type: 'success',
                        title: 'Agent added successfully'
                    });
                });

                this.$Progress.finish();
                },
            loadUsers(){
                axios.get("/blog/public/api/user").then(({ data }) =>(this.users = data.data));
            },
            removeUser: function (id) {
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
                        Fire.$emit('agent_removed');
                        axios.delete("/blog/public/api/user/"+id).then(( res ) => console.log(res));
                        Fire.$emit('agent_removed');
                        swal(
                            'Deleted!',
                            'The Agent has been deleted.',
                            'success'
                        )
                    }
                })


            },
        },
        created(){
            this.loadUsers();
            Fire.$on('agent_created', () => { this.loadUsers();})
            Fire.$on('agent_removed', () => { this.loadUsers();})
            Fire.$on('agent_updated', () => { this.loadUsers();})

            console.log('Component mounted');
        }
    }
</script>

<style scoped>

</style>