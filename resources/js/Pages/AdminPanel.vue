<template>
  <admin-panel-layout>

    <div class="w-full h-full grid grid-cols-6">
      <div v-if="is_proccessing" class="text-white text-5xl flex items-center justify-center fixed inset-0 bg-black bg-opacity-75">Proccessing ...</div>
      <aside class="h-full bg-secondary bg-opacity-75">
        <nav>
          <ul>

            <li class="text-white hover:bg-white hover:bg-opacity-25">
              <Link :href="route('admin_panel.users.index')" class="block w-full text-left py-2 px-4 text-xl font-medium">
                Users
              </Link>
            </li>

            <li class="text-white hover:bg-white hover:bg-opacity-25">

              <Link :href="route('admin_panel.sounds.index')" class="block w-full text-left py-2 px-4 text-xl font-medium">
                Sounds
              </Link>

            </li>
            <li class="text-white hover:bg-white hover:bg-opacity-25">

              <Link :href="route('admin_panel.sounds.disApproved')" class="block w-full text-left py-2 px-4 text-xl font-medium">
                Sounds to approve
              </Link>

            </li>

            <li class="text-white hover:bg-white hover:bg-opacity-25">

              <button @click="partialReload('categories')" class="w-full text-left py-2 px-4 text-xl font-medium">
                Categories
              </button>

            </li>
            <li class="text-white hover:bg-white hover:bg-opacity-25">

              <Link :href="route('admin_panel.complains.index')" class="block w-full text-left py-2 px-4 text-xl font-medium">
                Complains
              </Link>

            </li>
          </ul>
        </nav>
      </aside>

      <section class="w-full col-span-5 px-4 py-2">
        <div class="grid gap-4">

          <template v-if="$page.props.users">
            <h2 class="text-white text-3xl font-medium">
              Users
            </h2>
            <v-button
              @click="isModalActive = !isModalActive"
              class="justify-self-end">Add user</v-button>
            <table class="text-white border-white border-1 border-collapse w-full table-auto" v-if="$page.props.users">
              <thead>
              <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Username</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Block</th>
                <th class="border px-4 py-2">Delete</th>
              </tr>
              </thead>
              <tbody>
              <tr :key="user" class="hover:bg-gray-100 hover:bg-opacity-25 transition-all"
                  v-for="user in $page.props.users.data">
                <td class="border px-4 py-2">{{ user.id }}</td>
                <td class="border px-4 py-2">{{ user.username }}</td>
                <td class="border px-4 py-2">{{ user.email }}</td>
                <td class="border px-4 py-2">
                  <button v-if="!user.is_block"
                          @click="changeBlockStatus(true, user.id)"
                          class="w-full flex justify-center hover:text-red-400" title="Block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                  </button>
                  <button v-else
                          @click="changeBlockStatus(false, user.id)"
                          class="w-full flex justify-center hover:text-primary" title="Unblock">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                    </svg>
                  </button>
                </td>
                <td class="border px-4 py-2">
                  <button type="button"
                          @click="deleteUser(user.id)"
                        class="w-full flex justify-center hover:text-red-400"
                        title="Delete">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </td>
              </tr>
              </tbody>
            </table>

            <div class="flex justify-center">
              <v-button :class="{'opacity-25' : !$page.props.users.prev_page_url,
                                 'hover:bg-transparent' : !$page.props.users.next_page_url,
                                 'hover:text-white' : !$page.props.users.next_page_url,
                                 }"
                        :disabled="!$page.props.users.prev_page_url"
                        @click="prevPage"
                        type="button"
              >
                prev
              </v-button>
              <v-button :class="{'opacity-25' : !$page.props.users.next_page_url,
                                 'hover:bg-transparent' : !$page.props.users.next_page_url,
                                 'hover:text-white' : !$page.props.users.next_page_url,
                                 }"
                        :disabled="!$page.props.users.next_page_url"
                        @click="nextPage"
                        type="button"
              >
                next
              </v-button>
            </div>
          </template>

          <template v-if="$page.props.sounds">
            <h2 class="text-white text-3xl font-medium">
              Sounds
            </h2>
            <table class="text-white border-white border-1 border-collapse w-full table-auto" v-if="$page.props.sounds">
              <thead>
              <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">User</th>
                <th class="border px-4 py-2">Category</th>
              </tr>
              </thead>
              <tbody>
              <tr :key="sound.id" class="hover:bg-gray-100 hover:bg-opacity-25 transition-all"
                  v-for="sound in $page.props.sounds.data">
                <td class="border px-4 py-2">{{ sound.id }}</td>
                <td class="border px-4 py-2">{{ sound.title }}</td>
                <td class="border px-4 py-2">{{ sound.user.username }}</td>
                <td class="border px-4 py-2 text-black">
                  <select class="w-full" name="category" id="category" @change="changeCategory(sound.id, $event.target.value)">
                    <option v-for="category in $page.props.categories" :value="category.id" :selected="sound.categories[0].id === category.id">{{ category.name }}</option>
                  </select>
                </td>
              </tr>
              </tbody>
            </table>
            <div class="flex justify-center">
              <v-button :class="{'opacity-25' : !$page.props.sounds.prev_page_url,
                                  'hover:bg-transparent' : !$page.props.sounds.next_page_url,
                                 'hover:text-white' : !$page.props.sounds.next_page_url,}"
                        :disabled="!$page.props.sounds.prev_page_url"
                        @click="prevPage"
                        type="button"
              >
                prev
              </v-button>
              <v-button :class="{'opacity-25' : !$page.props.sounds.next_page_url,
                                 'hover:bg-transparent' : !$page.props.sounds.next_page_url,
                                 'hover:text-white' : !$page.props.sounds.next_page_url,
                                 }"
                        :disabled="!$page.props.sounds.next_page_url"
                        @click="nextPage"
                        type="button"
              >
                next
              </v-button>
            </div>
          </template>

          <template v-else-if="$page.props.categories">
            <h2 class="text-white text-3xl font-medium">
              Categories
            </h2>
            <v-button class="justify-self-end" type="button">Add Category</v-button>
            <table class="text-white border-white border-1 border-collapse w-full table-auto"
                   v-if="$page.props.categories">
              <thead>
              <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Delete</th>
              </tr>
              </thead>
              <tbody>
              <tr :key="category.id" class="hover:bg-gray-100 hover:bg-opacity-25 transition-all"
                  v-for="category in $page.props.categories">
                <td class="border px-4 py-2">{{ category.id }}</td>
                <td class="border px-4 py-2">{{ category.name }}</td>
                <td class="border px-4 py-2">delete</td>
              </tr>
              </tbody>
            </table>
          </template>

          <template v-if="$page.props.disApprovedSounds">

            <h2 class="text-white text-3xl font-medium">
              Sounds to approve
            </h2>
            <table class="text-white border-white border-1 border-collapse w-full table-auto" v-if="disApprovedSoundsList.length">
              <thead>
              <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Play</th>
                <th class="border px-4 py-2">Approve</th>

              </tr>
              </thead>
              <tbody>
              <tr
                  v-for="sound in disApprovedSoundsList"
                  :key="sound.id" class="hover:bg-gray-100 hover:bg-opacity-25 transition-all"
              >
                <td class="border px-4 py-2">{{ sound.id }}</td>
                <td class="border px-4 py-2">{{ sound.title }}</td>
                <td class="border px-4 py-2">
                  <button class="w-full text-center" @click="sound.isPlayerOpen = !sound.isPlayerOpen">Play</button>
                </td>
                <td class="border px-4 py-2">
                  <button class="w-full text-center" @click="soundApprove(sound.id)">Approve</button>
                </td>

                <v-player
                  v-if="sound.isPlayerOpen"
                  :download-url="route('sound.download', sound.id)"
                  :sound-url="sound.url"
                  @player-close="sound.isPlayerOpen = !sound.isPlayerOpen"
                />
              </tr>
              </tbody>
            </table>
            <h2 class="text-white text-3xl text-center" v-else>There's not sounds to approve</h2>
          </template>

          <template v-if="$page.props.complains">
            <h2 class="text-white text-3xl font-medium">
              Complains
            </h2>
            <table class="text-white border-white border-1 border-collapse w-full table-auto" v-if="disApprovedSoundsList.length">
              <thead>
              <tr>
                <th class="border px-4 py-2">Sound</th>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Play</th>
                <th class="border px-4 py-2">Approve</th>

              </tr>
              </thead>
              <tbody>
              <tr
                v-for="sound in disApprovedSoundsList"
                :key="sound.id" class="hover:bg-gray-100 hover:bg-opacity-25 transition-all"
              >
                <td class="border px-4 py-2">{{ sound.id }}</td>
                <td class="border px-4 py-2">{{ sound.title }}</td>
                <td class="border px-4 py-2">
                  <button class="w-full text-center" @click="sound.isPlayerOpen = !sound.isPlayerOpen">Play</button>
                </td>
                <td class="border px-4 py-2">
                  <button class="w-full text-center" @click="soundApprove(sound.id)">Approve</button>
                </td>

                <v-player
                  v-if="sound.isPlayerOpen"
                  :download-url="route('sound.download', sound.id)"
                  :sound-url="sound.url"
                  @player-close="sound.isPlayerOpen = !sound.isPlayerOpen"
                />
              </tr>
              </tbody>
            </table>
            <h2 class="text-white text-3xl text-center" v-else>There's not complains</h2>
          </template>

          <div v-if="isModalActive"
                       @click.self="isModalActive = !isModalActive"
                       class="fixed inset-0 w-screen h-screen bg-black bg-opacity-50 flex items-center justify-center">
