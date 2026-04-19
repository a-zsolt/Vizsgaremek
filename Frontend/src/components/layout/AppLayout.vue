<script>
import NavBar from "@/components/NavBar.vue";

export default {
  name: 'AppLayout',
  components: {NavBar},
}
</script>

<template>
  <NavBar/>
  <RouterView/>
</template>

<style scoped>

</style>