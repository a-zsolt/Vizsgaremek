<script>
import {http} from "@/utils/http.js";

export default {
  name: "HomeView",
  data() {
    return {
      isLoading: true,
      error: null,
      carModels: []
    }
  },
  methods: {
    async getCarModels() {
      this.isLoading = true;
      this.error = null;

      try {
        const resp = await http.get("/api/models");

        this.carModels = resp.data.models;
      } catch (e) {
        this.error = e;
      } finally {
        this.isLoading = false;
      }
    }
  },
  mounted() {
    this.getCarModels();
  }
}
</script>

<template>
  <section id="carousel">
    <div id="carouselCaptions" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="1" class="active" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item">
        <div class="ratio ratio-16x9">
          <img src="https://live.staticflickr.com/65535/55150982291_287b90f8ef_3k.jpg?s=eyJpIjo1NTE1MDk4MjI5MSwiZSI6MTc3NTEzNjkzNiwicyI6IjhjZDA5M2NhZTJlYjM0MjAzNTU3YmZlOWZlYTJkM2MwMGYzMmNkZTQiLCJ2IjoxfQ" class="d-block w-100 object-fit-cover" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5>First slide label</h5>
          <p>Some representative placeholder content for the first slide.</p>
        </div>
      </div>
      <div class="carousel-item active">
        <div class="ratio ratio-16x9">
          <img src="https://live.staticflickr.com/65535/52530191344_77e5d4115f_3k.jpg?s=eyJpIjo1MjUzMDE5MTM0NCwiZSI6MTc3NTE0Mzk2NCwicyI6IjFiMmVkNWZkODM4OWNlYmQxYmUyMTFkNDBiODhlMWU5MWE1ZTlmYjIiLCJ2IjoxfQ" class="d-block w-100 object-fit-cover" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5>Carrera GT is now available for customization</h5>
          <p>The holy grail. The le mans designed v10 powered monster is now on our site.</p>
        </div>
      </div>
      <div class="carousel-item">
        <div class="ratio ratio-16x9">
          <img src="https://live.staticflickr.com/65535/55108098348_bfc8a7e1a3_3k.jpg?s=eyJpIjo1NTEwODA5ODM0OCwiZSI6MTc3NTEzNzE4NCwicyI6ImE1Y2I2NDdmM2I4Y2MwY2YwNDQxZjFjZGExMzVmYWYyNDBhNjU4YjgiLCJ2IjoxfQ" class="d-block w-100 object-fit-cover" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5>Third slide label</h5>
          <p>Some representative placeholder content for the third slide.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  </section>

  <section class="mt-5" id="modelCards">
    <div v-if="isLoading" class="d-flex align-items-center justify-content-center mb-5">
      <div class="d-flex align-items-center gap-2 text-muted">
        <div class="spinner-border spinner-border-sm" role="status"></div>
        <span>Loading...</span>
      </div>
    </div>

    <div v-else-if="error" class="d-flex align-items-center justify-content-center mb-5">
      <div class="alert alert-danger">
        {{ error }}
      </div>
    </div>
  </section>
</template>

<style scoped>
  #carousel {
    max-height: 80vh;
    overflow: hidden;
  }

  #carousel .ratio {
    max-height: 80vh;
    overflow: hidden;
  }
</style>