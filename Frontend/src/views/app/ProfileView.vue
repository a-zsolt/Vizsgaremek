<script>
import { http } from "@/utils/http.js";
import OrderDetailsView from "@/views/app/OrderDetailsView.vue";

export default {
  name: "ProfileView",
  components: {OrderDetailsView},
  data() {
    return {
      user: null,
      abilities: [],
      isEditing: false,
      isLoading: false,
      error: null,
    };
  },
  methods: {
    // Load current user and abilities from API
    async fetchProfile() {
      this.isLoading = true;
      this.error = null;
      try {
        const resp = await http.get("/api/auth/check");
        this.user = resp.data.user;
        this.abilities = resp.data.abilities;
      } catch (e) {
        this.error = e;
      } finally {
        this.isLoading = false;
      }
    },

    // Generate placeholder avatar URL from user name
    avatarUrl(name) {
      return `https://ui-avatars.com/api/?name=${name}&background=1a1a1a&color=fff&size=128&bold=true`;
    },

    // Extract a large background token from model name
    modelBgText(name) {
      if (!name) return '';
      const tokens = name.split(' ');
      const numericToken = tokens.find(t => /^[\d.]+$/.test(t));
      return numericToken ?? tokens[0];
    },

    // Human-friendly "time ago" text for updated_at
    updatedText(item) {
      const now = new Date();
      const updated = new Date(item.updated_at);
      const diffMs = now - updated;

      const diffMins = Math.floor(diffMs / 60000);
      const diffHours = Math.floor(diffMs / 3600000);
      const diffDays = Math.floor(diffMs / 86400000);

      if (diffMins < 1) return 'Just now';
      if (diffMins < 60) return `${diffMins} min${diffMins > 1 ? 's' : ''} ago`;
      if (diffHours < 24) return `${diffHours} hour${diffHours > 1 ? 's' : ''} ago`;
      return `${diffDays} day${diffDays > 1 ? 's' : ''} ago`;
    },
  },
  mounted() {
    this.fetchProfile();
  },
};
</script>

<template>
  <main class="profile-page">

    <!-- Loading -->
    <div v-if="isLoading" class="d-flex justify-content-center align-items-center" style="height: 60vh;">
      <div class="spinner-border spinner-border-sm text-secondary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <!-- Error -->
    <div v-else-if="error" class="container py-5 text-center text-muted">
      <p class="label-text">Unable to load profile</p>
    </div>

    <!-- Profile -->
    <template v-else-if="user">

      <!-- Hero strip -->
      <section class="profile-hero border-bottom">
        <div class="container-xl">
          <div class="d-flex align-items-center gap-4">
            <img
                :src="avatarUrl(user.name)"
                :alt="user.name"
                class="profile-avatar"
                width="72"
                height="72"
            />
            <div>
              <p class="label-text mb-1">MEMBER PROFILE</p>
              <h1 class="profile-name">{{ user.name }}</h1>
            </div>
            <div class="ms-auto d-none d-md-flex gap-2">
              <span
                  v-for="ability in abilities"
                  :key="ability"
                  class="ability-badge text-uppercase"
              >{{ ability }}</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Content -->
      <section class="container-xl profile-body">
        <div class="row g-0">

          <!-- Left column: details -->
          <div class="col-12 col-md-9 profile-col border-end pe-md-5">

            <RouterView :user="user" :isEditing="isEditing" @profileUpdated="isEditing = !isEditing; fetchProfile()" :modelBgText="modelBgText" :updatedText="updatedText"/>

          </div>

          <!-- Right column: abilities / quick links -->
          <div class="col-12 col-md-3 profile-col ps-md-5">

            <div class="profile-section">
              <p class="label-text">QUICK ACTIONS</p>
              <div class="d-flex flex-column gap-2">
                <a v-if="this.$route.name === 'profile-details'" @click="isEditing = !isEditing" class="quick-link">
                  <span>Edit Details</span> <i class="bi bi-person-gear"></i>
                </a>
                <RouterLink v-else :to="{ name: 'profile-details' }" class="quick-link">
                  <span>Profile Details</span> <span>→</span>
                </RouterLink>
                <a class="quick-link" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas">
                  Browse Models <span>→</span>
                </a>
                <RouterLink :to="{ name: 'configs-list' }" class="quick-link">
                  Saved Configs <span>→</span>
                </RouterLink>
                <RouterLink :to="{ name: 'orders-list' }" class="quick-link">
                  My Orders <span>→</span>
                </RouterLink>
                <RouterLink v-if="abilities.includes('admin')" :to="{ name: 'dashboard' }" class="quick-link">
                  Admin Dashboard <span>→</span>
                </RouterLink>
              </div>
            </div>
          </div>
        </div>
      </section>

    </template>
  </main>
</template>

<style scoped>
.profile-page {
  min-height: 100vh;
  background: #fff;
}

/* Hero */
.profile-hero {
  padding: 3rem 0 2.5rem;
}

.profile-avatar {
  border-radius: 50%;
  flex-shrink: 0;
}

.profile-name {
  font-size: clamp(1.5rem, 3vw, 2.25rem);
  font-weight: 300;
  letter-spacing: -0.02em;
  margin: 0;
  color: #1a1a1a;
}

/* Shared label style matching the rest of the site */
.label-text {
  font-size: 0.65rem;
  letter-spacing: 0.12em;
  color: #999;
  font-weight: 500;
  margin-bottom: 1.25rem;
}

/* Ability badges (hero row) */
.ability-badge {
  font-size: 0.6rem;
  letter-spacing: 0.1em;
  border: 1px solid #ddd;
  padding: 0.25rem 0.65rem;
  color: #666;
}

/* Body layout */
.profile-body {
  padding-top: 3rem;
  padding-bottom: 5rem;
}

.profile-col {
  padding-top: 0;
}

.profile-section {
  margin-bottom: 3rem;
}

/* Ability rows (right column) */
.ability-row {
  padding: 0.75rem 0;
  border-bottom: 1px solid #f0f0f0;
  font-size: 0.875rem;
  color: #1a1a1a;
}

.ability-row svg {
  color: #999;
}

/* Quick links */
.quick-link {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.85rem 0;
  border-bottom: 1px solid #f0f0f0;
  font-size: 0.875rem;
  color: #1a1a1a;
  text-decoration: none;
  transition: color 0.15s ease;
  cursor: pointer;
}

.quick-link:hover {
  color: #555;
}

/* Mobile stacking */
@media (max-width: 767px) {
  .profile-hero {
    padding: 2rem 0 1.75rem;
  }

  .border-end {
    border-right: none !important;
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 2rem;
    margin-bottom: 2rem;
  }
}
</style>