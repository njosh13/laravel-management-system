<template>
    <AppLayout>
        <template v-slot:breadcrumb>
            <AppBreadCumb :pages="breadCrumbPages" />
        </template>

        <template #header>
            {{ editMode ? "Edit Book" : "Create Book" }}
        </template>

        <PageContent>
            <template #content>
                <SimpleForm>
                    <form @submit.prevent="submit" class="space-y-8 divide-y divide-gray-200">
                        <div class="space-y-8 divide-y divide-gray-200">
                            <div class="pt-8">
                                <div class="mt-6 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                                        <div class="mt-1">
                                            <FormInput
                                                type="text"
                                                v-model="form.name"
                                                name="name"
                                                id="name"
                                                autocomplete="given-name"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                        </div>
                                        <ValidationError>
                                            {{ form.errors.name }}
                                        </ValidationError>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="email" class="block text-sm font-medium text-gray-700">
                                            Publisher
                                        </label>
                                        <div class="mt-1">
                                            <FormInput
                                                type="text"
                                                v-model="form.publisher"
                                                name="publisher"
                                                id="publisher"
                                                autocomplete="given-publisher"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                        </div>
                                        <ValidationError>
                                            {{ form.errors.publisher }}
                                        </ValidationError>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="isbn" class="block text-sm font-medium text-gray-700"> Isbn </label>
                                        <div class="mt-1">
                                            <FormInput
                                                type="text"
                                                v-model="form.isbn"
                                                name="isbn"
                                                id="isbn"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                        </div>
                                        <ValidationError>
                                            {{ form.errors.isbn }}
                                        </ValidationError>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="categories" class="block text-sm font-medium text-gray-700">
                                            Category
                                        </label>
                                        <div class="mt-1">
                                            <FormSelect v-model="form.category_id" id="categories" name="categories">
                                                <option value="">---Select Category---</option>
                                                <option
                                                    v-for="category in categories"
                                                    :key="category.id"
                                                    :value="category.id">
                                                    {{ category.name }}
                                                </option>
                                            </FormSelect>
                                        </div>
                                        <ValidationError>
                                            {{ form.errors.roles }}
                                        </ValidationError>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="pages" class="block text-sm font-medium text-gray-700">
                                            Pages
                                        </label>
                                        <div class="mt-1">
                                            <FormInput
                                                type="text"
                                                v-model="form.pages"
                                                name="pages"
                                                id="pages"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                        </div>
                                        <ValidationError>
                                            {{ form.errors.pages }}
                                        </ValidationError>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="pages" class="block text-sm font-medium text-gray-700">
                                            Sub Category
                                        </label>
                                        <div class="mt-1">
                                            <FormInput
                                                type="text"
                                                v-model="form.sub_category"
                                                name="sub_category"
                                                id="sub_category"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                        </div>
                                        <ValidationError>
                                            {{ form.errors.sub_category }}
                                        </ValidationError>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <label for="description" class="block text-sm font-medium text-gray-700">
                                            Description
                                        </label>
                                        <div class="mt-1">
                                            <FormTextArea
                                                v-model="form.description"
                                                id="description"
                                                name="description" />
                                        </div>
                                        <ValidationError>
                                            {{ form.errors.description }}
                                        </ValidationError>
                                    </div>
                                    <div class="sm:col-span-6">
                                        <label for="image">Book Image</label>
                                        <input
                                            id="image"
                                            name="image"
                                            accept="image/*"
                                            type="file"
                                            @input="form.image = $event.target.files[0]"
                                            class="block w-full border border-gray-300 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 disabled:opacity-50 disabled:pointer-events-none bg-white text-gray-100 dark:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 file:border-0 file:bg-gray-100 file:me-4 file:py-2 file:px-4" />
                                        <p>Uploaded File: {{ image[0].name }}</p>
                                        <ValidationError>
                                            {{ form.errors.image }}
                                        </ValidationError>
                                    </div>
                                    <div class="sm:col-span-6">
                                        <label for="preview"> Book Preview </label>

                                        <input
                                            type="file"
                                            id="preview"
                                            name="preview"
                                            accept=".pdf"
                                            @input="form.preview = $event.target.files[0]"
                                            class="block w-full border border-gray-300 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 disabled:opacity-50 disabled:pointer-events-none bg-white text-gray-100 dark:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 file:border-0 file:bg-gray-100 file:me-4 file:py-2 file:px-4" />
                                        <p>Uploaded File: {{ preview[0].name }}</p>

                                        <ValidationError>
                                            {{ form.errors.preview }}
                                        </ValidationError>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-5">
                            <div class="flex justify-end">
                                <CancelButton :href="route('admin.books.index')" /> <SubmitButton />
                            </div>
                        </div>
                    </form>
                </SimpleForm>
            </template>
        </PageContent>
    </AppLayout>
</template>

<script setup>
import { useForm, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContent from "@/components/PageContent.vue";
import AppBreadCumb from "@/components/AppBreadCumb.vue";
import SimpleForm from "@/components/SimpleForm.vue";
import FormInput from "@/components/FormInput.vue";
import SubmitButton from "@/components/SubmitButton.vue";
import CancelButton from "@/components/CancelButton.vue";
import ValidationError from "@/components/ValidationError.vue";
import FormSelect from "@/components/FormSelect.vue";
import FormTextArea from "@/components/FormTextArea.vue";

const props = defineProps({
    categories: Array,
    book: Object,
    preview: Array,
    image: Array,
});

const editMode = props.book ? true : false;

const form = useForm({
    name: editMode ? props.book?.name : "",
    publisher: editMode ? props.book?.publisher : "",
    isbn: editMode ? props.book?.isbn : "",
    sub_category: editMode ? props.book?.sub_category : "",
    category_id: editMode ? props.book?.category_id : "",
    pages: editMode ? props.book?.pages : "",
    description: editMode ? props.book?.description : "",
    preview: editMode ? props.preview : "",
    image: editMode ? props.image : "",
});

const submit = () => {
    if (!editMode) {
        form.post(route("admin.books.store"));
        return;
    }
    router.post(route("admin.books.update", props.book.id), {
        _method: "patch",
        ...form.data(),
    });
};

const breadCrumbPages = [
    {
        name: "Books",
        href: route("admin.books.index"),
        current: true,
    },
    {
        name: !editMode ? "Create Book" : "Update Book",
        href: !editMode ? route("admin.books.create") : route("admin.books.edit", props.book.id),
        current: true,
    },
];
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
