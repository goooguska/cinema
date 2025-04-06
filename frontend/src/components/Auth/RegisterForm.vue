<script setup>
import {reactive, ref} from 'vue';
import FormInput from "@/components/Auth/FormInput.vue";
import DefaultButton from "@/components/BaseComponents/DefaultButton.vue";
import {useUserStore} from "@/stores/UserStore.js";
import ErrorPopup from "@/components/Error/ErrorPopup.vue";

const formData = reactive({
  name: '',
  phone: '',
  email: '',
  password: '',
  confirmPassword: ''
});

const userStore = useUserStore()
const errors = ref([])

const emit = defineEmits(['register-success', 'switch-to-auth']);

const registrationNewUser = async () => {
  try {
    await userStore.registrationNewUser(formData);
    emit('register-success');
  } catch (error) {
    if (error.response?.data?.errors) {
      errors.value = Object.values(error.response.data.errors).flat();
    } else {
      errors.value = [error.message || 'Произошла неизвестная ошибка'];
    }
  }
};
</script>

<template>
  <div>
    <ErrorPopup
        v-if="errors.length"
        :errors="errors"
        @close="errors = []"
    />
    <h2 class="reg-popup__title">Регистрация</h2>
    <div class="reg-popup__form">
      <FormInput label="Имя" type="text" placeholder="Введите имя" v-model="formData.name" />
      <FormInput label="Номер телефона" type="tel" placeholder="Введите номер телефона" v-model="formData.phone" />
      <FormInput label="Email" type="email" placeholder="Введите email" v-model="formData.email" />
      <FormInput label="Пароль" type="password" placeholder="Введите пароль" v-model="formData.password" />
      <FormInput
          label="Подтвердите пароль"
          type="password"
          placeholder="Введите повторно пароль"
          v-model="formData.confirmPassword"
      />
      <DefaultButton @click="registrationNewUser()" class="reg-popup__form-btn button">Регистрация</DefaultButton>
    </div>
    <div class="reg-popup__footer">
      <span>Уже есть аккаунт?</span>
      <button class="reg-popup__link" @click="$emit('switch-to-auth')">
        Войти
      </button>
    </div>
  </div>
</template>

<style scoped>
.reg-popup__title {
  font-size: 24px;
  margin-bottom: 24px;
  text-align: center;
}

.reg-popup__form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.reg-popup__footer {
  margin-top: 20px;
  text-align: center;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.reg-popup__link {
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

.reg-popup__form-btn {
  cursor: pointer;
  padding: 12px;
}

</style>