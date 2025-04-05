import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@/views/HomePage.vue'
import AboutPage from '@/views/AboutPage.vue'
import MoviesPage from "@/views/MoviesPage.vue";
import SchedulePage from "@/views/SchedulePage.vue";
import AccountPage from "@/views/AccountPage.vue";
import DetailMovie from "@/components/Movies/DetailMovie.vue";

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
        component: AccountPage
    },
    {
        path: '/movies/:id',
        name: 'DetailMovie',
        component: DetailMovie,
        props: true
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router