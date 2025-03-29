<script setup>
import {onMounted} from "vue";
import HeaderTemplate from "@/templates/HeaderTemplate.vue";
import MainTemplate from "@/templates/MainTemplate.vue";

onMounted(async () => {
  const res = await fetch('/api/v1/test')
  console.log(res);
})

</script>

<template>
  <HeaderTemplate/>
  <MainTemplate/>

</template>

<style scoped>

</style>
