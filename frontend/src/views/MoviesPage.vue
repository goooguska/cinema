<script setup>

import AllMovies from "@/components/Movies/AllMovies.vue";
</script>

<template>
  <div class="movies">
    <AllMovies/>
  </div>
</template>

<style scoped>
.movies {
  display: flex;
  margin: 0 auto;
  justify-content: space-between;
  padding: 2rem;
  max-width: 1440px;
}
</style>