<template>
  <main-layout>
    <div class="w-full py-8 h-full grid grid-cols-6 gap-12 pl-20">
      <section class="bg-secondary h-full col-span-5 col-start-1">
        <h2 class="text-white text-3xl text-bold">Latest</h2>

        <div v-for="(sound, index) of soundsList" :key="sound.id">
          <v-player :sound-url="sound.url" v-if="sound.isPlayerOpen" @player-close="sound.isPlayerOpen = !sound.isPlayerOpen"/>
          <button @click="sound.isPlayerOpen = !sound.isPlayerOpen">
            {{sound.url}}
          </button>
        </div>


      </section>
      <aside class="bg-secondary h-full col-start-6">Categories</aside>
    </div>
  </main-layout>

</template>

<script>
  import MainLayout from "@/Layout/MainLayout";
  import Player from "@/Components/Player";
  import Button from "@/Components/Button";
  import {Howl} from 'howler';

  export default {
    name: "Discover",
    props: {
      sounds: Array
    },
    components: {
      'v-button': Button,
      'main-layout': MainLayout,
      'v-player': Player,
    },
    data() {
      return {
        soundsList: this.sounds.map((sound) => {
          return {...sound, isPlayerOpen: false}
        }),
        isPlayerOpen: false,
      }
    },
    methods: {
      openPlayer(soundUrl) {

      }
    },
  }
</script>

<style scoped>

</style>
