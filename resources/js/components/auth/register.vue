<template>
<div class="register-page">
	<div class="register-box">
		<div class="register-logo">
			<a href=""><b>Admin</b>LTE</a>
		</div>
		<div class="card">
			<div class="card-body register-card-body">
				<p class="login-box-msg">Register a new membership</p>
				<form @submit.prevent="signup" method="post">
					<small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Full name" v-model="form.name">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
					<div class="input-group mb-3">
						<input type="email" class="form-control" placeholder="Email" v-model="form.email">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
					<div class="input-group mb-3">
						<input type="password" class="form-control" placeholder="Password" v-model="form.password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" placeholder="Retype password" v-model="form.password_confirmation">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						
						<!-- /.col -->
						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block">Register</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
				<router-link to="/" class="text-center">I already have a membership</router-link>
			</div>
			<!-- /.form-box -->
			</div><!-- /.card -->
		</div>
	</div>
	</template>
	<script>
		export default{
			created(){
				if (User.loggedIn()) {
					this.$router.push({name:'dashboard'})
				}
			},
			data(){
				return {
					form:{
						name:null,
						email:null,
						password:null,
						password_confirmation:null
					},
					errors:{}
				}
			},
			methods:{
				signup(){
					axios.post('/api/auth/signup',this.form)
						.then(res=>{
							User.responseAfterLogin(res)
							this.$router.push({name:'dashboard'})
							Toast.fire({
							  icon: 'success',
							  title: 'Signed in successfully'
							})
						})
						.catch(error => this.errors = error.response.data.errors)
				}
			}
		}
	</script>
	<style>
		
	</style>