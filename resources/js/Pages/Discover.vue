<template>
  <Head>
    <title>Discover</title>
  </Head>
  <main-layout>
    <div class="w-full py-8 h-full grid grid-cols-6 gap-12 pl-20">
      <section class="bg-secondary h-full col-span-5 col-start-1 px-4 py-2">
        <h2 class="text-white text-3xl text-bold">{{title}}</h2>

        <sounds-list v-if="sounds.data.length" :sounds="sounds" />
        <h4 class="text-white text-2xl text-center" v-else>There is not sound yet :)</h4>
      </section>
      <aside class="bg-secondary h-full col-start-6 px-4 py-2 text-center text-white">
        <h2 class="text-3xl text-bold">Categories</h2>
        <ul class="text-2xl">
          <li v-for="category in categories"
              :key="category.id"
              class="hover:text-primary"
          >
            <Link :href="route('sound.category.show', category.id)" class="block">{{ category.name }}</Link>
          </li>
          <li class="hover:text-primary">
            <Link :href="route('discover')" class="block">All</Link>
          </li>
        </ul>
      </aside>
    </div>
  </main-layout>

</template>

<script>
  import MainLayout from "@/Layout/MainLayout";
  import SoundsList from "@/Components/SoundsList";
  import {Link, Head} from "@inertiajs/inertia-vue3";

  export default {
    name: "Discover",
    components: {
      'main-layout': MainLayout,
      SoundsList,
      Link, Head,
    },
    props: {
      title: String,
      sounds: Object,
      categories: Array,
    },


  }
</script>

<style scoped>

</style>