<!--            User Add-->
            <div class="bg-secondary px-12 py-8 w-1/3 grid gap-4">
              <header class="flex justify-between text-white">
                <h3 class="text-xl">User add</h3>
                <button
                  @click="isModalActive = !isModalActive"
                  class="hover:text-primary">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </header>
              <form
                @submit.prevent="storeUser"
                class="grid gap-8">
                <div class="flex flex-col">
                  <label for="username" class="text-white">Username</label>
                  <v-input type="text" name="username" id="username" v-model="userForm.username"></v-input>
                  <div v-if="$page.props.errors.username" class="text-red-400">
                    {{ $page.props.errors.username }}
                  </div>
                </div>
                <div class="flex flex-col">
                  <label for="email" class="text-white">Email</label>
                  <v-input type="email" name="email" id="email" v-model="userForm.email"></v-input>
                  <div v-if="$page.props.errors.email" class="text-red-400">
                    {{ $page.props.errors.email }}
                  </div>
                </div>
                <div class="flex flex-col">
                  <label for="password" class="text-white">Password</label>
                  <v-input type="password" name="password" id="password" v-model="userForm.password"></v-input>
                  <div v-if="$page.props.errors.password" class="text-red-400">
                    {{ $page.props.errors.password }}
                  </div>
                </div>
                <v-button type="submit"
                          :class="{'opacity-25' : userForm.progress,
                                 'hover:bg-transparent' : userForm.progress,
                                 'hover:text-white' : !userForm.progress}"
                          :disabled="userForm.progress">Add</v-button>
              </form>
            </div>

          </div>

        </div>
      </section>

    </div>
  </admin-panel-layout>
