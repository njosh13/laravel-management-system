<template>
    <AppLayout>
        <template #breadcrumb>
            <AppBreadCumb :pages="breadCrumbPages" />
        </template>

        <template #header> {{ book.name }} </template>

        <template #addbutton>
            <EditButtonShow v-if="selectedIndex == 0" :href="route('admin.books.edit', { book })">
                Edit Book
            </EditButtonShow>
        </template>

        <div class="py-12">
            <!-- Tabs -->
            <TabGroup :selected-index="selectedIndex" vertical @change="setSelectedIndex">
                <div class="md:hidden">
                    <label for="tabs" class="sr-only">Select a tab</label>
                    <AppSelect class="w-full" v-model.number="selectedIndex">
                        <option value="">-- Select a tab ---</option>
                        <option v-for="tab in tabs" :key="tab.name" :value="tab.id">
                            {{ tab.name }}
                        </option>
                    </AppSelect>
                </div>
                <TabList class="hidden md:block">
                    <div class="border-b border-gray-200">
                        <TabList aria-label="Tabs" as="nav" class="-mb-px flex">
                            <Tab v-for="tab in tabs" :key="tab.name" v-slot="{ selected }" as="template">
                                <button
                                    class="block outline-none"
                                    :class="[
                                        selected
                                            ? 'border-yellow-500 text-yellow-600'
                                            : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700',
                                        'w-1/2 border-b-2 px-1 py-4 text-center text-sm font-medium',
                                    ]"
                                    type="button">
                                    {{ tab.name }}
                                </button>
                            </Tab>
                        </TabList>
                    </div>
                </TabList>
                <!-- TabPanels -->
                <TabPanels class="pt-4">
                    <TabPanel :as="BookDetailsTabPanel" :book="book" />
                </TabPanels>
            </TabGroup>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref } from "vue";
import { Tab, TabGroup, TabList, TabPanel, TabPanels } from "@headlessui/vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import AppSelect from "@/components/AppSelect.vue";
import BookDetailsTabPanel from "../../components/BookDetailsTabPanel.vue";
import AppBreadCumb from "@/components/AppBreadCumb.vue";
import EditButtonShow from "@/components/EditButtonShow.vue";

const props = defineProps({
    book: Object,
});
const tabs = [
    {
        name: "Book details",
        id: 0,
    },
];

const selectedIndex = ref(Number(localStorage.getItem("selectedIndex")) ?? 0);

const setSelectedIndex = (index) => {
    selectedIndex.value = index;
    localStorage.setItem("selectedIndex", index);
};

const breadCrumbPages = [
    {
        name: "book",
        href: route("admin.books.index"),
        current: false,
    },

    {
        name: props.book.name,
        href: route("admin.books.show", props.book.id),
        current: true,
    },
];
</script>
