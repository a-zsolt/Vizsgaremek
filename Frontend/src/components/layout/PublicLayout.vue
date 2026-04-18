<script>
import NavBar from "@/components/NavBar.vue";
import FooterBar from "@/components/FooterBar.vue"

export default {
  name: "PublicLayout",
  components: {NavBar, FooterBar}
}
</script>

<template>
  <NavBar/>
  <RouterView :key="$route.name === 'model' ? $route.fullPath : undefined"/>
  <FooterBar/>
</template>

<style scoped>

</style>