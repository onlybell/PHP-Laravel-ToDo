<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">To-Do List</div>

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
                                <td v-if="todo.completed=='Y'" style="text-decoration: line-through;">{{todo.title}}</td><td v-else>{{todo.title}}</td>
                                <td style='text-align:center;'>{{todo.due_at.substring(0,10)}}</td>
                                <td style='text-align:center;'>{{todo.completed}}</td>
                                <td style='text-align:center;'>
                                    <a href="#" @click="completeTask(todo.id)" role="button" class="btn btn-success btn-sm">Complete</a>&nbsp;
                                    <router-link :to="{name: 'todoedit', params: { id: todo.id }}" class="btn btn-primary btn-sm">Edit</router-link>
                                    <a href="#" @click="deleteTask(todo.id)" role="button" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="todos" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'; 

    export default {
        data() {
            return {
                loading: true,
                todos: {},
                meta: null
            }
        },
        mounted() {
            this.loadTodos();
        },
        methods: {
            getResults(page = 1) {
              axios.get('api/todolist?page=' + page)
              .then(res => {
                  this.todos = res.data;
                });
            },
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
                        if (result.value) {
                            axios.post('/api/todoComplete/'+id)
                            .then(res => {
                                if (res.data.status) {
                                    this.loadTodos();
                                }
                                else {
                                     Swal.fire("Failed!", res.data.status, "warning");
                                }
                            })
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
                        if (result.value) {
                            axios.delete('/api/todoDelete/'+id)
                            .then(res => {
                                if (res.data.status) {
                                    this.loadTodos();
                                }
                                else {
                                    Swal.fire("Failed!", res.data.errors, "warning");
                                }
                            }).catch((data)=> {
                                Swal.fire("Failed!", data.message, "warning");
                            });
                        }
                  })
            },
        },
        filters: {

        },
    }
</script>
