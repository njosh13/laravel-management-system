<template>
    <AppLayout>
        <template v-slot:breadcrumb> <AppBreadCumb :pages="breadCrumbPages" /> </template>
        <template #header> Users </template>
        <template #addbutton>
            <AddButton :href="route('admin.users.create')"> Add User </AddButton>
        </template>

        <PageContent>
            <template #content>
                <EmptyState
                    v-if="users.total === 0"
                    :icon="OfficeBuildingIcon"
                    title="No users"
                    description="Get started with adding a new user"
                    action-text="New user"
                    :action-href="route('admin.users.create')" />

                <SimpleTable v-else class="mt-5">
                    <template #thead>
                        <tr>
                            <Theader>Name</Theader>
                            <Theader>Email</Theader>
                            <Theader>Role</Theader>
                            <Theader> Actions </Theader>
                        </tr>
                    </template>
                    <template #tbody>
                        <tr
                            v-for="(user, index) in users.data"
                            :key="user.id"
                            :class="[index % 2 === 0 ? 'bg-white' : 'bg-gray-50']">
                            <TData class="cursor-pointer font-medium text-blue-500">
                                <Link :href="route('admin.users.show', { user })">{{ user.name }} </Link></TData
                            >
                            <TData class="text-gray-500">{{ user.email }}</TData>
                            <TData class="text-gray-500">
                                {{ user.roles?.map((role) => role.name).join() }}
                            </TData>
                            <TData class="space-x-4 whitespace-nowrap">
                                <EditButton :href="route('admin.users.edit', { user })" />
                                <!-- <span aria-hidden="true" class="text-gray-300">|</span> -->
                                <!-- <DeleteButton @click="destroy(user.id)" /> -->
                            </TData>
                        </tr>
                    </template>

                    <template #pagination>
                        <Pagination
                            :from="users.from"
                            :to="users.to"
                            :total="users.total"
                            :links="users.links"
                            :prev-page-url="users.prev_page_url"
                            :next-page-url="users.next_page_url" />
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
    users: Object,
});

const breadCrumbPages = [
    {
        name: "Users",
        href: route("admin.users.index"),
        current: true,
    },
];

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        Inertia.delete(route("admin.users.destroy", id));
    }
}
</script>
