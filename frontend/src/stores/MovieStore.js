import { defineStore } from 'pinia'
import axios from "axios";

export const useMovieStore = defineStore('movieStore', () => {

  const getAllMovies = async () => {
    const { data } = await axios.get("api/v1/movies");

    console.log(data)
    return data
  }

  return {  getAllMovies }
})
