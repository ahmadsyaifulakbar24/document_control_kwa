<template>
	<div>
		<template v-if="isLoggedIn">
			<Navigation />
		</template>
		<div class="main">
			<router-view />
		</div>
	</div>
</template>

<script>
import Navigation from './components/Navigation.vue'
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