<script>
export default {
  name: "AdminUserDetailsView",
  props: ['id'],
  computed: {
    currentUser() {
      return this.$parent.users.find(u => u.id == this.id);
    }
  }

}
</script>

<template>

</template>

<style scoped>

</style>