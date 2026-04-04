<script>
export default {
  name: "NavBar"
}
</script>

<template>
  <nav class="navbar bg-body-tertiary">
    <div class="container d-flex flex-column align-items-center">
      <RouterLink class="navbar-brand" :to="{ name: 'home' }">
        <img class="brand-logo" src="/Brand_light.png" alt="Bootstrap">
      </RouterLink>
    </div>
  </nav>
</template>

<style scoped>
  .brand-logo {
    width: clamp(160px, 40vw, 300px);
    max-width: 300px;
    height: auto;
  }
</style>