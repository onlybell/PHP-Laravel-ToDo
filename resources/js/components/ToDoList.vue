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
                            <th style='width:500px; text-align:center;'>Title</th>
                            <th style='width:200px; text-align:center;'>Due Date</th>
                            <th style='width:200px; text-align:center;'>Completed</th>
                            <th style='text-align:center;'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="todo in todos.data" :key="todo.id">
                                <td>{{todo.title}}</td>
                                <td style='text-align:center;'>{{todo.due_at}}</td>
                                <td style='text-align:center;'>{{todo.completed}}</td>
                                <td style='text-align:center;'>
                                    Edit / Complete / Delete
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
                axios.get('/api/todolist/',
                {
                    params: {
                        id: this.$route.params.id
                    }
                })
                .then(res => {
                    this.todos = res.data;
                    setTimeout(() => { 
                        this.loading = false;
                    }, 500)
                })
            }
        },
        filters: {

        },
    }
</script>
