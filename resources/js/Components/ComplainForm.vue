<template>
  <div @click.self="$emit('changeModalState')" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center">
    <form
      v-if="$page.props.auth.user"
      class="bg-secondary p-8 px-12 w-1/3" @submit.prevent="sendComplain">
      <div class="flex justify-end">
        <button type="button" @click="$emit('changeModalState')" title="Close">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-all hover:stroke-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <validation-errors class="mb-4"/>

      <div class="flex flex-col mb-4">
        <label for="theme">Theme</label>
        <v-input type="text" v-model="complainForm.theme" id="theme" class="text-black" name="theme"></v-input>
      </div>
      <div class="flex flex-col mb-4">
        <label for="description">Description</label>
        <textarea v-model="complainForm.description" name="description" id="description" class="w-full text-black" rows="10"></textarea>
      </div>
      <v-button type="submit" class="w-full">Send</v-button>
    </form>
    <div v-else class="bg-secondary p-8 px-12 w-1/3">
      <h2 class="text-3xl text-white text-center">You need to log in for report</h2>
    </div>
  </div>
</template>

<script>
  import vInput from "@/Components/Input";
  import vButton from "@/Components/Button";
  import ValidationErrors from "@/Components/ValidationErrors";
  import {useForm} from "@inertiajs/inertia-vue3";

  export default {
    name: "ComplainForm",
    components: {
      vInput,
      vButton,
      ValidationErrors
    },
    emits: ['changeModalState'],
    props: {
      soundId : {
        type: Number,
        required: true,
      }
    },
    data() {
      return {
        complainForm: useForm({
          theme: null,
          description: null,
          sound_id : this.soundId,
          user_id : this.$page.props.auth.user?.id
        })
      }
    },
    methods: {
      sendComplain() {
        this.complainForm.post(this.route('complain'),{
          onSuccess: () => this.$emit('changeModalState')
        })
      }
    }

  }
</script>

<style scoped>

</style>
