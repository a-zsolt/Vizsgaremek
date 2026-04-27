<script>
import {http} from "@/utils/http.js";

export default {
  name: "OrderDetailsView",
  data() {
    return {
      order: {},
      config: {},
      isLoading: false,
      error: null,
    }
  },
  methods: {
    async fetchOrderDetails() {
      this.isLoading = true;
      this.error = null;
      try {
        const resp = await http.get(`/api/orders/${this.$route.params.order}`);
        this.order = resp.data.data;
        this.config = this.order.config;
      } catch (e) {
        this.error = e;
      } finally {
        this.isLoading = false;
      }
    },
    formatDate(dateStr) {
      if (!dateStr) return '—';
      return new Date(dateStr).toLocaleDateString('en-US', {
        year: 'numeric', month: 'long', day: 'numeric'
      });
    },
    statusClass(status) {
      return {
        'text-success': status === 'completed',
        'text-warning': status === 'pending',
        'text-danger':  status === 'cancelled',
      };
    }
  },
  mounted() {
    this.fetchOrderDetails();
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
    <p class="label-text">Unable to load order details</p>
  </div>

  <!-- Content -->
  <div v-else-if="order.config" class="container-lg py-5 px-4">

    <!-- Hero -->
    <div class="order-hero position-relative overflow-hidden mb-5 rounded-1"
         :style="{ background: config.color_option?.hex_code ?? '#f5f5f5' }">
      <div class="position-absolute top-50 start-50 translate-middle user-select-none pe-none order-bg-text"
           aria-hidden="true">
        {{ config.car_model?.name?.toUpperCase() }}
      </div>
      <div class="d-flex align-items-center justify-content-center h-100 pe-none">
        <img :src="config.car_model?.image_url" :alt="config.car_model?.name" class="order-car-img-inner">
      </div>
    </div>

    <div class="row g-5">

      <!-- Left column: order info + config details -->
      <div class="col-lg-8">

        <!-- Order header -->
        <div class="d-flex align-items-baseline justify-content-between border-bottom pb-3 mb-4">
          <div>
            <p class="label-text mb-1">ORDER #{{ order.id }}</p>
            <h2 class="fw-light fs-3 mb-0">{{ config.car_model?.name }}</h2>
          </div>
          <span class="badge rounded-0 text-uppercase fw-medium small letter-spacing"
                :class="statusClass(order.status)"
                style="font-size: 0.65rem; letter-spacing: 0.1em;">
            {{ order.status }}
          </span>
        </div>

        <!-- Color -->
        <div class="mb-4">
          <p class="label-text mb-3">COLOR</p>
          <div class="d-flex align-items-center gap-3 border-bottom pb-3">
            <div class="color-dot flex-shrink-0" :style="{ background: config.color_option?.hex_code }"></div>
            <div class="flex-grow-1">
              <p class="small fw-medium mb-0">{{ config.color_option?.name }}</p>
            </div>
            <span class="small text-muted text-nowrap">+${{ config.color_option?.price?.toLocaleString() }}</span>
          </div>
        </div>

        <!-- Wheels -->
        <div class="mb-4">
          <p class="label-text mb-3">WHEELS</p>
          <div class="d-flex align-items-center gap-3 border-bottom pb-3">
            <div class="flex-grow-1">
              <p class="small fw-medium mb-0">{{ config.wheel_option?.name }}</p>
              <p class="x-small text-muted mb-0">
                {{ config.wheel_option?.color }} · {{ config.wheel_option?.material }} · {{ config.wheel_option?.size }}"
              </p>
            </div>
            <span class="small text-muted text-nowrap">+${{ config.wheel_option?.price?.toLocaleString() }}</span>
          </div>
        </div>

        <!-- Interior -->
        <div class="mb-4">
          <p class="label-text mb-3">INTERIOR</p>
          <div v-for="option in config.interior_options" :key="option.id" class="d-flex align-items-center gap-3 border-bottom pb-3 mb-3">
            <div class="flex-grow-1">
              <p class="x-small text-muted mb-0 text-uppercase" style="letter-spacing: 0.06em;">{{ option.part_name }}</p>
              <p class="small fw-medium mb-0">{{ option.material }} · {{ option.color }}</p>
            </div>
            <span class="small text-muted text-nowrap">+${{ option.price?.toLocaleString() }}</span>
          </div>
          <div v-if="!config.interior_options || config.interior_options.length === 0" class="border-bottom pb-3">
            <p class="small text-muted mb-0">No interior options selected</p>
          </div>
        </div>

        <!-- Accessories -->
        <div class="mb-4">
          <p class="label-text mb-3">ACCESSORIES</p>
          <div v-for="accessory in config.accessories" :key="accessory.id" class="d-flex align-items-center gap-3 border-bottom pb-3 mb-3">
            <div class="flex-grow-1">
              <p class="small fw-medium mb-0">{{ accessory.name }}</p>
            </div>
            <span class="small text-muted text-nowrap">+${{ accessory.price?.toLocaleString() }}</span>
          </div>
          <div v-if="!config.accessories || config.accessories.length === 0" class="border-bottom pb-3">
            <p class="small text-muted mb-0">No accessories selected</p>
          </div>
        </div>

      </div>

      <!-- Right column: order summary -->
      <div class="col-lg-4">
        <div class="border p-4">

          <p class="label-text mb-4">ORDER SUMMARY</p>

          <div class="d-flex justify-content-between mb-2">
            <span class="small text-muted">Base price</span>
            <span class="small">${{ config.car_model?.base_price?.toLocaleString() }}</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span class="small text-muted">Color</span>
            <span class="small">+${{ config.color_option?.price?.toLocaleString() }}</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span class="small text-muted">Wheels</span>
            <span class="small">+${{ config.wheel_option?.price?.toLocaleString() }}</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span class="small text-muted">Interior</span>
            <span class="small">+${{ config.interior_options?.reduce((sum, i) => sum + i.price, 0).toLocaleString() }}</span>
          </div>
          <div class="d-flex justify-content-between mb-4">
            <span class="small text-muted">Accessories</span>
            <span class="small">+${{ config.accessories?.reduce((sum, a) => sum + a.price, 0).toLocaleString() }}</span>
          </div>

          <div class="d-flex justify-content-between border-top pt-3 mb-4">
            <span class="small fw-medium text-uppercase letter-spacing">Total</span>
            <span class="fw-medium">${{ order.total_price?.toLocaleString() }}</span>
          </div>

          <hr class="my-4">

          <p class="label-text mb-3">ORDER DETAILS</p>

          <div class="d-flex justify-content-between mb-2">
            <span class="small text-muted">Status</span>
            <span class="small fw-medium text-capitalize" :class="statusClass(order.status)">{{ order.status }}</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span class="small text-muted">Placed</span>
            <span class="small">{{ formatDate(order.created_at) }}</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span class="small text-muted">Last updated</span>
            <span class="small">{{ formatDate(order.updated_at) }}</span>
          </div>
          <div class="d-flex justify-content-between">
            <span class="small text-muted">Note</span>
            <span class="small text-end" style="max-width: 60%;">{{ order.message }}</span>
          </div>

        </div>
      </div>

    </div>
  </div>
</template>

<style scoped>
.order-hero {
  height: 320px;
}

.order-bg-text {
  font-size: 8rem;
  letter-spacing: -0.04em;
  white-space: nowrap;
  opacity: 0.15;
  font-weight: 900;
  line-height: 1;
}

.order-car-img-inner {
  height: 65%;
  width: auto;
  max-width: 80%;
  object-fit: contain;
  filter: drop-shadow(0 20px 30px rgba(0, 0, 0, 0.15));
}

.color-dot {
  width: 2rem;
  height: 2rem;
  border-radius: 3px;
  border: 1px solid rgba(0, 0, 0, 0.08);
}

.label-text {
  font-size: 0.65rem;
  letter-spacing: 0.12em;
  color: #999;
  font-weight: 500;
}

.x-small { font-size: 0.7rem; }
.letter-spacing { letter-spacing: 0.1em; }
</style>