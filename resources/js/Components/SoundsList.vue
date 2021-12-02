<template>
  <ol class="grid grid-cols-2">
    <li v-for="(sound, index) of soundsList"
        :class="{'border-r' : index % 2 === 0 }"
        :key="sound.id"
        class="text-white flex p-4 py-2 hover:bg-white hover:bg-opacity-25 transition-all cursor-pointer border-b border-primary border-dashed"
        @click.self="sound.isPlayerOpen = !sound.isPlayerOpen">

      <v-player
        v-if="sound.isPlayerOpen"
        :download-url="route('sound.download', sound.id)"
        :sound-url="sound.url"
        @player-close="sound.isPlayerOpen = !sound.isPlayerOpen"
      />

      <button class="flex items-center mr-4 font-medium"
        @click="sound.isPlayerOpen = !sound.isPlayerOpen">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 transition-all hover:stroke-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
        </svg>
      </button>

      <div class="flex-2">
        <div
          @click="sound.isPlayerOpen = !sound.isPlayerOpen"
          >
          <h2 class="font-medium text-xl">
            {{sound.title}}
          </h2>
        </div>
        <Link :href="route('user_sound',{'username' : sound.user.username, 'id' : sound.user.id})"
              class="z-10 opacity-75 text-sm transition-all hover:stroke-primary">
          {{sound.user.username}}
        </Link>
      </div>

      <div class="flex items-center text-yellow-400" v-if="!sound.is_approved">
        your sound at moderation, it will be at site after administration approve.
      </div>

      <div class="grid grid-cols-2 gap-4 items-center justify-between">
        <a
          title="download"
          :href="route('sound.download', sound.id)"
          class="block flex transition-all hover:text-primary">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </a>
        <button type="button" @click="sound.isModalActive = !sound.isModalActive" class="text-red-500" title="Complain sound">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </button>
      </div>
      <complain-form v-if="sound.isModalActive" :sound-id="sound.id" @change-modal-state="sound.isModalActive = !sound.isModalActive" />
    </li>
  </ol>

</template>

<script>


import Player from "@/Components/Player";
import ComplainForm from "@/Components/ComplainForm";
import { Link } from "@inertiajs/inertia-vue3";
export default {
  name: "SoundsList",
  components: {
    ComplainForm,
    'v-player' : Player,
    Link
  },
  props: {
    sounds : {
      type: Object,
      required: true,
    },
  },
  data() {
    return {

      soundsList: this.sounds.data.map((sound) => {
        return {...sound, isPlayerOpen: false, isModalActive: false}
      }),
    }
  },
  methods: {

  },
}
</script>

<style scoped>

</style>
