<template>
  <Head>
    <title>Register</title>
  </Head>
  <main-layout>
    <div class="w-full h-full flex justify-center items-center py-12">
      <form @submit.prevent="form.post('/register')" class="bg-secondary w-3/12 h-full py-4 px-8 text-secondary">
        <h3 class="text-center text-3xl text-white font-indie mb-4">Sign up</h3>

        <validation-errors class="mb-4"/>

        <div class="flex flex-col mb-4">
          <label for="username" class="text-white"></label>
          <v-input type="text" id="username" v-model="form.username" placeholder="username" autocomplete="username" autofocus required />
        </div>
        <div class="flex flex-col mb-4">
          <label for="email" class="text-white"></label>
          <v-input type="email" id="email" v-model="form.email" placeholder="email" autocomplete="email" autofocus required />
        </div>
        <div class="flex flex-col mb-4">
          <label for="password" class="text-white"></label>
          <v-input type="password" id="password" v-model="form.password" placeholder="password" autocomplete="new_password" autofocus required/>
        </div>
        <div class="flex flex-col mb-4">
          <label for="password_confirmation" class="text-white"></label>
          <v-input type="password" id="password_confirmation" placeholder="confirm password" v-model="form.password_confirmation" autofocus required/>
        </div>
        <div class="flex flex-col items-center mb-4">
          <vue-recaptcha
            :tabindex="0"
            @verify="callbackVerify($event)"
            @widgetId="form.recaptcha = $event"
            size="normal"
            theme="dark"
          />
        </div>
        <v-button class="w-full" type="submit" :class="{'opacity-25' : form.processing}" :disabled="form.processing">Sign up</v-button>
      </form>
    </div>
  </main-layout>
</template>

<script>
  import ValidationErrors from "@/Components/ValidationErrors";
  import Input from '@/Components/Input'
  import Button from '@/Components/Button'
  import {VueRecaptcha} from 'vue3-recaptcha-v2';
  import MainLayout from '@/Layout/MainLayout'
  import {Head, useForm} from '@inertiajs/inertia-vue3'
  export default {
    name: "Register",
    components: {
      'validation-errors' : ValidationErrors,
      'v-input' : Input,
      'v-button' : Button,
      VueRecaptcha,
      'main-layout' : MainLayout,
      Head
    },
    data() {
      return {
        form: useForm({
          username: null,
          email: null,
          password: null,
          password_confirmation: null,
          recaptcha: null

        })
      }
    },
    methods: {
      callbackVerify(response) {
        this.form.recaptcha = response;
      }
    }
  }
</script>

<style scoped>

</style>
