import * as VueRouter from 'vue-router';

const routes = [
    {
        path: '/form',
        component: () => import('./Views/Form.vue'),
        name: 'form.create',
    },
];

const route =  VueRouter.createRouter({
    mode: 'history',
    history: VueRouter.createWebHistory('/'),
    routes,
})

export default route
