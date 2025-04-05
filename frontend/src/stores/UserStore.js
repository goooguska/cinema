import { defineStore } from 'pinia'
import axios from "axios";
import router from "@/router/index.js";

export const useUserStore = defineStore('userStore', () => {

  const loginUser = async (fields) => {
    try {
      const { data } = await axios.post("/api/v1/auth/login", {
        email: fields.email,
        password: fields.password
      })

      localStorage.setItem("access_token", data.access_token);
      await router.push('/')

    } catch (error) {
      let message = 'Ошибка авторизации';
      if (error.response?.data?.errors) {
        message = Object.values(error.response.data.errors).flat().join('\n');
      }

      throw new Error(message);
    }
  }

  const registrationNewUser = async (fields) => {
    try {
      const { data } = await axios.post("/api/v1/auth/register", {
        name: fields.name,
        phone: fields.phone,
        email: fields.email,
        password: fields.password,
        password_confirmation: fields.confirmPassword,
      });

      localStorage.setItem("access_token", data.access_token);
      await router.push('/')
    } catch (error) {
      let message = 'Ошибка регистрации';
      if (error.response?.data?.errors) {
        message = Object.values(error.response.data.errors).flat().join('\n');
      }

      throw new Error(message);
    }
  }

  const logout = async () => {
    try {
      const token = getToken();
      const { data } = await axios.delete("/api/v1/auth/logout", {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      localStorage.removeItem("access_token");
      await router.push('/')

      return data
    } catch (error) {
      console.log(error)
    }
  };

  const getToken = () => localStorage.getItem("access_token");

  const isAuth = () => {
    const token = getToken();

    if (!token || token.trim() === '') {
      return false;
    }

    try {
      const payloadEncoded = token.split('.')[1];
      const payload = JSON.parse(atob(payloadEncoded));

      const currentTime = Math.floor(Date.now() / 1000);
      if (payload.exp && payload.exp < currentTime) {
        return false;
      }
    } catch (e) {
      console.error("Ошибка при декодировании JWT:", e);
      return false;
    }

    return true;
  };

  return { loginUser, registrationNewUser, getToken, isAuth, logout  }
})
