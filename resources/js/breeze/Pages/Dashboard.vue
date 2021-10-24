<template>
    <Head title="Bet" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
            <Link :href="route('post.create')" as="button" type="button">create</Link>

        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <table>
                            <tr v-for="post of posts" :key="post.id">
                                <td>{{post.id}}</td>
                                <td>{{post.title}}</td>
                                <td>{{post.content}}</td>
                                <td><Link :href="route('post.show',{post: post.id})">show</Link></td>
                                <td><Link :href="route('post.edit',{post: post.id})">edit</Link></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeButton from '@/Components/Button.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
      'breeze-button' : BreezeButton
    },
    props: {
        posts: Array
    },
    mounted() {
        console.log(this.posts)
    }
}
</script>
