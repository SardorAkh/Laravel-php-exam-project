<template>
  <button :type="type" class="w-full py-2 px-3 border border-white text-center text-white hover:bg-white
  hover:text-secondary active:bg-gray-200 focus:outline-none focus:bg-gray-200 focus:text-secondary
  focus:shadow-outline-primary
  transition ease-in-out duration-150">
    <slot></slot>
  </button>
</template>

<script>
  export default {
    name: "Button",
    props: {
      type: {
        type: String,
        required: true
      }
    }
  }
</script>

<style scoped>

</style>
