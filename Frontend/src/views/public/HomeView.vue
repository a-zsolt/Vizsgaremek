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
          <img src="https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/CarreraPromo.jpg" class="d-block w-100 object-fit-cover" alt="Carrera GT">
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

    <div v-else>
      <div class="hero" style="background-image: url('https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/HomeImg1.jpg')">
        <div class="hero-content">
          <h1>The 911 Speedster</h1>
          <p>
            Porsche enthusiast, designer and Speedster collector made
            his dream of a 911 Speedster (Type 993) come true via the Sonderwunsch
            programme. The result is a Factory One-Off car based entirely on the
            personal vision of the designer.
          </p>
          <button class="discover-btn">Discover</button>
        </div>
      </div>

      <div class="text-strip bg-dark">
        <span v-for="n in 20" :key="n">SONDERWUNSCH &nbsp;·&nbsp; </span>
      </div>

      <div class="hero" style="background-image: url('https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/HomeImg2.jpg')">
        <div class="hero-content">
          <h1>The 911 Speedster</h1>
          <p>
            Porsche enthusiast, designer and Speedster collector made
            his dream of a 911 Speedster (Type 993) come true via the Sonderwunsch
            programme. The result is a Factory One-Off car based entirely on the
            personal vision of the designer.
          </p>
          <button class="discover-btn">Discover</button>
        </div>
      </div>

      <div class="text-strip bg-dark">
        <span v-for="n in 20" :key="n">SONDERWUNSCH &nbsp;·&nbsp; </span>
      </div>

      <div class="hero" style="background-image: url('https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/HomeImg3.jpg')">
        <div class="hero-content">
          <h1>The 911 Speedster</h1>
          <p>
            Porsche enthusiast, designer and Speedster collector made
            his dream of a 911 Speedster (Type 993) come true via the Sonderwunsch
            programme. The result is a Factory One-Off car based entirely on the
            personal vision of the designer.
          </p>
          <button class="discover-btn">Discover</button>
        </div>
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

  .hero {
    min-height: 60vh;
    background-attachment: fixed;
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
  }

  .hero-content {
    padding: 0 80px;
    max-width: 3000px;
    color: #fff;
  }

  h1 {
    font-size: clamp(2rem, 4vw, 3.2rem);
    font-weight: 300;
    margin-bottom: 1rem;
    line-height: 1.15;
  }

  p {
    font-size: 14px;
    line-height: 1.65;
    margin-bottom: 2rem;
    opacity: 0.9;
  }

  .discover-btn {
    background: transparent;
    color: #fff;
    border: 1px solid #fff;
    padding: 12px 28px;
    font-size: 14px;
    cursor: pointer;
    letter-spacing: 0.04em;
    transition: background 0.2s, color 0.2s;
  }

  .discover-btn:hover {
    background: #fff;
    color: #000;
  }

  .text-strip {
    color: #fff;
    padding: 14px 0;
    font-size: 13px;
    letter-spacing: .15em;
    white-space: nowrap;
    overflow: hidden;
    text-transform: uppercase;
  }
</style>