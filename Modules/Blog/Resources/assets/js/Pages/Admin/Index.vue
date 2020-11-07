<template>
    <admin-layout>
        <template #header>
            <div class=" flex flex-row justify-between">
                <h1 class=" text-xl">
                    Blog Index
                </h1>
                <ul>
                    <li>
                        <nav-link :href="route('blog::admin.posts.create')">
                            Create Post
                        </nav-link>
                    </li>
                </ul>
            </div>
        </template>
        <card>
            <nav-link
                v-for="post in $page.posts"
                :key="post.slug"
                :href="route('blog::admin.posts.show', {post: post.slug})"
            >
                {{ post.title }}
            </nav-link>
        </card>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import Card from "@/Components/Card";
import NavLink from "@/Jetstream/NavLink";
export default {
    components: { AdminLayout, Card, NavLink }
};
</script>

<style></style>
