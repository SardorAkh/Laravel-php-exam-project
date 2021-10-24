<template>
    <Head :title="post.title"/>
    <pre>{{post}}</pre>
</template>

<script>
    import { Head } from '@inertiajs/inertia-vue3'

    export default {
        name: "Post",
        components: {
            Head
        },
        props: {
            post: Object
        }
    }
</script>

<style scoped>

</style>
