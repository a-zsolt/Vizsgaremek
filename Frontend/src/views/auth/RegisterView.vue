<script>
import {http} from "@/utils/http.js";

export default {
  name: "RegisterView",
  data() {
    return {
      name: "",
      email: "",
      password: "",
      errors: {}
    }
  },
  methods: {
    // Create account and redirect to login on success
    async registerUser() {
      this.isLoading = true

      const newUser = {
        name: this.name,
        email: this.email,
        password: this.password,
      }

      try {
        const resp = await http.post('/api/auth/register', { name: newUser["name"], email: newUser["email"], password: newUser["password"] })

        if (resp.data.success){
          this.$router.push({name: "login"});
        }
      } catch (e) {
        this.errors = e.response.data.errors
      } finally {
        this.isLoading = false
      }
    }
  }
}
</script>

<template>
  <main class="row g-0 vh-100 overflow-hidden">
    <!-- Image decoration -->
    <section class="col-xl-9 d-none d-xl-block">
      <img src="https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/RegisterImage.jpg" alt="" class="side-image">
    </section>

    <!-- Login Panel -->
    <section class="col-12 col-xl-3 p-3 d-flex flex-column align-items-center justify-content-between login-panel">
      <RouterLink :to="{ name: 'home' }">
        <img class="brand-logo" src="/Brand_light.png" alt="Bootstrap">
      </RouterLink>

      <div class="d-flex align-items-center justify-content-center">
        <form class="w-100" @submit.prevent="registerUser">
          <div class="form-floating">
            <input type="text" :class="{ 'is-invalid': errors['name'] }" class="form-control" id="floatingInput" placeholder="name@example.com" v-model="name"/>
            <label for="floatingInput">Name</label>
            <div v-for="error in errors['name']" class="invalid-feedback">
              {{ error }}
            </div>
          </div>
          <div class="form-floating">
            <input type="email" :class="{ 'is-invalid': errors['email'] }" class="form-control" id="floatingInput" placeholder="name@example.com" v-model="email"/>
            <label for="floatingInput">Email address</label>
            <div v-for="error in errors['email']" class="invalid-feedback">
              {{ error }}
            </div>
          </div>
          <div class="form-floating">
            <input type="password" :class="{ 'is-invalid': errors['password'] }" class="form-control" id="floatingPassword" placeholder="Password" v-model="password"/>
            <label for="floatingPassword">Password</label>
            <div v-for="error in errors['password']" class="invalid-feedback">
              {{ error }}
            </div>
          </div>
          <div class="form-check text-start my-3">
            <input class="form-check-input" type="checkbox" value="remember-me" id="checkDefault"/>
            <label class="form-check-label" for="checkDefault">I accept the general terms and conditions.</label>
          </div>
          <button class="btn btn-primary w-100 py-2" type="submit">Register</button>

          <div class="mt-4">
            <p>Already have an account?
              <RouterLink :to="{name: 'login'}">Log In</RouterLink>
            </p>
          </div>
        </form>
      </div>

      <p class="mt-5 mb-3 text-body-secondary">&copy; Andorkó Zsolt, Varga Olivér (2026)</p>
    </section>
  </main>
</template>

<style scoped>
.side-image {
  width: 100%;
  height: 100vh;
  object-fit: cover;
  object-position: center;
  display: block;
}

:deep(.form-floating:focus-within) {
  z-index: 2;
}

:deep(input[type="text"]) {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

:deep(input[type="email"]) {
  margin-bottom: -1px;
  border-radius: 0;
}

:deep(input[type="password"]) {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.brand-logo {
  width: clamp(160px, 40vw, 300px);
  max-width: 300px;
  height: auto;
}

@media (min-width: 768px) and (max-width: 1199.98px) {
  main {
    background-image: url('https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/RegisterImage.jpg');
    background-size: cover;
    background-position: center;
    align-items: center;
    justify-content: center;
  }

  .login-panel {
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 40px rgba(0, 0, 0, 0.35);
    max-width: 420px;
    width: 100%;
    height: auto !important;
    min-height: unset;
  }

  .brand-logo{
    margin-bottom: 20px;
  }
}
</style>