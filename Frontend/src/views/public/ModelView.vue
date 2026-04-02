<script>
import {http} from "@/utils/http.js";

export default {
  name: "ModelView",
  data() {
    return {
      isLoading: true,
      error: null,
      model: []
    }
  },
  methods: {
    async fetchModel() {
      this.isLoading = true;
      this.error = null;

      try {
        const resp = await http.get(`/api/models/${this.$route.params.model}`);

        this.model = resp.data.data;
      } catch (e) {
        this.error = e;
      } finally {
        this.isLoading = false;
      }
    }
  },
  mounted() {
    this.fetchModel();
  }
}
</script>

<template>
<section class="container p-5">
  <h1>Model info page</h1>

  <div v-if="isLoading" class="d-flex align-items-center gap-2 text-muted">
    <div class="spinner-border spinner-border-sm" role="status"></div>
    <span>Loading...</span>
  </div>

  <div v-else-if="error" class="alert alert-danger">
      {{ error }}
  </div>

  <template v-else>
    <div class="d-flex align-items-center justify-content-between mb-2">
      <h6 class="text-muted text-uppercase fw-semibold mb-0">
        <i class="bi bi-bug me-1"></i> Debug — model data
      </h6>
      <span class="badge bg-secondary">{{ $route.params.model }}</span>
    </div>
    <pre class="bg-dark text-success rounded p-3 border border-secondary" style="font-size: .85rem; max-height: 80vh; overflow-y: auto;"><code>{{ JSON.stringify(model, null, 2) }}</code></pre>
  </template>
</section>
</template>

<style scoped>

</style>