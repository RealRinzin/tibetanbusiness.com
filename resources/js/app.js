/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
/**
 * 
 * Social Sharing
 *  */  
// import VueSocialSharing from 'vue-social-sharing'

// Vue.use(VueSocialSharing, {
//     networks: {
//         facebook: 'https://facebook.com/share?url=@url&title=@title'
//     }
// })
/**
 * Vue Progress bar
 * 
 */
// Progress bar
import VueProgressBar from 'vue-progressbar';
Vue.use(VueProgressBar, {
    color: "rgb(220, 66, 1)",
    failedColor: "red",
    height: "10px",
    thickness: "6px",
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
});
/**
 * 
 * Vuejs Light Box
 * 
 *  */ 
import VueLazyLoad from 'vue-lazyload'
Vue.use(VueLazyLoad)


/**
 * 
 * Datetime picker
 * 
 *  */ 
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";
Vue.component("VueCtkDateTimePicker", VueCtkDateTimePicker);

/**
 * 
 * Meta Description
 * 
 *  */ 
import Vue from "vue";
import vueHeadful from "vue-headful";
Vue.component("vue-headful", vueHeadful);


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
 * Star Rating
 *  */
import StarRating from "vue-star-rating";
Vue.component("star-rating", StarRating);

/**
 * Vee Vildate
 * Form Validation
 *  */ 
import VeeValidate from "vee-validate";
Vue.use(VeeValidate, {
    classes: true,
    classNames: {
        valid: "is-valid",
        invalid: "is-invalid"
    }
});

/**
 * 
 * Sweet Alert Toast
 * 
 *  */ 
 import swal from "sweetalert2";
 window.swal = swal;
 const toast = swal.mixin({
     showConfirmButton: false,
     timer: 1000
 });
 window.toast = toast;
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
Vue.component('image-upload', require('./components/ImageUpload.vue').default);
/**
 * 
 * Front Page Component 
 * */
Vue.component('nav-bar', require('./components/Home/NavBar.vue').default);
Vue.component('home-featured', require('./components/Home/HomeFeatured.vue').default);
Vue.component('search', require('./components/Home/Search.vue').default);
// Vue.component('business-list', require('./components/Home/BusinessList.vue').default);
Vue.component('featured-rent', require('./components/Home/Featured/Rent.vue').default);
Vue.component('featured-job', require('./components/Home/Featured/Job.vue').default);
/**
 * Sidebar
 * Check
 *  */ 
Vue.component('sidebar', require('./components/Home/Sidebar.vue').default);
Vue.component('rent-sidebar', require('./components/Rent/Sidebar.vue').default);
Vue.component('job-sidebar', require('./components/Job/Sidebar.vue').default);
Vue.component('event-sidebar', require('./components/Event/Sidebar.vue').default);
Vue.component('sale-sidebar', require('./components/Sale/Sidebar.vue').default);
Vue.component('service-sidebar', require('./components/Service/Sidebar.vue').default);


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

// Rent Components
Vue.component('rent-show', require('./components/Rent/Show.vue').default);
Vue.component('rent-room-photo', require('./components/Rent/RentRoomPhoto.vue').default);
Vue.component('rent-view-photo', require('./components/Rent/RentViewPhoto.vue').default);
Vue.component('rent-comment', require('./components/Rent/RentComment.vue').default);


// Job Component
Vue.component('job-show', require('./components/Job/Show.vue').default);
Vue.component('job-question', require('./components/Job/Question.vue').default);

// Event Component
Vue.component('event-show', require('./components/Event/Show.vue').default);
// Sale Component
Vue.component('sale-show', require('./components/Sale/Show.vue').default);
Vue.component('service-show', require('./components/Service/Show.vue').default);

