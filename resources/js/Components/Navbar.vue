<template>
  <nav class="bg-secondary py-2 px-4 flex justify-between items-center">
    <h1 class="flex-1 text-5xl font-indie text-white px-4">
      <Link :href="route('home')" class="hover:text-primary transition-all">
        audiocloud
      </Link>
    </h1>

    <template v-if="currentPage">
      <div class="flex-2 relative flex items-center">
        <v-input @keypress.enter="search"
                 class="w-full"
                 placeholder="Search..."
                 type="text"
                 v-model="searchValue"/>
        <button @click="search"
                class="absolute right-2 text-secondary">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2"/>
          </svg>
        </button>
      </div>
    </template>


    <template v-if="!$page.props.auth.user">
      <div class="text-white text-3xl font-indie flex flex-1 justify-end">
        <Link :href="route('login')" class="px-2 hover:text-primary transition-all">login</Link>
        <Link :href="route('register')" class="px-2 hover:text-primary transition-all">sign-up</Link>
      </div>
    </template>

    <!--When user is blocked-->
    <template v-else-if="$page.component === 'BlockedPage'">
      <div class="text-white text-3xl font-indie flex flex-1 justify-end">
        <Link :href="route('logout')" as="button" class="hover:text-primary transition-all"
              method="POST">Logout
        </Link>
      </div>
    </template>

<!--When User is Admin-->
    <template v-else-if="$page.component === 'AdminPanel'">
      <div class="relative px-4">
        <button @click="isHamburgerPop = !isHamburgerPop"
                class="text-white text-3xl font-indie text-center hover:text-primary transition-all">
          Profile
        </button>
        <transition name="slide">
          <ul class="absolute left-0 right-0 top-[140%] bg-white rounded divide-y divide-secondary text-center"
              v-if="isHamburgerPop">
            <li v-if="$page.props.auth?.is_admin" class="py-2 hover:bg-gray-300">
              <Link :href="route('admin_panel.index')" class="w-full block">Admin Panel</Link>
            </li>
            <li class="py-2 hover:bg-gray-300">settings</li>
            <li class="py-2 hover:bg-gray-300">
              <Link :href="route('logout')" as="button" class="w-full block"
                    method="POST">Logout
              </Link>
            </li>
          </ul>
        </transition>
      </div>
    </template>

    <!--When User is Authorized-->
    <template v-else>
      <div class="px-4 flex-1">
        <Link :href="route('sound.create')" class="px-2 text-3xl text-white font-indie hover:text-primary transition-all">upload</Link>
      </div>
      <div class="relative px-4">
        <button @click="isHamburgerPop = !isHamburgerPop"
                class="text-white text-3xl font-indie text-center hover:text-primary transition-all">
          Profile
        </button>
        <transition name="slide">
          <ul class="absolute left-0 right-0 top-[140%] bg-white rounded divide-y divide-secondary text-center"
              v-if="isHamburgerPop">
            <li v-if="$page.props.auth?.is_admin" class="py-2 hover:bg-gray-300">
              <Link :href="route('admin_panel.index')" class="w-full block">Admin Panel</Link>
            </li>
            <li class="py-2 hover:bg-gray-300">settings</li>
            <li class="py-2 hover:bg-gray-300">
              <Link :href="route('logout')" as="button" class="w-full block"
                    method="POST">Logout
              </Link>
            </li>
          </ul>
        </transition>
      </div>
    </template>

  </nav>
</template>

<script>
  import Input from "@/Components/Input";
  import {Link} from "@inertiajs/inertia-vue3";

  export default {
    name: "Navbar",
    components: {
      'v-input' : Input,
      Link,
    },
    data() {
      return {
        isHamburgerPop: false,
        searchValue: null,
      }
    },
    methods: {
      search(){}
    },
    computed: {
      currentPage() {
        return !(this.$page.component === 'Welcome'
          || this.$page.component === 'BlockedPage'
          || this.$page.component === 'AdminPanel')
      }
    }
  }
</script>

<style scoped>

</style>
