<template>
	<div class="login-page">
		<div class="login-box">
		  <div class="login-logo">
		    <a href=""><b>Admin</b>LTE</a>
		  </div>
		  <!-- /.login-logo -->
		  <div class="card">
		    <div class="card-body login-card-body">
		      <p class="login-box-msg">Sign in to start your session</p>

		      <form @submit.prevent="login" method="post">
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
		        <div class="row">
		          <!-- /.col -->
		          <div class="col-4">
		            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
		          </div>
		          <!-- /.col -->
		        </div>
		      </form>

		      <p class="mb-1">
		        <router-link to="/forgot-password">I forgot my password</router-link>
		      </p>
		      <p class="mb-0">
		        <router-link to="/register" class="text-center">Register a new membership</router-link>
		      </p>
		    </div>
		    <!-- /.login-card-body -->
		  </div>
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
					email:null,
					password:null
				},
				errors:{}
			}
		},
		methods:{
			login(){
				axios.post('/api/auth/login',this.form)
					.then(res=>{
						User.responseAfterLogin(res)
						this.$router.push({name:'dashboard'})
						Toast.fire({
						  icon: 'success',
						  title: 'Signed in successfully'
						})
					})
					.catch(error => {
						if (error.response.data.errors) {
							this.errors = error.response.data.errors
						}else{
							Toast.fire({
							  icon: 'error',
							  title: 'Invalid User Name or Password'
							})
						}
					})
			}
		}
	}
</script>
<style>
	
</style>