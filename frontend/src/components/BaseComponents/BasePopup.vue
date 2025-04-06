<script setup>
import CloseButton from "@/components/BaseComponents/CloseButton.vue";
</script>

<template>
  <div class="auth-popup" @click.self="$emit('close')">
    <div class="auth-popup__content">
      <CloseButton @click="$emit('close')" />
      <slot/>
    </div>
  </div>
</template>

<style scoped>
.auth-popup {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  backdrop-filter: blur(2px);
  animation: fadeIn 0.3s ease;
}

.auth-popup__content {
  position: relative;
  background: var(--color-background);
  padding: 40px 32px 32px;
  border-radius: 16px;
  width: 100%;
  max-width: 440px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
  margin: 20px;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@media (max-width: 480px) {
  .auth-popup__content {
    margin: 10px;
    padding: 32px 24px 24px;
    border-radius: 12px;
  }
}
</style>