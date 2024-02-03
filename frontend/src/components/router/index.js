import { createRouter, createWebHistory } from 'vue-router';
import Items from '../Items/Items.vue';
import Category from '../Items/Category.vue'
import NotFound from '../Items/NotFound.vue';

const routes = [{
        path: '/items',
        component: Items,
    },
    {
        path: '/category',
        component: Category,
    },
    {
        path: '/:pathMatch(.)',
        component: NotFound,
    }
];

const router = createRouter({
    history: createWebHistory(),
    // component: NotFound,
    routes: routes
});

export default router;