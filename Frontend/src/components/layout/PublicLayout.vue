<script>
import NavBar from "@/components/NavBar.vue";

export default {
  name: "PublicLayout",
  components: {NavBar}
}
</script>

<template>
  <NavBar/>
  <RouterView/>
</template>

<style scoped>

</style>