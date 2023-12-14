<script setup>
    defineProps({
        modelValue: String,
        options: Object
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
        <option v-for="option in options" v-text="option.name || option" :value="option.id || option"></option>
    </select>
</template>
