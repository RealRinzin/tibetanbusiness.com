<template>
    <div class="row">
        <div class="col-12 col-md-6 card py-2">
        <form class="contact-form" @submit.prevent="sendEmail" data-vv-scope="validate">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" v-validate="'required|email'" class="form-control" name="email" id="email" placeholder="Email">
                    <div class="valid-feedback"></div>
                    <div v-if="errors.has('validate.email')" class="invalid-feedback">
                        <span v-for="error in errors.collect('validate.email')">{{ error }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" v-validate="'required'"  class="form-control" id="name" placeholder="Name">
                    <div class="valid-feedback"></div>
                    <div v-if="errors.has('validate.name')" class="invalid-feedback">
                        <span v-for="error in errors.collect('validate.name')">{{ error }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" v-validate="'required'" name="message" id="message" rows="6" > </textarea>
                    <div class="valid-feedback"></div>
                    <div v-if="errors.has('validate.message')" class="invalid-feedback">
                        <span v-for="error in errors.collect('validate.message')">{{ error }}</span>
                    </div>
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
                <p class="m-1">support@tibetanbusiness.com</p>
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
import { Validator } from 'vee-validate';

export default {
  methods: {
      
    sendEmail(e){                        
        this.$validator.validateAll('validate').then((result) => { 
            if(result){
                emailjs.sendForm('service_g6doc6x', 'template_8r2rn1l', e.target, 'user_4XZM3OoOcJejmW6Zkz0O0') // tibetanbusinesscom@gmail.com
                .then((result) => {
                    toast.fire({
                        icon:'success',
                        title:'Mail Sent!!!',
                    });
                }, (error) => {
                    console.log('FAILED...', error);
                });
            }  
        })
    }
  }
}
</script>