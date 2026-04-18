<script>
import {http} from "@/utils/http.js";

export default {
  name: "HomeView",
  data() {
    return {
      isLoading: true,
      error: null,
      carModels: [],
      cards: [
        {
          image: "https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/StepImg1.jpg",
          title: "You Choose the Car",
          text: "Browse our selection of iconic Porsche models and pick the one that speaks to you. Filter by model, era, and specification — we'll help you find the perfect match.",
        },
        {
          image: "https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/StepImg2.webp",
          title: "We Order & Receive It",
          text: "Once you've made your choice, we handle the rest. We source, purchase, and have the car delivered directly to our facility — no hassle, no compromise.",
        },
        {
          image: "https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/StepImg3.webp",
          title: "We Build Your Vision",
          text: "Our team gets to work. Using your exact configuration and historically accurate parts, we build your Porsche from the ground up — exactly the way you specified it.",
        },
      ],
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
          <img src="https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/TurboPromo.jpg" class="d-block w-100 object-fit-cover" alt="...">
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
          <img src="https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/GT3Promo.jpg" class="d-block w-100 object-fit-cover" alt="...">
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

  <section id="modelCards">
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
      <div class="summary text-center py-5 px-3">
        <h2>Sonderwunsch – Your Dream, Our Craft</h2>
        <p class="summary-text mx-auto">
          The Porsche Sonderwunsch programme allows every car to be truly one of a kind.
          Choose your model, personalise it down to the finest detail, and create the car you've always dreamed of.
          Whether it's a classic 911 or the modern Taycan – we turn every vision into reality.
        </p>
      </div>

      <div class="hero justify-content-end" style="background-image: url('https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/HomeImg1.jpg')">
        <div class="hero-content">
          <h1 class="h1-p-shadow">The past, rebuilt your way.</h1>
          <p class="h1-p-shadow">
            Choose your model. Pick your options. Relive the golden age of Porsche — one spec at a time.
          </p>
        </div>
      </div>

      <div class="text-strip bg-dark">
        <span v-for="n in 20" :key="n">SONDERWUNSCH &nbsp;·&nbsp; </span>
      </div>

      <div class="hero" style="background-image: url('https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/HomeImg2.jpg')">
        <div class="hero-content">
          <h1 class="h1-p-shadow">Every detail. Exactly as built.</h1>
          <p class="h1-p-shadow">
            Historically accurate factory options across iconic Porsche models. Configure your legend down to the last specification.
          </p>
        </div>
      </div>

      <div class="text-strip bg-dark">
        <span v-for="n in 20" :key="n">SONDERWUNSCH &nbsp;·&nbsp; </span>
      </div>

      <div class="hero justify-content-end" style="background-image: url('https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/HomeImg3.jpg')">
        <div class="hero-content">
          <h1 class="h1-p-shadow">Your vision. Our history.</h1>
          <p class="h1-p-shadow">
            Three legendary models. Hundreds of original options. One configurator built for those who know the difference.
          </p>
        </div>
      </div>
    </div>

    <div class="py-5">
      <div class="container">

        <h2 class="text-center fw-bold mb-5">Your path to your Porsche</h2>

        <div class="row g-4">
          <div v-for="(card, i) in cards" :key="i" class="col-12 col-md-4">

            <div class="card-img-wrap mb-3">
              <img :src="card.image" :alt="card.title" />
              <span class="badge-num">0{{ i + 1 }}</span>
            </div>

            <h5 class="fw-bold mb-2">{{ card.title }}</h5>
            <p class="text-muted" style="font-size:14px; line-height:1.7;">{{ card.text }}</p>

          </div>
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
    max-width: 800px;
    color: #fff;
  }

  h1 {
    font-size: clamp(2rem, 4vw, 3.2rem);
    font-weight: 300;
    margin-bottom: 1rem;
    line-height: 1.15;
  }

  p {
    font-size: 18px;
    line-height: 1.65;
    margin-bottom: 2rem;
    opacity: 0.9;
  }

  .h1-p-shadow {
    text-shadow: 0 2px 12px rgba(0,0,0,0.8), 0 1px 3px rgba(0,0,0,0.9);
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

  .summary h2 {
    font-size: clamp(1.5rem, 3vw, 2.2rem);
    font-weight: 300;
    margin-bottom: 1.2rem;
  }

  .summary-text {
    max-width: 700px;
    font-size: 16px;
    line-height: 1.75;
    color: #555;
  }

  .card-img-wrap {
    position: relative;
    overflow: hidden;
    border-radius: 4px;
    aspect-ratio: 4/3;
  }

  .card-img-wrap img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }
</style>