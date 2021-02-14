<template>
    <!-- Service -->
    <div class="card p-2 my-2" v-if="services != ''">
        <h6 class="py-2 font-weight-bolder text-dark border-bottom"> <span><i class="fas fa-bed fa-1x mr-2 text-dark"></i></span> Services - {{service_location}}</h6>
        <div class="row">
            <div class="col-6 py-2" v-for="(service,index) in services" v-if="index <= 3">
                <a v-bind:href="'/service/'+service.id">
                <div class="banner lazyload small" :data-bgset="'/storage/Service/Banner/'+service.card"  data-sizes="auto">
                    <span  v-if="service.rate > 0.0" v-bind:class="service.rate_color" class="btn p-0 px-1 position-absolute" style="bottom:2px;right:2px"> <i class="fas fa-star text-white fa-1x mr-1 small" ></i>{{service.rate}}</span>

                </div>
                </a>
                <h6 class="text-muted pt-3 font-weight-bolder">{{service.name}}</h6>
                <p class="text-muted my-0">{{service.mobile_no}}</p>
                <p class="text-muted my-0">{{service.location}}</p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['location','id'],
         data(){
        return{
            place:this.location,
            services:[],
            service_location:'other places'
        }
    },
    methods:{
        // Service API
        service(){
            axios.get('/api/service/list/sidebar/'+this.location)
            .then(response=>{
                if(this.id !== undefined){
                    if(response.data.data.length > 1){
                        for (let i = 0; i < response.data.data.length; i++) {
                            if(response.data.data[i].id != this.id){
                                if(response.data.data[i].rate >=0.0 && response.data.data[i].rate <= 2.5){
                                    response.data.data[i].rate_color = 'btn-danger';
                                }else if(response.data.data[i].rate >= 2.6 && response.data.data[i].rate <= 3.5 ){
                                    response.data.data[i].rate_color = 'btn-warning';
                                }else if(response.data.data[i].rate >= 3.6 && response.data.data[i].rate <= 4.0 ){
                                    response.data.data[i].rate_color = 'btn-info';
                                }else if(response.data.data[i].rate >= 4.1 && response.data.data[i].rate <= 5.0 ){
                                    response.data.data[i].rate_color = 'btn-success';
                                }
                                else{
                                    response.data.data[i].rate_color = 'btn-secondary';
                                }
                                this.services.push(response.data.data[i]);
                                this.service_location = this.location
                            }
                        }
                    }else{
                        axios.get('/api/service/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        if(response.data[i].rate >=0.0 && response.data[i].rate <= 2.5){
                                            response.data[i].rate_color = 'btn-danger';
                                        }else if(response.data[i].rate >= 2.6 && response.data[i].rate <= 3.5 ){
                                            response.data[i].rate_color = 'btn-warning';
                                        }else if(response.data[i].rate >= 3.6 && response.data[i].rate <= 4.0 ){
                                            response.data[i].rate_color = 'btn-info';
                                        }else if(response.data[i].rate >= 4.1 && response.data[i].rate <= 5.0 ){
                                            response.data[i].rate_color = 'btn-success';
                                        }
                                        else{
                                            response.data.data[i].rate_color = 'btn-secondary';
                                        }
                                        this.services.push(response.data[i]);
                                    }
                                }
                            }
                            else{
                            axios.get('/api/service/list/all').then(response=>{
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        if(response.data[i].rate >=0.0 && response.data[i].rate <= 2.5){
                                            response.data[i].rate_color = 'btn-danger';
                                        }else if(response.data[i].rate >= 2.6 && response.data[i].rate <= 3.5 ){
                                            response.data[i].rate_color = 'btn-warning';
                                        }else if(response.data[i].rate >= 3.6 && response.data[i].rate <= 4.0 ){
                                            response.data[i].rate_color = 'btn-info';
                                        }else if(response.data[i].rate >= 4.1 && response.data[i].rate <= 5.0 ){
                                            response.data[i].rate_color = 'btn-success';
                                        }
                                        else{
                                            response.data[i].rate_color = 'btn-secondary';
                                        }
                                        this.services.push(response.data[i]);
                                    }
                                }
                            })}
                        })
                    }
                // Else part for
                // other businesses
                }else{
                    if(response.data.data.length > 0){
                        for (let i = 0; i < response.data.data.length; i++) {
                            if(response.data.data[i].id != this.id){
                                if(response.data.data[i].rate >=0.0 && response.data.data[i].rate <= 2.5){
                                    response.data.data[i].rate_color = 'btn-danger';
                                }else if(response.data.data[i].rate >= 2.6 && response.data.data[i].rate <= 3.5 ){
                                    response.data.data[i].rate_color = 'btn-warning';
                                }else if(response.data.data[i].rate >= 3.6 && response.data.data[i].rate <= 4.0 ){
                                    response.data.data[i].rate_color = 'btn-info';
                                }else if(response.data.data[i].rate >= 4.1 && response.data.data[i].rate <= 5.0 ){
                                    response.data.data[i].rate_color = 'btn-success';
                                }
                                else{
                                    response.data.data[i].rate_color = 'btn-secondary';
                                }
                                this.services.push(response.data.data[i]);
                                this.service_location = this.location;
                            }
                        }
                    }else{
                        axios.get('/api/service/list/sidebar_ad')
                        .then(response=>{
                            if(response.data.length > 0){
                                for (let i = 0; i < response.data.length; i++) {
                                    if(response.data[i].id != this.id){
                                        if(response.data[i].rate >=0.0 && response.data[i].rate <= 2.5){
                                            response.data[i].rate_color = 'btn-danger';
                                        }else if(response.data[i].rate >= 2.6 && response.data[i].rate <= 3.5 ){
                                            response.data[i].rate_color = 'btn-warning';
                                        }else if(response.data[i].rate >= 3.6 && response.data[i].rate <= 4.0 ){
                                            response.data[i].rate_color = 'btn-info';
                                        }else if(response.data[i].rate >= 4.1 && response.data[i].rate <= 5.0 ){
                                            response.data[i].rate_color = 'btn-success';
                                        }
                                        else{
                                            response.data.data[i].rate_color = 'btn-secondary';
                                        }
                                        this.services.push(response.data[i]);
                                    }
                                }
                            }
                            else{
                                axios.get('/api/service/list/all').then(response=>{
                                    for (let i = 0; i < response.data.length; i++) {
                                        if(response.data[i].id != this.id){
                                            if(response.data[i].rate >=0.0 && response.data[i].rate <= 2.5){
                                                response.data[i].rate_color = 'btn-danger';
                                            }else if(response.data[i].rate >= 2.6 && response.data[i].rate <= 3.5 ){
                                                response.data[i].rate_color = 'btn-warning';
                                            }else if(response.data[i].rate >= 3.6 && response.data[i].rate <= 4.0 ){
                                                response.data[i].rate_color = 'btn-info';
                                            }else if(response.data[i].rate >= 4.1 && response.data[i].rate <= 5.0 ){
                                                response.data[i].rate_color = 'btn-success';
                                            }
                                            else{
                                                response.data[i].rate_color = 'btn-secondary';
                                            }
                                            this.services.push(response.data[i]);
                                        }
                                    }
                                })
                            }
                        })
                    }
                }
            })
        },
    },
    mounted(){
        this.service()
    }
}
</script>