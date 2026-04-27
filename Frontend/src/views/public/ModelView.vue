<script>
import { http } from "@/utils/http.js";

export default {
  name: "ModelView",
  data() {
    return {
      isLoading: true,
      error: null,
      model: null,
      activeTab: 'accessories'
    }
  },
  computed: {
    info() { return this.model?.model_info ?? {}; },
    specs() { return this.model?.specs ?? {}; },
    options() { return this.model?.options ?? {}; },
    bgText() {
      const name = this.info.name ?? '';
      const tokens = name.split(' ');
      const numeric = tokens.find(t => /^[\d.]+$/.test(t));
      return numeric ?? tokens[0] ?? '';
    },
    formattedPrice() {
      return new Intl.NumberFormat('en-US', {
        style: 'currency', currency: 'USD', maximumFractionDigits: 0
      }).format(this.info.base_price);
    }
  },
  methods: {
    // Fetch model details from API by route param
    async fetchModel() {
      this.isLoading = true;
      this.error = null;
      try {
        const resp = await http.get(`/api/models/${this.$route.params.model}`);
        this.model = resp.data.data;
      } catch (e) {
        this.error = e;
      } finally {
        this.isLoading = false;
      }
    }
  },
  watch: {
    '$route.params.model': { immediate: true, handler: 'fetchModel' }
  }
}
</script>

<template>
  <!-- Loading -->
  <div v-if="isLoading" class="d-flex align-items-center justify-content-center vh-100">
    <div class="spinner-border text-secondary" role="status"></div>
  </div>

  <!-- Error -->
  <div v-else-if="error" class="container p-5">
    <div class="alert alert-danger">{{ error }}</div>
  </div>

  <!-- Content -->
  <div v-else>

    <!-- ─── HERO ─── -->
    <section class="position-relative overflow-hidden d-flex flex-column justify-content-end pb-5 hero">
      <!-- Background text -->
      <div class="position-absolute top-50 start-50 translate-middle user-select-none pe-none fw-black lh-1 text-body hero-bg-text"
           aria-hidden="true">
        {{ bgText }}
      </div>

      <!-- Car image -->
      <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-start align-items-md-center justify-content-center pe-none pt-3 pt-md-0">
        <img :src="`${info.image_url}`" :alt="info.name" class="hero-img">
      </div>

      <!-- Basic info -->
      <div class="container position-relative z-1 hstack ">
        <div>
          <p class="text-body-secondary text-uppercase mb-1 hero-year">{{ info.year }}</p>
          <h1 class="fw-light hero-title">{{ info.name }}</h1>
          <p class="text-body-secondary mb-0 mt-1">Starting at {{ formattedPrice }}</p>
        </div>
        <RouterLink
            class="configure-btn ms-auto text-decoration-none d-inline-flex align-items-center gap-2
         px-4 py-2 border border-dark-subtle text-body fw-medium text-uppercase small"
            :to="{ name: 'configure', params: { model: info.id } }"
        >
          Configure
          <i class="bi bi-arrow-right configure-arrow"></i>
        </RouterLink>
      </div>
    </section>

    <!-- ─── SPECS ─── -->
    <section class="container py-5 border-top border-bottom">
      <div class="row row-cols-2 row-cols-sm-4 row-cols-lg-7 g-4">
        <div class="col" v-for="spec in [
          { label: 'Power',        value: specs.power,        unit: 'hp'   },
          { label: '0–100 km/h',   value: specs.acceleration, unit: 's'    },
          { label: 'Top Speed',    value: specs.top_speed,    unit: 'km/h' },
          { label: 'Weight',       value: specs.weight,       unit: 'kg'   },
          { label: 'Displacement', value: specs.displacement, unit: 'cc'   },
          { label: 'Cylinders',    value: specs.cylinders,    unit: 'cyl'  },
          { label: 'Transmission', value: specs.transmission.split(' ')[0], unit: specs.transmission.split(' ')[1] },
        ]" :key="spec.label">
          <div class="spec-value fw-light lh-1">{{ spec.value }}<small class="opacity-50 ms-1">{{ spec.unit }}</small></div>
          <div class="text-body-secondary text-uppercase mt-1 spec-label">{{ spec.label }}</div>
        </div>
      </div>
    </section>

    <!-- ─── DESCRIPTION ─── -->
    <section class="container py-5">
      <p class="text-body-secondary lh-lg" style="max-width: 680px;">{{ info.description }}</p>
    </section>

    <!-- ─── OPTIONS ─── -->
    <section class="container pb-5">
      <h2 class="fs-6 fw-normal text-uppercase letter-spacing mb-4">Configuration Options</h2>

      <!-- Tabs -->
      <ul class="nav nav-underline mb-4">
        <li class="nav-item" v-for="tab in ['accessories', 'colors', 'interior_options', 'wheels']" :key="tab">
          <button class="nav-link text-capitalize" :class="{ active: activeTab === tab }" @click="activeTab = tab">
            {{ tab.replace('_', ' ') }}
          </button>
        </li>
      </ul>

      <!-- Accessories -->
      <div v-if="activeTab === 'accessories'" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        <div class="col" v-for="item in options.accessories" :key="item.id">
          <div class="option-card d-flex flex-column p-3 rounded-2 border bg-body-tertiary h-100">
            <span class="fw-medium">{{ item.name }}</span>
            <span class="text-body-secondary mt-auto pt-2 small">${{ item.price.toLocaleString() }}</span>
          </div>
        </div>
      </div>

      <!-- Colors -->
      <div v-if="activeTab === 'colors'" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        <div class="col" v-for="item in options.colors" :key="item.id">
          <div class="option-card d-flex align-items-center gap-3 p-3 rounded-2 border bg-body-tertiary">
            <span class="rounded-circle border flex-shrink-0 color-swatch" :style="{ background: item.hex_code }"></span>
            <span class="fw-medium">{{ item.name }}</span>
            <span class="text-body-secondary small ms-auto">${{ item.price.toLocaleString() }}</span>
          </div>
        </div>
      </div>

      <!-- Interior -->
      <div v-if="activeTab === 'interior_options'" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        <div class="col" v-for="item in options.interior_options" :key="item.id">
          <div class="option-card d-flex flex-column p-3 rounded-2 border bg-body-tertiary h-100">
            <span class="fw-medium">{{ item.part_name }} — {{ item.material }}</span>
            <span class="text-uppercase text-body-secondary small mt-1">{{ item.color }}</span>
            <span class="text-body-secondary small mt-auto pt-2">${{ item.price.toLocaleString() }}</span>
          </div>
        </div>
      </div>

      <!-- Wheels -->
      <div v-if="activeTab === 'wheels'" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        <div class="col" v-for="item in options.wheels" :key="item.id">
          <div class="option-card d-flex flex-column p-3 rounded-2 border bg-body-tertiary h-100">
            <span class="fw-medium">{{ item.name }}</span>
            <span class="text-uppercase text-body-secondary small mt-1">{{ item.size }}" · {{ item.material }} · {{ item.color }}</span>
            <span class="text-body-secondary small mt-auto pt-2">${{ item.price.toLocaleString() }}</span>
          </div>
        </div>
      </div>
    </section>

  </div>
