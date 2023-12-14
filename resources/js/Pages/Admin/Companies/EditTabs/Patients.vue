<script setup>
    import EditLayout from '../Edit.vue';
    import Pagination from '@js/Components/Pagination.vue';
    import EditIcon from '@js/Components/Icons/EditIcon.vue';

    const props = defineProps({
        company: Object,
        patients: Object
    });
</script>

<template>
    <EditLayout :company="props.company">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="w-1/3 px-6 py-3">Name</th>
                <th scope="col" class="w-1/2 px-6 py-3">Short URL</th>
                <th scope="col" class="w-1/3 px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="location in props.parkingLocations.data" :key="location.id" class="bg-white border-b hover:bg-gray-50">
                <td class="px-6 py-4">
                    {{ location.name }}
                </td>
                <td class="px-6 py-4">
                    <a :href="route('signUp.showLocationPackages', { short_url_key: location.short_url_key })" class="text-blue-600 hover:text-blue-800" target="_blank">
                        {{ route('signUp.showLocationPackages', { short_url_key: location.short_url_key }) }}
                    </a>
                </td>
                <td class="px-6 py-4">
                    {{ location.active ? 'Active' : 'Inactive' }}
                </td>
                <td class="px-6 py-4">
                    <a :href="route('admin.parkingLocationsEdit', location.id)" target="_blank">
                        <EditIcon/>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>

        <Pagination :links="props.parkingLocations.links" :from="props.parkingLocations.from" :to="props.parkingLocations.to" :total="props.parkingLocations.total"></Pagination>
    </EditLayout>
</template>
