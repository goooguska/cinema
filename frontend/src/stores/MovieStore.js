import { defineStore } from 'pinia'
import axios from "axios";

export const useMovieStore = defineStore('movieStore', () => {

  const getAllMovies = async () => {
    const { data } = await axios.get("/api/v1/movies");

    return data
  }

  const getMovieById = async (movieId) => {
    const { data } = await axios.get(`/api/v1/movies/${movieId}`)

    return data
  }

  const getDailyMovies = async (date) => {
    const { data } = await axios.get('/api/v1/movies/daily', { params: { date } });

    return data
  }

  return { getAllMovies, getMovieById, getDailyMovies }
})
