<script>
export default {
  name: "AdminUserView",
  props: {
    users: {type: Array, required: true},
    userInitials: {type: Function, required: true},
    statusClass: {type: Function, required: true},
    updatedDate: {type: Function, required: true},
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
          <th>Email</th>
          <th>Role</th>
          <th>Joined</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(user, i) in users" :key="i">
          <td>
            <div class="d-flex align-items-center gap-2">
              <div class="user-avatar">{{ userInitials(user.name) }}</div>
              {{ user.name }}
            </div>
          </td>
          <td class="text-muted">{{ user.email }}</td>
          <td><span class="border px-2 role-badge" :class="statusClass(user.role)" >{{ user.role }}</span></td>
          <td class="text-muted">{{ updatedDate(user) }}</td>
          <td>
            <RouterLink :to="{ name: 'user-details', params: {user: user.id } }"
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
.user-avatar {
  width: 30px; height: 30px; border-radius: 50%;
  background: #111; color: #fff; font-size: 11px; font-weight: 600;
  display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.role-badge { font-size: 10px; text-transform: uppercase; letter-spacing: .06em; color: #555; }
</style>