<template>
    <input
        ref="inputRef"
        :value="modelValue"
        class="block w-full px-3 py-2 mt-1 border-0 rounded-md shadow-sm bg-skin-neutral-1 text-skin-neutral-12 placeholder-skin-neutral-9 ring-1 ring-inset ring-skin-neutral-7 focus:ring-2 focus:ring-inset focus:ring-skin-neutral-7 sm:text-sm sm:leading-6"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>

<script setup>
import { ref } from 'vue'

defineProps({
    modelValue: {
        type: [String, Number],
        default: ''
    }
})

defineEmits(['update:modelValue'])

const inputRef = ref(null)

const focusInput = () => {
    inputRef.value.focus()
}

defineExpose({
    focusInput
})
</script>
