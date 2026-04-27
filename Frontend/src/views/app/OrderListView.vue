<script>
import {http} from "@/utils/http.js";
import CarouselComponent from "@/components/CarouselComponent.vue";

export default {
  name: "OrderListView",
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
      orders: [],
      isLoading: false,
      error: null,
    }
  },
  methods: {
    // Fetch authenticated user's orders from API
    async getUserOrders() {
      this.isLoading = true;
      this.error = null;

      try {
        const resp = await http.get("/api/myOrders");

        this.orders = resp.data.data;
        console.log(resp.data);
      } catch (e) {
        this.error = e.error;
      } finally {
        this.isLoading = false;
      }
    },
  },
  mounted() {
    this.getUserOrders();
  },
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
    <p class="label-text">Unable to load profile</p>
  </div>

  <section v-else class="order-section">
    <div v-if="orders.length === 0" class="container py-5 text-center text-muted">
      <p class="label-text">There are no active orders <a class="link-body-emphasis cursor-pointer" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas">order a car now</a></p>
    </div>

    <div v-else>
      <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="label-text mb-0">ACTIVE ORDERS</p>
      </div>

      <CarouselComponent :items="orders">
        <template #item="{ item: order }">
          <RouterLink :to="{ name: 'order-details', params: { order: order.id } }"
                      class="card text-decoration-none flex-shrink-0" style="width: 18rem;">
            <div class="order-car-img position-relative overflow-hidden"
                 :style="{ background: order.config.color_option?.hex_code ?? 'var(--bs-body-bg)' }">
              <div class="position-absolute top-50 start-50 translate-middle user-select-none pe-none fw-black lh-1 text-body order-bg-text"
                   aria-hidden="true">
                {{ modelBgText(order.config.car_model.name) }}
              </div>
              <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center pe-none">
                <img :src="order.config.car_model.image_url" :alt="order.config.car_model.name" class="order-car-img-inner">
              </div>
            </div>
            <div class="card-body">
              <h5 class="card-title">{{ order.config.car_model.name }}</h5>
              <p class="card-text">{{ order.message }}</p>
              <p class="card-text">
                <small class="text-body-secondary">{{ order.status }} • Updated {{ updatedText(order) }}</small>
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
.order-car-img {
  height: 180px;
  border-radius: calc(var(--bs-card-border-radius) - 1px) calc(var(--bs-card-border-radius) - 1px) 0 0;
  background: var(--bs-body-bg);
}

.order-bg-text {
  font-size: 6rem;
  letter-spacing: -0.04em;
  white-space: nowrap;
  opacity: 0.15;
  font-weight: 900;
  line-height: 1;
}

.order-car-img-inner {
  height: 75%;
  width: auto;
  max-width: 90%;
  object-fit: contain;
  filter: drop-shadow(0 20px 30px rgba(0, 0, 0, 0.15));
}
</style>