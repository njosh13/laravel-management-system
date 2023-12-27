<template>
    <div class="bg-transparent p-0">
        <!-- Mobile filter dialog -->
        <TransitionRoot as="template" :show="open">
            <Dialog as="div" class="fixed inset-0 z-40 flex sm:hidden" @close="open = false">
                <TransitionChild
                    as="template"
                    enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100"
                    leave-to="opacity-0">
                    <DialogOverlay class="fixed inset-0 bg-black bg-opacity-25" />
                </TransitionChild>

                <TransitionChild
                    as="template"
                    enter="transition ease-in-out duration-300 transform"
                    enter-from="translate-x-full"
                    enter-to="translate-x-0"
                    leave="transition ease-in-out duration-300 transform"
                    leave-from="translate-x-0"
                    leave-to="translate-x-full">
                    <div
                        class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-6 shadow-xl">
                        <div class="flex items-center justify-between px-4">
                            <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                            <button
                                type="button"
                                class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                @click="open = false">
                                <span class="sr-only">Close menu</span>
                                <XIcon class="h-6 w-6" aria-hidden="true" />
                            </button>
                        </div>

                        <!-- Filters -->
                        <form class="mt-4">
                            <Disclosure
                                as="div"
                                v-for="section in filters"
                                :key="section.name"
                                class="border-t border-gray-200 px-4 py-6"
                                v-slot="{ open }">
                                <h3 class="-mx-2 -my-3 flow-root">
                                    <DisclosureButton
                                        class="flex w-full items-center justify-between bg-white px-2 py-3 text-sm text-gray-400">
                                        <span class="font-medium text-gray-900">
                                            {{ section.name }}
                                        </span>
                                        <span class="ml-6 flex items-center">
                                            <ChevronDownIcon
                                                :class="[open ? '-rotate-180' : 'rotate-0', 'h-5 w-5 transform']"
                                                aria-hidden="true" />
                                        </span>
                                    </DisclosureButton>
                                </h3>
                                <DisclosurePanel class="pt-6">
                                    <div class="space-y-6">
                                        <div
                                            v-for="(option, optionIdx) in section.options"
                                            :key="option.value"
                                            class="flex items-center">
                                            <input
                                                :id="`filter-mobile-${section.id}-${optionIdx}`"
                                                :name="`${section.id}[]`"
                                                :value="`${section.id}-${option.value}`"
                                                type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                v-model="selectedOptions" />
                                            <label
                                                :for="`filter-mobile-${section.id}-${optionIdx}`"
                                                class="ml-3 text-sm text-gray-500">
                                                {{ option.label }}
                                            </label>
                                        </div>
                                    </div>
                                </DisclosurePanel>
                            </Disclosure>
                        </form>
                    </div>
                </TransitionChild>
            </Dialog>
        </TransitionRoot>

        <div class="mx-auto max-w-3xl text-center lg:max-w-7xl">
            <section aria-labelledby="filter-heading">
                <h2 id="filter-heading" class="sr-only">Filters</h2>

                <div class="flex items-center justify-between">
                    <Menu as="div" class="relative z-10 inline-block text-left">
                        <div>
                            <MenuButton
                                v-if="sortOptions.length"
                                class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900">
                                Sort
                                <ChevronDownIcon
                                    class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                    aria-hidden="true" />
                            </MenuButton>
                            <button
                                type="button"
                                @click="clearSelectedOptions"
                                class="w-full rounded-md bg-white py-1.5 px-6 text-gray-500 hover:bg-idg-lightergray hover:text-gray-700">
                                Clear&nbsp;all
                            </button>
                        </div>

                        <transition
                            v-if="sortOptions.length"
                            enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95">
                            <MenuItems
                                class="scrollbar-rounded-sm scrollbar-thin scrollbar-thumb-gray-300 scrollbar-thumb-rounded-md absolute left-0 z-10 mt-2 max-h-80 w-40 origin-top-left rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                    <MenuItem v-for="option in sortOptions" :key="option" v-slot="{ active }">
                                        <a
                                            :href="option.href"
                                            :class="[
                                                active ? 'bg-gray-100' : '',
                                                'block px-4 py-2 text-sm font-medium text-gray-900',
                                            ]">
                                            {{ option.name }}
                                        </a>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>

                    <button
                        type="button"
                        class="inline-block text-sm font-medium text-gray-700 hover:text-gray-900 sm:hidden"
                        @click="open = true">
                        Filters
                    </button>

                    <PopoverGroup class="hidden sm:flex sm:items-baseline sm:space-x-8">
                        <!--Date Filters-->

                        <div class="relative h-full sm:flex sm:items-baseline sm:space-x-8" v-if="displayDates">
                            <button
                                class="w-28 rounded-md bg-white py-2 px-4 text-sm font-medium text-gray-700 hover:text-gray-900"
                                @click="toggleFilterMenu">
                                Filter Date
                            </button>
                            <div
                                class="absolute -left-[32px] my-2 w-40 translate-y-10 rounded-md bg-white px-3 py-5 shadow-lg"
                                v-if="toggleFilter">
                                <div class="my-1 grid text-left text-sm font-medium text-gray-700 hover:text-gray-900">
                                    From
                                    <input
                                        class="group inline-flex rounded-md bg-white py-2 px-3 text-sm font-medium text-gray-700 hover:text-gray-900"
                                        type="date"
                                        v-model="dates.fromDate" />
                                </div>
                                <div class="my-1 grid text-left text-sm font-medium text-gray-700 hover:text-gray-900">
                                    To
                                    <input
                                        class="group inline-flex items-center justify-center rounded-md bg-white py-2 px-3 text-sm font-medium text-gray-700 hover:text-gray-900"
                                        type="date"
                                        v-model="dates.toDate"
                                        v-on:change="toggleFilter = !toggleFilter" />
                                </div>
                            </div>
                        </div>
                        <Popover
                            as="div"
                            v-for="(section, sectionIdx) in filters"
                            :key="section.name"
                            id="desktop-menu"
                            class="relative z-10 inline-block text-left">
                            <div v-if="section.options?.length">
                                <PopoverButton
                                    class="group inline-flex items-center justify-center rounded-md bg-white py-2 px-6 text-sm font-medium text-gray-700 hover:text-gray-900">
                                    <span>{{ section.name }}</span>
                                    <span
                                        class="ml-1.5 rounded bg-gray-200 py-0.5 px-1.5 text-xs font-semibold tabular-nums text-gray-700"
                                        >{{ outputOptions[section.id]?.length || 0 }}</span
                                    >
                                    <ChevronDownIcon
                                        class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                        aria-hidden="true" />
                                </PopoverButton>
                            </div>

                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95">
                                <PopoverPanel
                                    class="scrollbar-rounded-sm scrollbar-thin scrollbar-thumb-gray-300 scrollbar-thumb-rounded-md absolute right-0 mt-2 max-h-80 origin-top-right overflow-x-auto rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <form class="space-y-4">
                                        <div
                                            v-for="(option, optionIdx) in section.options"
                                            :key="option.value"
                                            class="flex items-center">
                                            <input
                                                :id="`filter-${section.id}-${optionIdx}`"
                                                :name="`${section.id}[]`"
                                                :value="`${section.id}-${option.value}`"
                                                type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                v-model="selectedOptions" />
                                            <label
                                                :for="`filter-${section.id}-${optionIdx}`"
                                                class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">
                                                {{ option.label }}
                                            </label>
                                        </div>
                                    </form>
                                </PopoverPanel>
                            </transition>
                        </Popover>
                    </PopoverGroup>
                </div>
            </section>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, reactive } from "vue";
