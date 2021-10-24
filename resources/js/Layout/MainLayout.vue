<template>
  <div class="h-screen flex flex-col justify-items-stretch items-stretch">
    <nav class="bg-secondary py-2 px-4 flex justify-between items-center">
      <h1 class="text-5xl font-indie text-white">
        <Link :href="route('home')">audiocloud</Link>
      </h1>
      <template v-if="!$page.props.auth.user">
        <div class="text-white text-3xl font-indie flex">
          <Link :href="route('login')" class="px-2">login</Link>
          <Link :href="route('register')" class="px-2">sign-up</Link>
        </div>
      </template>

      <!--When User is Authorized-->
      <template v-else>
        <div class="relative px-4">
          <button @click="isHamburgerPop = !isHamburgerPop"
                  class="text-white text-3xl font-indie text-center">
            Profile
          </button>
          <transition name="slide">
            <ul class="absolute left-0 right-0 top-[140%] bg-white rounded divide-y divide-secondary text-center"
                v-if="isHamburgerPop">
              <li class="py-2 hover:bg-gray-300">settings</li>
              <li class="py-2 hover:bg-gray-300">
                <Link :href="route('logout')" method="POST" as="button"
                class="w-full">Logout</Link>
              </li>
            </ul>
          </transition>
        </div>
      </template>
    </nav>

    <main class="flex-2">
      <slot/>
    </main>

    <footer>
      it is footerman
    </footer>
  </div>
</template>

<script>
  import {Link} from "@inertiajs/inertia-vue3";

  export default {
    name: "Main",
    components: {
      Link
    },
    data() {
      return {
        isHamburgerPop: false
      }
    },
    mounted() {
    }

  }
</script>

<style scoped>
  .slide-enter-active {
    transition: all 0.3s ease-out;
  }

  .slide-leave-active {
    transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
  }

  .slide-enter-from,
  .slide-leave-to {
    transform: translateY(20px);
    opacity: 0;
  }
</style>
