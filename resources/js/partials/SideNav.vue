<template>
    <div class="p-2">
        <h3>
            Side nav
        </h3>
        <nav
            class="flex flex-col w-full text-gray-700 dark-mode:text-gray-200 dark-mode:bg-gray-800 flex-shrink-0"
        >
            <inertia-link
                v-for="r in list"
                :key="r.name"
                :href="route(r.name)"
                class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-gray-200 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
            >
                {{ r.title }}
            </inertia-link>
        </nav>
    </div>
</template>

<script>
export default {
    data() {
        return {
            list: [
                { title: "users", name: "profile.show" },
                { title: "Blog", name: "blog::admin.index" }
            ]
        };
    }
};
</script>

<style></style>
