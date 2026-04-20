<script>
import {http} from "@/utils/http.js";

export default {
  name: "AdminOrderDetailsView",
  props: {
    id: {type: [String, Number], required: true},
    orders: {type: Array, default: () => []},
  },
  emits: ["orderUpdated"],
  data() {
    return {
      isLoading: false,
      error: null,
      errors: {},
      newStatus: "",
      newMessage: "",
    }
  },
  computed: {
    currentOrder() {
      return this.orders.find(order => Number(order.id) === Number(this.id)) ?? null;
    },
    isOrderMissing() {
      return this.orders.length > 0 && !this.currentOrder;
    }
  },
  watch: {
    currentOrder: {
      immediate: true,
      handler(order) {
        this.newStatus = order?.status ?? "pending";
        this.newMessage = order?.message ?? "";
      }
    }
  },
  methods: {
    async updateOrder() {
      if (!this.currentOrder) {
        this.error = "Order not found.";
        return;
      }
      this.isLoading = true;
      this.error = null;
      this.errors = {};

      try {
        const payload = {
          status: this.newStatus,
        };

        if (this.newMessage?.trim() !== "") {
          payload.message = this.newMessage;
        }

        const resp = await http.patch(`/api/orders/${this.currentOrder.id}`, payload);

        if (resp.data.success) {
          this.$emit("orderUpdated");
          window.location.reload();
        }
      } catch (e) {
        if (e.response?.status === 422) {
          this.errors = e.response.data.errors ?? {};
        } else {
          this.error = "An error occurred while updating the order.";
        }
      } finally {
        this.isLoading = false;
      }
    },
    formatDate(dateStr) {
      if (!dateStr) return "—";
      return new Date(dateStr).toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
      });
    },
    formatPrice(value) {
      const amount = Number(value);
      if (Number.isNaN(amount)) return "—";
      return new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "USD",
        maximumFractionDigits: 0,
      }).format(amount);
    },
  },
}
</script>

<template>
  <form v-if="currentOrder" class="detail-grid" @submit.prevent="updateOrder">

    <div v-if="error" class="error-banner">
      {{ error }}
    </div>

    <div class="detail-item" :class="{ 'has-error': errors.status }">
      <span class="detail-label">Status</span>
      <div class="input-wrapper">
        <select class="detail-value form-control" :class="{ 'is-invalid': errors.status }" v-model="newStatus">
          <option value="pending">pending</option>
          <option value="completed">completed</option>
          <option value="cancelled">cancelled</option>
        </select>
        <span v-if="errors.status" class="field-error">{{ errors.status[0] }}</span>
      </div>
    </div>

    <div class="detail-item" :class="{ 'has-error': errors.message }">
      <span class="detail-label">Message</span>
      <div class="input-wrapper">
        <textarea rows="3" class="detail-value form-control message-area" :class="{ 'is-invalid': errors.message }" v-model="newMessage"/>
        <span v-if="errors.message" class="field-error">{{ errors.message[0] }}</span>
      </div>
    </div>

    <div class="detail-item">
      <span class="detail-label">Order ID</span>
      <span class="detail-value">{{ currentOrder.id }}</span>
    </div>
    <div class="detail-item">
      <span class="detail-label">User</span>
      <span class="detail-value">{{ currentOrder.user?.name ?? '—' }}</span>
    </div>
    <div class="detail-item">
      <span class="detail-label">Model</span>
      <span class="detail-value">{{ currentOrder.config?.car_model?.name ?? '—' }}</span>
    </div>
    <div class="detail-item">
      <span class="detail-label">Total price</span>
      <span class="detail-value">{{ formatPrice(currentOrder.total_price) }}</span>
    </div>
    <div class="detail-item">
      <span class="detail-label">Created at</span>
      <span class="detail-value">{{ formatDate(currentOrder.created_at) }}</span>
    </div>
    <div class="detail-item">
      <span class="detail-label">Last updated</span>
      <span class="detail-value">{{ formatDate(currentOrder.updated_at) }}</span>
    </div>

    <button type="submit" :disabled="isLoading" class="configure-btn btn btn-sm ms-auto d-inline-flex align-items-center gap-2
     px-4 py-2 mt-4 border border-dark-subtle text-body fw-medium text-uppercase small">
      {{ isLoading ? 'Saving...' : 'Save' }}
    </button>

  </form>
  <div v-else-if="isOrderMissing" class="error-banner">
    Order not found.
  </div>
  <div v-else class="detail-value">
    Loading order...
  </div>
</template>

<style scoped>
.detail-grid {
  display: flex;
  flex-direction: column;
  gap: 0;
}

.detail-item {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
  padding: 0.85rem 0;
  border-bottom: 1px solid #f0f0f0;
  gap: 1rem;
}

.detail-label {
  font-size: 0.8rem;
  color: #999;
  white-space: nowrap;
}

.detail-value {
  font-size: 0.875rem;
  color: #1a1a1a;
}
.configure-btn {
  letter-spacing: .12em;
  border-radius: 0 !important;
  transition: color .2s ease, background .2s ease;
}

.configure-btn:hover {
  background: var(--bs-body-color) !important;
  color: var(--bs-body-bg) !important;
}

.input-wrapper {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 0.25rem;
  flex: 1;
}

.message-area {
  min-height: 5.25rem;
}

.field-error {
  font-size: 0.72rem;
  color: #c0392b;
  letter-spacing: 0.02em;
}

.has-error {
  border-bottom-color: #f5c6c6;
}

.error-banner {
  font-size: 0.8rem;
  color: #c0392b;
  border: 1px solid #f5c6c6;
  padding: 0.65rem 1rem;
  margin-bottom: 0.5rem;
  letter-spacing: 0.02em;
}

.form-control.is-invalid {
  border-color: #c0392b;
  box-shadow: none;
}

.form-control.is-invalid:focus {
  border-color: #c0392b;
  box-shadow: 0 0 0 2px rgba(192, 57, 43, 0.12);
}
</style>
