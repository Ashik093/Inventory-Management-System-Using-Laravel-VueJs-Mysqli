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
		              <li class="breadcrumb-item active">Edit Product</li>
		            </ol>
		          </div><!-- /.col -->
		        </div><!-- /.row -->
		    </div><!-- /.container-fluid -->
		</div>
		<div class="card card-primary">
            <div class="card-header">
          		<h3 class="card-title">Update Product</h3>
          		<router-link to="/all-product" class="btn btn-success btn-sm float-sm-right">All Product</router-link><router-link to="/add-product" class="btn btn-success btn-sm float-sm-right">Add Product</router-link>
           	</div>
           	<div class="card-body">
           		<form @submit.prevent="updateProduct" method="post" enctype="multipart/form-data">
           			<div class="row">
           				<div class="col-md-6">
           					<small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
           					<div class="form-group">
           					    <label>Product Name</label>
          			                <input type="text" class="form-control" placeholder="Enter Product Name" v-model="form.name">
           					</div>

           					<small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
           					<div class="form-group">
           					    <label>Category Name</label>
          			                <select v-model="form.category_id" class="form-control">
          			                	<option selected="" disabled="" value="null">Select Category Name</option>
          			                	<option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
          			                </select>
           					</div>

           					<small class="text-danger" v-if="errors.code">{{ errors.code[0] }}</small>
           					<div class="form-group">
           					    <label>Product Code</label>
          			                <input type="text" class="form-control" placeholder="Enter Product Code" v-model="form.code">
           					</div>

           					<small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
           					<div class="form-group">
           					    <label>Product Root</label>
          			                <input type="text" class="form-control" placeholder="Enter Product Root" v-model="form.root">
           					</div>

           					<div class="form-group">
           					    <label>Product Photo</label>
          			                <input type="file" class="form-control" @change="onFileSelected">
           					</div>
           				</div>
           				<div class="col-md-6">
           					<small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
           					<div class="form-group">
           					    <label>Product Buying Price</label>
          			                <input type="text" class="form-control" placeholder="Enter Product Buying Price" v-model="form.buying_price">
           					</div>
							
							<small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
           					<div class="form-group">
           					    <label>Supplier Name</label>
          			                <select v-model="form.supplier_id" class="form-control">
          			                	<option selected="" disabled="" value="null">Select Supplier Name</option>
          			                	<option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">{{ supplier.name }}</option>
          			                </select>
           					</div>

           					<small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
           					<div class="form-group">
           					    <label>Product Selling Price</label>
          			                <input type="text" class="form-control" placeholder="Enter Product Selling Price" v-model="form.selling_price">
           					</div>
           					<small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
           					<div class="form-group">
           					    <label>Product Buying Date</label>
          			                <input type="date" class="form-control" placeholder="Enter Product Buying Date" v-model="form.buying_date">
           					</div>

							<small class="text-danger" v-if="errors.quantity">{{ errors.quantity[0] }}</small>
           					<div class="form-group">
           					    <label>Product Quantity</label>
          			                <input type="text" class="form-control" placeholder="Enter Product Quantity" v-model="form.quantity">
           					</div>

           					<div class="form-group">
           					    <img :src="form.picture" alt="" style="width: 50px;height: 50px;">
           					</div>
           				</div>
           			</div>
           			<button type="submit" class="btn btn-primary">Update Product</button>
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
					root:null,
					buying_price:null,
					selling_price:null,
					supplier_id:null,
					buying_price:null,
					quantity:null,
					picture:null,
					new_picture:null

				},
				categories:{},
				suppliers:{},
				errors:{}
			}
		},
		methods:{
			onFileSelected(event){
				let file = event.target.files[0]
				if (file.size > 1048770) {
					Notification.image()
				}else{
					let reader = new FileReader()
					reader.onload = event =>{
						this.form.picture = event.target.result
						this.form.new_picture = event.target.result
					};
					reader.readAsDataURL(file)
				}
			},
			updateProduct(){
				let id = this.$route.params.id
				axios.patch('/api/product/'+id,this.form)
					.then(()=>{
						Notification.success()
						this.$router.push({name:'allproduct'})

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
			axios.get('/api/supplier')
				.then(({data})=>(this.suppliers=data))
				.catch()
		}
	}
</script>
<style>
	
</style>