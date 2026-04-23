<script>
export default {
  name: "NotFoundView"
}
</script>

<template>
  <section>
    <div class="d-flex justify-content-center p-3 border-bottom">
      <RouterLink class="navbar-brand" :to="{ name: 'home' }">
        <img class="brand-logo" src="/Brand_light.png" alt="Bootstrap">
      </RouterLink>
    </div>

    <div class="d-flex flex-column align-items-center mt-5">
      <div class="error-number" style="font-size: clamp(10rem, 25vw, 20rem); line-height: 1;">
        <span>404</span>
      </div>
      <p style="font-size: clamp(2rem, 5vw, 3rem); margin: -30px;">The page was not found.</p>
    </div>

    <div class="d-flex justify-content-center" style="margin-top: 200px;">
      <RouterLink :to="{name: 'home'}" type="button" class="btn btn-outline-secondary">
        To the home page
      </RouterLink>
    </div>
  </section>
</template>

<style scoped>
.brand-logo {
  width: clamp(160px, 40vw, 300px);
  max-width: 300px;
  height: auto;
}
.error-number {
  font-family: 'Montserrat', sans-serif;

  background: linear-gradient(180deg,
  #aaaaaa 30%,
  #dddddd 55%,
  #ffffff 80%);

  -webkit-background-clip: text;
  background-clip: text;

  -webkit-text-fill-color: transparent;
  color: transparent;
}
p {
  font-family: 'Montserrat', sans-serif;
}
</style>