<template>
    <div class="auth">
		<div class="card rounded">
			<div class="card-head text-center px-4 pt-4">
				<h2 class="pt-4">Dokumen Kontrol KWA</h2>
				<p class="text-secondary">PT. Karl Wig Abadi</p>
			</div>
			<div class="card-body">
				<form id="form" @submit.prevent="userLogin">
					<div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="errors.success === false">
						<i class="mdi mdi-close-circle" data-dismiss="alert" aria-label="Close"></i>Username atau Password salah.
					</div>
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" v-model="form.username" ref="username" id="username" class="form-control" autofocus="autofocus" />
						<div v-if="errors.username" class="text-danger">{{ errors.username[0] }}</div>
					</div>
					<div class="form-group position-relative">
						<label for="password">Password</label>
						<input type="password" v-model="form.password" ref="password" id="password" class="form-control pr-5" maxlength="32" autocomplete="on" />
						<i class="password mdi mdi-eye-off mdi-18px" data-id="password" @click="passwordClick"></i>
						<div v-if="errors.password" class="text-danger">{{ errors.password[0] }}</div>
					</div>
					<div class="form-group mt-5">
						<button class="btn btn-primary btn-block mb-4" id="submit" >
							<span id="text">Login</span>
							<div class="loader loader-sm none" id="load">
								<svg class="circular" viewBox="25 25 50 50">
									<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10" />
								</svg>
							</div>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
import $ from "jquery"
export default {
    data() {
		return {
			form: {
				username: '',
				password: ''
			},
			errors: []
		}
    },
    methods: {
		userLogin() {
			this.$store.dispatch('auth/login', this.form).then(() => {
				this.$router.push({ name: 'dashboard' })
			}).catch((error) => {
				this.errors = error.response.data
			})
		},

		passwordClick() {
			if($('.password').hasClass('mdi-eye')){
				$('.password').removeClass('mdi-eye')
                $('.password').addClass('mdi-eye-off')
                if($('.password').data('id') == 'password'){
                    $('#password').attr('type','password')
                } else if($('.password').data('id') == 'npassword'){
                    $('#npassword').attr('type','password')
                } else {
                    $('#cpassword').attr('type','password')
                }
			} else {
				$('.password').addClass('mdi-eye')
				$('.password').removeClass('mdi-eye-off')
				if($(".password").data('id') == 'password'){
                    $('#password').attr('type','text')
                } else if($(this).data('id') == 'npassword'){
                    $('#npassword').attr('type','text')
                } else {
                    $('#cpassword').attr('type','text')
                }
			}
        }
	}
}
</script>