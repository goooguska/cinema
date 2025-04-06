<template>
  <div class="loader-container">
    <div class="loader"></div>
    <div class="loading-text"><slot>Загрузка...</slot></div>
  </div>
</template>

<style scoped>
.loader-container {
  text-align: center;
  padding: 2rem;
}

.loader {
  display: inline-block;
  width: 40px;
  height: 40px;
  border: 4px solid #f3f3f3;
  border-radius: 50%;
  border-top: 4px solid #3498db;
  animation: spin 1s linear infinite;
  margin-bottom: 1rem;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.loading-text {
  color: #666;
  font-size: 0.9em;
}
</style>