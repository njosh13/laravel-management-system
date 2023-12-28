<template>
    <AppLayout>
        <template v-slot:breadcrumb> <AppBreadCumb :pages="breadCrumbPages" /> </template>
        <template #header> Book Loans </template>

        <PageContent>
            <template #content>
                <SimpleTable class="mt-5">
                    <template #thead>
                        <tr>
                            <Theader>Book</Theader>
                            <Theader>Loan Date</Theader>
                            <Theader>Due Date</Theader>
                            <Theader>Extended</Theader>
                            <Theader>Returned date</Theader>
                            <Theader>Status</Theader>
                            <Theader>Penalty Status</Theader>
                            <Theader>Penalty amount</Theader>
                        </tr>
                    </template>
                    <template #tbody>
                        <tr
                            v-for="(bookLoan, index) in bookLoans.data"
                            :key="bookLoan.id"
                            :class="[index % 2 === 0 ? 'bg-white' : 'bg-gray-50']">
                            <TData class="text-bold text-gray-900"> {{ bookLoan.book?.name }} </TData>
                            <TData class="text-gray-500">{{ bookLoan.loan_date }}</TData>
                            <TData class="text-gray-500">{{ bookLoan.due_date }}</TData>
                            <TData class="text-gray-500">{{ bookLoan.extended === 1 ? "True" : "False" }}</TData>
                            <TData class="text-gray-500">{{ bookLoan.return_date || "NA" }}</TData>
                            <TData class="text-gray-500">
                                <td
                                    class="hidden justify-center px-0 py-4 text-left text-sm text-gray-500 sm:table-cell">
                                    <Menu as="div">
                                        <div>
                                            <MenuButton
                                                class="inline-flex w-3/5 justify-center rounded-md border border-gray-300 bg-white px-5 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100">
                                                <span>{{ bookLoan.status }}</span>
                                                <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true" />
                                            </MenuButton>
                                        </div>
                                        <transition
                                            enter-active-class="transition ease-out duration-100"
                                            enter-from-class="transform opacity-0 scale-95"
                                            enter-to-class="transform opacity-100 scale-100"
                                            leave-active-class="transition ease-in duration-75"
                                            leave-from-class="transform opacity-100 scale-100"
                                            leave-to-class="transform opacity-0 scale-95">
                                            <MenuItems
                                                class="absolute z-10 mt-2 w-32 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                <div class="py-1">
                                                    <MenuItem
                                                        as="div"
                                                        v-for="status in statuses"
                                                        :key="status"
                                                        v-slot="{ active }">
                                                        <div
                                                            @click="update_status(bookLoan, status)"
                                                            :class="[
                                                                active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                                                                'block px-4 py-2 text-sm',
                                                                'cursor-pointer',
                                                            ]">
                                                            {{ status }}
                                                        </div>
                                                    </MenuItem>
                                                </div>
                                            </MenuItems>
                                        </transition>
                                    </Menu>
                                </td>
                            </TData>
                            <TData class="text-gray-500">{{ bookLoan.penalty_status || "NA" }}</TData>
                            <TData class="text-gray-500">{{ bookLoan.penalty_amount || "NA" }}</TData>
                        </tr>
                    </template>

                    <template #pagination>
                        <Pagination
                            :from="bookLoans.from"
                            :to="bookLoans.to"
                            :total="bookLoans.total"
                            :links="bookLoans.links"
                            :prev-page-url="bookLoans.prev_page_url"
                            :next-page-url="bookLoans.next_page_url" />
                    </template>
                </SimpleTable>
            </template>
        </PageContent>
    </AppLayout>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/outline";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContent from "@/components/PageContent.vue";
import AppBreadCumb from "@/components/AppBreadCumb.vue";
import SimpleTable from "@/components/SimpleTable.vue";
import Theader from "@/components/SimpleTableHeader.vue";
import TData from "@/components/SimpleTableData.vue";
import Pagination from "@/components/Pagination.vue";

const props = defineProps({
    bookLoans: Object,
    statuses: Array,
});

function update_status(bookLoan, status) {
    bookLoan.status = status;
    Inertia.patch(route("admin.book-loans.update_status", { bookLoan, status }));
}

const breadCrumbPages = [
    {
        name: "Book Loans",
        href: route("admin.book-loans.index"),
        current: true,
    },
];
</script>
