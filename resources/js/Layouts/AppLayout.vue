<template>
    <div class="flex w-full justify-end">
        <JetBanner class="w-[85%] md:w-[90%]" />
    </div>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Static sidebar for desktop -->
        <SideBar :sidebarOpen="sidebarOpen" @closeSidebar="closeSideBar" :roles="roles" :user="user" />
        <div class="flex flex-1 flex-col md:pl-64">
            <PageHeader @openSidebar="openSidebar" />

            <main>
                <!--  Breadcrumbs -->
                <slot name="breadcrumb" />

                <!-- Page Heading -->
                <header class="bg-white shadow" v-if="$slots.header">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:flex sm:items-center sm:px-6 lg:px-8">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">
                                <slot name="header"></slot>
                            </h1>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <slot name="addbutton"></slot>
                        </div>
                    </div>
                </header>
                <div class="mx-auto max-w-7xl px-4 sm:px-6 md:px-8">
                    <slot></slot>
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import SideBar from "@/components/SideBar.vue";
import PageHeader from "@/components/PageHeader.vue";
import JetBanner from "@/Components/Banner.vue";
import { usePage } from "@inertiajs/vue3";

const sidebarOpen = ref(false);

const closeSideBar = () => {
    sidebarOpen.value = false;
};

const openSidebar = () => {
    sidebarOpen.value = true;
};

const { props } = usePage();

const user = props.auth.user;
const roles = user.roles;
</script>
