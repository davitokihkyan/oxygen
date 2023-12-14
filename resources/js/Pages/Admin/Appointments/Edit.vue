<script setup>
    import AdminLayout from '@js/Layouts/AdminLayout.vue';
    import Delete from '@js/Pages/Admin/Appointments/Delete.vue';
    import InputError from '@js/Components/InputError.vue';
    import InputLabel from '@js/Components/InputLabel.vue';
    import PrimaryButton from '@js/Components/PrimaryButton.vue';
    import SecondaryButton from '@js/Components/SecondaryButton.vue';
    import TextInput from '@js/Components/TextInput.vue';
    import Select from '@js/Components/Select.vue';

    import { ref, watch } from "vue";
    import { Head, useForm } from '@inertiajs/vue3';
    import VueTailwindDatepicker from "vue-tailwind-datepicker";

    const props = defineProps({
        appointment: Object,
        patients: Object
    });

    const formatter = ref({
        date: 'MM/DD/YYYY',
        month: 'MMM'
    });

    const form = useForm(props.appointment);

    const goBack = () => {
        window.location.href = route('admin.appointments')
    };
</script>

<template>
    <Head title="Appointment" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit an appointment</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="form.put(route('admin.appointmentsUpdate', form.id))" class="mt-6 space-y-6 max-w-7xl">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <InputLabel for="patient_id" value="Patient" />

                                <Select
                                    id="patient_id"
                                    class="mt-1 w-full bg-gray-50 border-gray-300 rounded-md shadow-sm"
                                    v-model="form.patient_id"
                                    :options="props.patients"
                                    disabled
                                />
                            </div>
                            <div>
                                <InputLabel for="date" value="Date" />

                                <VueTailwindDatepicker
                                    input-classes="bg-gray-50 border-gray-300 rounded-md shadow-sm mt-1 w-full"
                                    v-model="date"
                                    :formatter="formatter"
                                    as-single
                                    disabled
                                />
                            </div>
                        </div>

                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <InputLabel for="start_time" value="Start time" />

                                <TextInput
                                    id="start_time"
                                    type="text"
                                    class="mt-1 w-full"
                                    v-model="form.start_time"
                                    disabled
                                />
                            </div>
                            <div>
                                <InputLabel for="end_time" value="End time" />

                                <TextInput
                                    id="end_time"
                                    type="text"
                                    class="mt-1 w-full"
                                    v-model="form.end_time"
                                    disabled
                                />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <SecondaryButton @click="goBack">Back</SecondaryButton>
                        </div>
                    </form>

                    <Delete :id="form.id" />
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
