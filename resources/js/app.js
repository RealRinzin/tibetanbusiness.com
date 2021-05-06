/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import axios from 'axios';
/**
 * Lazy loading 
 * plugin
 * 
 * */ 
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
// Init plugin
Vue.use(Loading);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * 
 * Front Page Component 
 * */
Vue.component('lazy-loading', require('./components/Home/LazyLoading.vue').default);
Vue.component('home-featured', require('./components/Home/HomeFeatured.vue').default);
Vue.component('nav-bar', require('./components/Home/NavBar.vue').default);
Vue.component('auto-complete', require('./components/Autocomplete.vue').default);
Vue.component('home-list-fast', require('./components/Home/HomeListFast.vue').default);
Vue.component('map-location', require('./components/Map.vue').default);

/**
 * 
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// Vue.component("event-list", require("./components/Home/List/Event.vue").default);
const app = new Vue({
    el: '#tibetanbusiness',
    // Data
    data() {
        return {
            // token
            token: '',
            // User object
            user_name:'',
            user_avatar:'',
            user_id:'',
            locations:{},
            places:{},
        }
    },
    // Methods
    methods:{
        /**
         * Login Status
         * Check
         *  */
        login_status() {
            axios.get('/login_status').then(response => {
                const data = {
                    name: 'Personal Token',
                    scopes: []
                };
                /**
                 * Creating
                 * Personal 
                 * Token
                 *  */

                if (response.data.status === true) {
                    // User
                    localStorage.setItem("user_id",response.data.user.id);
                    // User Local Storage
                    localStorage.setItem("user_name",response.data.user.name);
                    // user avatar storage
                    localStorage.setItem("user_avatar", response.data.user.avatar);
                    // Create Personal Token
                    axios.post('/oauth/personal-access-tokens', data)
                        .then(response => {
                            this.token = "Bearer " + response.data.accessToken;
                            localStorage.setItem("token", this.token);
                        })
                        .catch(response => {
                            // List errors on response...
                        });
                } else {
                }
            });
        }
    },
    // Mounted
    mounted(){
        axios.get('/api/map?query="MC"')
        .then(response=>{
            this.locations = JSON.parse(response.data.data);
            // console.log(response.data.data);
            // console.log(JSON.parse(response.data.data));
            // console.log(this.places.suggestedLocations);
            this.places = this.locations.suggestedLocations;

        })
        this.login_status(); 
        // Mobile device size  
        if(screen.width < 767){
            $("#search_collapse").addClass("hide");
            // Add business and promote button
            $("#mobile_add_promote_link").css("display", "block");
            $("#desktop_add_promote_link").css("display", "none");
        }else{
            //Other size
            $("#search_collapse").addClass("show");
             }

        
    }
});
