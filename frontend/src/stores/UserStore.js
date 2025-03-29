import { defineStore } from 'pinia'
import axios from "axios";

export const useUserStore = defineStore('userStore', () => {

  const loginUser = async (fields) => {
    try {
      const response = await axios.post("api/v1/auth/login", {
        email: fields.email,
        password: fields.password
      })
    } catch (error) {
      console.log(error)
    }
  }

  const registrationNewUser = async (fields) => {
    try {
      const response = await axios.post("api/users", {
        login: fields.login,
        phoneNumber: fields.phoneNumber,
        email: fields.email,
        password: fields.password,
        password_confirmation: fields.password_confirmation,
      });
    } catch (error) {
      console.log(error)
    }
  }

  return { loginUser, registrationNewUser  }
})
