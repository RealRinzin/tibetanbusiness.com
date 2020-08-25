<template>
    <div class="row" v-if="loading">
        <div class="col-md-12 mx-auto">
            <h6 class="small text-muted py-2 font-weight-bolder"><img src="/img/job.png" class="mr-2" alt="">AVAILABLE JOBS</h6>
            <swiper class="row swiper" :options="settings">
                <swiper-slide class="col-md-3 col-sm-6 col-6" v-for="(job,index) in jobs" :key="index">
                    <div class="card">
                        <a v-bind:href="'job/'+job.id">
                        <div class="banner" v-bind:style='{ backgroundImage: `url(storage/job/Banner/${job.banner})`}'></div>
                        </a>
                        <div class="info p-1">
                            <h5>{{job.title}}</h5>
                            <h6 class="pt-1">{{job.mobile_no}}</h6>
                            <h6>{{job.location}}</h6>
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
            jobs:{},
                // Swiper Carousel
            settings:{
                // slidesPerView: 4,
                spaceBetween: 30,
                slidesPerGroup: 2,
                loop: true,
                breakpoints: {
                    1024: {
                    slidesPerView: 4,
                    spaceBetween: 30
                    },
                    768: {
                    slidesPerView: 3,
                    spaceBetween: 15
                    },
                    640: {
                    slidesPerView: 2,
                    spaceBetween: 15
                    },
                    320: {
                    slidesPerView: 1,
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
        // jobs
        job_list(){
            // home advertisment
            axios.get('api/job/list/home_ad')
            .then(response=>{
                this.loading = true;
                if(response.data.length > 0){
                    this.jobs = response.data;
                }else{
                    axios.get('/api/job/list/all').then(response=>{
                        this.jobs = response.data;
                        this.loading = true;
                    })
                }
            })
        }
    },

    mounted(){
        this.job_list(); // Restaurant
    }
}
</script>