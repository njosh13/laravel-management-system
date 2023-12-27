<template>
    <div class="sticky top-0 z-10 flex h-14 flex-shrink-0 bg-white shadow">
        <button
            type="button"
            class="border-r border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden"
            @click="openSidebar">
            <span class="sr-only">Open sidebar</span>
            <MenuAlt2Icon class="h-6 w-6" aria-hidden="true" />
        </button>
        <div class="flex flex-1 items-center justify-between px-4">
            <div class="flex flex-1">
                <h1 class="text-xl font-semibold text-gray-900">{{ greeting }},{{ user.name }}</h1>
            </div>
            <div class="ml-4 flex items-center md:ml-6">
                <button
                    type="button"
                    class="rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <span class="sr-only">View notifications</span>
                    <BellIcon class="h-6 w-6" aria-hidden="true" />
                </button>

                <!-- Profile dropdown -->
                <Menu as="div" class="relative ml-3">
                    <div>
                        <MenuButton
                            class="flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <span class="sr-only">Open user menu</span>
                            <img
                                class="h-8 w-8 rounded-full"
                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                alt="" />
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
                            class="absolute right-0 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                                <a
                                    :href="item.href"
                                    :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']"
                                    >{{ item.name }}</a
                                >
                            </MenuItem>
                            <div class="border-t border-gray-200" />
                            <MenuItem key="Sign out" v-slot="{ active }">
                                <button
                                    :class="[
                                        active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                                        'block w-full px-4 py-2 text-left text-sm',
                                    ]"
                                    @click="logout">
                                    Sign Out
                                </button>
                            </MenuItem>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { BellIcon, MenuAlt2Icon } from "@heroicons/vue/outline";
import { SearchIcon } from "@heroicons/vue/solid";
import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/vue3";

const emits = defineEmits(["openSidebar"]);

const openSidebar = () => {
    emits("openSidebar");
};

const userNavigation = [
    { name: "Your Profile", href: route("profile.show") },
    { name: "Settings", href: "#" },
];

function logout() {
    if (confirm("Are you sure you want to Logout")) {
        Inertia.post(route("logout"));
    }
}

// Give User Greeting based on Time they Log in
const currentTime = ref("");

const getGreeting = () => {
    const currentHour = new Date().getHours();
    let greeting = "";

    if (currentHour >= 5 && currentHour < 12) {
        greeting = "Good Morning";
    } else if (currentHour >= 12 && currentHour < 18) {
        greeting = "Good Afternoon";
    } else {
        greeting = "Good Evening";
    }

    return greeting;
};

const greeting = getGreeting();

onMounted(() => {
    setInterval(() => {
        currentTime.value = new Date().toLocaleTimeString();
    }, 1000);
});

const page = usePage();

const user = computed(() => page.props.auth.user);
</script>
