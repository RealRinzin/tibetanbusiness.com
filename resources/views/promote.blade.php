@extends('welcome')
@section('content')
<div style="min-height:100vh" class="bg-white">
    <h3 class="pt-5 text-center">Advertise on Tibetanbusiness.com</h3>
    <section class="bg-light">
        <div class="container py-4">
            <div class="row">
                <div class="col-8 mx-auto py-3">
                    <blockquote class="blockquote py-1">
                        <p class="mb-0">
                            “Doing business without advertising is like winking at a girl in the dark. You know what you are doing but nobody else does.”
                        </p>
                        <p class="blockquote-footer"> Steuart Henderson Britt <cite title="Source Title"></cite></footer>
                    </blockquote>
                    <div class="row">
                        <div class="col-md-6" data-aos="fade-up" data-aos-offset="2" data-aos-delay="50" data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-center"><img src="{{ asset('img/Featured-Ad.jpg') }}" alt="" class="w-100 rounded"></div>
                        <div class="col-md-6">
                            <h5 class="text-dark">FEATURED AD</h5>
                            <p class="py-5">
                                In this business advertisement type, your service advertisement will display at the home page featured section of the website and will get better attention from the visitors.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white">
        <div class="container py-4">
            <div class="row">
                <div class="col-8 mx-auto py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-dark">HOME LISTING AD</h5>
                            <p>
                                In this business advertisement type, your service advertisement will display at the listing section of the home page
                            </p>
                        </div>
                        <div class="col-md-6" data-aos="fade-up" data-aos-offset="2" data-aos-delay="50" data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-center"><img src="{{ asset('img/Home-Ad.jpg') }}" alt="" class="w-100 rounded"></div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
<section class="bg-light">
    <div class="container py-4">
        <div class="row">
            <div class="col-8 mx-auto py-3">
                <div class="row">
                    <div class="col-md-6" data-aos="fade-up" data-aos-offset="2" data-aos-delay="50" data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-center"><img src="{{ asset('img/Sidebar-Ad.jpg') }}" alt="" class="w-100 rounded"></div>
                    <div class="col-md-6">
                        <h5 class="text-dark">SIDEBAR AD</h5>
                        <p>
                            In this business advertisement type, your service advertisement will display at the sidebar of every individual page visitors visit.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section class="bg-white">
    <div class="container py-4">
        <div class="row">
            <div class="col-8 mx-auto py-3">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-dark">POPUP AD</h5>
                        <p class="py-5">
                            In this business advertisement type, your service advertisement will popup at every individual page visitors visit.
                        </p>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-offset="2" data-aos-delay="50" data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-center"><img src="{{ asset('img/Popup-Ad.jpg') }}" alt="" class="w-100 rounded"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
</div>
@endsection