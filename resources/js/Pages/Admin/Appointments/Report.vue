<script setup>
    import AdminLayout from '@js/Layouts/AdminLayout.vue';
    import ReportFilter from '@js/Pages/Admin/Appointments/ReportFilter.vue';
    import Pagination from '@js/Components/Pagination.vue';
    import EditIcon from '@js/Components/Icons/EditIcon.vue';

    import { Head, Link } from '@inertiajs/vue3';

    const props = defineProps({
        companies: Object,
        patients: Object,
        appointments: Object,
        filters: Object
    });
</script>

<template>
    <Head title="Appointments" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Appointments</h2>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <ReportFilter :companies="companies" :patients="patients" :filters="filters" />

                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Company</th>
                                    <th scope="col" class="px-6 py-3">Patient</th>
                                    <th scope="col" class="px-6 py-3">Patient Phone</th>
                                    <th scope="col" class="px-6 py-3">Patient Address</th>
                                    <th scope="col" class="px-6 py-3">Date</th>
                                    <th scope="col" class="px-6 py-3">Time</th>
                                    <th scope="col" class="w-1 px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="appointment in props.appointments.data" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 inline-flex gap-2">
                                        {{ appointment.patient?.company?.name }}
                                        <div :style="{ 'background-color': appointment.patient?.company?.color, 'width': '50px', 'height': '25px' }"></div>
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ appointment.patient?.name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ appointment.patient?.phone }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ appointment.patient?.address }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ appointment.date }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ appointment.start_time }} - {{ appointment.end_time }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <Link :href="route('admin.appointmentsEdit', { 'id': appointment.id })">
                                            <EditIcon/>
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination
                            :links="props.appointments.links"
                            :from="props.appointments.from"
                            :to="props.appointments.to"
                            :total="props.appointments.total" />
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
