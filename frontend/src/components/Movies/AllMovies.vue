<script setup>
import BaseTitle from "@/components/BaseComponents/BaseTitle.vue";
import BaseLoader from "@/components/BaseComponents/BaseLoader.vue";
import { onMounted, ref } from "vue";
import { useMovieStore } from "@/stores/MovieStore.js";
import DefaultButton from "@/components/BaseComponents/DefaultButton.vue";

const movieStore = useMovieStore();
const movies = ref([]);
const isLoading = ref(true);

onMounted(async () => {
  try {
    movies.value = await movieStore.getAllMovies();
  } catch (error) {
    console.error("Ошибка загрузки фильмов:", error);
  } finally {
    isLoading.value = false;
  }
});
</script>

<template>
  <BaseTitle>Сейчас в кино</BaseTitle>

  <BaseLoader v-if="isLoading" />
  <div v-if="isLoading" class="loading-message">
    Идёт загрузка фильмов...
  </div>

  <template v-else>
    <div v-if="movies.length" class="movies-grid">
      <div v-for="movie in movies" :key="movie.id" class="movie-card">
        <img
            :src="movie.poster_url"
            :alt="movie.title"
            class="movie-poster"
        />

        <div class="card-body">
          <span class="card-title">{{ movie.title ?? 'Нет названия'}}</span>

          <div class="movie-info">
            <div class="genres">
              <span
                  v-for="genre in movie.genres"
                  :key="genre.id"
                  class="genre"
              >
                {{ genre }}
              </span>
            </div>
          </div>
          <RouterLink :to="`/movies/${movie.id}`">
            <DefaultButton class="watch-button button">
              Смотреть
            </DefaultButton>
          </RouterLink>
        </div>
      </div>
    </div>

    <div v-else class="empty-message">
      Нет доступных фильмов
    </div>
  </template>
</template>

<style scoped>
.movies-grid {
  display: grid;
  grid-template-columns: repeat(12, 1fr);
  gap: 2rem;
  padding: 1rem;
}

.movie-card {
  grid-column: span 4;
  background: var(--color-background);
  border-radius: 12px;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  transition: transform 0.2s;
}

.movie-card:hover {
  transform: translateY(-5px);
}

.movie-card:nth-child(n+4) {
  grid-column: span 3;
}

.card-title {
  font-size: 16px;
  font-weight: 700;
}

.watch-button {
  cursor: pointer;
  display: inline-block;
  padding: 12px 100px;
}

.movie-poster {
  width: 100%;
  height: 250px;
  object-fit: cover;
  border-bottom: 2px solid var(--color-background);
}

.card-body {
  padding: 20px;
}

.movie-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  margin-top: 20px;
}

.genres {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
}

.genre {
  font-size: 12px;
  color: #666;
  padding: 4px 8px;
  background: #f0f0f0;
  border-radius: 4px;
}

.loading-message,
.empty-message {
  text-align: center;
  padding: 2rem;
  color: #666;
}
</style>