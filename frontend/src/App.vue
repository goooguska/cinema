<script setup>
import HeaderTemplate from "@/templates/HeaderTemplate.vue";
import MainTemplate from "@/templates/MainTemplate.vue";
import FooterTemplate from "@/templates/FooterTemplate.vue";
import {onMounted} from "vue";
import {useUserStore} from "@/stores/UserStore.js";
import router from "@/router/index.js";

const userStore = useUserStore()

onMounted(async () => {
  try {
    if (!userStore.isAuth()) {
      await userStore.logout();
      await router.push('/');
    }
  } catch (error) {
    console.error('Auth check error:', error);
    await router.push('/');
  }
});

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
