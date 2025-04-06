<script setup>
import BasePopup from "@/components/BaseComponents/BasePopup.vue";

defineProps({
  errors: {
    type: [Array, String],
    required: true
  }
});

const emit = defineEmits(['close']);
</script>

<template>
  <BasePopup @close="emit('close')">
    <div class="error-popup">
      <div v-if="Array.isArray(errors)">
        <div
            v-for="(error, index) in errors"
            :key="index"
            class="error-item"
        >
          {{ error }}
        </div>
      </div>
      <div v-else class="error-item">
        {{ errors }}
      </div>
    </div>
  </BasePopup>
</template>

<style scoped>
.error-popup {
  padding: 1.5rem;
  max-width: 400px;
}

.error-item {
  color: #dc3545;
  padding: 0.5rem;
  font-size: 0.9rem;
  line-height: 1.4;
  border-left: 3px solid #dc3545;
  margin-bottom: 0.5rem;
  background: #fff5f5;
}
</style>