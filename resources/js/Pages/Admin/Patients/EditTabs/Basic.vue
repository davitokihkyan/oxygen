<script setup>
    import EditLayout from '../Edit.vue';
    import Delete from '@js/Pages/Admin/Patients/Delete.vue';
    import InputError from '@js/Components/InputError.vue';
    import InputLabel from '@js/Components/InputLabel.vue';
    import PrimaryButton from '@js/Components/PrimaryButton.vue';
    import SecondaryButton from '@js/Components/SecondaryButton.vue';
    import TextInput from '@js/Components/TextInput.vue';
    import Checkbox from '@js/Components/Checkbox.vue';
    import Autocomplete from '@js/Components/Autocomplete.vue';
    import Select from '@js/Components/Select.vue';

    import { useForm } from '@inertiajs/vue3';

    const props = defineProps({
        patient: Object,
        companies: Object
    });

    const form = useForm(props.patient);

    const goBack = () => {
        window.location.href = route('admin.patients')
    };
</script>

<template>
    <EditLayout :patient="props.patient">
        <form @submit.prevent="form.put(route('admin.patientsUpdate', props.patient.id))" class="space-y-6 max-w-xl">
            <div>
                <InputLabel for="company_id" value="Company" />

                <Select
                    id="company_id"
                    class="mt-1 w-full bg-gray-50 border-gray-300 rounded-md shadow-sm"
                    label="name"
                    :options="props.companies"
                    :reduce="(option) => option.id"
                    v-model="form.company_id"
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
                    autofocus
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

            <div>
                <InputLabel for="status" value="Status" />

                <Checkbox name="status" v-model="form.active" :checked="!!form.active" />

                <InputError class="mt-2" :message="form.errors.active" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Update</PrimaryButton>
                <SecondaryButton @click="goBack">Back</SecondaryButton>
            </div>
        </form>

        <Delete :id="props.patient.id" />
    </EditLayout>
</template>
