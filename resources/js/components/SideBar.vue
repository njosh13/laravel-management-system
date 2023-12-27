<template>
    <TransitionRoot as="template" :show="sidebarOpen">
        <Dialog as="div" class="fixed inset-0 z-40 flex md:hidden" @close="closeSidebar">
            <TransitionChild
                as="template"
                enter="transition-opacity ease-linear duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="transition-opacity ease-linear duration-300"
                leave-from="opacity-100"
                leave-to="opacity-0">
                <DialogOverlay class="fixed inset-0 bg-black bg-opacity-75" />
            </TransitionChild>
            <TransitionChild
                as="template"
                enter="transition ease-in-out duration-300 transform"
                enter-from="-translate-x-full"
                enter-to="translate-x-0"
                leave="transition ease-in-out duration-300 transform"
                leave-from="translate-x-0"
                leave-to="-translate-x-full">
                <div class="relative flex w-full max-w-xs flex-1 flex-col pb-0 pt-5 bg-gray-800">
                    <TransitionChild
                        as="template"
                        enter="ease-in-out duration-300"
                        enter-from="opacity-0"
                        enter-to="opacity-100"
                        leave="ease-in-out duration-300"
                        leave-from="opacity-100"
                        leave-to="opacity-0">
                        <div class="absolute right-0 top-0 -mr-12 pt-2">
                            <button
                                type="button"
                                class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                @click="closeSidebar">
                                <span class="sr-only">Close sidebar</span>
                                <XIcon class="h-6 w-6 text-black" aria-hidden="true" />
                            </button>
                        </div>
                    </TransitionChild>
                    <div class="flex flex-shrink-0 items-center px-4">
                        <img class="h-auto w-1/2" src="../../assets/images/Logo.png" alt="Workflow" />
                    </div>
                    <div class="mt-5 h-0 flex-1 overflow-y-auto">
                        <nav class="space-y-1 px-2">
                            <template v-for="item in navigation" :key="item.name">
                                <div v-if="!item.children">
                                    <Link
                                        :key="item.name"
                                        :href="item.href"
                                        :class="[
                                            item.current()
                                                ? 'bg-gray-900 text-white'
                                                : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                                            'group flex items-center rounded-md px-2 py-2 text-sm font-medium',
                                        ]">
                                        <component
                                            :is="item.icon"
                                            class="mr-3 h-6 w-6 flex-shrink-0 text-white"
                                            aria-hidden="true" />
                                        {{ item.name }}
                                    </Link>
                                </div>
                                <Disclosure as="div" v-else-if="item.children" class="space-y-1" v-slot="{ open }">
                                    <DisclosureButton
                                        :class="[
                                            item.current()
                                                ? 'bg-gray-900 text-white'
                                                : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                                            'group flex items-center rounded-md px-2 py-2 text-sm font-medium',
                                        ]">
                                        <component
                                            :is="item.icon"
                                            class="mr-3 h-6 w-6 flex-shrink-0 text-white group-hover:text-gray-500"
                                            aria-hidden="true" />
                                        <span class="flex-1">
                                            {{ item.name }}
                                        </span>
                                        <svg
                                            :class="[
                                                open ? 'rotate-90 text-white' : 'text-white',
                                                'ml-3 h-5 w-5 flex-shrink-0 transform transition-colors duration-150 ease-in-out group-hover:text-gray-400',
                                            ]"
                                            viewBox="0 0 20 20"
                                            aria-hidden="true">
                                            <path d="M6 6L14 10L6 14V6Z" fill="currentColor" />
                                        </svg>
                                    </DisclosureButton>
                                    <DisclosurePanel class="space-y-1">
                                        <Link
                                            v-for="subItem in item.children"
                                            :key="subItem.name"
                                            :class="[
                                                subItem.current()
                                                    ? 'bg-gray-900 text-white'
                                                    : 'text-gray-300 hover:bg-gray-50 hover:text-gray-900',
                                                'group flex w-full items-center rounded-md py-2 pl-11 text-sm font-medium',
                                            ]"
                                            :href="subItem.href">
                                            {{ subItem.name }}
                                        </Link>
                                    </DisclosurePanel>
                                </Disclosure>
                            </template>
                        </nav>
                    </div>
                    <div class="flex flex-shrink-0 bg-gray-700 p-4">
                        <Link :href="route('profile.show')" class="group block flex-shrink-0">
                            <div class="flex items-center">
                                <div>
                                    <img
                                        class="inline-block h-10 w-10 rounded-full"
                                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="" />
                                </div>
                                <div class="ml-3">
                                    <p class="text-base font-medium text-white">{{ user.name }}</p>
                                    <p class="text-sm font-medium text-gray-400 group-hover:text-gray-300">
                                        View profile
                                    </p>
                                </div>
                            </div>
                        </Link>
                    </div>
                </div>
            </TransitionChild>
            <div class="w-14 flex-shrink-0" aria-hidden="true">
                <!-- Dummy element to force sidebar to shrink to fit close icon -->
            </div>
            ;'df'
        </Dialog>
    </TransitionRoot>

    <div class="hidden md:fixed md:inset-y-0 md:flex md:w-64 md:flex-col">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="flex flex-grow flex-col overflow-y-auto border-r-2 bg-gray-800 pt-5">
            <div class="flex flex-shrink-0 items-center px-4">
                <img class="h-auto w-3/4" src="../../assets/images/Logo.png" alt="WizProd" />
            </div>
            <div class="mt-5 flex flex-1 flex-col">
                <nav class="flex-1 space-y-1 px-2 pb-4">
                    <template v-for="item in navigation" :key="item.name">
                        <div v-if="!item.children">
                            <Link
                                :key="item.name"
                                :href="item.href"
                                :class="[
                                    item.current()
                                        ? 'bg-gray-900 text-white'
                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                                    'group flex items-center px-2 py-2 text-sm font-medium rounded-md',
                                ]">
                                <component
                                    :is="item.icon"
                                    :class="[
                                        item.current() ? 'text-gray-300' : 'text-gray-400 group-hover:text-gray-300',
                                        'mr-3 flex-shrink-0 h-6 w-6',
                                    ]"
                                    aria-hidden="true" />
                                {{ item.name }}
                            </Link>
                        </div>
                        <Disclosure
                            as="div"
                            v-else-if="item.children"
                            class="space-y-1"
                            v-slot="{ open }"
                            :default-open="item.current()">
                            <DisclosureButton
                                :class="[
                                    item.current()
                                        ? 'bg-gray-900 text-white'
                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                                    'focus:indigo-800 group flex w-full items-center rounded-md py-2 pl-2 pr-1 text-left text-sm font-medium focus:outline-none focus:ring-2',
                                ]">
                                <component
                                    :is="item.icon"
                                    class="mr-3 h-6 w-6 flex-shrink-0 text-white group-hover:text-gray-500"
                                    aria-hidden="true" />
                                <span class="flex-1">
                                    {{ item.name }}
                                </span>
                                <svg
                                    :class="[
                                        open ? 'rotate-90 text-white' : 'text-white',
                                        'ml-3 h-5 w-5 flex-shrink-0 transform transition-colors duration-150 ease-in-out group-hover:text-white',
                                    ]"
                                    viewBox="0 0 20 20"
                                    aria-hidden="true">
                                    <path d="M6 6L14 10L6 14V6Z" fill="currentColor" />
                                </svg>
                            </DisclosureButton>
                            <DisclosurePanel class="space-y-1">
                                <Link
                                    v-for="subItem in item.children"
                                    :key="subItem.name"
                                    :class="[
                                        subItem.current()
                                            ? 'bg-gray-900 text-white'
                                            : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                                        'group flex w-full items-center rounded-md py-2 pl-11 text-sm font-medium',
                                    ]"
                                    :href="subItem.href">
                                    {{ subItem.name }}
                                </Link>
                            </DisclosurePanel>
                        </Disclosure>
                    </template>
                </nav>
            </div>
            <div class="flex flex-shrink-0 bg-gray-700 p-4">
                <Link :href="route('profile.show')" class="group block w-full flex-shrink-0">
                    <div class="flex items-center">
                        <div>
                            <img
                                class="inline-block h-9 w-9 rounded-full"
                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                alt="" />
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-white">{{ user.name }}</p>
                            <p class="text-xs font-medium text-gray-300 group-hover:text-gray-200">View profile</p>
                        </div>
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    DialogPanel,
} from "@headlessui/vue";
import {
    CalendarIcon,
    DocumentReportIcon,
    HomeIcon,
    InboxIcon,
    UsersIcon,
    UserIcon,
    XIcon,
    CheckIcon,
    OfficeBuildingIcon,
    LockClosedIcon,
    ClipboardCheckIcon,
    FolderOpenIcon,
    FolderIcon,
    StarIcon,
    BriefcaseIcon,
    TicketIcon,
    ShoppingBagIcon,
    UserGroupIcon,
    ChartBarIcon,
    BookOpenIcon,
} from "@heroicons/vue/outline";
import { Link } from "@inertiajs/vue3";

defineProps({
    sidebarOpen: {
        type: Boolean,
        default: false,
    },

    components: {
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
    },

    roles: Array,
    user: Object,
});

const emit = defineEmits(["closeSidebar"]);

const closeSidebar = () => {
    emit("closeSidebar");
};

const navigation = [
    {
        name: "Dashboard",
        href: route("dashboard"),
        icon: HomeIcon,
        current: () => route().current("dashboard"),
    },
    {
        name: "Profile",
        href: route("profile.show"),
        icon: UserIcon,
        current: () => route().current("profile*"),
    },
    {
        name: "Admin",
        icon: LockClosedIcon,
        current: () => route().current("admin*"),
        children: [
            {
                name: "Users",
                href: route("admin.users.index"),
                icon: OfficeBuildingIcon,
                current: () => route().current("admin.users*"),
            },
            {
                name: "Books",
                href: route("admin.books.index"),
                icon: BookOpenIcon,
                current: () => route().current("admin.books*"),
            },
        ],
    },
];
</script>
