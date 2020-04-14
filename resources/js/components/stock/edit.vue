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
		              <li class="breadcrumb-item active">Update Product Stock</li>
		            </ol>
		          </div><!-- /.col -->
		        </div><!-- /.row -->
		    </div><!-- /.container-fluid -->
		</div>
		<div class="card card-primary">
            <div class="card-header">
          		<h3 class="card-title">Update Product Stock</h3>
          		<router-link to="/all-stock" class="btn btn-success btn-sm float-sm-right">Product Stock</router-link>
           	</div>
           	<div class="card-body">
           		<form @submit.prevent="updateStock" method="post">
           			<div class="row">
           				<div class="col-md-6">
           					
           					<div class="form-group">
           					    <label>Product Name</label>
          			             <input type="text" class="form-control" placeholder="Enter Product Name" v-model="form.name" readonly>
           					</div>

           					<small class="text-danger" v-if="errors.quantity">{{ errors.quantity[0] }}</small>
           					<div class="form-group">
           					    <label>Product Quantity</label>
          			            <input type="text" class="form-control" placeholder="Enter Product Quantity" v-model="form.quantity">
           					</div>
           				</div>

           				<div class="col-md-6">
           					<div class="form-group">
           					    <label>Category Name</label>
          			                <select v-model="form.category_id" class="form-control" readonly>
          			                	<option selected="" disabled="" value="null">Select Category Name</option>
          			                	<option disabled v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
          			                </select>
           					</div>
           					<div class="form-group">
           					    <label>Product Code</label>
          			             <input type="text" class="form-control" placeholder="Enter Product Code" v-model="form.code" readonly>
           					</div>
           					
           				</div>
           			</div>
           			<button type="submit" class="btn btn-primary">Update Stock</button>
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
					category_id:null,
					code:null,
					quantity:null,

				},
				categories:{},
				suppliers:{},
				errors:{}
			}
		},
		methods:{
			updateStock(){
				let id = this.$route.params.id
				axios.patch('/api/product-stock-update/'+id,this.form)
					.then(()=>{
						Notification.success()
						this.$router.push({name:'allstock'})

					})
					.catch(error => this.errors = error.response.data.errors)
			}
		},
		created(){
			let id = this.$route.params.id
			axios.get('/api/product/'+id)
				.then(({data})=>(this.form = data))
				.catch()
			axios.get('/api/category')
				.then(({data})=>(this.categories=data))
				.catch()
		}
	}
</script>
<style>
	
</style>