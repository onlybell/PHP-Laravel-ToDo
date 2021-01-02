<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">To-Do Create</div>

                    <div class="card-body">
                       <div class="form-group">
                            <label>Title</label>
                            <input v-model="form.title" type="text" name="title" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea v-model="form.description" type="text" name="description" class="form-control" ></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" @click.prevent="store">Save</button>
                        <a class="btn btn-primary" href="/todolist" role="button">Cancel</a>
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
            form: {
                title: "",
                desc: ""
            },
            loading: false,
            error: false
        }),
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            store() {
                this.loading = true;
                axios.post('/api/todos', this.form, {
                    headers: {
                        "Content-type": "application/json"
                    }
                })
                .then(res => {
                    if (res.data.status) {
                        this.$router.push('todolist');
                    }
                    else {
                        console.log(res.data.errors);
                    }
                })
            }
        }
    }
</script>
