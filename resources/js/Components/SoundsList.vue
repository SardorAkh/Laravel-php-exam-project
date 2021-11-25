<template>
  <ol class="divide-y divide-primary">
    <li v-for="(sound, index) of soundsList"
        :key="sound.id"
        class="text-white flex p-4 py-2 hover:bg-white hover:bg-opacity-25 transition-all cursor-pointer"
        @click.self="sound.isPlayerOpen = !sound.isPlayerOpen">

      <div class="flex items-center mr-4 font-medium">
      {{index + 1}}.
      </div>
      <div>
        <button @click="sound.isPlayerOpen = !sound.isPlayerOpen" class="font-medium text-xl">
          {{sound.title}}
        </button>
        <h4 class="opacity-75 text-sm">{{sound.user.username}}</h4>
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