/**
 *     DASHBOARD COMPONENTS
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// Restaurant Dashboard
Vue.component('dashboard-restaurant-index', require('./components/Dashboard/Restaurant/Index.vue').default);
Vue.component('dashboard-restaurant-edit', require('./components/Dashboard/Restaurant/Edit.vue').default);
Vue.component('dashboard-restaurant-overview', require('./components/Dashboard/Restaurant/Overview.vue').default);
Vue.component('dashboard-restaurant-menu-photo', require('./components/Dashboard/Restaurant/MenuPhoto.vue').default);
Vue.component('dashboard-restaurant-food-photo', require('./components/Dashboard/Restaurant/FoodPhoto.vue').default);
Vue.component('dashboard-restaurant-comment', require('./components/Dashboard/Restaurant/Comment.vue').default);
Vue.component('dashboard-restaurant-add', require('./components/Dashboard/Restaurant/AddNew.vue').default);

// Rent Dashboard
Vue.component('dashboard-rent-index', require('./components/Dashboard/Rent/Index.vue').default);
Vue.component('dashboard-rent-edit', require('./components/Dashboard/Rent/Edit.vue').default);
Vue.component('dashboard-rent-overview', require('./components/Dashboard/Rent/Overview.vue').default);
Vue.component('dashboard-rent-room-photo', require('./components/Dashboard/Rent/RoomPhoto.vue').default);
Vue.component('dashboard-rent-view-photo', require('./components/Dashboard/Rent/ViewPhoto.vue').default);
Vue.component('dashboard-rent-comment', require('./components/Dashboard/Rent/Comment.vue').default);
Vue.component('dashboard-rent-add', require('./components/Dashboard/Rent/AddNew.vue').default);

// Job Dashboard
Vue.component('dashboard-job-index', require('./components/Dashboard/Job/Index.vue').default);
Vue.component('dashboard-job-edit', require('./components/Dashboard/Job/Edit.vue').default);


// Event Dashboard
Vue.component('dashboard-event-index', require('./components/Dashboard/Event/Index.vue').default);
Vue.component('dashboard-event-edit', require('./components/Dashboard/Event/Edit.vue').default);

// Sale Dashboard
Vue.component('dashboard-sale-index', require('./components/Dashboard/Sale/Index.vue').default);
Vue.component('dashboard-sale-edit', require('./components/Dashboard/Sale/Edit.vue').default);

// Service Dashboard
Vue.component('dashboard-service-index', require('./components/Dashboard/Service/Index.vue').default);
Vue.component('dashboard-service-edit', require('./components/Dashboard/Service/Edit.vue').default);


// Search Result
Vue.component('restaurant-search', require('./components/Restaurant/Search.vue').default);
Vue.component("rent-search", require("./components/Rent/Search.vue").default);
Vue.component("sale-search", require("./components/Sale/Search.vue").default);
Vue.component("service-search", require("./components/Service/Search.vue").default);
Vue.component("job-search", require("./components/Job/Search.vue").default);
Vue.component("event-search", require("./components/Event/Search.vue").default);

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
            // User object
            user_name:'',
            user_avatar:'',
            user_id:'',
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
                    name: 'Token Name',
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
        this.login_status(); 
        // Mobile device size  
        if(screen.width < 767){
            // $("#tb_location").removeClass("px-0");
            // $("#tb_type").removeClass("px-0");
            $("#search_collapse").addClass("hide");
            // $("#search_mobile").addClass("search_filter");
            // $("#desktop_search_toggle").css("display", "none");
            // $("#search_mobile").addClass("p-0");
            // $("#search_mobile .card").removeClass("p-3");
            // $("#search_mobile .card").addClass("px-3");
            // Add business and promote button
            $("#mobile_add_promote_link").css("display", "block");
            $("#desktop_add_promote_link").css("display", "none");
        }else{
            //Other size
            $("#search_collapse").addClass("show");
            // $("#mobile_search_toggle").css("display", "none");
            // Add business and promote button
            // $("#mobile_add_promote_link").css("display", "none");
            // $("#desktop_add_promote_link").css("display", "block");
             }
        
    }
});
