<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">To-Do Edit </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input v-model="todo.title" type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea v-model="todo.description" type="text" name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Due Date</label>
                            <input v-model="todo.due_at" type="date" name="due_at" class="form-control" style="width:220px;">
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button class="btn btn-success" @click.prevent="update">Update</button>
                        <router-link :to="{name: 'todolist'}" role="button" class="btn btn-primary">Cancel</router-link>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</template>

<script> 
    import axios from 'axios'; 
    
    export default {
        components: {},
        data: () => ({
            todo: {},
            form: {
                title: "",
                description: "",
                due_at: ""
            },
            loading: false,
            error: false,
        }),
       
        mounted() {
            this.loadTodos();
        },
        methods: {
           loadTodos() {
                axios.get('/api/todoEdit/'+this.$route.params.id)
                .then(res => {
                    this.todo = res.data.data;
                    setTimeout(() => { 
                        this.loading = false;
                    }, 500)
                })
            },
            update() {
                this.loading = true;
                axios.post('/api/todoUpdate/'+this.$route.params.id, this.todo) 
                .then(res => {
                    if (res.data.success) {
                        Swal.fire({
                            title: 'Task has been updated',
                            text: "",
                            showCancelButton: false,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Okay'
                            }).then((result) => {
                                this.$router.push('/todolist');
                            })
                    }
                    else {
                        if (res.data.errors) {  
                            var str = '';
                            if (res.data.errors.title) {
                                str += res.data.errors.title+'\n';
                            }
                            
                            if (res.data.errors.description) {
                                str += res.data.errors.description+'\n';
                            }
                            
                            if (res.data.errors.due_at) {
                                str += res.data.errors.due_at+'\n';
                            }

                            Toast.fire({
                                icon: 'error',
                                title: str
                            });
                        }
                    }
                })
            }
        },
    }
</script>
