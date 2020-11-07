<template>
    <div class="flex flex-col justify-between">
        <div>
            <template><slot name="title"></slot></template>
            <template><slot name="description"></slot></template>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <form @submit.prevent="$emit('submitted')">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <slot name="form"></slot>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-start px-4 py-3 bg-gray-50 text-left sm:px-6"
                        v-if="hasActions"
                    >
                        <slot name="actions"></slot>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    components: {},

    computed: {
        hasActions() {
            return !!this.$slots.actions;
        }
    }
};
</script>
