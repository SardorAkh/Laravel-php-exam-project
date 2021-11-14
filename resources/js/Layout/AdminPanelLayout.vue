<template>
  <div class="h-screen flex flex-col justify-items-stretch items-stretch bg-secondary bg-opacity-[95%]">
    <nav-bar />
    <main class="flex-2">
      <slot/>
    </main>
  </div>
</template>

<script>
  import Navbar from "@/Components/Navbar"

  export default {
    name: "AdminPanelLayout",
    components: {
      'nav-bar' : Navbar
    },
    data() {
      return {
      }
    },
  }
</script>

<style scoped>

</style>
