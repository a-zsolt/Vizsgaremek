<script>
import { http } from "@/utils/http.js";

export default {
  name: "DashboardView",
  data() {
    return {
      users: [],
      orders: [],
      isLoading: false,
      error: null,
    };
  },
  methods: {
    async fetchInfo() {
      this.isLoading = true;
      this.error = null;
      try {
        const resp = await http.get("/api/auth/allData");
        console.log(resp.data);
        this.users = resp.data.users;
        this.orders = resp.data.orders;
      } catch (e) {
        this.error = e;
      } finally {
        this.isLoading = false;
      }
    },
    statusClass(status) {
      const map = {
        'pending': 'badge bg-warning text-white',
        'completed': 'badge bg-success text-white',
        'cancelled': 'badge bg-danger text-white',
        'admin': 'badge bg-danger text-white',
        'user': 'badge bg-secondary text-white',
      };
      return map[status] || 'badge bg-secondary';
    },
    userInitials(name) {
      const names = name.split(' ');
      return names.map(n => n[0]).join('').toUpperCase();
    },
    updatedDate(user) {
      const now = new Date();
      const updated = new Date(user.created_at);
      const diffMs = now - updated;

      const diffMins = Math.floor(diffMs / 60000);
      const diffHours = Math.floor(diffMs / 3600000);
      const diffDays = Math.floor(diffMs / 86400000);

      if (diffMins < 1) return 'Just now';
      if (diffMins < 60) return `${diffMins} min${diffMins > 1 ? 's' : ''} ago`;
      if (diffHours < 24) return `${diffHours} hour${diffHours > 1 ? 's' : ''} ago`;
      return `${diffDays} day${diffDays > 1 ? 's' : ''} ago`;
    },
  },
  mounted(){
    this.fetchInfo();
  }
}
</script>

<template>
  <div class="p-4 bg-light min-vh-100">

    <!-- Header -->
    <div class="border-bottom pb-3 mb-4">
      <h4 class="fw-light mb-0">Admin Dashboard</h4>
      <small class="text-muted">Overview of all activity</small>
    </div>

    <!-- Stats
    <div class="row g-3 mb-4">
      <div v-for="(stat, i) in stats" :key="i" class="col-6 col-md-3">
        <div class="bg-white border p-3">
          <div class="stat-value">{{ stat.value }}</div>
          <div class="text-uppercase text-muted stat-label">{{ stat.label }}</div>
          <small class="text-muted">{{ stat.delta }}</small>
        </div>
      </div>
    </div>
    -->
    <div class="d-flex gap-5 border-bottom pb-3 mb-4">
      <RouterLink :to="{name: 'users-list'}" style="text-decoration: none;">
        <h4 class="fw-light mb-0">Users</h4>
        <small class="text-muted">All registered members</small>
      </RouterLink>
      <RouterLink :to="{name: 'orders'}" style="text-decoration: none;">
        <h4 class="fw-light mb-0">Orders</h4>
        <small class="text-muted">All orders</small>
      </RouterLink>
    </div>
    <RouterView :users="users" :orders="orders"
                :userInitials="userInitials" :statusClass="statusClass" :updatedDate="updatedDate"
    />
  </div>
</template>

<style scoped>
.stat-value { font-size: 1.6rem; font-weight: 300; letter-spacing: -0.02em; }
.stat-label { font-size: 11px; letter-spacing: .07em; margin: 4px 0 2px; }
</style>