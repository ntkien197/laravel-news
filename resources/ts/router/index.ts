import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import AuthRoutes from "@/router/routes/AuthRoutes";
import DashboardRoutes from "@/router/routes/DashboardRoutes";

// const routes: Array<RouteRecordRaw> = [
//     { path: '/', component: () => import('@/views/home/index.vue') },
// ]

const routes = [
    ...AuthRoutes,
    ...DashboardRoutes
]

const router = createRouter({
    history: createWebHistory(),
    routes:routes,
})

export default router
