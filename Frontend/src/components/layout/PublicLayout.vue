<script>
import NavBar from "@/components/NavBar.vue";

export default {
  name: "PublicLayout",
  components: {NavBar}
}
</script>

<template>
  <NavBar/>
  <RouterView :key="$route.name === 'model' ? $route.fullPath : undefined"/>
</template>

<style scoped>

</style>