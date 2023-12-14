<script setup>
    import SearchIcon from '@js/Components/Icons/SearchIcon.vue';
    import PrimaryButton from '@js/Components/PrimaryButton.vue';
    import VueTailwindDatepicker from "vue-tailwind-datepicker";

    import { ref, watch } from "vue";
    import { Link, router } from "@inertiajs/vue3";

    const props = defineProps({
        companies: Object,
        patients: Object,
        filters: Object
    });

    const formatter = ref({
        date: 'MM/DD/YYYY',
        month: 'MMM'
    });

    const search = ref(props.filters.search);
    const company = ref(props.filters.company_id);
    const patient = ref(props.filters.patient_id);
    const status = ref(props.filters.status);
    const date = ref(props.filters.date);

    watch([
        search,
        company,
        patient,
        status,
        date
    ], ([
        searchValue,
        companyValue,
        patientValue,
        statusValue,
        dateValue
    ]) => {
        router.get(
            route('admin.appointments'),
            {
                search: searchValue,
                company_id: companyValue,
                patient_id: patientValue,
                status: statusValue,
                date: dateValue
            },
            {
                preserveState: true,
                replace: true
            }
        )
    });
</script>

<template>
    <div id="filter-block" class="flex justify-between items-center pt-3 pb-3 bg-white">
        <div class="flex ml-5 gap-4">
            <div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <SearchIcon/>
                    </div>
                    <input v-model="search" type="text" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-50 bg-gray-50" placeholder="Search">
                </div>
            </div>
            <div>
                <select v-model="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-40 p-2">
                    <option value="">Select company</option>
                    <option v-for="company in props.companies" v-text="company.name" :value="company.id"></option>
                </select>
            </div>
            <div>
                <select v-model="patient" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-40 p-2">
                    <option value="">Select patient</option>
                    <option v-for="patient in props.patients" v-text="patient.name" :value="patient.id"></option>
                </select>
            </div>
            <div>
                <select v-model="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-40 p-2">
                    <option value="">Select status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
            <div>
                <VueTailwindDatepicker
                    v-model="date"
                    :formatter="formatter"
                    as-single
                    use-range
                    input-classes="block p-2 text-sm text-gray-900 border border-gray-300 rounded-lg w-56 bg-gray-50"
                    placeholder="Date"
                    separator=" to "
                />
            </div>
        </div>
        <div class="mr-5">
            <Link :href="route('admin.appointmentsCreate')">
                <PrimaryButton>Create</PrimaryButton>
            </Link>
        </div>
    </div>
</template>
