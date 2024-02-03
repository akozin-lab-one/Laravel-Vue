import { createRouter, createWebHistory } from 'vue-router';
import Items from '../components/items/Index.vue';
import Category from '../Category.vue'
import NotFound from '../components/NotFound.vue';

const routes = [{
        path: '/dashboard/items',
        component: Items,
    },
    {
        path: '/dashboard/category',
        component: Category,
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound,
    }
];

const router = createRouter({
    history: createWebHistory(),
    // component: NotFound,
    routes: routes
});

export default router;