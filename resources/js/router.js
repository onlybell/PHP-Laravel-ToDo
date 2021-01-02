import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Dashboard from "./components/Dashboard";
import ToDoList from "./components/ToDoList";

const routes = [
    {
        path: "/dashboard",
        component: Dashboard
    },
    {
        path: "/todolist",
        component: ToDoList
    }
];

export default new vueRouter({
    mode: "history",
    routes
});
