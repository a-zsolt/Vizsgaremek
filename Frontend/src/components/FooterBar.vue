<script>
export default {
  name: "FooterBar",
}
</script>

<template>
  <footer class="porsche-footer py-5 bg-dark">
    <div class="container-xl px-4 px-md-5">

      <hr class="footer-divider" />

      <div class="row g-4 mb-2 text-white">
        <!-- Locations & Contacts -->
        <div class="col-12 col-md-4">
          <span class="footer-col-heading d-block mb-3">Locations & Contacts</span>
          <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
            <li><a href="#" class="footer-link">Get in touch</a></li>
          </ul>
        </div>

        <!-- Company -->
        <div class="col-12 col-md-4">
          <span class="footer-col-heading d-block mb-3">Company</span>
          <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
            <li><a href="#" class="footer-link">Investor Relations</a></li>
            <li><a href="#" class="footer-link">Career</a></li>
            <li><a href="#" class="footer-link">Global Partnership Council</a></li>
            <li><a href="#" class="footer-link">Compliance</a></li>
            <li><a href="#" class="footer-link">Newsroom & Press</a></li>
            <li><a href="#" class="footer-link">Information Security</a></li>
          </ul>
        </div>

        <!-- on the web -->
        <div class="col-12 col-md-4">
          <span class="footer-col-heading d-block mb-3">On the web</span>
          <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
            <li><RouterLink :to="{name: 'home'}" class="footer-link">Homepage</RouterLink></li>
            <li><a href="#" class="footer-link">Configurator</a></li>
            <li><a href="#" class="footer-link">Connect</a></li>
          </ul>
        </div>
      </div>

      <hr class="footer-divider" />

      <!-- Copyright -->
      <p class="mb-0" style="font-size:12px; color:#555;">© Andorkó Zsolt, Varga Olivér (2026)</p>

    </div>


  </footer>
</template>

<style scoped>
.porsche-footer {
  background-color: #0a0a0a;
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
  color: #e0e0e0;
}

.footer-divider {
  border-color: #1a1a1a;
  opacity: 1;
  margin: 2rem 0;
}

.footer-col-heading {
  font-size: 11px;
  color: #666;
  letter-spacing: .08em;
  text-transform: uppercase;
}

.footer-link {
  color: #e0e0e0;
  text-decoration: none;
  font-size: 14px;
  transition: color .2s;
}

.footer-social {
  color: #e0e0e0;
  display: flex;
  align-items: center;
  transition: color .2s;
}

</style>