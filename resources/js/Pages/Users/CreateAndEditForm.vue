<template>
    <AppLayout>
        <template v-slot:breadcrumb>
            <AppBreadCumb :pages="breadCrumbPages" />
        </template>

        <template #header>
            {{ editMode ? "Edit User" : "Create User" }}
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
                                            Email
                                        </label>
                                        <div class="mt-1">
                                            <FormInput
                                                type="email"
                                                v-model="form.email"
                                                name="email"
                                                id="email"
                                                autocomplete="given-email"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                        </div>
                                        <ValidationError>
                                            {{ form.errors.email }}
                                        </ValidationError>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="roles" class="block text-sm font-medium text-gray-700">
                                            Roles
                                        </label>
                                        <div class="mt-1">
                                            <Multiselect
                                                id="roles"
                                                v-model="form.roles"
                                                :options="roles"
                                                :searchable="true"
                                                label="name"
                                                mode="tags"
                                                trackBy="name"
                                                valueProp="id"
                                                placeholder="Select roles" />
                                        </div>
                                        <ValidationError>
                                            {{ form.errors.roles }}
                                        </ValidationError>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-5">
                            <div class="flex justify-end">
                                <CancelButton :href="route('admin.users.index')" /> <SubmitButton />
                            </div>
                        </div>
                    </form>
                </SimpleForm>
            </template>
        </PageContent>
    </AppLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContent from "@/components/PageContent.vue";
import AppBreadCumb from "@/components/AppBreadCumb.vue";
import SimpleForm from "@/components/SimpleForm.vue";
import FormInput from "@/components/FormInput.vue";
import SubmitButton from "@/components/SubmitButton.vue";
import CancelButton from "@/components/CancelButton.vue";
import ValidationError from "@/components/ValidationError.vue";
import Multiselect from "@vueform/multiselect";

const props = defineProps({
    roles: Array,
    user: Object,
    role_user: Array,
});

const editMode = props.user ? true : false;

const form = useForm({
    name: editMode ? props.user?.name : "",
    email: editMode ? props.user?.email : "",
    roles: !editMode ? [] : props.role_user?.map(({ role_id }) => role_id),
});

const submit = () => {
    if (!editMode) form.post(route("admin.users.store"));
    else form.put(route("admin.users.update", props.user.id));
};

const breadCrumbPages = [
    {
        name: "Users",
        href: route("admin.users.index"),
        current: true,
    },
    {
        name: !editMode ? "Create User" : "Update User",
        href: !editMode ? route("admin.users.create") : route("admin.users.edit", props.user.id),
        current: true,
    },
];
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
