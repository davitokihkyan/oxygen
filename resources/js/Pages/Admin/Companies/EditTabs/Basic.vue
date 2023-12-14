<script setup>
    import EditLayout from '../Edit.vue';
    import Delete from '@js/Pages/Admin/Companies/Delete.vue';
    import InputError from '@js/Components/InputError.vue';
    import InputLabel from '@js/Components/InputLabel.vue';
    import PrimaryButton from '@js/Components/PrimaryButton.vue';
    import SecondaryButton from '@js/Components/SecondaryButton.vue';
    import TextInput from '@js/Components/TextInput.vue';
    import Checkbox from '@js/Components/Checkbox.vue';

    import { useForm } from '@inertiajs/vue3';

    const props = defineProps({
        company: Object
    });

    const form = useForm(props.company);

    const goBack = () => {
        window.location.href = route('admin.companies')
    };
</script>

<template>
    <EditLayout :company="props.company">
        <form @submit.prevent="form.put(route('admin.companiesUpdate', props.company.id))" class="space-y-6 max-w-xl">
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
                <InputLabel for="name" value="Color" />

                <TextInput
                    id="color"
                    type="color"
                    class="mt-1 w-12 h-12"
                    v-model="form.color"
                />

                <InputError class="mt-2" :message="form.errors.color" />
            </div>

            <div>
                <InputLabel for="status" value="Status" />

                <Checkbox name="status" v-model="form.active" :checked="!!form.active"/>

                <InputError class="mt-2" :message="form.errors.active" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Update</PrimaryButton>
                <SecondaryButton @click="goBack">Back</SecondaryButton>
            </div>
        </form>

        <Delete :id="props.company.id" />
    </EditLayout>
</template>
