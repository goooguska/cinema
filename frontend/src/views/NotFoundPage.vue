<script setup>
import BaseTitle from "@/components/BaseComponents/BaseTitle.vue";
import DefaultButton from "@/components/BaseComponents/DefaultButton.vue";
import router from "@/router/index.js";

const goBack = () => {
  router.push('/')
};

</script>

<template>
  <div class="notfound">
    <BaseTitle> 404 </BaseTitle>
    <p class="notfound__text">
      Страница, которую вы ищете, не удалось найти.
    </p>
    <DefaultButton class="back-button button" @click="goBack" > Вернуться назад </DefaultButton>
  </div>
</template>

<style scoped>
.notfound {
  margin: 0 auto;
  padding: 2rem;
  max-width: 1440px;
  text-align: center;
}
.notfound__text {
  margin-top: 20px;
  font-size: 20px;
}
.back-button {
  cursor: pointer;
  max-width: 500px;
  display: inline-block;
  margin-top: 20px;
  padding: 20px;
}
</style>