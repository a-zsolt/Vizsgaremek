<script>
export default {
  name: "CarouselComponent",
  props: {
    items: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      activeIndex: 0,
      visibleCards: 1,
      canScrollLeft: false,
      canScrollRight: true
    }
  },
  computed: {
    pageCount() {
      if (!this.items?.length) return 0;
      return Math.max(1, this.items.length - this.visibleCards + 1);
    }
  },
  methods: {
    scroll(direction) {
      const container = this.$refs.carousel;
      container.scrollBy({ left: direction * 304, behavior: 'smooth' });
    },
    onScroll() {
      const container = this.$refs.carousel;
      if (!container) return;
      const cardWidth = container.firstElementChild?.offsetWidth + 16 ?? 304;
      this.activeIndex = Math.round(container.scrollLeft / cardWidth);
      this.canScrollLeft = container.scrollLeft > 0;
      this.canScrollRight = container.scrollLeft < container.scrollWidth - container.offsetWidth - 1;
    },
    scrollTo(index) {
      const container = this.$refs.carousel;
      if (!container) return;
      const cardWidth = container.firstElementChild?.offsetWidth + 16 ?? 304;
      container.scrollTo({ left: index * cardWidth, behavior: 'smooth' });
      this.activeIndex = index;
    },
    updateVisibleCards() {
      const container = this.$refs.carousel;
      if (!container || !container.firstElementChild) return;
      const cardWidth = container.firstElementChild.offsetWidth + 16;
      this.visibleCards = Math.floor(container.offsetWidth / cardWidth);
    }
  },
  mounted() {
    this.updateVisibleCards();
    this.onScroll();
    window.addEventListener('resize', this.updateVisibleCards);
  },
  beforeUnmount() {
    window.removeEventListener('resize', this.updateVisibleCards);
  },
  watch: {
    items: {
      handler() {
        this.$nextTick(() => {
          this.updateVisibleCards();
          this.onScroll();
        });
      },
      deep: true
    }
  }
}
</script>

<template>
  <div class="carousel-wrapper">
    <!-- Track: buttons + cards -->
    <div class="carousel-track position-relative">
      <button v-if="canScrollLeft"
              class="carousel-overlay-btn carousel-overlay-btn--left"
              @click="scroll(-1)" aria-label="Previous">
        <i class="bi bi-chevron-left"></i>
      </button>

      <button v-if="canScrollRight"
              class="carousel-overlay-btn carousel-overlay-btn--right"
              @click="scroll(1)" aria-label="Next">
        <i class="bi bi-chevron-right"></i>
      </button>

      <div class="carousel-container" ref="carousel" @scroll="onScroll">
        <slot name="item" v-for="(item, index) in items" :key="index" :item="item">
          <!-- Default card structure if no slot is provided -->
        </slot>
      </div>
    </div>

    <!-- Dots outside the track -->
    <div v-if="pageCount > 1" class="d-flex justify-content-center gap-2 mt-3">
      <span v-for="i in pageCount" :key="i"
            class="dot" :class="{ active: (i - 1) === activeIndex }"
            @click="scrollTo(i - 1)" style="cursor: pointer"></span>
    </div>
  </div>
</template>

<style scoped>
.carousel-container {
  display: flex;
  gap: 1rem;
  overflow-x: auto;
  scroll-snap-type: x mandatory;
  scrollbar-width: none;
  -ms-overflow-style: none;
  padding-bottom: 0.5rem;
}

.carousel-container::-webkit-scrollbar { display: none; }
.carousel-container > * { scroll-snap-align: start; }

/* Blurred overlay buttons */
.carousel-overlay-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 10;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  border: 1px solid rgba(255, 255, 255, 0.3);
  background: rgba(255, 255, 255, 0.45);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  color: #1a1a1a;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: background 0.2s ease, transform 0.15s ease;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.carousel-overlay-btn:hover {
  background: rgba(255, 255, 255, 0.7);
  transform: translateY(-50%) scale(1.05);
}

.carousel-overlay-btn--left  { left: 0.75rem; }
.carousel-overlay-btn--right { right: 0.75rem; }

/* pill dots */
.dot {
  width: 6px;
  height: 6px;
  border-radius: 999px;
  background: #ccc;
  transition: width 0.3s ease, background 0.3s ease;
}

.dot.active {
  width: 20px;
  background: #1a1a1a;
}
</style>
