<template>
  <div class="h-screen flex flex-col justify-items-stretch items-stretch"
    :style="{ backgroundImage : 'url(' + $page.props.assets.bgImage + ')' }">
    <nav-bar />
    <main class="flex-2">
      <slot/>
    </main>
  </div>
</template>

<script>
  import Navbar from "@/Components/Navbar"

  export default {
    name: "MainLayout",
    components: {
     'nav-bar' : Navbar
    },
    data() {
      return {}
    },
  }
</script>

<style scoped></style>
