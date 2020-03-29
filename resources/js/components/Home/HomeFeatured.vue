<template>
    <div class="container">
        <button class="btn btn-dark">Latest Featured </button>
        <div class="row py-3">
            <div class="col-md-4">
                <div class="card">
                    <a href="#"><div class="list"></div></a>
                    <div class="likes">
                        <p class="btn btn-danger"><i class="fas fa-star text-white"></i>9.2</p>
                    </div>
                    <div class="types">
                        <button class="btn btn-outline-info btn-xs py-1">Restuarant</button>
                    </div>
                    <div class="card-body">
                        <h5>Khawa Hotel</h5>
                        <h6>8353049170</h6>
                        <h6>Dharamsala</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
