<template>
    <div class="row my-1" v-if="loading">
        <div class="col-md-10 mx-auto">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/rent.png" class="mr-2" alt="">POPULAR RENTS</h6>
            <swiper class="row swiper" :options="settings" >
                <swiper-slide class="col-md-3 col-sm-6 col-6" v-for="(rent,index) in rents" :key="index">
                    <div class="card">
                        <a v-bind:href="'rent/'+rent.id">
                        <div class="banner" v-bind:style='{ backgroundImage: `url(storage/Rent/Banner/${rent.banner})`}'></div>
                        </a>
                        <div class="info p-2">
                            <h5>{{rent.name}}</h5>
                            <h6 class="pt-1">{{rent.mobile_no}}</h6>
                            <h6>{{rent.location}}</h6>
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
            rents:{},
            // swiper
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
                        slidesPerView: 1,
                        spaceBetween: 5,
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
        // rents
        rent_list(){
            // home advertisment
            axios.get('api/rent/list/home_ad')
            .then(response=>{
                if(response.data.length > 0){
                    this.loading = true;
                    this.rents = response.data;
                }else{
                    axios.get('/api/rent/list/all').then(response=>{
                        this.loading = true;
                        this.rents = response.data;
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