<template>
  <main-layout>
    <div class="w-full py-8 h-full grid grid-cols-6 gap-12 pl-20">
      <section class="bg-secondary h-full col-span-5 col-start-1">
        Latest
      </section>
      <aside class="bg-secondary h-full col-start-6">Categories</aside>
    </div>
  </main-layout>
</template>

<script>
  import MainLayout from "@/Layout/MainLayout";

  export default {
    name: "Discover",
    components: {
      'main-layout': MainLayout
    }
  }
</script>

<style scoped>

</style>
