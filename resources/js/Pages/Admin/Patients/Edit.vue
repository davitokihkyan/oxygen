<script setup>
    import AdminLayout from '@js/Layouts/AdminLayout.vue';
    import NavLink from '@js/Components/NavLink.vue';

    import { Head } from '@inertiajs/vue3';

    const props = defineProps({
        patient: Object
    });

    const goBack = () => {
        window.location.href = route('admin.patients')
    }
</script>

<template>
    <Head title="Patient" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit a Patient - {{ props.patient.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="space-x-4">
                        <NavLink :href="route('admin.patientsEdit', props.patient.id)" :active="route().current('admin.patientsEdit')">
                            Basic
                        </NavLink>
<!--                        <NavLink :href="route('admin.parkingOperatorsEditLocations', props.parkingOperator.id)" :active="route().current('admin.parkingOperatorsEditLocations')">-->
<!--                            Locations-->
<!--                        </NavLink>-->
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
