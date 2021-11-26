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

      <div class="flex items-center mr-4 font-medium">
      {{index + 1}}.
      </div>

      <div
        @click="sound.isPlayerOpen = !sound.isPlayerOpen"
        class="flex-2">
        <h2 class="font-medium text-xl">
          {{sound.title}}
        </h2>
        <h4 class="opacity-75 text-sm">{{sound.user.username}}</h4>
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
        <button type="button" class="text-red-500" title="Complain sound">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </button>
      </div>
    </li>
  </ol>

</template>

<script>

import Player from "@/Components/Player";
import { Link } from "@inertiajs/inertia-vue3";
export default {
  name: "SoundsList",
  components: {
    'v-player' : Player,
    Link
  },
  props: {
    sounds : {
      type: Object,
      required: true,
    }
  },
  data() {
    return {
      soundsList: this.sounds.data.map((sound) => {
        return {...sound, isPlayerOpen: false}
      }),
    }
  },
  methods: {

  },
}
</script>

<style scoped>

</style>
