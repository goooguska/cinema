<script setup>
import {useTicketStore} from "@/stores/TicketStore.js";
import {computed, onMounted, ref} from "vue";
import BaseLoader from "@/components/BaseComponents/BaseLoader.vue";

const tickets = ref([])
const ticketStore = useTicketStore()
const isLoading = ref(true);

onMounted(async () => {
  try {
    tickets.value = await ticketStore.getTicketsByUserId()

  } catch (error) {
    console.error("Ошибка загрузки билетов:", error);
  } finally {
    isLoading.value = false;
  }
})

const formatDate = (datetime) => {
  const options = { weekday: 'long', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', timeZone: 'Europe/Moscow' };
  const formattedDate = new Date(datetime).toLocaleTimeString('ru-RU', options);

  return formattedDate[0].toUpperCase() + formattedDate.slice(1);
};

</script>

<template>
  <BaseLoader v-if="isLoading" />
  <div v-if="isLoading" class="loading-message">
    Идёт загрузка билетов...
  </div>

  <template v-else>
    <div class="tickets">
      <div class="tickets-item" v-for="ticket in tickets" :key="ticket.id">
        <div class="tickets-img">
          <img
              :src="ticket.screening.movie.poster_url"
              :alt="ticket.screening.movie.title"
              class="ticket-poster"
          />
        </div>
        <div class="tickets-info">
          <p class="ticket-title">
            {{ticket.screening.movie.title}}
          </p>
          <p class="ticket-date">
            {{ formatDate(ticket.screening.start_time) }}
          </p>
          <p class="ticket-description">
            {{ticket.screening.movie.description}}
          </p>

        </div>
      </div>
    </div>

  </template>


</template>

<style scoped>
.tickets-item {
  display: flex;
  gap: 2rem;
  margin-bottom: 3rem;
  padding: 2rem;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s;
}

.tickets-item:hover {
  transform: translateY(-3px);
}

.tickets-img {
  flex: 0 0 200px;
}

.ticket-poster {
  width: 100%;
  height: 300px;
  object-fit: cover;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.tickets-info {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.ticket-title {
  font-size: 1.8rem;
  font-weight: 600;
  color: var(--color-primary-text);
  margin: 0;
}

.ticket-date {
  font-size: 1.1rem;
  color: var(--color-primary-text);
  font-weight: 500;
  margin: 0;
}

.ticket-description {
  font-size: 1rem;
  line-height: 1.6;
  color: var(--color-other-text);
  margin: 0;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.loading-message {
  text-align: center;
  font-size: 1.2rem;
  color: #666;
  margin-top: 2rem;
}
</style>