<template>
  <main-layout>
    <div class="w-full py-8 h-full">
      <section class="bg-secondary h-full col-span-5 col-start-1 px-4 py-2">
        <h1 class="text-white text-3xl text-center">
          Your Account is blocked.<br>
          Contact with Administrator for unblocking
        </h1>
      </section>
    </div>
  </main-layout>
</template>

<script>
  import MainLayout from "@/Layout/MainLayout";
  export default {
    name: "BlockedPage",
    components: {
      MainLayout
    }
  }
</script>

<style scoped>

</style>
