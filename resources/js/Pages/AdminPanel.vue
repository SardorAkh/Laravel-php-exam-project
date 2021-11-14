<template>
  <admin-panel-layout>
    <div class="w-full h-full grid grid-cols-6">
      <aside class="h-full bg-secondary bg-opacity-75">
        <nav>
          <ul>
            <li class="text-white hover:bg-white hover:bg-opacity-25">
              <button @click="partialReload('users')" class="w-full text-left py-2 px-4 text-xl font-medium">
                Users
              </button>
<!--              <Link :href="route('admin_panel')" :only="['users']" class="block py-2 px-4 text-xl font-medium">-->
<!--              Users-->
<!--              </Link>-->
            </li>
            <li class="text-white hover:bg-white hover:bg-opacity-25">

              <button @click="partialReload('sounds')" class="w-full text-left py-2 px-4 text-xl font-medium">
                Sounds
              </button>
<!--              <Link :href="route('admin_panel')" :only="['sounds']" @click="currentTab = 'sounds'"  class="block py-2 px-4 text-xl font-medium">-->
<!--              Sounds-->
<!--              </Link>-->
            </li>
            <li class="text-white hover:bg-white hover:bg-opacity-25">

              <button @click="partialReload('categories')" class="w-full text-left py-2 px-4 text-xl font-medium">
                Categories
              </button>
<!--              <Link :href="route('admin_panel')" :only="['categories']"  class="block py-2 px-4 text-xl font-medium">-->
<!--              Categories-->
<!--              </Link>-->
            </li>
            <li class="text-white hover:bg-white hover:bg-opacity-25">

              <button @click="partialReload('users')" class="w-full text-left py-2 px-4 text-xl font-medium">
                Users
              </button>
<!--              <Link :href="route('admin_panel')" :only="['users']"  class="block py-2 px-4 text-xl font-medium">-->
<!--              Reports-->
<!--              </Link>-->
            </li>
          </ul>
        </nav>
      </aside>
      <section>
        <h2 class="text-white text-3xl font-medium">
          {{ currentTab }}
        </h2>
        <div>
          <ul v-if="$page.props.users">
            <li v-for="user in $page.props.users" :key="user.id">
              {{user.id}} : {{user.username}}
            </li>
          </ul>
        </div>
      </section>
    </div>
  </admin-panel-layout>
</template>

<script>
  import AdminPanelLayout from "@/Layout/AdminPanelLayout";
  import { Inertia } from "@inertiajs/inertia";
  import {Link} from "@inertiajs/inertia-vue3";
  export default {
    name: "AdminPanel",
    components: {
      AdminPanelLayout,
      Link
    },
    data() {
      return {
        currentTab: null,
      }
    },
    methods: {
      partialReload(data_name) {
        this.currentTab = data_name;
        Inertia.reload({only: [data_name]})
        console.log(this.$page);
      }
    }
  }
</script>

<style scoped>

</style>
