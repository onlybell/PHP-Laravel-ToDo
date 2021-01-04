<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">To-Do List {{ $route.params.id }}</div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                        <thead>
                            <tr>
                            <th style='text-align:center;'>Title</th>
                            <th style='width:120px; text-align:center;'>Due Date</th>
                            <th style='width:120px; text-align:center;'>Completed</th>
                            <th style='width:220px; text-align:center;'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="todo in todos.data" :key="todo.id">
                                <td>{{todo.title}}</td>
                                <td style='text-align:center;'>{{todo.due_at.substring(0,10)}}</td>
                                <td style='text-align:center;'>{{todo.completed}}</td>
                                <td style='text-align:center;'>
                                    <a href="#" @click="completeTask(todo.id)" role="button" class="btn btn-success btn-sm">Complete</a>&nbsp;
                                    <a href="#" @click="updateTask(todo.id)" role="button" class="btn btn-primary btn-sm">Edit</a>&nbsp;
                                    <a href="#" @click="deleteTask(todo.id)" role="button" class="btn btn-danger btn-sm">Delete</a>
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
    export default {
        
        data: () => ({
            loading: true,
            todos: []
        }),
        mounted() {
            this.loadTodos();
        },
        methods: {
            loadTodos() {
                axios.get('/api/todolist/')
                .then(res => {
                    this.todos = res.data;
                    setTimeout(() => { 
                        this.loading = false;
                    }, 500)
                })
            },

            completeTask(id){
              Swal.fire({
                  title: 'Complete the Task',
                  text: "",
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Yes, Complete it!'
                  }).then((result) => {

                      // Send request to the server
                        if (result.value) {
                            console.log('Delete');
                            /*
                              this.form.delete('api/product/'+id).then(()=>{
                                      Swal.fire(
                                      'Deleted!',
                                      'Your file has been deleted.',
                                      'success'
                                      );
                                  // Fire.$emit('AfterCreate');
                                  this.loadProducts();
                            
                              }).catch((data)=> {
                                  Swal.fire("Failed!", data.message, "warning");
                              });
                              */
                        }
                  })
            },
            deleteTask(id){
              Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {

                      // Send request to the server
                        if (result.value) {
                            axios.delete('/api/todoDelete/'+id)
                            .then(res => {
                                if (res.data.status) {
                                    location.reload();
                                }
                                else {
                                    console.log(res.data.errors);
                                }
                            })
                            console.log('Delete');
                            /*
                              this.form.delete('api/product/'+id).then(()=>{
                                      Swal.fire(
                                      'Deleted!',
                                      'Your file has been deleted.',
                                      'success'
                                      );
                                  // Fire.$emit('AfterCreate');
                                  this.loadProducts();
                            
                              }).catch((data)=> {
                                  Swal.fire("Failed!", data.message, "warning");
                              });
                              */
                        }
                  })
            },
        },
        filters: {

        },
    }
</script>
