<template>
    <admin-layout>
        <template #header>
            <h3 class=" text-xl">BLOG INDEX</h3>
        </template>

        <div>
            <h1>dd</h1>
           
            <div v-for="post in posts" :key="post.id">
                {{ post.title }}
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import Welcome from "@/Jetstream/Welcome";

export default {
    props: {
        posts: Array
    },
    components: { AdminLayout, Welcome }
};
</script>

<style></style>
