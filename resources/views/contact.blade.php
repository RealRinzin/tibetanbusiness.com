@extends('welcome')
@section('content')
<email-us></email-us>
<div style="min-height:100vh" class="bg-light">
    <div class="container">
        <div class="row py-4">
            <div class="col-12">
                <h4 class="text-dark">CONTACT US FOR INQUIRY</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 card py-2">
            <form action="mailto:geniusbulbs@gmail.com" method="post" enctype="text/plain">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Message</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" required> </textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">Send Message</button>
                </form>
            </div>
            <div class="col-12 col-md-6">
                    <p class="m-1">Rinzin</p>
                    <p class="m-1">Jogiwara Road</p>
                    <p class="m-1">Mcleod Gang, Dharamshala</p>
                    <p class="m-1">Pin: 34562</p>
                    <p class="m-1">India, H.P</p>
                    <p class="m-1">+91-8353049170</p>
                    <p class="m-1">inquiry@tibetanbusiness.com</p>
                    <div class="py-3">
                        <span class="px-1 text-primary"><a href=""><i class="fab fa-facebook-square"></i></a></span>
                        <span class="px-1"><a href=""><i class="fab fa-instagram text-danger"></i></a></span>
                        <span class="px-1 text-primary"><a href=""><i class="fab fa-twitter-square"></i></a></span>
                        <span class="px-1"><a href=""><i class="fab fa-linkedin"></i></a></span>
                    </div>
                    <div id='contact-page-map' class="w-100" style="height:200px"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 bg-light">
                <!-- <div id='contact-page-map' class="position-relative w-100" style="top:0;bottom:0"></div> -->
            </div>
        </div>
    </div>
</div>
<?php
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("geniusbulbs@gmail.com","My subject",$msg);
?>
@endsection
