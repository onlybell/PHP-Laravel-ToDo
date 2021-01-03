import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Dashboard from "./components/Dashboard";
import ToDoList from "./components/ToDoList";
import ToDoCreate from "./components/ToDoCreate";

const routes = [
    {
        path: "/dashboard/",
        component: Dashboard
    },
    {
        path: "/todolist/",
        component: ToDoList
    },
    {
        path: "/todocreate",
        component: ToDoCreate
    }
];
 
export default new vueRouter({
    mode: "history",
    routes 
});
