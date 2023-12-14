<script setup>
    import { useCurrencyInput } from 'vue-currency-input'

    const props = defineProps({
        modelValue: Number,
        options: Object
    });

    const { inputRef } = useCurrencyInput(props.options);
</script>

<template>
    <input
        type="text"
        class="bg-gray-50 border-gray-300 rounded-md shadow-sm"
        ref="inputRef"
    />
</template>


