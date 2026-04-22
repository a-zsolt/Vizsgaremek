<script>
export default {
  name: "NotAuthorizedView"
}
</script>

<template>
  <section>
    <div class="d-flex justify-content-center p-3 border-bottom">
      <RouterLink class="navbar-brand" :to="{ name: 'home' }">
        <img class="brand-logo" src="/Brand_light.png" alt="Bootstrap">
      </RouterLink>
    </div>

    <div class="d-flex flex-column align-items-center">
      <div class="error-number" style="font-size: 403px; line-height: 1;">
        <span>403</span>
      </div>
      <p style="font-size: 35px; margin: -67px;">Not authorized.</p>
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