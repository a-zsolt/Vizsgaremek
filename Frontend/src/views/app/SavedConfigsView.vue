<script>
import {http} from "@/utils/http.js";
import CarouselComponent from "@/components/CarouselComponent.vue";

export default {
  name: "SavedConfigsView",
  components: {CarouselComponent},
  props: {
    modelBgText: {
      type: Function,
      required: true
    },
    updatedText: {
      type: Function,
      required: true
    }
  },
  data() {
    return {
      configs: [],
      isLoading: false,
      error: null
    }
  },
  methods: {
    async getUserConfigs() {
      this.isLoading = true;
      this.error = null;

      try {
        const resp = await http.get("/api/myConfigs");
        this.configs = resp.data.data;
      } catch (e) {
        this.error = e.response?.data?.message || e.message;
      } finally {
        this.isLoading = false;
      }
    }
  },
  mounted() {
    this.getUserConfigs();
  }
}
</script>

<template>
  <!-- Loading -->
  <div v-if="isLoading" class="d-flex justify-content-center align-items-center" style="height: 60vh;">
    <div class="spinner-border spinner-border-sm text-secondary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  <!-- Error -->
  <div v-else-if="error" class="container py-5 text-center text-muted">
    <p class="label-text">Unable to load configs</p>
  </div>

  <section v-else class="config-section">
    <div v-if="configs.length === 0" class="container py-5 text-center text-muted">
      <p class="label-text">You have no saved configurations yet.</p>
    </div>

    <div v-else>
      <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="label-text mb-0">SAVED CONFIGURATIONS</p>
      </div>

      <CarouselComponent :items="configs">
        <template #item="{ item: config }">
          <RouterLink :to="{ name: 'model', params: { model: config.car_model.id } }"
                      class="card text-decoration-none flex-shrink-0" style="width: 18rem;">
            <div class="config-car-img position-relative overflow-hidden"
                 :style="{ background: config.color_option?.hex_code ?? 'var(--bs-body-bg)' }">
              <div class="position-absolute top-50 start-50 translate-middle user-select-none pe-none fw-black lh-1 text-body config-bg-text"
                   aria-hidden="true">
                {{ modelBgText(config.car_model.name) }}
              </div>
              <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center pe-none">
                <img :src="config.car_model.image_url" :alt="config.car_model.name" class="config-car-img-inner">
              </div>
            </div>
            <div class="card-body">
              <h5 class="card-title">{{ config.car_model.name }}</h5>
              <p class="card-text text-truncate">{{ config.color_option.name }} • {{ config.wheel_option.name }}</p>
              <p class="card-text">
                <small class="text-body-secondary">Saved {{ updatedText(config) }}</small>
              </p>
            </div>
          </RouterLink>
        </template>
      </CarouselComponent>
    </div>
  </section>
</template>

<style scoped>
/* Card image area */
.config-car-img {
  height: 180px;
  border-radius: calc(var(--bs-card-border-radius) - 1px) calc(var(--bs-card-border-radius) - 1px) 0 0;
  background: var(--bs-body-bg);
}

.config-bg-text {
  font-size: 6rem;
  letter-spacing: -0.04em;
  white-space: nowrap;
  opacity: 0.15;
  font-weight: 900;
  line-height: 1;
}

.config-car-img-inner {
  height: 75%;
  width: auto;
  max-width: 90%;
  object-fit: contain;
  filter: drop-shadow(0 20px 30px rgba(0, 0, 0, 0.15));
}
</style>