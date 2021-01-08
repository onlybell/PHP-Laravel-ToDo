import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Dashboard from "./components/Dashboard";
import ToDoList from "./components/ToDoList";
import ToDoCreate from "./components/ToDoCreate";
import ToDoEdit from "./components/ToDoEdit";

const routes = [
    {
        name: "dashboard",
        path: "/dashboard/",
        component: Dashboard
    },
    {
        name: "todolist",
        path: "/todolist/",
        component: ToDoList
    },
    {
        name: "todocreate",
        path: "/todocreate",
        component: ToDoCreate
    },
    {
        name: "todoedit",
        path: "/todoedit/:id",
        component: ToDoEdit
    }
];
 
export default new vueRouter({
    mode: "history",
    routes 
});
