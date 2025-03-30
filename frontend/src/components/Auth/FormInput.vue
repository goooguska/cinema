<script setup>
defineProps({
  label: String,
  type: {
    type: String,
    default: 'text'
  },
  placeholder: {
    type: String,
    default: ''
  },
  modelValue: [String, Number]
});
</script>

<template>
  <div class="auth-popup__input-group">
    <label>{{ label }}</label>
    <input
        :type="type"
        :placeholder="placeholder"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="auth-popup__input"
    >
  </div>
</template>

<style scoped>
.auth-popup__input-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.auth-popup__input {
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-size: 16px;
}
</style>