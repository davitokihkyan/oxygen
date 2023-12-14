<script setup>
    import AdminLayout from '@js/Layouts/AdminLayout.vue';
    import NavLink from '@js/Components/NavLink.vue';

    import { Head } from '@inertiajs/vue3';

    const props = defineProps({
        company: Object
    });
</script>

<template>
    <Head title="Company" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit a Company - {{ props.company.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="space-x-4">
                        <NavLink :href="route('admin.companiesEdit', props.company.id)" :active="route().current('admin.companiesEdit')">
                            Basic
                        </NavLink>
                        <NavLink :href="route('admin.companiesEditPatients', props.company.id)" :active="route().current('admin.companiesEditPatients')">
                            Patients
                        </NavLink>
                    </div>

                    <!-- Page Content -->
                    <div class="mt-6 ">
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