import {
    Dialog,
    DialogOverlay,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    Popover,
    PopoverPanel,
    PopoverButton,
    PopoverGroup,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { XIcon } from "@heroicons/vue/outline";
import { ChevronDownIcon } from "@heroicons/vue/solid";

defineProps({
    filters: {
        type: Array,
        default: () => [],
    },
    sortOptions: {
        type: Array,
        default: () => [],
    },
    modelValue: {
        type: Object,
        default: () => ({}),
    },
    displayDates: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["dataChange"]);

const open = ref(false);
const selectedOptions = ref([]);
const outputOptions = reactive({});
const dates = reactive({
    fromDate: "",
    toDate: "",
});

const arrangeFilters = (value) => {
    const items = value.map((el) => {
        const arr = el.split("-");
        const [key, ...val] = arr;
        return [key, val.join("-")];
    });

    for (const key in outputOptions) {
        delete outputOptions[key];
    }

    items.forEach(([key]) => {
        outputOptions[key] = [];
    });

    items.forEach(([key, val]) => {
        outputOptions[key].push(val);
    });
};

watch(
    () => selectedOptions.value,
    (value) => {
        arrangeFilters(value);
        outputOptions["fromDate"] = dates.fromDate;
        outputOptions["toDate"] = dates.toDate;
        emit("dataChange", outputOptions);
    }
);

watch(dates, () => {
    outputOptions["fromDate"] = dates.fromDate;
    outputOptions["toDate"] = dates.toDate;
    emit("dataChange", outputOptions);
});

const clearSelectedOptions = () => {
    selectedOptions.value = [];
    dates.fromDate = "";
    dates.toDate = "";
};

//filter by date//
const toggleFilter = ref(false);
const toggleFilterMenu = () => {
    toggleFilter.value = !toggleFilter.value;
};
</script>
