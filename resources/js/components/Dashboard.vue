<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                         
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Tasks</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>{{todos.totalCount}}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-arielle-smile">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Complete</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>{{todos.completeCount}}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-grow-early">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">In Progress</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>{{todos.progressCount}}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tabs-eg-77">
                                        <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                                            <div class="widget-chat-wrapper-outer">
                                                <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">
                                                    <canvas id="canvas"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
-->
                    </div>
                </div>  
            </div>
        </div>
    </div>
</template>

<script>
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
            
            loadTodos() {
                axios.get('/api/tododashboard/')
                .then(res => {
                    this.todos = res.data;
                    console.log('----->' + res.data);
                    setTimeout(() => { 
                        this.loading = false;
                    }, 500)
                })
            },
            
        }
    }
</script>
