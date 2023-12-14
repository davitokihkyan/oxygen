<script setup>
    import AdminLayout from '@js/Layouts/AdminLayout.vue';
    import InputError from '@js/Components/InputError.vue';
    import InputLabel from '@js/Components/InputLabel.vue';
    import PrimaryButton from '@js/Components/PrimaryButton.vue';
    import SecondaryButton from '@js/Components/SecondaryButton.vue';
    import TextInput from '@js/Components/TextInput.vue';
    import Select from '@js/Components/Select.vue';

    import { ref, watch } from "vue";
    import { Head, useForm } from '@inertiajs/vue3';
    import VueTailwindDatepicker from "vue-tailwind-datepicker";
    import NProgress from 'nprogress'

    const props = defineProps({
        patients: Object
    });

    const formatter = ref({
        date: 'MM/DD/YYYY',
        month: 'MMM'
    });

    const form = useForm({
        patient_id: '',
        name: '',
        date: '',
        start_time: ''
    });

    const date = ref('');
    const times = ref({});

    watch(date, (dateValue) => {
        if (dateValue.length > 0) {
            form.date = dateValue;

            axios.post(route('admin.getAvailableStartTimes'), { date: dateValue })
                .then((response) => {
                    times.value = response.data;
                }).finally(() => {
                NProgress.done();
            });
        }
    });

    const goBack = () => {
        window.location.href = route('admin.appointments');
    };
</script>

<template>
    <Head title="Appointment" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create an appointment</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="form.post(route('admin.appointmentsStore'))" class="mt-6 space-y-6 max-w-7xl">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <InputLabel for="patient_id" value="Patient" />

                                <Select
                                    id="patient_id"
                                    class="mt-1 w-full bg-gray-50 border-gray-300 rounded-md shadow-sm"
                                    label="name"
                                    :options="props.patients"
                                    :reduce="(option) => option.id"
                                    v-model="form.patient_id"
                                />

                                <InputError class="mt-2" :message="form.errors.patient_id" />
                            </div>

                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 w-full"
                                    v-model="form.name"
                                />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                        </div>

                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <InputLabel for="date" value="Date" />

                                <VueTailwindDatepicker
                                    input-classes="bg-gray-50 border-gray-300 rounded-md shadow-sm mt-1 w-full"
                                    v-model="date"
                                    :formatter="formatter"
                                    as-single
                                />

                                <InputError class="mt-2" :message="form.errors.date" />
                            </div>

                            <div>
                                <InputLabel for="date" value="Start time" />

                                <Select
                                    id="color"
                                    class="mt-1 w-full"
                                    v-model="form.start_time"
                                    :options="times"
                                />

                                <InputError class="mt-2" :message="form.errors.start_time" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Submit</PrimaryButton>
                            <SecondaryButton @click="goBack">Back</SecondaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
