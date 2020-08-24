<template>
    <div class="row" v-if="loading">
        <div class="col-md-10 mx-auto">
            <!-- <h6 class="btn-info btn btn-flat small"><img src="/img/event.png" class="mr-2" alt=""> Upcoming Events</h6> -->
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/restaurant.png" alt=""> RESTAURANTS</h6>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-6" v-for="(event,index) in events" :key="index" v-if="index <= 3">
                    <div class="card">
                        <a v-bind:href="'event/'+event.id">
                        <div class="banner rounded-top lazyload" v-bind:style='{ backgroundImage: `url(storage/Event/Banner/${event.banner})`}'></div>
                        </a>
                        <div class="info p-2">
                            <h5>{{event.name}}</h5>
                            <h6 class="pt-1">{{event.mobile_no}}</h6>
                            <h6>{{event.location}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            events:{},
            loading:false,
                // Swiper Carousel
                settings:{
                    slidesPerView: 2,
                    spaceBetween: 30,
                    slidesPerGroup: 3,
                    loop: true,
                    // loopFillGroupWithBlank: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    }
                }
        }
    },
    // methods / Functions
    methods:{
        // events
        event_list(){
            // home advertisment
            axios.get('api/event/list/home_ad')
            .then(response=>{
                // this.isLoading = true; //Loading true
                this.events = response.data;
                if(response.data.length > 0){
                    this.loading = true;
                    this.events = response.data;

                }else{
                    axios.get('/api/event/list/all').then(response=>{
                        this.loading = true;
                        this.events = response.data;
                    })
                }
            })
        }
    },
    mounted(){
        this.event_list(); // Restaurant
    }
}
</script>