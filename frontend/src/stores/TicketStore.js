import { defineStore } from 'pinia'
import axios from "axios";
import {useUserStore} from "@/stores/UserStore.js";

export const useTicketStore = defineStore('ticketStore', () => {

  const userStore = useUserStore()

  const getTicketsByUserId =  async () => {
    const user = await userStore.me();
    const userId = user.id

    const { data } = await axios.get(`/api/v1/tickets`, { params: { user_id : userId } })

    return data
  }

  return { getTicketsByUserId }
})
