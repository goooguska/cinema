<script setup lang="ts">
import BaseTitle from "@/components/UI/BaseTitle.vue";
</script>

<template>
  <div class="about">
    <div class="about__content">
      <BaseTitle>О Нас</BaseTitle>
      <div class="about__text-container">
        <p class="about__subtitle">Мы молодая сеть кинотеатров, которая старается завоевать доверие клиентов.</p>
        <p class="about__text">
          Мы постоянно развиваемся, и нам важно ваше мнение о работе наших кинотеатров и сервиса.
          Если вы хотите задать вопрос, оставить отзыв или сообщить о забытой вещи,
          <a href="#" class="highlight">напишите нам</a>
          или прослушайте ответы на частые вопросы в нашем автоинформаторе: по телефону
          <a href="tel:+74954193344" class="highlight">+7 (495) 419-33-44.</a>
        </p>
      </div>
    </div>
    <div class="about__image">
      <img class="about__image-img" src="../assets/images/about_logo.png" alt="Кинотеатры">
    </div>
  </div>
</template>

<style scoped>
.about {
  display: flex;
  margin: 0 auto;
  justify-content: space-between;
  padding: 2rem;
  max-width: 1440px;
}

.about__content {
  max-width: 700px;
  width: 100%;
}

.about__subtitle {
  margin-top: 20px;
  font-size: 30px;
  font-weight: bold;
  color: var(--color-primary-text);
}

.about__text {
  margin-top: 50px;
  font-size: 20px;
  color: var(--color-primary-text);
}

.highlight {
  color: var(--color-primary-text);
  text-decoration: underline;
}
</style>