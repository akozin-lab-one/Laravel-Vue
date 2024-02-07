import { createRouter, createWebHistory } from 'vue-router';
import Items from '../Items/Items.vue';
import Category from '../Items/Category.vue'
import AddCategory from '../Items/CreateCategory.vue'
import AddItem from '../Items/CreateItem.vue'
import NotFound from '../Items/NotFound.vue';
import Open from '../section/Open.vue'

const routes = [{
        path: '/',
        component: Open,
    }, {
        path: '/items',
        component: Items,
    },
    {
        path: '/category',
        component: Category,
    },
    {
        path: '/category/addcategory',
        component: AddCategory,
    },
    {
        path: '/item/additem',
        component: AddItem,
    },
    {
        path: '/:pathMatch(.)',
        component: NotFound,
    }
];

const router = createRouter({
    history: createWebHistory(),
    component: NotFound,
    routes: routes
});

export default router;