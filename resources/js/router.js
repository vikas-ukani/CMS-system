import { createWebHistory, createRouter } from "vue-router";

const routes = [
    {
        name: 'home',
        path: "/",
        component: () => import('./components/tables/AllPages.vue')
    },
    {
        name: 'create',
        path: "/create",
        component: () => import('./components/tables/CreatePage.vue')
    },
    {
        name: 'edit',
        path: "/edit/:id",
        component: () => import('./components/tables/Test.vue')
    }
    // {
    //     name: 'create',
    //     path : "/create",
    //     component: CreatePage
    // },
    // {
    //     name: 'edit',
    //     path : "/edit",
    //     component: EditPage
    // },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
