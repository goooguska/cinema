<script setup>
import {computed, ref} from 'vue';
import BasePopup from "@/components/BaseComponents/BasePopup.vue";
import SeatSelection from "@/components/Ticket/SeatSelection.vue";
import {useUserStore} from "@/stores/UserStore.js";
import AuthWarningPopup from "@/components/BaseComponents/AuthWarningPopup.vue";

const props = defineProps({
  movie: {
    type: Object,
    required: true
  }
});

const userStore = useUserStore();

const isSeatsPopupVisible = ref(false);
const isAuthWarningVisible = ref(false);

const selectedScreening = ref(null);
const selectedGroup = ref(null)


const openSeats = (screening, group) => {
  if (userStore.isAuth()) {
    selectedScreening.value = screening;
    selectedGroup.value = group;
    isSeatsPopupVisible.value = true;
  } else {
    showAuthWarning();
  }
};

const showAuthWarning = () => {
  isAuthWarningVisible.value = true;
};

const closeSeatsPopup = () => {
  isSeatsPopupVisible.value = false;
  selectedScreening.value = null;
  selectedGroup.value = null;
};

const closeAuthWarning = () => {
  isAuthWarningVisible.value = false;
};

const navigateToAuth = () => {
  closeAuthWarning();
};

const getTodayDate = () => {
  const today = new Date();
  return today.toISOString().split('T')[0];
};

const groupedScreenings = computed(() => {
  const today = getTodayDate();

  const groups = props.movie.screenings?.reduce((acc, screening) => {
    const cinema = screening.cinema;
    if (!cinema) return acc;

    const screeningDate = new Date(screening.start_time).toISOString().split('T')[0];
    if (screeningDate !== today) return acc;

    if (!acc[cinema.id]) {
      acc[cinema.id] = {
        cinema: cinema,
        screenings: []
      };
    }

    acc[cinema.id].screenings.push({
      id: screening.id,
      time: formatTime(screening.start_time),
      rawTime: new Date(screening.start_time),
      price: screening.price > 0 ? `От ${screening.price} ₽` : 'Бесплатно',
      hall: `Зал ${screening.hall.number}`
    });

    return acc;
  }, {});

  if (groups) {
    Object.values(groups).forEach(group => {
      group.screenings.sort((a, b) => a.rawTime - b.rawTime);
    });
  }

  return groups;
});

const formatTime = (datetime) => {
  return new Date(datetime).toLocaleTimeString('ru-RU', {
    hour: '2-digit',
    minute: '2-digit'
  });
};

const formatAddress = (address) => {
  return address.replace(/\n/g, ', ');
};
</script>

<template>
  <div class="schedule">
    <div
        v-for="(group, cinemaId) in groupedScreenings"
        :key="cinemaId"
        class="cinema-block"
    >
      <div class="cinema-header">
        <h2 class="cinema-title">{{ group.cinema.name }}</h2>
        <div class="cinema-address">{{ formatAddress(group.cinema.address) }}</div>
      </div>

      <div class="screening-cards">
        <div
            v-for="(screening, index) in group.screenings"
            :key="index"
            class="screening-card"
            @click="openSeats(screening, group)"
        >
          <div class="screening-time">{{ screening.time }}</div>
          <div class="screening-price">{{ screening.price }}</div>
          <div class="screening-hall">{{ screening.hall }}</div>
        </div>
      </div>
    </div>
    <BasePopup
        v-if="isSeatsPopupVisible"
        @close="closeSeatsPopup"
    >
      <SeatSelection
          v-if="isSeatsPopupVisible"
          :movie="movie"
          :screening="selectedScreening"
          :group="selectedGroup"
      />
    </BasePopup>
    <BasePopup
        v-if="isAuthWarningVisible"
        @close="closeAuthWarning"
    >
      <AuthWarningPopup
          @confirm="navigateToAuth"
          @cancel="closeAuthWarning"
      />
    </BasePopup>
  </div>
</template>

<style scoped>
.cinema-block {
  display: flex;
  gap: 5rem;
  margin-bottom: 2rem;
  padding: 1.5rem;
  background: var(--color-background);
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.cinema-title {
  font-size: 18px;
  margin-bottom: 1.5rem;
}

.cinema-address {
  font-size: 14px;
}

.screening-cards {
  display: flex;
  gap: 1.5rem;
}

.screening-card {
  flex: 0 0 120px;
  padding: 1rem;
  border: 1px solid #eee;
  border-radius: 8px;
  text-align: center;
  cursor: pointer;
}

.screening-time {
  font-size: 16px;
  font-weight: 500;
  margin-bottom: 0.5rem;
}

.screening-card:hover {
  background: var(--color-primary-text);
  color: white;
  transition: 0.3s;

}

.screening-hall {
  color: var(--color-other-text);
  font-size: 14px;
}

.screening-price {
  font-size: 14px;
  font-weight: 500;
  margin-bottom: 0.25rem;
}
</style>