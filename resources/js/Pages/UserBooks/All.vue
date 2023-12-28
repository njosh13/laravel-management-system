<template>
    <AppLayout>
        <template v-slot:breadcrumb> <AppBreadCumb :pages="breadCrumbPages" /> </template>
        <template #header> Books </template>
        <PageContent>
            <template #content>
                <div class="mt-2">
                    <div class="mb-2">
                        <input
                            type="text"
                            v-model="search"
                            placeholder="Search..."
                            class="block w-60 rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" />
                    </div>
                </div>
                <Filters :filters="filters" @dataChange="filterChange($event)" />
                <div>
                    <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
                        <h2 class="sr-only">Books</h2>

                        <div
                            class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-10 lg:grid-cols-3 lg:gap-x-8">
                            <div
                                v-for="book in books"
                                :key="book.id"
                                class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white">
                                <div
                                    class="aspect-w-3 aspect-h-4 bg-gray-200 group-hover:opacity-75 sm:aspect-none sm:h-96">
                                    <img
                                        v-if="book.media && book.media.length > 0"
                                        :src="book.image_url.replace('http://localhost/', '')"
                                        class="h-full w-full object-cover object-center sm:h-full sm:w-full" />

                                    <img v-else :alt="imageAlt" />
                                </div>
                                <div class="flex flex-1 flex-col space-y-2 p-4">
                                    <h3 class="text-sm font-medium text-gray-900">
                                        <a :href="book.href">
                                            <span aria-hidden="true" class="absolute inset-0" />
                                            {{ book.name }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-gray-500">{{ book.description }}</p>
                                    <div class="flex flex-1 flex-col justify-end">
                                        <p class="text-sm italic text-gray-900">Publisher : {{ book.publisher }}</p>
                                        <p class="text-sm text-gray-900">Pages: {{ book.pages }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </PageContent>
    </AppLayout>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { watch, ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContent from "@/components/PageContent.vue";
import AppBreadCumb from "@/components/AppBreadCumb.vue";
import Filters from "@/components/Filters.vue";
import EmptyState from "@/components/EmptyState.vue";
import SimpleTable from "@/components/SimpleTable.vue";
import Theader from "@/components/SimpleTableHeader.vue";
import { OfficeBuildingIcon } from "@heroicons/vue/outline";
import TData from "@/components/SimpleTableData.vue";
import Pagination from "@/components/Pagination.vue";
import EditButton from "@/components/EditButton.vue";
import DeleteButton from "@/components/DeleteButton.vue";
import AddButton from "@/components/AddButton.vue";

const props = defineProps({
    books: Object,
    categories: Array,
    publishers: Array,
});

const imageAlt = "Book Image";

const search = ref("");
let searchTimer = null;

const handleSearch = (value) => {
    clearTimeout(searchTimer); // Clear previous timer

    // Set a new timer to delay the search request
    searchTimer = setTimeout(() => {
        const query = {
            search: value,
        };

        router.visit(route("books.all"), {
            data: query,
            preserveState: true,
        });
    }, 300); // Adjust the delay time as needed
};
watch(search, handleSearch);

const filterOptions = ref({});

const filters = [
    {
        id: "category",
        name: "category",
        options: props.categories?.map((el) => ({ value: el.id, label: el.name })) || [],
    },
    {
        id: "publisher",
        name: "Publisher",
        options: props.publishers?.map((value) => ({ value, label: value })) || [],
    },
];

const filterChange = (data) => {
    const query = {
        category: data["category"],
        publisher: data["publisher"],
    };

    filterOptions.value = query;

    router.visit(route("books.all"), {
        data: query,
        preserveState: true,
    });
};

const breadCrumbPages = [
    {
        name: "Books",
        href: route("books.all"),
        current: true,
    },
];
</script>
