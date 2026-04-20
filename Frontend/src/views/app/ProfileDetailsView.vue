<script>
export default {
  name: "ProfileDetailsView",
  props: { user: { required: true, type: Object } },
  methods: {
    formatDate(dateStr) {
      if (!dateStr) return "—";
      return new Date(dateStr).toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
      });
    },
  }
}
</script>

<template>
  <section class="profile-section">
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
        <span class="detail-label">Role</span>
        <span class="detail-value text-capitalize">{{ user.role }}</span>
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
</style>