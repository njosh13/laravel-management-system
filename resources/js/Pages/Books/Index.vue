<template>
    <AppLayout>
        <template v-slot:breadcrumb> <AppBreadCumb :pages="breadCrumbPages" /> </template>
        <template #header> Books </template>
        <template #addbutton>
            <AddButton :href="route('admin.books.create')"> Add Book </AddButton>
        </template>

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
                <SimpleTable class="mt-5">
                    <template #thead>
                        <tr>
                            <Theader>Name</Theader>
                            <Theader>Publisher</Theader>
                            <Theader>ISBN</Theader>
                            <Theader>Category</Theader>
                            <Theader>Created by</Theader>
                            <Theader>Actions</Theader>
                        </tr>
                    </template>
                    <template #tbody>
                        <tr
                            v-for="(book, index) in books.data"
                            :key="book.id"
                            :class="[index % 2 === 0 ? 'bg-white' : 'bg-gray-50']">
                            <TData class="cursor-pointer font-medium text-blue-500">
                                <Link :href="route('admin.books.show', { book })">{{ book.name }} </Link></TData
                            >
                            <TData class="text-gray-500">{{ book.publisher }}</TData>
                            <TData class="text-gray-500">{{ book.isbn }}</TData>
                            <TData class="text-gray-500">{{ book.category?.name }}</TData>
                            <TData class="text-gray-500">{{ book.creator?.name }}</TData>
                            <TData class="space-x-4 whitespace-nowrap">
                                <EditButton :href="route('admin.books.edit', { book })" />
                                <span aria-hidden="true" class="text-gray-300">|</span>
                                <DeleteButton @click="destroy(book.id)" />
                            </TData>
                        </tr>
                    </template>

                    <template #pagination>
                        <Pagination
                            :from="books.from"
                            :to="books.to"
                            :total="books.total"
                            :links="books.links"
                            :prev-page-url="books.prev_page_url"
                            :next-page-url="books.next_page_url" />
                    </template>
                </SimpleTable>
            </template>
        </PageContent>
    </AppLayout>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { watch, ref } from "vue";
import { router } from "@inertiajs/vue3";
import { BookOpenIcon } from "@heroicons/vue/outline";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContent from "@/components/PageContent.vue";
import AppBreadCumb from "@/components/AppBreadCumb.vue";
import EmptyState from "@/components/EmptyState.vue";
import SimpleTable from "@/components/SimpleTable.vue";
import Theader from "@/components/SimpleTableHeader.vue";
import TData from "@/components/SimpleTableData.vue";
import Pagination from "@/components/Pagination.vue";
import EditButton from "@/components/EditButton.vue";
import DeleteButton from "@/components/DeleteButton.vue";
import AddButton from "@/components/AddButton.vue";
import Filters from "@/components/Filters.vue";

const props = defineProps({
    books: Object,
    categories: Array,
    publishers: Array,
    users: Array,
});

const search = ref("");
let searchTimer = null;

const handleSearch = (value) => {
    clearTimeout(searchTimer); // Clear previous timer

    // Set a new timer to delay the search request
    searchTimer = setTimeout(() => {
        const query = {
            search: value,
        };

        router.visit(route("admin.books.index"), {
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
    {
        id: "creator",
        name: "Creator",
        options: props.users?.map((value) => ({ value, label: value })) || [],
    },
];

const filterChange = (data) => {
    const query = {
        category: data["category"],
        publisher: data["publisher"],
        creator: data["creator"],
    };

    filterOptions.value = query;

    router.visit(route("admin.books.index"), {
        data: query,
        preserveState: true,
    });
};

const breadCrumbPages = [
    {
        name: "Books",
        href: route("admin.books.index"),
        current: true,
    },
];

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        Inertia.delete(route("admin.books.destroy", id));
    }
}
</script>
