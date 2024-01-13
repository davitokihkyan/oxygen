<script setup>
    import AdminLayout from '@js/Layouts/AdminLayout.vue';
    import ReportFilter from '@js/Pages/Admin/Companies/ReportFilter.vue';
    import Pagination from '@js/Components/Pagination.vue';
    import EditIcon from '@js/Components/Icons/EditIcon.vue';

    import { Head, Link } from '@inertiajs/vue3';

    const props = defineProps({
        companies: Object,
        filters: Object
    });
</script>

<template>
    <Head title="Companies" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Companies</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <ReportFilter :filters="filters"/>

                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Color</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="w-1 px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="company in props.companies.data" :key="company.id" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        {{ company.name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div :style="{ 'background-color': company.color, 'width': '50px', 'height': '25px' }"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ company.active ? 'Active' : 'Inactive' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <Link :href="route('admin.companiesEdit', company.id)">
                                            <EditIcon/>
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination
                            :links="props.companies.links"
                            :from="props.companies.from"
                            :to="props.companies.to"
                            :total="props.companies.total"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
