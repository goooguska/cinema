<script setup>
import {reactive, ref} from 'vue';
import FormInput from "@/components/Auth/FormInput.vue";
import DefaultButton from "@/components/DefaultButton.vue";
import {useUserStore} from "@/stores/UserStore.js";

const userStore = useUserStore();

const formData = reactive({
  email: '',
  password: '',
});

const loginUser = () => {
  userStore.loginUser(formData)
}
</script>

<template>
  <div>
    <h2 class="auth-popup__title">Вход или регистрация</h2>
    <div class="auth-popup__form">
      <FormInput label="Email" type="email" v-model="formData.email" />
      <FormInput label="Пароль" type="password" v-model="formData.password" />
      <DefaultButton @click="loginUser" class="auth-popup__next button">Продолжить</DefaultButton>
    </div>
    <div class="auth-popup__footer">
      <span>Впервые в компании?</span>
      <button class="auth-popup__link" @click="$emit('switch-to-register')">
        Создать аккаунт
      </button>
    </div>
  </div>
</template>

<style scoped>
.auth-popup__title {
  font-size: 24px;
  margin-bottom: 24px;
  text-align: center;
}

.auth-popup__next {
  cursor: pointer;
  padding: 12px;
}

.auth-popup__form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.auth-popup__footer {
  margin-top: 20px;
  text-align: center;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.auth-popup__link {
  color: var(--color-secondary-text);
  border: none;
  cursor: pointer;
  font-weight: 500;
  background-color: var(--color-primary-text);
  border-radius: 6px;
  text-align: center;
  padding: 12px;
  font-size: 16px;
}

</style>
