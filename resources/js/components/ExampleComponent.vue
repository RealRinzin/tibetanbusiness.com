<template>
    <div class="container">
 
<p>
    {{number}}asd
  <label for="amount">Price range:</label>
  <input type="text" id="amount" readonly  style="border:0; color:#f6931f; font-weight:bold;">
</p>
<div id="slider-range"></div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                // min:0,
                number:'',
            }
        },
        methods:{

            load(){
                   $( function() {
                        $( "#slider-range" ).slider({
                        range: true,
                        min: 0,
                        max: 500,
                        // values: [ 75, 300],
                        slide: function( event, ui ) {
                            $( "#amount" ).val( + ui.values[ 0 ] + "-" + ui.values[ 1 ] );
                        }
                        });
                        $( "#amount" ).val( + $( "#slider-range" ).slider( "values", 0 ) +
                        " - " + $( "#slider-range" ).slider( "values", 1 ) );
                            // console.log(this.number);
                    } );
            },
            line(){
                var min = document.getElementById("amount");
                this.number = min.value.split("-");
                console.log(this.number);

            }
        },
        mounted() {
            this.load();
            
            // this.load();
            //     var min = document.getElementById("min_fare");
            //     var min_output = document.getElementById("min_value");
            //     var see = document.getElementById("change");
            //     min_output.innerHTML = min.value;
            //         console.log(this.filter.check);
            //     min.oninput = function() {
            //         min_output.innerHTML = this.value;
            //     }

                // Max
                // var max = document.getElementById("max_fare");
                // var max_output = document.getElementById("max_value");
                // max_output.innerHTML = max.value;
                // max.oninput = function() {
                // max_output.innerHTML = this.value;
                // }
        }
    }
</script>

