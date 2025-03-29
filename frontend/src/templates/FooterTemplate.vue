<script setup>

import WhiteAppLogo from "@/components/icons/WhiteAppLogo.vue";
</script>

<template>
    <footer class="footer">
      <div class="footer__columns">
        <div class="footer__logo">
          <RouterLink to="/" class="footer__logo-link">
            <WhiteAppLogo/>
          </RouterLink>
          <span class="footer__logo-text">Ваш премиум-киноопыт</span>
        </div>
        <div class="footer__links">
          <ul class="footer__links-list list">
            <li class="footer__links-item strong">
              Активные ссылки
            </li>
            <RouterLink to="/movies" class="footer__links-item item">
              Фильмы
            </RouterLink>
            <RouterLink to="/schedule" class="footer__links-item item">
              Расписание
            </RouterLink>
            <RouterLink to="/about" class="footer__links-item item">
              О нас
            </RouterLink>
          </ul>
        </div>
        <div class="footer__contacts">
          <ul class="footer__contacts-list list">
            <li class="footer__contacts-item strong">Контакты</li>
            <li class="footer__contacts-item item">Москва, ПЛК 12</li>
            <li class="footer__contacts-item item">8(915)-555-55-55</li>
          </ul>
        </div>
        <div class="footer__socials">
          <ul class="footer__socials-list list">
            <li class="footer__socials-item strong">
              Социальные сети
            </li>
            <li class="footer__socials-item">
              <img src="../assets/icons/whatsapp.svg" alt="whatsapp">
              <img src="../assets/icons/telegram.svg" alt="telegram">
            </li>
          </ul>
        </div>
      </div>
      <div class="footer__copyright">
        © 2025 Киномания. Все права защищены
      </div>

    </footer>

</template>

<style scoped>
.footer {
  max-width: 1440px;
  margin: 0 auto;
  padding: 2rem;
}

.footer__columns {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
}

.footer__logo {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.footer__logo-text {
  margin-top: 8px;
  color: var(--color-other-text);
  font-size: 18px;
}

.list {
  display: flex;
  flex-direction: column;
}
.strong {
  color: var(--color-secondary-text);
  margin-bottom: 10px;
  font-weight: 600;
}

.item {
  color: var(--color-other-text);
  margin-bottom: 20px;
}

.item:hover {
  opacity: 0.9;
}

.footer__socials-list img {
  width: 32px;
  height: 32px;
  margin-right: 1rem;
  cursor: pointer;
}

.footer__copyright {
  margin-top: 2rem;
  border-top: 1px solid var(--color-other-text);
  color: var(--color-other-text);
  padding-top: 1rem;
  text-align: center;
}

</style>