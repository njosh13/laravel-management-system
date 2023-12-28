<template>
    <AppLayout>
        <template v-slot:breadcrumb> <AppBreadCumb :pages="breadCrumbPages" /> </template>
        <template #header> My Books </template>
        <template #addbutton>
            <AddButton :href="route('my-books.create')"> Borrow Book </AddButton>
        </template>

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
                            <TData class="text-gray-500">{{ bookLoan.status || "NA" }}</TData>
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
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContent from "@/components/PageContent.vue";
import AppBreadCumb from "@/components/AppBreadCumb.vue";
import SimpleTable from "@/components/SimpleTable.vue";
import Theader from "@/components/SimpleTableHeader.vue";
import TData from "@/components/SimpleTableData.vue";
import Pagination from "@/components/Pagination.vue";
import AddButton from "@/components/AddButton.vue";

const props = defineProps({
    bookLoans: Object,
});

const breadCrumbPages = [
    {
        name: "My Books",
        href: route("my-books.index"),
        current: true,
    },
];

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        Inertia.delete(route("my-books.destroy", id));
    }
}
</script>
