/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import UpdateRecipe from "./components/UpdateRecipe";

require('./bootstrap');
//require('vue-router/dist/vue-router');

import Auth from './auth.js';
import Api from './api.js';

window.api = new Api();
window.auth = new Auth();

window.Vue = require('vue');
import VueRouter from 'vue-router';
import VueFormulate from '@braid/vue-formulate';
import { ru } from '@braid/vue-formulate-i18n';

Vue.use(VueRouter);

import Paginate from 'vuejs-paginate';
Vue.component('paginate', Paginate);

window.Event = new Vue;

import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import App from './components/App';
import MyRecipes from './components/MyRecipes';
import RecipesCatalog from './components/RecipesCatalog';
import Recipe from './components/Recipe';
import AddRecipe from './components/AddRecipe';
import Home from './components/Home';
import LeftMenu from "./components/LeftMenu";
import FooterComponent from "./components/FooterComponent";
import HeaderComponent from "./components/HeaderComponent";
import Register from "./components/Register";
import Login from "./components/Login";
/*Vue.component('vueFormulate', require('@braid/vue-formulate'));*/

import VueAgile from 'vue-agile'
Vue.use(VueAgile);

Vue.use(VueFormulate,   {
    plugins: [ ru ],
    locale: 'ru',
    uploader: axios,
    uploadUrl: '/api/upload',
    uploadBehavior: 'delayed',
    library: {
        autocomplete: {
            classification: 'hidden',
            component: 'Autocomplete'
        },
        htmleditor: {
            classification: 'text',
            component: 'HtmlEditor'
        }
    }
},);

import vSelect from 'vue-select'
Vue.component('v-select', vSelect);
Vue.component('Autocomplete', require('./components/Autocomplete.vue').default);

import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor );
Vue.component('HtmlEditor', require('./components/HtmlEditor.vue').default);



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: {
                title: 'Главная страница',
            },
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                title: 'Регистрация',
            },
        },
        {
            path: '/recipes',
            name: 'recipes',
            component: RecipesCatalog,
            meta: {
                title: 'Рецепты',
            },
        },
        {
            path: '/my-recipes',
            name: 'my-recipes',
            component: MyRecipes,
            meta: {
                middlewareAuth: true,
                title: 'Мои рецепты',
            },
        },
        {
            path: '/recipes/add',
            name: 'add-recipe',
            component: AddRecipe,
            meta: {
                middlewareAuth: true,
                title: 'Добавить рецепт',
            },
        },
        {
            path: '/recipes/update/:id',
            name: 'update-recipe',
            component: UpdateRecipe,
            meta: {
                middlewareAuth: true,
                title: 'Редактировать рецепт',
            },
        },
        {
            path: '/recipes/:id',
            name: 'show-recipe',
            component: Recipe,
            meta: {
                title: 'Показать рецепт',
            },
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                title: 'Авторизация пользователя',
                middlewareAuth: false,
            },
        },
    ],
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.middlewareAuth)) {
        if (!auth.check()) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            });

            return;
        }
    }

    next();
});

export default router;

new Vue({
    el: '#app',
    components: {LeftMenu, FooterComponent, HeaderComponent, App, RecipesCatalog, MyRecipes, Recipe, Register, Login, Loading, VueAgile}, router, VueFormulate, Loading,
    data: {
        authenticated: window.auth.check(),
        user: window.auth.user,
        isLoading: false,
    }
});
