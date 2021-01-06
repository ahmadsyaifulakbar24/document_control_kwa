<template>
  <div>
      <h3 class="text-uppercase">selamat datang {{ user.name }}</h3>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  computed: {
    ...mapGetters({
      user: 'auth/user'
    })
  }
}
</script>