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
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="todo in todos.data" :key="todo.id">
                                <td>{{todo.id}}</td>
                                <td>{{todo.title}}</td>
                                <td><textarea v-model="todo.description" type="text" name="description" class="form-control" readonly></textarea></td>
                                <td>
                                    
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
                axios.get('/api/todolist')
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
