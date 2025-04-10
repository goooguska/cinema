import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@/views/HomePage.vue'
import AboutPage from '@/views/AboutPage.vue'
import MoviesPage from "@/views/MoviesPage.vue";
import SchedulePage from "@/views/SchedulePage.vue";
import AccountPage from "@/views/AccountPage.vue";
import DetailMovie from "@/components/Movies/DetailMovie.vue";
import {useUserStore} from "@/stores/UserStore.js";
import NotFoundPage from "@/views/NotFoundPage.vue";
import axios from "axios";

const routes = [
    {
        path: '/',
        name: 'Home',
        component: HomePage
    },
    {
        path: '/movies',
        name: 'Movies',
        component: MoviesPage
    },
    {
        path: '/schedule',
        name: 'Schedule',
        component: SchedulePage
    },
    {
        path: '/about',
        name: 'About',
        component: AboutPage
    },
    {
        path: '/account',
        name: 'Account',
        component: AccountPage,
        meta: { requiresAuth: true }
    },
    {
        path: '/movies/:id',
        name: 'DetailMovie',
        component: DetailMovie,
        props: true
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFoundPage
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status === 404) {
            router.push({ name: 'NotFound' })
        }
        return Promise.reject(error)
    }
)

router.beforeEach((to, from, next) => {
    const userStore = useUserStore()

    if (!to.matched.length) {
        next({ name: 'NotFound' })
        return
    }

    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!userStore.isAuth()) {
            next({ name: 'Home' })
            return
        }
    }

    next()
})

export default router