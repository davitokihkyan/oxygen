<script setup>
    import AdminLayout from '@js/Layouts/AdminLayout.vue';
    import InputError from '@js/Components/InputError.vue';
    import InputLabel from '@js/Components/InputLabel.vue';
    import PrimaryButton from '@js/Components/PrimaryButton.vue';
    import SecondaryButton from '@js/Components/SecondaryButton.vue';
    import TextInput from '@js/Components/TextInput.vue';
    import Autocomplete from '@js/Components/Autocomplete.vue';
    import Select from '@js/Components/Select.vue';

    import { Head, useForm } from '@inertiajs/vue3';

    const props = defineProps({
        companies: Object
    });

    const form = useForm({
        company_id: '',
        name: '',
        email: '',
        phone: '',
        address: ''
    });

    const goBack = () => {
        window.location.href = route('admin.patients')
    };
</script>

<template>
    <Head title="Patient" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create a Patient</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="form.post(route('admin.patientsStore'))" class="mt-6 space-y-6 max-w-xl">
                        <div>
                            <InputLabel for="company_id" value="Company" />

                            <Select
                                id="company_id"
                                class="mt-1 w-full bg-gray-50 border-gray-300 rounded-md shadow-sm"
                                v-model="form.company_id"
                                :options="companies"
                            />

                            <InputError class="mt-2" :message="form.errors.company_id" />
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

                        <div>
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                type="text"
                                class="mt-1 w-full"
                                v-model="form.email"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div>
                            <InputLabel for="phone" value="Phone Number" />

                            <TextInput
                                id="phone"
                                type="text"
                                class="mt-1 w-full"
                                v-model="form.phone"
                            />

                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>

                        <div>
                            <InputLabel for="address" value="Address" />

                            <Autocomplete
                                v-model="form.address"
                            />
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
