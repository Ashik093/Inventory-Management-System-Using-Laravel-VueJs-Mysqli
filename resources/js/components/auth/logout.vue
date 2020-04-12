<template>
	<div>
		
	</div>
</template>
<script>
	export default{
		created(){
			if (User.loggedIn()) {
				User.logout()
				this.$router.push({name:'/'})
				Toast.fire({
				  icon: 'success',
				  title: 'Logout successfully'
				})
			}
		}
	}
</script>
<style>
	
</style>