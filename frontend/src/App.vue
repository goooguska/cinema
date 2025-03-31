<script setup>
import {onMounted} from "vue";
import HeaderTemplate from "@/templates/HeaderTemplate.vue";
import MainTemplate from "@/templates/MainTemplate.vue";
import FooterTemplate from "@/templates/FooterTemplate.vue";

onMounted(async () => {
  const res = await fetch('/api/v1/test')
  console.log(res);
})

</script>

<template>
  <div class="app-container">
    <div class="header-wrapper">
      <HeaderTemplate/>
    </div>
    <div class="content-wrapper">
      <MainTemplate/>
    </div>
    <div class="footer-wrapper">
      <FooterTemplate/>
    </div>
  </div>
</template>

<style scoped>
.header-wrapper {
  max-width: 1440px;
  margin: 0 auto;
  padding: 2rem;
}
.footer-wrapper {
  background-color: var(--color-primary-text);
}
</style>
