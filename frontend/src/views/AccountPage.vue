<script setup>
import BaseTitle from "@/components/BaseComponents/BaseTitle.vue";
import AccountTickets from "@/components/Account/AccountTickets.vue";

</script>

<template>
  <div class="account">
    <BaseTitle>Ваши билеты</BaseTitle>
    <AccountTickets/>
  </div>
</template>

<style scoped>
.account {
  margin: 0 auto;
  padding: 2rem;
  max-width: 1440px;
}
</style>