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
                                    <td>Edit | Delete</td>
                                </tr>

                            </tbody>
                        </table>
                        <pagination :data="students" @pagination-change-page="getResults"></pagination>

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
                phone : ''
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
                });
            },
            // pagination method
            getResults(page = 1) {
			axios.get('all_students?page=' + page)
				.then(response => {
					this.students = response.data;
				});
		}
        },
        created(){
            // runs at first positon
            console.log("created");
        }
    }
</script>
