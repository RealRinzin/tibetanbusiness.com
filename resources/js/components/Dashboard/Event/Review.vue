<template>
    <div>
        <!-- Show Review -->
        <div class="card p-3">
            <div class="row">
                <h5 class="text-dark">Reviews<span class="text-muted ml-2" style="font-size:14px">({{total_reviews}})</span></h5>
                <div v-if="events_lazy_load">
                    <loading :active.sync="events_lazy_load"></loading>
                </div>
                    <div class="col-md-12 p-3" v-for="(event,index) in reviews">
                        <div class="media animated fadeIn duration-1s">
                        <img class="mr-2 img-circle" :src="event.avatar" alt="Generic placeholder image" style="height:50px;width:50px">
                        <div class="media-body">
                            <h6 class="mt-0">{{event.name}} 
                                <!-- <small class="text-muted"><timeago :datetime="event.created_at" /></small> -->
                                <small>
                                <span  v-bind:class="event.rate_color" class="p-1 rounded"><i class="fas fa-star pr-1"></i>{{event.rate}}</span>
                                </small>
                            </h6>
                            <small class="text-muted" style="font-size:12px"><timeago :datetime="event.created_at" /></small>
                            <p class="text-muted">{{event.review}}</p>
                            </div>
                        </div>
                    </div>
                <div class="col-md-12 text-center" v-if="load_more_button">
                    <button @click="load_more_reviews()" class="btn btn-danger btn-sm">Load more</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['event'],
    data(){
        return{
            id:this.event.id,
            reviews:{},
            events_lazy_load:false, //lazy loading
            load_more_button : false, //load more button
            total_reviews:0, //total review counts
            nextPage:2, //paginating 

        }
    },
    // methods
    methods:{
        load_review(){
            axios.get('/api/event/'+this.id+'/reviews')
            .then(response=>{
                this.reviews = response.data.data;
                this.total_reviews = response.data.data.length
                /**
                 * Rating background
                 * Danger, Warning, Info, Success
                 *  0-3 , 3-5, 5-7 , 7-3
                 *  */ 
                for (let index = 0; index < this.reviews.length; index++) {
                    if(this.reviews[index].rate >= 0.0 && this.reviews[index].rate <= 1.0){
                        this.reviews[index].rate_color = 'bg-danger';
                    }else if(this.reviews[index].rate >= 1.1 && this.reviews[index].rate <= 2.0 ){
                        this.reviews[index].rate_color = 'bg-warning';
                    }else if(this.reviews[index].rate >= 2.1 && this.reviews[index].rate <= 3.0 ){
                        this.reviews[index].rate_color = 'bg-info';
                    }else if(this.reviews[index].rate >= 3.1 && this.reviews[index].rate <= 5.0 ){
                        this.reviews[index].rate_color = 'bg-success';
                    }else{
                        this.reviews[index].rate_color = 'bg-secondary';
                    }
                }
                // load more button
                if(response.data.last_page > 1){
                    this.load_more_button = true
                }
            })
        },
        // Load more reviews
        load_more_reviews(nextPage){
            axios.get('/api/event/'+this.id+'/reviews?page='+this.nextPage)
            .then(response=>{
                this.nextPage = this.nextPage +1;
                    this.reviews = [
                        ...this.reviews,
                        ...response.data.data
                    ];
                    // Load more hide
                    if(response.data.current_page ===response.data.last_page){
                        this.load_more_button = false
                    }
                /**
                 * Rating background
                 * Danger, Warning, Info, Success
                 *  0-3 , 3-5, 5-7 , 7-3
                 *  */ 
                for (let index = 0; index < this.reviews.length; index++) {
                    if(this.reviews[index].rate >= 0.0 && this.reviews[index].rate <= 1.0){
                        this.reviews[index].rate_color = 'bg-danger';
                    }else if(this.reviews[index].rate >= 1.1 && this.reviews[index].rate <= 2.0 ){
                        this.reviews[index].rate_color = 'bg-warning';
                    }else if(this.reviews[index].rate >= 2.1 && this.reviews[index].rate <= 3.0 ){
                        this.reviews[index].rate_color = 'bg-info';
                    }else if(this.reviews[index].rate >= 3.1 && this.reviews[index].rate <= 5.0 ){
                        this.reviews[index].rate_color = 'bg-success';
                    }else{
                        this.reviews[index].rate_color = 'bg-secondary';
                    }
                }

            })
        },

    },
    mounted(){
        this.load_review();
    }
}
</script>