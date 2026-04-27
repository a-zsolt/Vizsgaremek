<script>
import {http} from "@/utils/http.js";
export default {
  name: "AdminUserDetailsView",
  props: {
    id: {type: [String, Number], required: true},
    users: {type: Array, default: () => []},
  },
  emits: ["profileUpdated"],
  data() {
    return {
      isLoading: false,
      error: null,
      errors: {},
      newEmail: "",
      newName: "",
      newPassword: "",
    }
  },
  computed: {
    // Currently selected user (by route param id)
    currentUser() {
      return this.users.find(u => Number(u.id) === Number(this.id)) ?? null;
    },
    // True if users loaded but the requested user is not found
    isUserMissing() {
      return this.users.length > 0 && !this.currentUser;
    }
  },
  watch: {
    currentUser: {
      immediate: true,
      handler(user) {
        this.newEmail = user?.email ?? "";
        this.newName = user?.name ?? "";
      }
    }
  },
  methods: {
    async updateProfile() {
      if (!this.currentUser) {
        this.error = "User not found.";
        return;
      }
      this.isLoading = true;
      this.error = null;
      this.errors = {};

      try {
        const payload = {
          name: this.newName,
          email: this.newEmail,
        };
        if (this.newPassword) {
          payload.password = this.newPassword;
        }
        const resp = await http.patch(`/api/auth/update/${this.currentUser.id}`, payload);

        if (resp.data.success) {
          this.$emit("profileUpdated");
          window.location.reload({name: "users-list"});
        }

      } catch (e) {
        if (e.response?.status === 422) {
          this.errors = e.response.data.errors ?? {};
        } else {
          this.error = "An error occurred while updating the profile.";
        }
      } finally {
        this.isLoading = false;
      }
    },
    formatDate(dateStr) {
      if (!dateStr) return "—";
      return new Date(dateStr).toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
      });
    },
  },

}
</script>

<template>
  <form v-if="currentUser" class="detail-grid" @submit.prevent="updateProfile">

    <!-- General error (non-422) -->
    <div v-if="error" class="error-banner">
      {{ error }}
    </div>

    <div class="detail-item" :class="{ 'has-error': errors.name }">
      <span class="detail-label">Full name</span>
      <div class="input-wrapper">
        <input type="text" class="detail-value form-control" :class="{ 'is-invalid': errors.name }" v-model="newName"/>
        <span v-if="errors.name" class="field-error">{{ errors.name[0] }}</span>
      </div>
    </div>

    <div class="detail-item" :class="{ 'has-error': errors.email }">
      <span class="detail-label">Email address</span>
      <div class="input-wrapper">
        <input type="text" class="detail-value form-control" :class="{ 'is-invalid': errors.email }" v-model="newEmail"/>
        <span v-if="errors.email" class="field-error">{{ errors.email[0] }}</span>
      </div>
    </div>

    <div class="detail-item" :class="{ 'has-error': errors.password }">
      <span class="detail-label">Password</span>
      <div class="input-wrapper">
        <input type="text" class="detail-value form-control" :class="{ 'is-invalid': errors.password }" v-model="newPassword"/>
        <span v-if="errors.password" class="field-error">{{ errors.password[0] }}</span>
      </div>
    </div>

    <div class="detail-item">
      <span class="detail-label">Email verified</span>
      <span class="detail-value">
      {{ currentUser.email_verified_at ? formatDate(currentUser.email_verified_at) : 'Not verified' }}
    </span>
    </div>
    <div class="detail-item">
      <span class="detail-label">Member since</span>
      <span class="detail-value">{{ formatDate(currentUser.created_at) }}</span>
    </div>
    <div class="detail-item">
      <span class="detail-label">Last updated</span>
      <span class="detail-value">{{ formatDate(currentUser.updated_at) }}</span>
    </div>

    <button type="submit" :disabled="isLoading" class="configure-btn btn btn-sm ms-auto d-inline-flex align-items-center gap-2
     px-4 py-2 mt-4 border border-dark-subtle text-body fw-medium text-uppercase small">
      {{ isLoading ? 'Saving...' : 'Save' }}
    </button>

  </form>
  <div v-else-if="isUserMissing" class="error-banner">
    User not found.
  </div>
  <div v-else class="detail-value">
    Loading user...
  </div>
</template>

<style scoped>
.detail-grid {
  display: flex;
  flex-direction: column;
  gap: 0;
}

.detail-item {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
  padding: 0.85rem 0;
  border-bottom: 1px solid #f0f0f0;
  gap: 1rem;
}

.detail-label {
  font-size: 0.8rem;
  color: #999;
  white-space: nowrap;
}

.detail-value {
  font-size: 0.875rem;
  color: #1a1a1a;
}
.ability-badge {
  font-size: 0.6rem;
  letter-spacing: 0.1em;
  border: 1px solid #ddd;
  padding: 0.25rem 0.65rem;
  color: #666;
}

.configure-btn {
  letter-spacing: .12em;
  border-radius: 0 !important;
  transition: color .2s ease, background .2s ease;
}

.configure-btn:hover {
  background: var(--bs-body-color) !important;
  color: var(--bs-body-bg) !important;
}

.input-wrapper {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 0.25rem;
  flex: 1;
}

.field-error {
  font-size: 0.72rem;
  color: #c0392b;
  letter-spacing: 0.02em;
}

.has-error {
  border-bottom-color: #f5c6c6;
}

.error-banner {
  font-size: 0.8rem;
  color: #c0392b;
  border: 1px solid #f5c6c6;
  padding: 0.65rem 1rem;
  margin-bottom: 0.5rem;
  letter-spacing: 0.02em;
}

.form-control.is-invalid {
  border-color: #c0392b;
  box-shadow: none;
}

.form-control.is-invalid:focus {
  border-color: #c0392b;
  box-shadow: 0 0 0 2px rgba(192, 57, 43, 0.12);
}
</style>