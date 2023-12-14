<script setup>
    import AdminLayout from '@js/Layouts/AdminLayout.vue';
    import InputError from '@js/Components/InputError.vue';
    import InputLabel from '@js/Components/InputLabel.vue';
    import PrimaryButton from '@js/Components/PrimaryButton.vue';
    import SecondaryButton from '@js/Components/SecondaryButton.vue';
    import TextInput from '@js/Components/TextInput.vue';

    import { Head, useForm } from '@inertiajs/vue3';

    const form = useForm({
        name: '',
        color: ''
    });

    const goBack = () => {
        window.location.href = route('admin.companies')
    };
</script>

<template>
    <Head title="Company" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create a Company</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="form.post(route('admin.companiesStore'))" class="mt-6 space-y-6 max-w-xl">
                        <div>
                            <InputLabel for="name" value="Name" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 w-full"
                                v-model="form.name"
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div>
                            <InputLabel for="color" value="Color" />

                            <TextInput
                                id="color"
                                type="color"
                                class="mt-1 w-12 h-12"
                                v-model="form.color"
                            />

                            <InputError class="mt-2" :message="form.errors.color" />
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
