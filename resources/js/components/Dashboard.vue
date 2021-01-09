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

                        <div class="row">
                            <div class="col-md-12">
                                <line-chart :chart-data="datacollection" :options="options" :width="1070" :height="500"></line-chart>
                            </div>
                        </div>

                    </div>
                </div>  
            </div>
        </div>
    </div>
</template>

<script>
    import LineChart from './LineChart.js'
    import moment from 'moment'

    export default {
        components: {
            LineChart
        },
        data() {
            return {
                loading: true,
                todos: {},

                datacollection: null,
                options: null,
                labels: [],
                pending_tasks_count: []
            }
        },
        mounted() {
            this.loadTodos();
            this.setupChartOptions();
            this.lastHour();
        },
        methods: {
            
            loadTodos() {
                axios.get('/api/tododashboard/')
                .then(res => {
                    this.todos = res.data;
                    setTimeout(() => { 
                        this.loading = false;
                    }, 500)
                })
            },

            setupChartOptions() {
                this.options = {
                    responsive: false,
                    maintainAspectRatio: false
                };
            },
            lastHour() {
                axios.get('/api/todochart')
                    .then((response) => {
                        var activities = response.data.data;
                        this.labels.push('Due Date');
                        this.pending_tasks_count.push(0);

                        activities.forEach((activity) => {
                            this.labels.push(activity.due_at);
                            this.pending_tasks_count.push(activity.total);
                        }, this.labels, this.pending_tasks_count);

                        this.fillData();
                    })
                    .catch(function (error) {
                        console.error('Fetch Activities: ', error);
                    });
            },

            fillData () {
                this.datacollection = {
                    labels: this.labels,
                    datasets: [
                        {
                            label: "In Progress",
                            pointRadius: 10,
                            backgroundColor: '#3cba92',
                            borderColor: '#0ba360',
                            strokeColor: "rgba(151,187,205,1)",
                            pointColor: "#226D82",
                            pointBorderWidth: 2,
                            pointBorderColor: "#5E9732",
                            data: this.pending_tasks_count
                        }
                    ]
                };
            },
            
        }
    }
</script>
