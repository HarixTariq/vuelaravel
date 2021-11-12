<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
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
        </div>
    </div>
</template>

<script>
    export default {
        // binding a model
        data(){
            return {
                name : '',
                email : '',
                phone : ''
            }
        },

        mounted() {
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
                .then(response => console.log(response));
            }
        },
        created(){
            // runs at first positon
            console.log("created");
        }
    }
</script>
