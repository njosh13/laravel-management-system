<template>
    <AppLayout>
        <template v-slot:breadcrumb> <AppBreadCumb :pages="breadCrumbPages" /> </template>
        <template #header> Dashboard </template>

        <PageContent>
            <template #content>
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Last 30 days</h3>
                    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                        <div
                            v-for="item in stats"
                            :key="item.name"
                            class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                            <dt class="truncate text-sm font-medium text-gray-500">{{ item.name }}</dt>
                            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ item.stat }}</dd>
                        </div>
                    </dl>
                </div>
            </template>
        </PageContent>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContent from "@/components/PageContent.vue";
import AppBreadCumb from "@/components/AppBreadCumb.vue";

const stats = [
    { name: "Total Subscribers", stat: "71,897" },
    { name: "Avg. Open Rate", stat: "58.16%" },
    { name: "Avg. Click Rate", stat: "24.57%" },
];

const breadCrumbPages = [];
</script>
