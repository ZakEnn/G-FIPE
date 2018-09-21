*<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Formations</h3>
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
                                <th>Register</th>
                                <th>Modify</th>
                            </tr>
                            <tr v-for="Formation in formations" :key="Formation.id">
                                <td>{{Formation.id}}</td>
                                <td>{{Formation.libelle}}</td>
                                <td><span class="tag tag-success">{{Formation.created_at | myDate }}</span></td>
                                <td >
                                    <button @click="editModal(Formation)"  class="btn btn-primary text-center ">Edit</button>
                                    <button @click="removeFormation(Formation.id)"  class="btn btn-danger text-center ">Remove</button>
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
                        <h4 class="modal-title" v-show="!editMode"> Add Formation </h4>
                        <h4 class="modal-title" v-show="editMode"> Update Formation </h4>                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <form @submit.prevent="editMode ? updateFormation(form.id) :createFormation()">
                        <div class="modal-body">
                            <div>
                                <div class="form-group" style="display: none">
                                    <label>Id</label>
                                    <input v-model="form.id" type="number" name="id"
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
    export default {
        data(){
            return{
                editMode: false,
                formations:{},
                form: new Form({
                    id:'',
                    libelle:'',

                }),

            }
        },

        methods:{
            newModal(){
                this.editMode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            editModal(f){
                this.editMode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(f);

            },
            updateFormation(id){
                this.$Progress.start();
                //console.log('editing data');
                this.form.put("/blog/public/api/formation/"+id)
                    .then((data) => {
                        console.log(data);
                        Fire.$emit('formation_updated');
                        $('#addNew').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Formation updated successfully'
                        });
                        this.$Progress.finish();
                    })
                    .catch(()=> this.$Progress.fail());
                this.$Progress.finish();
            },
            createFormation(){
                this.$Progress.start();
                this.form.post('/blog/public/api/formation').then((data)=>{
                    console.log(data);
                    Fire.$emit('formation_created');
                    $('#addNew').modal('hide');
                    toast({
                        type: 'success',
                        title: 'formation added successfully'
                    });
                });
                this.$Progress.finish();
            },
            loadFormations(){
                axios.get("/blog/public/api/formation").then(({ data }) =>(this.formations = data.data));
            },
            removeFormation: function (id) {
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
                        Fire.$emit('formation_removed');
                        axios.delete("/blog/public/api/formation/"+id).then(( res ) => console.log(res));
                        Fire.$emit('formation_removed');
                        swal(
                            'Deleted!',
                            'The Formation has been deleted.',
                            'success'
                        )
                    }
                })


            },
        },
        created(){
            this.loadFormations();
         //   Fire.$emit('formations',this.formations);
            Fire.$on('formation_created', () => { this.loadFormations();});
            Fire.$on('formation_removed', () => { this.loadFormations();});
            Fire.$on('formation_updated', () => { this.loadFormations();});

            console.log('Component mounted');
        }
    }
</script>

<style scoped>

</style>