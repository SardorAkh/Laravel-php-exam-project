<template>
  <div class="h-screen flex flex-col justify-items-stretch items-stretch">
    <nav class="bg-secondary py-2 px-4 flex justify-between items-center">
      <h1 class="flex-1 text-5xl font-indie text-white px-4">
        <Link :href="route('home')">audiocloud</Link>
      </h1>

      <template v-if="$page.component != 'Welcome'">
        <div class="flex-2 relative flex items-center">
          <v-input type="text"
                   @keypress.enter="search"
                   v-model="searchValue"
                   class="w-full"
                   placeholder="Search..."/>
          <button @click="search"
                  class="absolute right-2 text-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </button>
        </div>
      </template>


      <template v-if="!$page.props.auth.user">
        <div class="text-white text-3xl font-indie flex flex-1 justify-end">
          <Link :href="route('login')" class="px-2">login</Link>
          <Link :href="route('register')" class="px-2">sign-up</Link>
        </div>
      </template>

      <!--When User is Authorized-->
      <template v-else>
        <div class="px-4 flex-1">
          <Link :href="route('sound.create')" class="px-2 text-3xl text-white font-indie">upload</Link>
        </div>
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

  </div>
</template>

<script>
  import Input from "@/Components/Input";
  import {Link} from "@inertiajs/inertia-vue3";

  export default {
    name: "Main",
    components: {
      'v-input' : Input,
      Link
    },
    data() {
      return {
        searchValue: null,
        isHamburgerPop: false,
      }
    },
    methods: {
      search() {
        console.log(this.searchValue)
      },
    },

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