</template>

<script>
  import AdminPanelLayout from "@/Layout/AdminPanelLayout";
  import vInput from "@/Components/Input";
  import vButton from "@/Components/Button"
  import vPlayer from "@/Components/Player"
  import {Inertia} from "@inertiajs/inertia";
  import {Link, useForm} from "@inertiajs/inertia-vue3";

  export default {
    name: "AdminPanel",
    components: {
      vInput,
      vButton,
      vPlayer,
      AdminPanelLayout,
      Link
    },
    data() {
      return {
        page: 1,
        is_proccessing: false,
        isModalActive: false,
        userForm: useForm({
          username: null,
          email: null,
          password: null,
        }),
        soundCategory: null,
      }
    },
    computed:{
      disApprovedSoundsList() {
        if(this.$page.props.disApprovedSounds) {
          return this.$page.props.disApprovedSounds.data.map(sound => {
            sound.isPlayerOpen = false;
            return sound;
          })
        }
      },
    },
    methods: {

      storeUser() {
        this.userForm.post(route('admin_panel.users.store'), {
          onSuccess: () => {
            this.isModalActive = !this.isModalActive
            this.userForm.reset()
          }
        })
      },
      deleteUser(id) {
        Inertia.delete(this.route('admin_panel.users.destroy',{id}),{
          onBefore: () => confirm('Are you sure to delete this user? Music published by the user will also be deleted')
        })
      },

      changeCategory(sound_id, category_id) {
        Inertia.put(this.route('admin_panel.sounds.update', {id : sound_id }), {category_id}, {
          onStart:() => this.is_proccessing = true,
          onFinish: () => this.is_proccessing = false
        })
      },
      soundApprove(id) {
        Inertia.post(this.route('admin_panel.sounds.approve',{id}), {}, {
          onBefore: () => confirm('Are you sure to approve this sound?')
        })
      },

      partialReload(data_name) {
        this.page = 1;
        Inertia.reload({only: [data_name], data: {page: this.page}})
      },
      prevPage() {
        this.page--;
        Inertia.reload({
          data: {
            page: this.page
          },
          preserveState: true,
        })
      },
      nextPage() {
        this.page++;
        Inertia.reload({
          data: {
            page: this.page
          },
          preserveState: true,
        })
      },
      changeBlockStatus(is_blocking, user_id) {
        if(is_blocking) {
          Inertia.get(this.route('admin_panel.users.block'),
            { id:user_id },
            {
              onBefore: () => confirm("Are you sure to block this user?")
            }
          );
        } else {
          Inertia.get(this.route('admin_panel.users.unblock'),{ id:user_id },
            {
              onBefore: () => confirm("Are you sure to unblock this user?")
            })
        }
      }
    }
  }
</script>

<style scoped>

</style>
