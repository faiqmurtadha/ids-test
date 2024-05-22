import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/login',
        name: 'login',
        component: () => import('../views/auth/login.vue')
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('../views/auth/register.vue')
    },
    {
        path: '/forgot',
        name: 'forgot',
        component: () => import('../views/auth/forgotPassword.vue')
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router