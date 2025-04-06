<script setup>
import { ref, computed, onMounted } from 'vue';
import BaseTitle from "@/components/BaseComponents/BaseTitle.vue";
import {useMovieStore} from "@/stores/MovieStore.js";

const movies = ref([]);
const selectedDate = ref('');
const isLoading = ref(false);
const movieStore = useMovieStore()

const DAYS_RU = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
const MONTHS_RU = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
  'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
const DAY_LABELS = ['Сегодня', 'Завтра', 'Послезавтра'];

const generateDates = () => {
  return Array.from({ length: 3 }, (_, i) => {
    const date = new Date();
    date.setDate(date.getDate() + i);

    return {
      id: date.toISOString().split('T')[0],
      label: formatDateLabel(date, i)
    };
  });
};

const formatDateLabel = (date, index) => {
  const dayLabel = DAY_LABELS[index] || DAYS_RU[date.getDay()];
  return `${dayLabel}, ${date.getDate()} ${MONTHS_RU[date.getMonth()]}`;
};

const dates = computed(generateDates);

const fetchMovies = async (date) => {
  try {
    isLoading.value = true;
    movies.value = await movieStore.getDailyMovies(date);
  } catch (error) {
    handleError(error);
  } finally {
    isLoading.value = false;
  }
};

const handleError = (error) => {
  console.error('Ошибка загрузки расписания:', error);
};

const handleDateChange = (date) => {
  if (date === selectedDate.value) return;
  selectedDate.value = date;
  fetchMovies(date);
};

const formatDuration = (minutes) => {
  if (!minutes) return 'Длительность не указана';
  const hours = Math.floor(minutes / 60);
  const mins = minutes % 60;
  return `${hours} ч ${mins.toString().padStart(2, '0')} мин`;
};

onMounted(() => {
  selectedDate.value = dates.value[0]?.id;
  if (selectedDate.value) fetchMovies(selectedDate.value);
});
</script>


<template>
  <div class="schedule-page">
    <BaseTitle>Расписание</BaseTitle>

    <div class="date-selector">
      <button
          v-for="date in dates"
          :key="date.id"
          class="date-btn"
          :class="{ active: date.id === selectedDate }"
          @click="handleDateChange(date.id)"
      >
        {{ date.label }}
      </button>
    </div>

    <div v-if="isLoading" class="loading">Загрузка...</div>

    <div v-else class="movies-list">
      <div v-for="movie in movies" :key="movie.id" class="movie-card">
        <div class="movie-header">
          <img
              :src="movie.poster_url"
              :alt="movie.title"
              class="movie-poster"
          />
          <div class="movie__meta">
            <h2 class="movie-title">{{ movie.title }}</h2>
            <div class="movie-info">
              {{ formatDuration(movie.duration) }} |
              {{ movie.genres.join(', ') }}
            </div>
          </div>
        </div>

        <div class="screenings">
          <RouterLink class="screening-time" v-for="screening in movie.screenings" :key="screening.id" :to="`/movies/${movie.id}`">
              {{ new Date(screening.start_time).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) }}
          </RouterLink>

        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.movie-poster {
  width: 100%;
  max-width: 100px;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  margin-right: 20px;
}

.date-selector {
  display: flex;
  gap: 1rem;
  margin: 2rem 0;
}

.date-btn {
  color: var(--color-primary-text);
  padding: 0.5rem 1.5rem;
  border: none;
  border-radius: 8px;
  background: none;
  cursor: pointer;
  transition: 0.3s;
}

.date-btn.active {
  background-color: var(--color-primary-text);
  color: white;
}

.movie-card {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 2rem;
  padding: 1.5rem;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.movie-header {
  margin-bottom: 1rem;
  display: flex;
  align-items: center;
}

.movie-title {
  font-size: 16px;
  margin: 0 0 0.5rem 0;
}

.movie-info {
  color: #666;
  margin-bottom: 0.5rem;
  max-width: 500px;
  line-height:1.5;
}

.screenings {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.screening-time {
  padding: 0.5rem 1rem;
  border: 1px solid #ddd;
  border-radius: 6px;
  cursor: pointer;
  transition: 0.3s;
  color: var(--color-primary-text);
}

.screening-time:hover {
  background: var(--color-primary-text);
  color: white;
  border-color: transparent;
}

.loading {
  text-align: center;
  padding: 2rem;
  color: #666;
}
</style>