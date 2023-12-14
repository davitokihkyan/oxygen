<script setup>
    defineProps({
        modelValue: String,
        options: Object,
        optionKey: {
            type: String,
            default: 'name'
        }
    });

    defineEmits(['update:modelValue']);
</script>

<template>
    <select
        class="bg-gray-50 border-gray-300 rounded-md shadow-sm"
        @change="$emit('update:modelValue', $event.target.value)"
        :value="modelValue"
    >
        <option value="" selected disabled>Select an option</option>
        <option v-for="option in options" v-text="option[optionKey] || option" :value="option.id || option"></option>
    </select>
</template>
