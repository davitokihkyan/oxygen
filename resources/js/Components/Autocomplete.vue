<script setup>
    import GoogleAddressAutocomplete from 'vue3-google-address-autocomplete'

    const props = defineProps({
        modelValue: String,
        apiKey: {
            type: String,
            default: 'AIzaSyAmqML4fQefA2UHSbOJv98aWYmby_2K1YA'
        }
    });

    const emit = defineEmits(['update:modelValue']);

    const googleAddressAutocompleteCallback = (place) => {
        emit('update:modelValue', place.formatted_address);
    }
</script>

<template>
    <GoogleAddressAutocomplete
        :apiKey="apiKey"
        class="mt-1 w-full bg-gray-50 border-gray-300 rounded-md shadow-sm"
        @callback="googleAddressAutocompleteCallback"
        :value="modelValue"
        placeholder="Enter an address"
    />
</template>
