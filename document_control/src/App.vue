<template>
  <template v-if="isLoggedIn">
    <Navigation />
  </template>
  <div class="main">
    <router-view/>
  </div>
</template>

<script>
import "@/assets/css/style.css"
import "@/assets/vendors/mdi/css/materialdesignicons.css"
import Navigation  from "./components/Navigation.vue"
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters({
      isLoggedIn: 'auth/isLoggedIn'
    })
  },
  components: {
    Navigation
  }
}
</script>