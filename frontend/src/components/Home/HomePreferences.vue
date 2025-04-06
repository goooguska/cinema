<script setup>
const points = [
  {
    title: 'Лучшее качество',
    text: 'Наслаждайтесь фильмами в потрясающем качестве',
    img: new URL('../../assets/icons/film_strip.svg', import.meta.url).href
  },
  {
    title: 'Удобное сидение',
    text: 'Роскошные кресла с откидной спинкой',
    img: new URL('../../assets/icons/sofa.svg', import.meta.url).href
  },
  {
    title: 'Закусочная',
    text: 'Широкий выбор прохладительных напитков',
    img: new URL('../../assets/icons/question.svg', import.meta.url).href
  },
];
</script>

<template>
  <ul class="preferences">
    <li
        class="preferences-item"
        v-for="(point, i) in points"
        :key="i"
    >
      <img
          :src="point.img"
          :alt="point.title"
          class="preferences-image"
      >
      <h3 class="preferences-title">
        {{ point.title }}
      </h3>
      <p class="preferences-text">
        {{ point.text }}
      </p>
    </li>
  </ul>
</template>

<style scoped>
.preferences {
  list-style: none;
  padding: 0;
  margin: 0;
  display: grid;
  gap: 2rem;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
}

.preferences-item {
  text-align: center;
  padding: 1.5rem;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.preferences-image {
  width: 60px;
  height: 60px;
  object-fit: contain;
  margin: 0 auto 1rem;
}

.preferences-title {
  margin: 0 0 0.5rem;
  font-size: 16px;
  color: var(--color-primary-text);
}

.preferences-text {
  margin-top: 20px;
  font-size: 16px;
  color: var(--color-primary-text);
  line-height: 1.5;
}

</style>