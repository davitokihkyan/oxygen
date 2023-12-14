<script setup>
    import SearchIcon from '@js/Components/Icons/SearchIcon.vue';
    import PrimaryButton from '@js/Components/PrimaryButton.vue';

    import { ref, watch } from "vue";
    import { Link, router } from "@inertiajs/vue3";

    const props = defineProps({
        filters: Object
    });

    const search = ref(props.filters.search);
    const status = ref(props.filters.status);

    watch([
        search,
        status
    ], ([
        searchValue,
        statusValue
    ]) => {
        router.get(
            route('admin.companies'),
            {
                search: searchValue,
                status: statusValue
            },
            {
                preserveState: true,
                replace: true
            }
        )
    });
</script>

<template>
    <div id="filter-block" class="flex justify-between items-center pt-3 pb-3 bg-white">
        <div class="flex ml-5 gap-4">
            <div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <SearchIcon/>
                    </div>
                    <input v-model="search" type="text" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-50 bg-gray-50" placeholder="Search">
                </div>
            </div>
            <div>
                <select v-model="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-40 p-2">
                    <option value="">Select status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
        </div>

        <div class="mr-5">
            <Link :href="route('admin.companiesCreate')">
                <PrimaryButton>Create</PrimaryButton>
            </Link>
        </div>
    </div>
</template>
