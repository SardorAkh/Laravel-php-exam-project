<template>
  <ol class="divide-y divide-primary">
    <li v-for="(sound, index) of soundsList"
        :key="sound.id"
        class="text-white flex p-4 py-2"
    >
      {{index + 1}}.
      <div>
        <button @click="sound.isPlayerOpen = !sound.isPlayerOpen">
          {{sound.title}}
        </button>
        <h4 class="">{{sound.user.name}}</h4>
      </div>
      <v-player
        v-if="sound.isPlayerOpen"
        :sound-url="sound.url"
        @player-close="sound.isPlayerOpen = !sound.isPlayerOpen"/>
    </li>
  </ol>
</template>

<script>
import Player from "@/Components/Player";

export default {
  name: "SoundsList",
  components: {
    'v-player' : Player,
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
  }
}
</script>

<style scoped>

</style>
