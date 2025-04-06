<script setup>
import { ref, computed, onMounted } from 'vue';
import DefaultButton from '@/components/BaseComponents/DefaultButton.vue';
import axios from "axios";
import {useUserStore} from "@/stores/UserStore.js";
import router from "@/router/index.js";

const props = defineProps({
  screening: Object,
  movie: Object,
  group: Object
});

const userStore = useUserStore();

const seats = ref([]);
const selectedSeats = ref(new Set());
const totalPrice = computed(() => selectedSeats.value.size * props.screening.price);

const isSeatOccupied = (row, seatNumber) => {
  const globalSeatNumber = (row - 1) * 10 + seatNumber;
  return seats.value.some(s => s.number === globalSeatNumber && s.occupied);
};

const isSeatSelected = (row, seatNumber) => {
  const globalSeatNumber = (row - 1) * 10 + seatNumber;
  return selectedSeats.value.has(globalSeatNumber);
};

const toggleSeat = (row, seatNumber) => {
  const globalSeatNumber = (row - 1) * 10 + seatNumber;
  const seat = seats.value.find(s => s.number === globalSeatNumber);

  if (!seat || seat.occupied) return;

  selectedSeats.value.has(globalSeatNumber)
      ? selectedSeats.value.delete(globalSeatNumber)
      : selectedSeats.value.add(globalSeatNumber);
};

const loadSeats = async () => {
  try {
    console.log(props.screening)
    const response = await fetch(`/api/v1/screenings/${props.screening.id}/seats`);
    const data = await response.json();

    seats.value = data.all_seats.map(number => ({
      number,
      occupied: data.occupied.includes(number)
    }));
  } catch (error) {
    console.error('Error loading seats:', error);
  }
};

const bookSeats = async () => {
  try {
    const user = await userStore.me()
    const response = await axios.post('/api/v1/bookings', {
        screening_id: props.screening.id,
        seats: Array.from(selectedSeats.value),
        user_id: user.id
      });

    window.location.reload();
    router.push('/account')
  } catch (error) {
    console.error('Booking failed:', error);
  }
};

const formatDate = computed(() => {
  const options = { weekday: 'long', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', timeZone: 'Europe/Moscow' };
  const date = new Date(props.screening.rawTime);
  const formattedDate = date.toLocaleDateString('ru-RU', options);

  return formattedDate[0].toUpperCase() + formattedDate.slice(1);
})

onMounted(loadSeats);

</script>

<template>
  <div class="seat-map">
      <div class="header">
        <h2>{{ movie.title }}</h2>
        <div class="info">
          <p>{{ group.cinema.address }}</p>
          <p>{{ formatDate }}</p>
        </div>
      </div>

      <div class="cinema-screen">Экран</div>

      <div class="rows-container">
        <div
            v-for="row in 6"
            :key="row"
            class="seat-row"
        >
          <div class="row-number">{{ row }}</div>
          <div class="seats-in-row">
            <div
                v-for="seatNumber in 10"
                :key="seatNumber"
                :class="['seat', {
              'occupied': isSeatOccupied(row, seatNumber),
              'selected': isSeatSelected(row, seatNumber)
            }]"
                @click="toggleSeat(row, seatNumber)"
            >
              {{ seatNumber }}
            </div>
          </div>
        </div>
      </div>

    <div class="summary">
      <p>Selected: {{ selectedSeats.size }}</p>
      <p>Total: {{ totalPrice }} ₽</p>
      <DefaultButton class="button"
          @click="bookSeats"
          :disabled="selectedSeats.size === 0"
      >
        Confirm Booking
      </DefaultButton>
    </div>
  </div>
</template>

<style scoped>
.seat-map {
  padding: 2rem;
  max-width: 1000px;
  margin: 0 auto;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.cinema-screen {
  text-align: center;
  margin: 2rem 0;
  padding: 1rem;
  background: #f0f0f0;
  border-radius: 4px;
  font-weight: bold;
}

.rows-container {
  max-height: 60vh;
  overflow-y: auto;
  padding: 1rem 0;
}

.seat-row {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.row-number {
  width: 40px;
  text-align: center;
  font-weight: 500;
  color: #666;
}

.seats-in-row {
  display: flex;
  gap: 8px;
}

.seat {
  width: 40px;
  height: 40px;
  border: 2px solid #3498db;
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s;
  font-weight: 500;
  background: #fff;
}

.seat:hover:not(.occupied):not(.selected) {
  background: #e3f2fd;
}

.seat.selected {
  background: #3498db;
  color: white;
  border-color: #2980b9;
}

.seat.occupied {
  background: #eee;
  border-color: #ddd;
  cursor: not-allowed;
  position: relative;
}

.seat.occupied::after {
  content: '';
  position: absolute;
  width: 120%;
  height: 2px;
  background: #e74c3c;
  transform: rotate(-45deg);
}

.header {
  text-align: center;
  margin-bottom: 2rem;
  padding-bottom: 1.5rem;
  border-bottom: 1px solid #eee;
}

.header h2 {
  font-size: 1.8rem;
  color: #2c3e50;
  margin-bottom: 0.5rem;
  font-weight: 600;
}

.info {
  display: flex;
  justify-content: center;
  gap: 1.5rem;
  color: #7f8c8d;
  font-size: 0.95rem;
}

.info p {
  margin: 0;
  display: flex;
  align-items: center;
  gap: 0.3rem;
}

.info p::before {
  content: '';
  display: inline-block;
  width: 6px;
  height: 6px;
  background: #3498db;
  border-radius: 50%;
}

.summary {
  background: #f8f9fa;
  padding: 1.5rem;
  border-radius: 8px;
  text-align: center;
  margin-top: 2rem;
}

.summary p {
  font-size: 1.1rem;
  margin: 0.8rem 0;
  color: #2c3e50;
}

.summary p:first-child {
  color: #3498db;
  font-weight: 500;
}
</style>