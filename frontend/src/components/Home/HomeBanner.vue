<script setup>
// Логика компонента при необходимости
</script>

<template>
  <div class="banner">
    <div class="wrapper">
      <div class="content">
        <h2 class="title">Сейчас в кино</h2>
        <p class="subtitle">Посмотрите новейшие блокбастеры в премиальном качестве</p>
        <RouterLink to="/movies" class="btn">Смотреть</RouterLink>
      </div>
    </div>
  </div>
</template>

<style scoped>
.banner {
  background-image: url("../../assets/images/banner.png");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  height: 100vh;
  position: relative;
  display: flex;
  align-items: center;
  margin: 0;
}

.wrapper {
  max-width: 1440px;
  width: 100%;
  margin: 0 auto;
  padding: 2rem;
  display: flex;
  justify-content: flex-start;
}

.content {
  max-width: 440px;
  width: 100%;
  background: rgba(0, 0, 0, 0.2);
  border-radius: 15px;
  padding: 20px;
}

.title {
  font-size: 40px;
  color: var(--color-secondary-text);
  font-weight: bold;
}

.subtitle {
  font-size: 20px;
  color: var(--color-secondary-text);
  font-weight: 600;
  margin-top: 30px;
  margin-bottom: 30px;
}

.btn {
  display: inline-block;
  background-color: var(--color-secondary-text);
  color: var(--color-primary-text);
  padding: 12px 60px;
  border-radius: 6px;
}
</style>