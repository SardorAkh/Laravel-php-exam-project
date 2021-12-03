<template>
  <main-layout>
    <div class="h-full w-full flex justify-center items-center py-4">
      <div class="relative w-2/5 h-4/5 bg-secondary pt-2 flex flex-col items-center">
        <h2 class="text-white text-center text-3xl font-work z-40">hi. audiocloud</h2>
        <Link :href="route('discover')" class="justify-self-center z-40 text-white">press here.</Link>
        <div class="absolute inset-0" id="canvasContainer"></div>
      </div>

    </div>
  </main-layout>
</template>

<script>
  import MainLayout from '@/Layout/MainLayout'
  import {Link} from '@inertiajs/inertia-vue3'
  import P5 from 'p5';
  import {sketch} from '@/p5';

  export default {
    name: "Welcome",
    components: {
      'main-layout': MainLayout,
      Link
    },
    mounted() {
      new P5(sketch);
    }
  }
</script>

<style scoped>

</style>
