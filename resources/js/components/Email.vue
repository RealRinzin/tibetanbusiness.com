<template>
    <div class="row">
        <div class="col-12 col-md-6 card py-2">
        <form class="contact-form" @submit.prevent="sendEmail">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" name="message" id="message" rows="6" required> </textarea>
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
                <map-location :longitude="76.32" :latitude="32.23"></map-location>
        </div>
    </div>
</template>

<script>
import emailjs from 'emailjs-com';
export default {
  methods: {
    sendEmail: (e) => {
      emailjs.sendForm('service_nyp3x39', 'template_w5m2djd', e.target, 'user_KUEPWiHsjxRGX713YMj3h')
        .then((result) => {
              toast.fire({
                  icon:'success',
                  title:'Mail Sent!!!',
              });
        }, (error) => {
            console.log('FAILED...', error);
        });
    }
  }
}
</script>