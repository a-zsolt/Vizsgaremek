<script>
import { http } from "@/utils/http.js";
export default {
  name: 'App',
  async created() {
    const token = localStorage.getItem('token')
    if (token) {
      try {
        const resp = await http.get('/api/auth/check')

        localStorage.setItem('abilities', JSON.stringify(resp.data.abilities))
        localStorage.setItem('user', JSON.stringify(resp.data.user));
      } catch {
        localStorage.removeItem('token')
        localStorage.removeItem('abilities')
        localStorage.removeItem('user')
      }
    }
  }
}
</script>

<template>
  <RouterView/>
</template>

<style scoped></style>