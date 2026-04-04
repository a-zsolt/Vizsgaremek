<script>
import { http } from "@/utils/http.js";
export default {
  name: 'App',
  async created() {
    const token = localStorage.getItem('token')
    if (token) {
      try {
        const resp = await http.get('/api/auth/check')

        this.$root.user = resp.data.user

        localStorage.setItem('abilities', JSON.stringify(resp.data.abilities))
      } catch {
        localStorage.removeItem('token')
        localStorage.removeItem('abilities')
      }
    }
  }
}
</script>

<template>
  <RouterView/>
</template>

<style scoped></style>