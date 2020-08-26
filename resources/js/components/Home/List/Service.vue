<template>
    <div class="row" v-if="loading">
        <div class="col-md-10 mx-auto">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/service.png" class="mr-2" alt="">POPULAR SERVICES</h6>
            <swiper class="row swiper" :options="settings">
                <swiper-slide class="col-md-3 col-sm-6 col-6" v-for="(service,index) in services" :key="index">
                    <div class="card">
                        <a v-bind:href="'service/'+service.id">
                        <div class="banner" v-bind:style='{ backgroundImage: `url(storage/Service/Banner/${service.banner})`}'></div>
                        </a>
                        <div class="info p-1">
                            <h5>{{service.name}}</h5>
                            <h6 class="pt-1">{{service.mobile_no}}</h6>
                            <h6>{{service.location}}</h6>
                        </div>
                    </div>
                </swiper-slide>
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
            </swiper>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            loading:false,
            services:{},
            settings:{
                // slidesPerView: 4,
                spaceBetween: 10,
                slidesPerGroup: 2,
                loop: true,
                breakpoints: {
                    1024: {
                    slidesPerView: 4,
                    spaceBetween: 10
                    },
                    768: {
                    slidesPerView: 3,
                    spaceBetween: 10
                    },
                    640: {
                    slidesPerView: 2,
                    spaceBetween: 10
                    },
                    320: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                    slidesPerGroup: 1,
                    }
                },
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
        // services
        rent_list(){
            // home advertisment
            axios.get('api/service/list/home_ad')
            .then(response=>{
                this.loading = true;
                if(response.data.length > 0){                    
                    this.services = response.data;
                }else{
                    axios.get('/api/service/list/all').then(response=>{
                        this.loading = true;
                        this.services = response.data;
                    })
                }
            })
        }
    },
    mounted(){
        this.rent_list(); // Restaurant
    }
}
</script>