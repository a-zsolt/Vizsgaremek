<script>
import {http} from "@/utils/http.js";

export default {
  name: "ProfileDetailsView",
  props: { user: { required: true, type: Object }, isEditing: { required: true } },
  emits: ['profileUpdated'],
  data() {
    return {
      isLoading: false,
      error: null,
      errors: {},
      newEmail: this.user.email,
      newName: this.user.name,
      newPassword: "",
    }
  },
  methods: {
    formatDate(dateStr) {
      if (!dateStr) return "—";
      return new Date(dateStr).toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
      });
    },
    async updateProfile() {
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
        const resp = await http.patch(`/api/auth/update/${this.user.id}`, payload);

        if (resp.data.success) {
          this.$emit("profileUpdated");
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
    }
  }
}
</script>

<template>
  <section v-if="isEditing" class="profile-section">
    <div class="d-flex justify-content-between align-items-center">
      <p class="label-text">ACCOUNT DETAILS</p>
      <span class="ability-badge text-uppercase">editing</span>
    </div>

    <form class="detail-grid" @submit.prevent="updateProfile">

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

      <div class="detail-item">
        <span class="detail-label">Email verified</span>
        <span class="detail-value">
      {{ user.email_verified_at ? formatDate(user.email_verified_at) : 'Not verified' }}
    </span>
      </div>
      <div class="detail-item">
        <span class="detail-label">Member since</span>
        <span class="detail-value">{{ formatDate(user.created_at) }}</span>
      </div>
      <div class="detail-item">
        <span class="detail-label">Last updated</span>
        <span class="detail-value">{{ formatDate(user.updated_at) }}</span>
      </div>

      <button type="submit" :disabled="isLoading" class="configure-btn btn btn-sm ms-auto d-inline-flex align-items-center gap-2
     px-4 py-2 mt-4 border border-dark-subtle text-body fw-medium text-uppercase small">
        {{ isLoading ? 'Saving...' : 'Save' }}
      </button>

    </form>
  </section>

  <section v-else class="profile-section">
    <p class="label-text">ACCOUNT DETAILS</p>

    <div class="detail-grid">
      <div class="detail-item">
        <span class="detail-label">Full name</span>
        <span class="detail-value">{{ user.name }}</span>
      </div>
      <div class="detail-item">
        <span class="detail-label">Email address</span>
        <span class="detail-value">{{ user.email }}</span>
      </div>
      <div class="detail-item">
        <span class="detail-label">Email verified</span>
        <span class="detail-value">
                    {{ user.email_verified_at ? formatDate(user.email_verified_at) : 'Not verified' }}
                  </span>
      </div>
      <div class="detail-item">
        <span class="detail-label">Member since</span>
        <span class="detail-value">{{ formatDate(user.created_at) }}</span>
      </div>
      <div class="detail-item">
        <span class="detail-label">Last updated</span>
        <span class="detail-value">{{ formatDate(user.updated_at) }}</span>
      </div>
    </div>
  </section>
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
    text-align: right;
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