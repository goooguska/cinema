import { defineStore } from 'pinia'
import axios from "axios";
import router from "@/router/index.js";

export const useUserStore = defineStore('userStore', () => {

  const loginUser = async (fields) => {
    try {
      const { data } = await axios.post("api/v1/auth/login", {
        email: fields.email,
        password: fields.password
      })

      localStorage.setItem("access_token", data.access_token);
      await router.push('/')

    } catch (error) {
      console.log(error)
    }
  }

  const registrationNewUser = async (fields) => {
    try {
      const { data } = await axios.post("api/v1/auth/register", {
        name: fields.name,
        phone: fields.phone,
        email: fields.email,
        password: fields.password,
        password_confirmation: fields.confirmPassword,
      });

      localStorage.setItem("access_token", data.access_token);
      await router.push('/')
    } catch (error) {
      console.log(error)
    }
  }

  const logout = async () => {
    try {
      const token = getToken();
      const { data } = await axios.post("api/v1/auth/logout", {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      localStorage.removeItem("access_token");
    } catch (error) {
      console.log(error)
    }
  };

  const getToken = () => {
      return localStorage.getItem("access_token");
  }

  return { loginUser, registrationNewUser, getToken  }
})
