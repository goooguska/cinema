<script setup>

import HomeBanner from "@/components/Home/HomeBanner.vue";
import AllMovies from "@/components/Movies/AllMovies.vue";
</script>

<template>
  <HomeBanner class="banner"/>
  <div class="home">
    <AllMovies/>
  </div>
</template>

<style scoped>
.banner {
  margin-bottom: 50px;
}
.home {
  max-width: 1440px;
  margin: 0 auto;
}
</style>