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
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Phone Number</th>
                <th scope="col" class="px-6 py-3">Address</th>
                <th scope="col" class="px-6 py-3">Status</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="patient in props.patients.data" :key="patient.id" class="bg-white border-b hover:bg-gray-50">
                <td class="px-6 py-4">
                    {{ patient.name }}
                </td>
                <td class="px-6 py-4">
                    {{ patient.phone }}
                </td>
                <td class="px-6 py-4">
                    {{ patient.address }}
                </td>
                <td class="px-6 py-4">
                    {{ patient.active ? 'Active' : 'Inactive' }}
                </td>
            </tr>
            </tbody>
        </table>

        <Pagination
            :links="props.patients.links"
            :from="props.patients.from"
            :to="props.patients.to"
            :total="props.patients.total" />
    </EditLayout>
</template>
