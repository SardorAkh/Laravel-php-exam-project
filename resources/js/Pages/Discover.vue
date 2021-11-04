<template>
  <main-layout>
    <div class="w-full py-8 h-full grid grid-cols-6 gap-12 pl-20">
      <section class="bg-secondary h-full col-span-5 col-start-1 px-4 py-2">
        <h2 class="text-white text-3xl text-bold">Latest</h2>
        <sounds-list :sounds="sounds" />
      </section>
      <aside class="bg-secondary h-full col-start-6 px-4 py-2 text-center text-white">
        <h2 class="text-3xl text-bold">Categories</h2>
        <ul class="text-2xl">
          <li>Fire</li>
          <li>Fire</li>
          <li>Fire</li>
          <li>Fire</li>
          <li>Fire</li>
          <li>Fire</li>
          <li>Fire</li>
        </ul>
      </aside>
    </div>
  </main-layout>

</template>

<script>
  import MainLayout from "@/Layout/MainLayout";
  import Button from "@/Components/Button";
  import SoundsList from "@/Components/SoundsList";

  export default {
    name: "Discover",
    props: {
      sounds: Object
    },
    components: {
      'v-button': Button,
      'main-layout': MainLayout,
      SoundsList
    },
  }
</script>

<style scoped>

</style>
