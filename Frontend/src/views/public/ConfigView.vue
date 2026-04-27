<script>
import {http} from "@/utils/http.js";

export default {
  name: "ConfigView",
  data() {
    return {
      model: [],
      isLoading: false,
      error: null,
      userId:  JSON.parse(localStorage.getItem('user'))?.id,
      config: {
        color: 0,
        wheels: 0,
        interior: {},
        accessories: {}
      },
      savedConfigId: null
    }
  },
  methods: {
    // Load selected car model with specs and options
    async fetchModel() {
      this.isLoading = true;
      this.error = null;
      try {
        const resp = await http.get(`/api/models/${this.$route.params.model}`);
        this.model = resp.data.data;

        this.config.color = this.model.options.colors[0].id;
        this.config.wheels = this.model.options.wheels[0].id;

        console.log(resp.data.data);
      } catch (e) {
        this.error = e;
      } finally {
        this.isLoading = false;
      }
    },

    // Toggle an accessory selection by id
    toggleAccessory(id) {
      this.config.accessories = {
        ...this.config.accessories,
        [id]: !this.config.accessories[id]
      };
    },

    // Persist current configuration to backend
    async saveConfig() {
      try {
        const interiorIds = Object.values(this.config.interior)
            .filter(id => id != null)
            .map(id => +id);

        const accessoryIds = Object.entries(this.config.accessories)
            .filter(([, checked]) => checked)
            .map(([id]) => +id);

        let payload = {
          user_id: this.userId,
          car_model_id: this.info.id,
          color_option_id: this.config.color,
          wheel_option_id: this.config.wheels || null,
          interior_option_ids: interiorIds,
          accessory_ids: accessoryIds,
        };

        payload = Object.fromEntries(
            Object.entries(payload).filter(([, value]) => value !== null)
        );

        const resp = await http.post('/api/configs/', payload);
        this.savedConfigId = resp.data.data?.id ?? null;

        this.$router.push({name: 'configs-list'});
      } catch (e) {
        console.error('Failed to save config:', e);
      }
    },

    // Create order from saved (or just-saved) configuration
    async placeOrder() {
      try {
        // Save first if not already saved
        if (!this.savedConfigId) {
          await this.saveConfig();
        }

        const payload = {
          user_id: this.userId,
          config_id: this.savedConfigId,
          message: 'Order is waiting for approval.',
          status: 'pending'
        };

        const resp = await http.post('/api/orders/', payload);

        this.$router.push({name: 'orders-list'});
      } catch (e) {
        console.error('Failed to place order:', e);
      }
    }
  },
  computed: {
    info() { return this.model?.model_info ?? {}; },
    specs() { return this.model?.specs ?? {}; },
    options() { return this.model?.options ?? {}; },

    selectedColorName() {
      return this.options.colors?.find(c => c.id === this.config.color)?.name ?? '';
    },
    selectedColorPrice() {
      return this.options.colors?.find(c => c.id === this.config.color)?.price ?? 0;
    },
    selectedWheelName() {
      return this.options.wheels?.find(w => w.id === this.config.wheels)?.name ?? '';
    },
    totalPrice() {
      let total = this.info.base_price ?? 0;
      total += this.selectedColorPrice;
      total += this.options.wheels?.find(w => w.id === this.config.wheels)?.price ?? 0;
      total += Object.entries(this.config.interior).reduce((sum, [part, id]) => {
        return sum + (this.options.interior_options?.find(i => i.id === id)?.price ?? 0);
      }, 0);
      total += Object.entries(this.config.accessories).reduce((sum, [id, checked]) => {
        return sum + (checked ? (this.options.accessories?.find(a => a.id === +id)?.price ?? 0) : 0);
      }, 0);
      return total;
    },
    groupedInterior() {
      const groups = {};
      (this.options.interior_options ?? []).forEach(item => {
        if (!groups[item.part_name]) groups[item.part_name] = [];
        groups[item.part_name].push(item);
      });
      return groups;
    },
  },
  mounted() {
    this.fetchModel();
  }
}
</script>

