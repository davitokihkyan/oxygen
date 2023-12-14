<script setup>
    import { Link } from '@inertiajs/vue3';

    defineProps({
        links: Array,
        from: Number,
        to: Number,
        total: Number
    })
</script>

<template>
    <nav class="flex items-center justify-between pt-4">
        <span class="text-sm font-normal text-gray-500">Showing <span class="font-semibold text-gray-900">{{ from }} - {{ to }}</span> of <span class="font-semibold text-gray-900">{{ total }}</span></span>
        <ul class="inline-flex -space-x-px text-base h-10">
            <li v-for="link in links">
                <Link
                    v-if="link.active"
                    :href="link.url"
                    v-html="link.label"
                    class="flex items-center justify-center px-3 h-8 text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700"
                ></Link>
                <Link
                    v-else
                    :href="link.url"
                    v-html="link.label"
                    class="flex items-center justify-center px-3 h-8 text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700"
                ></Link>
            </li>
        </ul>
    </nav>
</template>
