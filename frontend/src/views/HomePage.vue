<script setup>

import HomeBanner from "@/components/Home/HomeBanner.vue";
import AllMovies from "@/components/Movies/AllMovies.vue";
import ListSchedule from "@/components/Schedule/ListSchedule.vue";
import HomePreferences from "@/components/Home/HomePreferences.vue";
</script>

<template>
  <HomeBanner class="banner"/>
  <div class="home">
    <AllMovies/>
    <ListSchedule/>
    <HomePreferences/>
  </div>
</template>

<style scoped>
.banner {
  margin-bottom: 50px;
}
.home {
  max-width: 1440px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 2rem;
}
</style>