<template>
  <main class="config-page">
    <div class="config-layout">

      <!-- 3D Showroom -->
      <section class="bg-light d-flex align-items-center justify-content-center">
        <h1 class="text-center text-muted">3D panel</h1>
      </section>

      <!-- Options panel -->
      <aside class="config-panel d-flex flex-column border-start overflow-y-auto bg-white">

        <!-- Header -->
        <div class="px-4 pt-4 pb-3 border-bottom">
          <p class="label-text mb-1">CONFIGURATOR</p>
          <h2 class="fw-light fs-5 mb-1">{{ info.name }}</h2>
          <p class="text-muted small mb-0">Starting at ${{ info.base_price?.toLocaleString() }}</p>
        </div>

        <!-- Price summary -->
        <div class="d-flex justify-content-between align-items-center px-4 py-3 bg-light border-bottom">
          <span class="label-text mb-0">TOTAL</span>
          <span class="fw-medium">${{ totalPrice.toLocaleString() }}</span>
        </div>

        <!-- Accordion -->
        <div class="accordion accordion--flat">

          <!-- Colors -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button"
                      data-bs-toggle="collapse" data-bs-target="#panel1"
                      aria-expanded="true" aria-controls="panel1">
                <span>Color</span>
                <span class="accordion-selected-label">{{ selectedColorName }}</span>
              </button>
            </h2>
            <div id="panel1" class="accordion-collapse collapse show">
              <div class="accordion-body">
                <div class="d-flex flex-wrap gap-2">
                  <div
                      v-for="color in options.colors" :key="color.id"
                      class="color-swatch"
                      :class="{ 'color-swatch--selected': config.color === color.id }"
                      :style="{ backgroundColor: color.hex_code }"
                      :title="color.name"
                      @click="config.color = color.id"
                  />
                </div>
                <p v-if="selectedColorName" class="text-muted mt-2 mb-0 small">
                  {{ selectedColorName }} · +${{ selectedColorPrice?.toLocaleString() }}
                </p>
              </div>
            </div>
          </div>

          <!-- Wheels -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button"
                      data-bs-toggle="collapse" data-bs-target="#panel2"
                      aria-expanded="false" aria-controls="panel2">
                <span>Wheels</span>
                <span class="accordion-selected-label">{{ selectedWheelName }}</span>
              </button>
            </h2>
            <div id="panel2" class="accordion-collapse collapse">
              <div class="accordion-body p-0">
                <div
                    v-for="wheel in options.wheels" :key="wheel.id"
                    class="option-row d-flex align-items-center gap-3 px-4 py-3 border-bottom"
                    :class="{ 'option-row--selected': config.wheels === wheel.id }"
                    @click="config.wheels = wheel.id"
                >
                  <div class="option-img bg-light flex-shrink-0">
                    <img :src="wheel.img_url" :alt="wheel.name" class="p-1" />
                  </div>
                  <div class="flex-grow-1 overflow-hidden">
                    <p class="small fw-medium mb-0 text-truncate">{{ wheel.name }}</p>
                    <p class="x-small text-muted mb-0">{{ wheel.color }} · {{ wheel.material }} · {{ wheel.size }}"</p>
                  </div>
                  <span class="small text-nowrap text-muted">${{ wheel.price.toLocaleString() }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Interior -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button"
                      data-bs-toggle="collapse" data-bs-target="#panel3"
                      aria-expanded="false" aria-controls="panel3">
                Interior
              </button>
            </h2>
            <div id="panel3" class="accordion-collapse collapse">
              <div class="accordion-body p-0">
                <template v-for="(items, partName) in groupedInterior" :key="partName">
                  <div class="px-4 py-2 bg-light border-bottom label-text">{{ partName }}</div>
                  <div
                      v-for="item in items" :key="item.id"
                      class="option-row d-flex align-items-center gap-3 px-4 py-3 border-bottom"
                      :class="{ 'option-row--selected': config.interior[partName] === item.id }"
                      @click="config.interior = { ...config.interior, [partName]: config.interior[partName] === item.id ? null : item.id }"
                  >
                    <div class="flex-grow-1">
                      <p class="small fw-medium mb-0">{{ item.material }} · {{ item.color }}</p>
                    </div>
                    <span class="small text-nowrap text-muted">${{ item.price.toLocaleString() }}</span>
                  </div>
                </template>
              </div>
            </div>
          </div>

          <!-- Accessories -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button"
                      data-bs-toggle="collapse" data-bs-target="#panel4"
                      aria-expanded="false" aria-controls="panel4">
                Accessories
              </button>
            </h2>
            <div id="panel4" class="accordion-collapse collapse">
              <div class="accordion-body p-0">
                <div
                    v-for="acc in options.accessories" :key="acc.id"
                    class="option-row d-flex align-items-center gap-3 px-4 py-3 border-bottom"
                    :class="{ 'option-row--selected': config.accessories[acc.id] }"
                    @click="toggleAccessory(acc.id)"
                >
                  <div class="flex-grow-1">
                    <p class="small fw-medium mb-0">{{ acc.name }}</p>
                  </div>
                  <span class="small text-nowrap text-muted">${{ acc.price.toLocaleString() }}</span>
                  <i class="bi fs-6" :class="config.accessories[acc.id] ? 'bi-check-square' : 'bi-square'"></i>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Footer -->
        <div class="px-4 py-4 border-top mt-auto d-flex flex-column gap-2">
          <button class="btn btn-outline-dark rounded-0 text-uppercase fw-medium small py-3 letter-spacing" @click="saveConfig">
            Save Configuration
          </button>
          <button class="btn btn-dark rounded-0 text-uppercase fw-medium small py-3 letter-spacing" @click="placeOrder">
            Place Order
          </button>
        </div>

      </aside>
    </div>
  </main>
</template>

<style scoped>
.config-page {
  height: 100vh;
  overflow: hidden;
}

.config-layout {
  display: grid;
  grid-template-columns: 1fr 420px;
  height: 100%;
}

.label-text {
  font-size: 0.65rem;
  letter-spacing: 0.12em;
  color: #999;
  font-weight: 500;
}

.x-small { font-size: 0.7rem; }

.letter-spacing { letter-spacing: 0.1em; }

/* Accordion overrides */
.accordion--flat .accordion-item { border-left: none; border-right: none; border-radius: 0 !important; }
.accordion--flat .accordion-button { font-size: 0.8rem; font-weight: 500; letter-spacing: 0.08em; text-transform: uppercase; background: #fff; color: #1a1a1a; box-shadow: none; }
.accordion--flat .accordion-button:not(.collapsed) { background: #fff; color: #1a1a1a; box-shadow: none; }
.accordion-selected-label { font-size: 0.7rem; color: #999; font-weight: 400; letter-spacing: 0.04em; text-transform: none; margin-left: 0.75rem; margin-right: auto; }

/* Color swatches */
.color-swatch { width: 2.25rem; height: 2.25rem; border-radius: 4px; cursor: pointer; border: 2px solid transparent; transition: border-color 0.15s ease; }
.color-swatch--selected { border-color: #1a1a1a; outline: 2px solid #fff; outline-offset: -4px; }

/* Option rows */
.option-row { cursor: pointer; transition: background 0.15s ease; }
.option-row:hover { background: #fafafa; }
.option-row--selected { background: #f5f5f5; border-left: 2px solid #1a1a1a !important; }

/* Wheel image */
.option-img { width: 56px; height: 56px; }
.option-img img { width: 100%; height: 100%; object-fit: contain; }

@media (max-width: 768px) {
  .config-layout { grid-template-columns: 1fr; grid-template-rows: 50vh 1fr; height: auto; }
  .config-page { height: auto; overflow: auto; }
}
</style>