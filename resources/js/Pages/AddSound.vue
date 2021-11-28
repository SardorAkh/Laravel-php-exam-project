<template>
  <Head>
    <title>Add Sound</title>
  </Head>
  <main-layout>
    <div class="w-full h-full flex items-center justify-center py-4">
      <form @submit.prevent="form.post(route('sound.store'))" class="bg-secondary w-3/12 p-8">
        <h3 class="text-white font-bold font-indie text-3xl text-center">Sound Upload</h3>

        <validation-errors class="mt-4"/>

        <div class="mt-4 flex flex-col">
          <label for="title" class="text-white">Title</label>
          <v-input type="text" v-model="form.title" id="title"/>
        </div>
        <div class="mt-4 flex flex-col">
          <label for="category" class="text-white">Category</label>
          <select
            v-model="form.category"
            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            id="category">
            <option v-for="category in categories" :key="category.id" :value="category.id">
              {{ category.name }}
            </option>
          </select>
        </div>
        <div class="mt-4 flex flex-col">
          <label for="sound" class="text-white">Sound</label>
          <v-input type="file" class="text-white" @input="form.sound = $event.target.files[0]" id="sound"/>
          <span class="text-yellow-400">File must be under 20mb</span>
        </div>

        <div class="mt-4 flex flex-col">
          <label for="description" class="text-white">Description</label>
          <textarea v-model="form.description" name="description" id="description" rows="10" class="w-full"></textarea>
        </div>
        <div class="w-full mt-4">
          <progress v-if="form.progress" :value="form.progress.percentage" max="100" class="w-full">
            {{ form.progress.percentage }}%
          </progress>
        </div>
        <v-button type="submit" :disabled="form.progress" class="mt-4 w-full">Save</v-button>
      </form>
    </div>
  </main-layout>
</template>

<script>
  import vInput from '@/Components/Input'
  import vButton from '@/Components/Button'
  import MainLayout from "@/Layout/MainLayout";
  import ValidationErrors from "@/Components/ValidationErrors";
  import {Head, useForm} from "@inertiajs/inertia-vue3";

  export default {
    name: "AddSound",
    components:{
      vInput,
      vButton,
      MainLayout,
      ValidationErrors,
      Head,
    },
    props: {
      categories: Array,
    },
    data() {
      return {
        form: useForm({
          title: null,
          category:null,
          user_id: this.$page.props.auth.user.id,
          sound: null,
          description: null,
        })
      }
    },
  }
</script>

<style scoped>

</style>
