<template>
	<div>
		<div class="content-header">
		    <div class="container-fluid">
			    <div class="row mb-2">
		  	      <div class="col-sm-6">
		            <h1 class="m-0 text-dark">Dashboard</h1>
		          </div><!-- /.col -->
		          <div class="col-sm-6">
		            <ol class="breadcrumb float-sm-right">
		              <li class="breadcrumb-item"><router-link to="/dashboard">Home</router-link></li>
		              <li class="breadcrumb-item active">Add Category</li>
		            </ol>
		          </div><!-- /.col -->
		        </div><!-- /.row -->
		    </div><!-- /.container-fluid -->
		</div>
		<div class="card card-primary">
            <div class="card-header">
          		<h3 class="card-title">Add Category</h3>
          		<router-link to="/all-category" class="btn btn-success btn-sm float-sm-right">All Category</router-link>
           	</div>
           	<div class="card-body">
           		<form @submit.prevent="insertCategory" method="post">
           			<div class="row">
           				<div class="col-md-6">
           					<small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
           					<div class="form-group">
           					    <label>Category Name</label>
          			                <input type="text" class="form-control" placeholder="Enter Category Name" v-model="form.name">
           					</div>
           					<button type="submit" class="btn btn-primary">Add Category</button>
           				</div>
           				
           			</div>
           		</form>
           	</div>
		</div>
	</div>
</template>
<script>
	export default{
		mounted(){
			if (!User.loggedIn()) {
				this.$router.push({name:'/'})
			}
		},
		data(){
			return {
				form:{
					name:null,
				},
				errors:{}
			}
		},
		methods:{
			insertCategory(){
				axios.post('/api/category',this.form)
					.then(()=>{
						Notification.success()
						this.$router.push({name:'allcategory'})

					})
					.catch(error => this.errors = error.response.data.errors)
			}
		}
	}
</script>
<style>
	
</style>