<script>
export default {
  name: "AdminOrderListView",
  props: {
    orders: {type: Array, required: true},
    statusClass: {type: Function, required: true},
  }
}
</script>

<template>
  <div class="p-4 bg-light min-vh-100">

    <div class="bg-white border p-3">
      <table class="table table-sm table-hover mb-0">
        <thead class="text-muted text-uppercase" style="font-size:11px; letter-spacing:.06em;">
        <tr>
          <th>User</th>
          <th>Model</th>
          <th>Message</th>
          <th>Status</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(order, i) in orders" :key="i">
          <td>
            <div class="d-flex align-items-center gap-2">
              <div class="user-avatar">{{ order.user_id }}</div>
              {{ order.user?.name }}
            </div>
          </td>
          <td class="text-muted">{{ order.config?.car_model?.name }}</td>
          <td class="text-muted">{{ order.message }}</td>
          <td><span class="border px-2 role-badge" :class="statusClass(order.status)" >{{ order.status }}</span></td>
          <td>
            <RouterLink :to="{ name: 'order-details', params: {order: order.id } }"
                        class="text-dark text-decoration-none btn btn-sm btn-outline-secondary">
              <i class="bi bi-arrow-right"></i></RouterLink>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style scoped>

</style>