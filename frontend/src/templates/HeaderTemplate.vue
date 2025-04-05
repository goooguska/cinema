<script setup>
import AppLogo from "@/components/icons/AppLogo.vue";
import DefaultButton from "@/components/UI/DefaultButton.vue";
import AccountIcon from "@/components/icons/AccountIcon.vue";
import { ref, watch} from 'vue';
import BasePopup from "@/components/Auth/BasePopup.vue";
import AuthForm from "@/components/Auth/AuthForm.vue";
import RegisterForm from "@/components/Auth/RegisterForm.vue";
import {useUserStore} from "@/stores/UserStore.js";
import router from "@/router/index.js";
import LogoutIcon from "@/components/icons/LogoutIcon.vue";

const isAuthPopupVisible = ref(false);
const isRegisterPopupVisible = ref(false);

const userStore = useUserStore();
const isAccountPage = ref(false)

const openAuth = () => {
  if (userStore.isAuth()){
    router.push('/account')
    return
  }
  isAuthPopupVisible.value = true;
}

const closeAllPopups = () => {
  isAuthPopupVisible.value = false;
  isRegisterPopupVisible.value = false;
}

const switchToRegister = () => {
  isAuthPopupVisible.value = false;
  isRegisterPopupVisible.value = true;
}

const switchToAuth = () => {
  isRegisterPopupVisible.value = false;
  isAuthPopupVisible.value = true;
}

watch(() => router.currentRoute.value.name, (newVal) => {
  isAccountPage.value = newVal === 'Account';
});

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
      <RouterLink to="/schedule" class="header__account-link">
        <DefaultButton class="button header__account-button"> Купить билеты </DefaultButton>
      </RouterLink>
      <button class="header__account-btn" @click="openAuth">
        <AccountIcon v-if="!isAccountPage"/>
        <LogoutIcon v-else @click="userStore.logout"/>
      </button>
    </div>
  </header>
  <BasePopup
      v-if="isAuthPopupVisible"
      @close="closeAllPopups"
  >
    <AuthForm
        @switch-to-register="switchToRegister"
        @login-success="closeAllPopups"
    />
  </BasePopup>

  <BasePopup
      v-if="isRegisterPopupVisible"
      @close="closeAllPopups"
  >
    <RegisterForm
        @switch-to-auth="switchToAuth"
        @register-success="closeAllPopups"
    />
  </BasePopup>
</template>

<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.header__nav {
  max-width: 370px;
  width: 100%;
}

.header__nav-list {
  display: flex;
  justify-content: space-between;
}

.header__nav-item {
  color: var(--color-primary-text);
}

.header__account {
  display: flex;
  align-items: center;
  max-width: 225px;
  gap: 20px;
}

.header__account-button {
  padding: 12px 30px;
  max-width: 180px;
}

.header__account-btn {
  padding: 0;
  border: none;
  background: none;
  cursor: pointer;
}
</style>