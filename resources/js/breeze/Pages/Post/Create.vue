<template>
  <Head title="Create Post"/>
  <BreezeValidationErrors class="mb-4" />

  <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
    {{ status }}
  </div>

  <form @submit.prevent="form.post(route('post.store'))">
    <div>
      <BreezeLabel for="title" value="Title" />
      <BreezeInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus />
    </div>

    <div class="mt-4">
      <BreezeLabel for="content" value="Password" />
      <BreezeInput id="content" type="text" class="mt-1 block w-full" v-model="form.content" required  />
    </div>


    <div class="flex items-center justify-end mt-4">

      <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Save
      </BreezeButton>
    </div>
  </form>
</template>

<script>

  import BreezeButton from '@/Components/Button.vue'
  import BreezeCheckbox from '@/Components/Checkbox.vue'
  import BreezeGuestLayout from '@/Layouts/Guest.vue'
  import BreezeInput from '@/Components/Input.vue'
  import BreezeLabel from '@/Components/Label.vue'
  import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
  import {Head, useForm } from '@inertiajs/inertia-vue3';
  export default {
    name: "Create",
    components:{
      BreezeButton,
      BreezeCheckbox,
      BreezeInput,
      BreezeLabel,
      BreezeValidationErrors,
      Head
    },
    props: {
      status: String,
    },
    data() {
      return {
        form: useForm({
          title : null,
          content : null,
        })
      }
    },
    mounted() {
      console.log(this.$page)
    }
  }
</script>

<style scoped>

</style>
