<template>
    <div class="col-md-4 py-1" v-if="rent">
    <loading :active.sync="isLoading"></loading>
        <div class="card">
            <a v-bind:href="'rent/'+rent.id"><div class="list" v-bind:style='{ backgroundImage: `url(img/${rent.banner})`}'></div></a>
            <div class="likes" v-if="rent.rate != null">
                <p v-if="rent" v-bind:class="rent.rate_color" class="btn"><i class="fas fa-star text-white fa-1x mr-1"></i>{{rent.rate}}</p>
            </div>
            <div class="types">
                <button class="btn btn-outline-info btn-xs py-1"><i class="fas fa-mug-hot mx-1"></i>Rent</button>
            </div>
            <div class="card-body text-truncate">
                <h5>{{rent.name}}</h5>
                <h6>{{rent.mobile_no}}</h6>
                <h6>{{rent.location}}</h6>
            </div>
        </div>
    </div>
</template>
<script>
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    data(){
        return{
            isLoading : false,//Lazy loading
            rent:{}, //Rent object
        }
    },
    methods:{
        load_rent(){
            this.isLoading = true; //Loading true
            axios.get('/api/rent/list/featured_ad')
            .then(response=>{
                if (response.data.length > 0) {
                    // Assign
                    this.rent = response.data[Math.floor(Math.random() *response.data.length)]
                        /**
                         * Rating Background
                         * Color
                         *  */  
                        if(this.rent.rate >= 0.0 && this.rent.rate <= 2.5){
                            this.rent.rate_color = 'bg-danger';
                        }else if(this.rent.rate >= 2.6 && this.rent.rate <= 3.5 ){
                            this.rent.rate_color = 'bg-warning';
                        }else if(this.rent.rate >= 3.6 && this.rent.rate <= 4.0 ){
                            this.rent.rate_color = 'bg-info';
                        }else if(this.rent.rate >= 4.1 && this.rent.rate <= 5.0 ){
                            this.rent.rate_color = 'bg-success';
                        }else{
                            this.rent.rate_color = 'bg-secondary';
                        }
                        this.isLoading = false; //Loading true
                }else{
                    axios.get('/api/rent/list/all')
                    .then(response => {
                        // Assign
                        this.rent = response.data[Math.floor(Math.random() *response.data.length)]
                        /**
                         * Rating Background
                         * Color
                         *  */  
                        if(this.rent.rate >= 0.0 && this.rent.rate <= 2.5){
                            this.rent.rate_color = 'bg-danger';
                        }else if(this.rent.rate >= 2.6 && this.rent.rate <= 3.5 ){
                            this.rent.rate_color = 'bg-warning';
                        }else if(this.rent.rate >= 3.6 && this.rent.rate <= 4.0 ){
                            this.rent.rate_color = 'bg-info';
                        }else if(this.rent.rate >= 4.1 && this.rent.rate <= 5.0 ){
                            this.rent.rate_color = 'bg-success';
                        }else{
                            this.rent.rate_color = 'bg-secondary';
                        }
                        this.isLoading = false; //Loading true

                    })
                }
            })
        }
    },
        /**
         * 
         * Components
         *  */  
        components:{Loading},
    mounted(){
        // load
        this.load_rent();
    }
}
</script>