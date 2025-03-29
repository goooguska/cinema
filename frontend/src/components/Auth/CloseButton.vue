<script setup>
import CloseIcon from "@/components/icons/CloseIcon.vue";
</script>

<template>
  <button class="popup-close" @click="$emit('click')">
    <CloseIcon />
  </button>
</template>

<style scoped>
.popup-close {
  position: absolute;
  top: 16px;
  right: 16px;
  padding: 8px;
  border: none;
  background: none;
  cursor: pointer;
  transition: all 0.2s ease;
  border-radius: 50%;
  display: flex;
}

.popup-close:hover {
  transform: rotate(90deg);
}

.popup-close:active {
  transform: scale(0.95) rotate(90deg);
}
</style>