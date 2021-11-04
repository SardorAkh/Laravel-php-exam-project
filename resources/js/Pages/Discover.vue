<template>
  <main-layout>
    <div class="w-full py-8 h-full grid grid-cols-6 gap-12 pl-20">
      <section class="bg-secondary h-full col-span-5 col-start-1 px-4 py-2">
        <h2 class="text-white text-3xl text-bold">Latest</h2>
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

      </section>
      <aside class="bg-secondary h-full col-start-6 px-4 py-2">
        Categories
      </aside>
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
      sounds: Object
    },
    components: {
      'v-button': Button,
      'main-layout': MainLayout,
      'v-player': Player,
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
