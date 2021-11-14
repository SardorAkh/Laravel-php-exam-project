<template>
  <Head>
    <title>Login</title>
  </Head>
  <main-layout>
    <div class="w-full h-full flex justify-center items-center py-12">
      <form @submit.prevent="form.post('/login')" class="bg-secondary w-3/12 h-full py-4 px-8 text-secondary">
        <h3 class="text-center text-3xl text-white">Login</h3>

        <validation-errors class="mb-4"/>

        <div class="flex flex-col mb-4">

          <label class="text-white" for="email">Email</label>
          <v-input autocomplete="email" autofocus id="email" required type="email" v-model="form.email"/>
          <!--          <input type="email" id="email" v-model="form.email" autocomplete="email" autofocus required>-->
        </div>
        <div class="flex flex-col mb-4">
          <label class="text-white" for="password">Password</label>
          <v-input autocomplete="password" autofocus id="password" required type="password" v-model="form.password"/>
        </div>
        <div class="flex flex-col items-center mb-4">
          <vue-recaptcha
            :tabindex="0"
            @verify="callbackVerify($event)"
            @expired="callbackExpired"
            @widgetId="form.recaptcha = $event"
            size="normal"
            theme="dark"
          />
        </div>
        <v-button :class="{'opacity-25' : form.processing}" :disabled="form.processing" type="submit">Login</v-button>
      </form>
    </div>
  </main-layout>

</template>

<script>
  import Input from '@/Components/Input';
  import ValidationErrors from "@/Components/ValidationErrors";
  import Button from '@/Components/Button'
  import {VueRecaptcha} from 'vue3-recaptcha-v2';
  import MainLayout from "@/Layout/MainLayout";
  import {Head, useForm} from '@inertiajs/inertia-vue3';

  export default {
    name: "Login",
    components: {
      'validation-errors': ValidationErrors,
      'v-input': Input,
      'v-button': Button,
      'main-layout': MainLayout,
      VueRecaptcha,
      Head
    },
    data() {
      return {
        form: useForm({
          email: null,
          password: null,
          recaptcha: null
        })
      }
    },
    methods: {
      callbackVerify(response) {
        this.form.recaptcha = response;
      },
      callbackExpired() {
        this.form.recaptcha = null;
      }
    }
  }
</script>

<style scoped>

</style>
