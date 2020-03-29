<template>
    <div class="container">
        <button class="btn btn-dark">Latest Featured </button>
        <div class="row py-3">
            <div class="col-md-4">
                <div class="card">
                    <div class="list"></div>
                    <div class="likes">
                        <button class="btn btn-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>9.2</button>
                    </div>
                    <div class="card-body">
                        <h6>Khawa Hotel</h6>
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
