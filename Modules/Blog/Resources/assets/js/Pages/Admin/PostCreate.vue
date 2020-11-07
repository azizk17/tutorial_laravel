<template>
    <admin-layout>
        <template #header>
            <div class=" flex flex-col">
                <h3>
                    Profile Information
                </h3>
                <p>
                    Update your account's profile information and excerpt
                    address.
                </p>
            </div>
        </template>
        <app-form-section @submitted="submit">
            <template #form>
                <!-- Profile Photo -->
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <app-label for="title" value="Title" />
                    <app-input
                        id="title"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.title"
                        autocomplete="title"
                    />
                    <app-input-error
                        :message="form.error('title')"
                        class="mt-2"
                    />
                </div>

                <!-- excerpt -->
                <div class="col-span-6 sm:col-span-4">
                    <app-label for="excerpt" value="Excerpt" />
                    <app-input
                        id="excerpt"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.excerpt"
                    />
                    <app-input-error
                        :message="form.error('excerpt')"
                        class="mt-2"
                    />
                </div>
                <!-- excerpt -->
                <div class="col-span-6 sm:col-span-4">
                    <app-label for="content" value="Content" />
                    <app-input
                        id="content"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.content"
                    />
                    <app-input-error
                        :message="form.error('content')"
                        class="mt-2"
                    />
                </div>
                <!-- excerpt -->
                <div class="col-span-6 sm:col-span-4">
                    <app-label for="category" value="Category" />
                    <select
                        v-model="form.category_id"
                        id="category"
                        class="mt-1 block w-full"
                    >
                        <option v-for="cat in $page.categories" :key="`${cat.id}`" :value="cat.id">
                            {{ cat.name }}
                        </option>
                    </select>
                </div>
            </template>

            <template #actions>
                <app-action-message :on="form.recentlySuccessful" class="mr-3">
                    Saved.
                </app-action-message>

                <app-button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Save
                </app-button>
            </template>
        </app-form-section>
    </admin-layout>
</template>

<script>
import AppButton from "@/Components/Button";
import AppFormSection from "@/Components/FormSection";
import AppInput from "@/Components/Input";
import AppInputError from "@/Components/InputError";
import AppLabel from "@/Components/Label";
import AppActionMessage from "@/Components/ActionMessage";
import AppSecondaryButton from "@/Components/SecondaryButton";
import AdminLayout from "@/Layouts/AdminLayout";
export default {
    components: {
        AppActionMessage,
        AppButton,
        AppFormSection,
        AppInput,
        AppInputError,
        AppLabel,
        AppSecondaryButton,
        AdminLayout
    },

    props: ["user"],

    data() {
        return {
            form: this.$inertia.form(
                {
                    _method: "POST",
                    title: "",
                    excerpt: "",
                    content: "",
                    category_id: "",
                    coverImage: null
                },
                {
                    bag: "submit",
                    resetOnSuccess: false
                }
            ),

            photoPreview: null
        };
    },

    methods: {
        submit() {
            // if (this.$refs.photo) {
            //     this.form.photo = this.$refs.photo.files[0];
            // }

            this.form.post(route("blog::admin.posts.store"), {
                preserveScroll: true
            });
        },

        selectNewPhoto() {
            this.$refs.photo.click();
        },

        updatePhotoPreview() {
            const reader = new FileReader();

            reader.onload = e => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.photo.files[0]);
        },

        deletePhoto() {
            this.$inertia
                .delete(route("current-user-photo.destroy"), {
                    preserveScroll: true
                })
                .then(() => {
                    this.photoPreview = null;
                });
        }
    }
};
</script>
