<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-header">Create New Student</div>

                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" v-model="name" class="form-control" id="name" placeholder="name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" v-model="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                              <div class="form-group">
                                  <label for="name">Phone</label>
                                  <input type="number" v-model="phone" class="form-control" id="phone" placeholder="Enter phone">
                              </div>

                          <button type="submit" @click.prevent="saveStudent" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">

                    <div class="card-header">All Student</div>

                    <div class="card-body">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(student,index) in students.data" >
                                    <th scope="row">{{index+1}}</th>
                                    <td>{{student.name}}</td>
                                    <td>{{student.email}}</td>
                                    <td>{{student.phone}}</td>
                                    <td>
                                        <button type="button" @click="editStudent(student.id)" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#EditeModal">
                                            Edit
                                        </button>
                                        <button type="button" @click="deleteStudent(student.id)" class="btn btn-sm btn-danger" >
                                            Delete
                                        </button>

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <pagination :data="students" @pagination-change-page="getResults"></pagination>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="EditeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" v-model="editname" class="form-control" id="name" placeholder="name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" v-model="editemail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                              <div class="form-group">
                                  <label for="name">Phone</label>
                                  <input type="number" v-model="editphone" class="form-control" id="phone" placeholder="Enter phone">
                              </div>

                          <button type="submit" @click.prevent="updateStudent(editid)" data-dismiss="modal" class="btn btn-success">Update</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        // binding a model
        //data initialization present on the this component
        data(){
            return {
                students : {},
                name : '',
                email : '',
                phone : '',
                editname : '',
                editemail : '',
                editphone : '',
                editid:''
            }
        },

        mounted() {
            //runs at start of application
            //getResults get data from Database student table using laravel on start of this page
            this.getResults();
            console.log('CreateComponent mounted.')
        },
        methods:{
            saveStudent(){
                // alert("Saave student test");
                axios.post("save_student",{
                    name : this.name,
                    email : this.email,
                    phone : this.phone
                })
                .then(response => {
                    // so after entering new student the feilds become empty
                    this.name = '';
                    this.email = '';
                    this.phone = '';
                    this.getResults();
                });
            },
            // pagination method
            getResults(page = 1) {
			axios.get('all_students?page=' + page)
				.then(response => {
					this.students = response.data;
				});
		},
        editStudent(student_id){
                // alert(student_id);
                // alert("Saave student test");
                axios.get("edit_student/"+student_id)
                .then(response => {
                    console.log(response);
                    this.editname = response.data.name;
                    this.editemail = response.data.email;
                    this.editphone = response.data.phone;
                    this.editid = response.data.id;

                });
            },
        updateStudent(student_id){
            axios.put("updateStudent/"+student_id,{
                name : this.editname,
                email : this.editemail,
                phone : this.editphone
            }).then(response => {
                // alert("data updated");
                this.getResults();
                // $('#EditeModal').hide();
            });
        },
        deleteStudent(student_id){
            axios.delete("deleteStudent/"+student_id)
            .then(response => {
                this.getResults();

            });
        }
        },
        created(){
            // runs at first positon
            console.log("created");
        }
    }
</script>
