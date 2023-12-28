<template>
    <AppLayout>
        <template v-slot:breadcrumb>
            <AppBreadCumb :pages="breadCrumbPages" />
        </template>

        <template #header>
            {{ editMode ? "Edit Book Loan" : "Create Book Loan" }}
        </template>

        <PageContent>
            <template #content>
                <SimpleForm>
                    <form @submit.prevent="submit" class="space-y-8 divide-y divide-gray-200">
                        <div class="space-y-8 divide-y divide-gray-200">
                            <div class="pt-8">
                                <div class="mt-6 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="roles" class="block text-sm font-medium text-gray-700">
                                            Book
                                        </label>
                                        <div class="mt-1">
                                            <Multiselect
                                                v-model="form.book_id"
                                                :options="books"
                                                :searchable="true"
                                                label="name"
                                                trackBy="name"
                                                valueProp="id"
                                                placeholder="Select Book" />
                                        </div>
                                        <ValidationError>
                                            {{ form.errors.roles }}
                                        </ValidationError>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="due_date" class="block text-sm font-medium text-gray-700">
                                            Due Date
                                        </label>
                                        <div class="mt-1">
                                            <FormDate v-model="form.due_date" name="due_date" id="due_date" />
                                        </div>
                                        <ValidationError>
                                            {{ form.errors.due_date }}
                                        </ValidationError>
                                    </div>

                                    <div v-if="editMode">
                                        <label for="due_date" class="block text-sm font-medium text-gray-700">
                                            Extended Date
                                        </label>
                                        <div class="mt-1">
                                            <FormDate v-model="form.due_date" name="due_date" id="due_date" />
                                        </div>
                                        <ValidationError>
                                            {{ form.errors.due_date }}
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
import FormDate from "../../components/FormDate.vue";
import Multiselect from "@vueform/multiselect";

const props = defineProps({
    books: Array,
    bookLoan: Object,
    preview: Object,
});

const editMode = props.bookLoan ? true : false;

const form = useForm({
    book_id: editMode ? props.bookLoan?.book_id : "",
    loan_date: editMode ? props.bookLoan?.loan_date : "",
    due_date: editMode ? props.bookLoan?.due_date : "",
});

const submit = () => {
    if (!editMode) {
        form.post(route("my-books.store"));
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
        href: route("my-books.index"),
        current: true,
    },
    {
        name: !editMode ? "Create Book" : "Update Book",
        href: !editMode ? route("my-books.create") : route("admin.books.edit", props.bookLoan.id),
        current: true,
    },
];
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
