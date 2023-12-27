<template>
    <dt class="text-base font-normal text-gray-900">
        <slot name="statName" />
    </dt>
    <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
        <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
            <slot name="stat" />
            <span class="ml-2 text-sm font-medium text-gray-500"
                >from
                <slot name="previousStat" />
            </span>
        </div>

        <div class="inline-flex items-baseline rounded-full px-2.5 py-0.5 text-sm font-medium md:mt-2 lg:mt-0">
            <slot name="arrowIcon" />
            <slot name="change" />
        </div>
    </dd>
</template>
