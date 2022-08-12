import { createWebHistory, createRouter } from "vue-router";

const routes = [
    {
        name: 'pages',
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
        component: () => import('./components/tables/Edit.vue')
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
