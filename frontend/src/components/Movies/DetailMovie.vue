<script setup>
import {onMounted, ref} from "vue";
import {useMovieStore} from "@/stores/MovieStore.js";
import BaseTitle from "@/components/UI/BaseTitle.vue";
import ScheduleMovie from "@/components/Movies/ScheduleMovie.vue";
const props = defineProps({
  id: String
})

const movieStore = useMovieStore();
const movie = ref([]);

const isLoading = ref(true);

onMounted(async () => {
  isLoading.value = true;
  try {
    const movies = await movieStore.getMovieById(props.id);
    movie.value = movies?.[0] || null;
  } catch (error) {
    console.error("Ошибка при загрузке фильма:", error);
    movie.value = null;
  } finally {
    isLoading.value = false;
  }
});

</script>

<template>
  <div class="detail">
    <div class="movie">
      <div class="movie__images">
        <img
            :src="movie.poster_url"
            :alt="movie.title"
            class="movie__poster"
        >

      </div>
      <div class="movie__info">
        <BaseTitle>{{ movie.title }}</BaseTitle>

        <div class="movie__meta">
          <span class="movie__year">{{ movie.year }}</span>
          <span class="movie__duration" v-if="movie.duration">{{ movie.duration }} мин</span>
          <ul class="movie__countries">
            <li
                v-for="(country, index) in movie.countries"
                :key="index"
                class="movie__country"
            >
              {{ country }}{{ index < movie.countries.length - 1 ? ',' : '' }}
            </li>
          </ul>
        </div>

        <div class="movie__description">{{ movie.description }}</div>

        <div class="movie__details">
          <div class="movie__genre" v-if="movie.genres">
            <span> Жанр: </span> {{ movie.genres.join(', ') }}
          </div>
          <div v-else><span> Жанр: </span> Не указан</div>

          <div class="movie__director" v-if="movie.directors">
            <span>Режиссёры: </span> {{ movie.directors.join(', ') }}
          </div>
          <div v-else><span>Режиссёры: </span> Не указаны</div>

          <div class="movie__cast" v-if="movie.actors">
            <span>В ролях: </span> {{ movie.actors.join(', ') }}
          </div>
          <div v-else><span>В ролях: </span> Нет информации</div>
        </div>
      </div>
    </div>

    <ScheduleMovie :movie="movie"/>
  </div>
</template>

<style scoped>
.detail {
  margin: 0 auto;
  padding: 2rem;
  max-width: 1440px;
}

.movie {
  display: grid;
  grid-template-columns: 300px 1fr;
  gap: 2rem;
  margin-bottom: 3rem;
}

.movie__poster {
  width: 100%;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.movie__meta {
  display: flex;
  gap: 1rem;
  align-items: center;
  margin: 1rem 0;
  color: var(--color-primary-text);
  font-size: 18px
}

.movie__countries {
  display: flex;
  gap: 0.5rem;
  list-style: none;
  padding: 0;
  margin: 0;
}

.movie__description {
  line-height: 1.6;
  margin: 1.5rem 0;
  color: var(--color-primary-text);
}

.movie__details span {
  margin-right: 1rem;
  color: var(--color-other-text);
}

.movie__details {
  gap: 0.5rem;
  display: flex;
  flex-direction: column;
}

</style>