</template>

<style scoped>

.hero {
  min-height: clamp(200px, 40vh, 460px);
}

.hero-bg-text {
  font-size: clamp(6rem, 22vw, 20rem);
  letter-spacing: -0.04em;
  white-space: nowrap;
  opacity: 0.04;
}

.hero-img {
  height: 72%;
  width: auto;
  max-width: 80%;
  object-fit: contain;
  filter: drop-shadow(0 40px 60px rgba(0, 0, 0, 0.15));
}

.hero-title {
  font-size: clamp(2rem, 4vw, 3.8rem);
  letter-spacing: -0.02em;
  line-height: 1;
}
.hero-year  { font-size: .75rem; letter-spacing: .15em; }

.spec-value     { font-size: clamp(1.8rem, 3vw, 2.8rem); letter-spacing: -0.02em; }
.spec-value--sm { font-size: clamp(1rem, 2vw, 1.4rem); }
.spec-label     { font-size: .7rem; letter-spacing: .1em; }

.option-card { transition: border-color .2s ease, background .2s ease; }
.option-card:hover { border-color: var(--bs-secondary-color) !important; background: var(--bs-secondary-bg) !important; }

.color-swatch { width: 36px; height: 36px; }

.configure-btn {
  letter-spacing: .12em;
  border-radius: 0 !important;
  transition: color .2s ease, background .2s ease;
}

.configure-btn:hover {
  background: var(--bs-body-color) !important;
  color: var(--bs-body-bg) !important;
}

.configure-arrow { transition: transform .2s ease; }
.configure-btn:hover .configure-arrow { transform: translateX(3px); }
</style>