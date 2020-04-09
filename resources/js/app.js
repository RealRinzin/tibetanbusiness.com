/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * 
 * Vuejs time ago
 *  */ 
import VueTimeago from "vue-timeago";

Vue.use(VueTimeago, {
    name: "Timeago", // Component name, `Timeago` by default
    locale: "en", // Default locale
    // We use `date-fns` under the hood
    // So you can use all locales from it
    // locales: {
    //     "zh-CN": require("date-fns/locale/zh_cn"),
    //     ja: require("date-fns/locale/ja")
    // }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('test-vue', require('./components/TestVue.vue').default);
/**
 * 
 * Front Page Component 
 * */
Vue.component('home-featured', require('./components/Home/HomeFeatured.vue').default);
Vue.component('business-list', require('./components/Home/BusinessList.vue').default);

/**
 * 
 * Restaurant Components
 * */ 
Vue.component('restaurant-show', require('./components/Restaurant/Show.vue').default);
Vue.component('restaurant-sidebar', require('./components/Restaurant/SideBar.vue').default);
Vue.component('geo-map', require('./components/Restaurant/Map.vue').default);
Vue.component('menu-photo', require('./components/Restaurant/MenuPhoto.vue').default);
Vue.component('food-photo', require('./components/Restaurant/FoodPhoto.vue').default);
Vue.component('restaurant-comment', require('./components/Restaurant/Comments.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    // Data
    data() {
        return {
            // token
            token: '',
        }
    },
    // Methods
    methods:{
        /**
         * Login Status
         * Check
         *  */
        login_status() {
            axios.get('login_status').then(response => {
                const data = {
                    name: 'Token Name',
                    scopes: []
                };
                /**
                 * Creating
                 * Personal 
                 * Token
                 *  */

                if (response.data.status === true) {
                    axios.post('/oauth/personal-access-tokens', data)
                        .then(response => {
                            this.token = "Bearer " + response.data.accessToken;
                            localStorage.setItem("token", this.token);
                        })
                        .catch(response => {
                            // List errors on response...
                        });
                } else {
                    console.log("not true");

                }
            });
        }
    },
    // Mounted
    mounted(){
        this.login_status();   
    }
});
