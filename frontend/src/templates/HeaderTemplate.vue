<script setup>
import AppLogo from "@/components/icons/AppLogo.vue";
import DefaultButton from "@/components/DefaultButton.vue";
</script>

<template>
  <header class="header">
    <div class="header__logo">
      <RouterLink to="/" class="header__logo-link">
        <AppLogo/>
      </RouterLink>
    </div>

    <nav class="header__nav">
      <ul class="header__nav-list">
        <RouterLink to="/movies" class="header__nav-item">
          Фильмы
        </RouterLink>
        <RouterLink to="/schedule" class="header__nav-item">
          Расписание
        </RouterLink>
        <RouterLink to="/about" class="header__nav-item">
          О нас
        </RouterLink>
      </ul>
    </nav>

    <div class="header__account">
        <DefaultButton class="button header__account-button"> Купить билеты </DefaultButton>
    </div>
  </header>
</template>

<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.header__logo {
  /* Стили элемента логотипа */
}

.header__nav {
  /* Стили навигационного контейнера */
}

.header__list {
  /* Стили списка */
  list-style: none;
  padding: 0;
}

.header__item {
  /* Стили элемента списка */
}

.header__account {
  /* Стили аккаунт-блока */
}
.header__account-button{
  padding: 12px 30px;
  max-width: 180px;
}
</style>