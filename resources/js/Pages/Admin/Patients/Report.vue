<script setup>
    import AdminLayout from '@js/Layouts/AdminLayout.vue';
    import ReportFilter from '@js/Pages/Admin/Patients/ReportFilter.vue';
    import Pagination from '@js/Components/Pagination.vue';
    import EditIcon from '@js/Components/Icons/EditIcon.vue';

    import { Head, Link } from '@inertiajs/vue3';

    const props = defineProps({
        patients: Object,
        filters: Object
    });
</script>

<template>
    <Head title="Patients" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Patients</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <ReportFilter :filters="filters"/>

                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Company</th>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Phone Number</th>
                                    <th scope="col" class="px-6 py-3">Address</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="w-1 px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="patient in props.patients.data" :key="patient.id" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 inline-flex gap-2">
                                        {{ patient.company?.name }}
                                        <div :style="{ 'background-color': patient.company?.color, 'width': '50px', 'height': '25px' }"></div>
                                    </td>
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
                                    <td class="px-6 py-4">
                                        <Link :href="route('admin.patientsEdit', patient.id)">
                                            <EditIcon/>
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination
                            :links="props.patients.links"
                            :from="props.patients.from"
                            :to="props.patients.to"
                            :total="props.patients.total" />
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
