<script>
import {http} from "@/utils/http.js";

export default {
  name: "ModelCard",
  data() {
    return {
      error: null,
      routes: [],
      isLoggedIn: !!localStorage.getItem('token'),
      carModels: []
    }
  },
  methods: {
    async getCarModels() {
      this.isLoading = true;
      this.error = null;

      try {
        const resp = await http.get("/api/models");

        this.carModels = resp.data.models;
      } catch (e) {
        this.error = e;
      } finally {
        this.isLoading = false;
      }
    },
    modelBgText(name) {
      const tokens = name.split(' ');
      const numericToken = tokens.find(t => /^[\d.]+$/.test(t));
      return numericToken ?? tokens[0];
    }
  },
  mounted() {
    this.getCarModels();
  }
}
</script>

<template>
  <RouterLink
      class="model-card card position-relative overflow-hidden text-decoration-none"
      style="container-type: inline-size; min-height: 110px;"
      v-for="model in carModels"
      :key="model.id"
      :to="{ name: 'model', params: { model: model.id } }"
  >
    <!-- Background name text -->
    <div
        class="position-absolute top-50 start-50 translate-middle w-100 text-center
           user-select-none pe-none fw-black lh-1 text-body"
        style="font-size: clamp(2rem, 40cqi, 6rem); letter-spacing: -0.03em; opacity: 0.06;"
        aria-hidden="true"
    >
      {{ modelBgText(model.name) }}
    </div>

    <!-- Car image -->
    <img
        :src="`/CarPictures/${model.name}.png`"
        :alt="model.name"
        class="position-absolute pe-none model-card-img"
    >

    <!-- Gradient overlay -->
    <div class="position-absolute top-0 start-0 h-100 model-card-gradient" aria-hidden="true"></div>

    <!-- Text -->
    <div class="card-body position-relative z-1">
      <h5 class="model-card-title card-title mb-0 fw-semibold">{{ model.name }}</h5>
      <p class="card-text mt-1 text-body-secondary"><small>{{ model.year }}</small></p>
    </div>
  </RouterLink>
</template>

<style scoped>

.model-card-img {
  right: -5%;
  bottom: 0;
  height: 90%;
  width: auto;
  max-width: 65%;
  object-fit: contain;
  opacity: 0.92;
  transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), opacity 0.4s ease;
}

.model-card-gradient {
  width: 70%;
  background: linear-gradient(
      to right,
      var(--bs-body-bg) 55%,
      transparent
  );
  transition: width 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.card {
  background-color: var(--bs-tertiary-bg) !important;
}

.model-card:hover {
  border-color: rgba(255, 255, 255, 0.15) !important;
}


.model-card:hover .model-card-gradient {
  width: 55%;
}

.model-card-title {
  transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.model-card:hover .model-card-title {
  transform: translateX(4px);
}

.model-card:hover .model-card-img {
  transform: translateX(-6%) scale(1.05);
  opacity: 1;
}

.model-card {
  transition: border-color 0.3s ease;
  border-color: transparent !important;
}
</style>