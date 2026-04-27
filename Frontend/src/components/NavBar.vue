<script>
import { http } from "@/utils/http.js";
import {useRouter} from "vue-router";
import ModelCard from "@/components/ModelCard.vue";

export default {
  name: "NavBar",
  components: {ModelCard},
  data() {
    return {
      error: null,
      routes: [],
      isLoggedIn: !!localStorage.getItem('token'),
      abilities: JSON.parse(localStorage.getItem('abilities') || '[]'),
      carModels: []
    }
  },
  computed: {
    user() {
      this.$route;
      const raw = localStorage.getItem('user');
      return raw ? JSON.parse(raw) : null;
    },
  },
  methods: {
    // Collect all registered routes for menu/offcanvas
    getAllRoutes() {
      this.routes = useRouter().getRoutes();
    },
    // Call API logout and clear local session
    async logOut() {
      try {
        await http.post('/api/auth/logout');

        localStorage.removeItem('token');
        localStorage.removeItem('abilities');
        localStorage.removeItem('user')

        this.isLoggedIn = false
        this.$router.push({ name: "home" });
      } catch (e) {
        this.error = e;
      }
    },
    // Fetch car models for the aside offcanvas list
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
    },
    avatarUrl(name) {
      return `https://ui-avatars.com/api/?name=${name}&background=1a1a1a&color=fff&size=128&bold=true`;
    }
  },
  mounted() {
    this.getAllRoutes();
    this.getCarModels();
  }
}
</script>

<template>
  <nav class="navbar bg-body-tertiary">
    <div class="container-fluid d-flex flex-row align-items-center">
      <!-- Aside menu -->
      <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas"><i class="bi bi-list"></i></button>

      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

          <div id="carModelList" class="vstack gap-2">
            <h1 class="h4">Models</h1>

            <ModelCard/>
          </div>

        </div>
      </div>

      <!-- Centered brand icon -->
      <RouterLink class="navbar-brand" :to="{ name: 'home' }">
        <img class="brand-logo" src="/Brand_light.png" alt="Bootstrap">
      </RouterLink>

      <!-- Profile menu (LoggedIn) -->
      <div v-if="isLoggedIn" class="dropdown text-end">
        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
          <img :src="avatarUrl(user.name)" alt="mdo" width="32" height="32" class="rounded-circle" />
        </a>
        <ul class="dropdown-menu dropdown-menu-end text-small">
          <li><span class="dropdown-item-text">{{ user?.name }}</span></li>
          <li><hr class="dropdown-divider" /></li>
          <li><RouterLink v-if="abilities?.includes('admin')" class="dropdown-item" :to="{name: 'dashboard'}">Admin Dashboard</RouterLink></li>
          <li><RouterLink class="dropdown-item" :to="{name: 'orders-list'}">Orders</RouterLink></li>
          <li><RouterLink class="dropdown-item" :to="{name: 'configs-list'}">Configs</RouterLink></li>
          <li><RouterLink class="dropdown-item" :to="{name: 'profile-details'}">Profile</RouterLink></li>
          <li><hr class="dropdown-divider" /></li>
          <li><button class="dropdown-item" @click="logOut">Sign out</button></li>
        </ul>
      </div>

      <!-- Profile menu (Guest) -->
      <div v-else class="dropdown text-end">
        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
           aria-expanded="false">
          <i class="bi bi-person"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end text-small">
          <li><RouterLink class="dropdown-item" :to="{name: 'register'}">Register</RouterLink></li>
          <li><hr class="dropdown-divider"/></li>
          <li><RouterLink class="dropdown-item" :to="{name: 'login'}">Log In</RouterLink></li>
        </ul>
      </div>
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