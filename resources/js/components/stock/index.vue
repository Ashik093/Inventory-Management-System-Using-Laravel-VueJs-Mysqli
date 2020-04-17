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
							<li class="breadcrumb-item active">Product Stock</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<div class="row">

			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-primary">
						<h3 class="card-title">All Product</h3>
						<router-link to="/add-product" class="btn btn-success btn-sm float-sm-right">Add Product</router-link>
				 	</div>
					<!-- /.card-header -->
					<div class="card-body">
						<label for="">Search</label>
						<input type="text" class="form-control mb-4" style="width: 20%;" v-model="search">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Category Name</th>
									<th>Code</th>
									<th>Image</th>
									<th>Buying Price</th>
									<th>Status</th>
									<th>Quantity</th>
									<th>Update Stock</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="product in filterSearch" :key="product.id">
									<td>{{ product.name }}</td>
									<td>{{ product.category.name }}</td>
									<td>{{ product.code }}</td>
									<td><img :src="product.picture" alt="" style="width: 40px;height: 40px;"></td>
									<td>{{ product.buying_price }}</td>
									<td v-if="product.quantity < 10 && product.quantity > 0"><span class="badge badge-warning">Low Stock</span></td>
									<td v-else-if="product.quantity < 1"><span class="badge badge-danger">Out Of Stock</span></td>
									<td v-else=""><span class="badge badge-success">Available</span></td>
									<td>{{ product.quantity }}</td>
									<td><div class="btn-group"><router-link :to="{name:'editstock',params:{id:product.id}}" class="bnt btn-info btn-sm"><i class="fas fa-edit"></i></router-link></div></td>
								</tr>
								
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		mounted(){
			if (!User.loggedIn()) {
				this.$router.push({name:'/'})
			}
		},
		data(){
			return {
				products:[],
				search:''
			}
		},
		computed:{
			filterSearch(){
				return this.products.filter(product =>{
					return product.name.match(this.search)
				})
			}
		},
		methods:{
			allProduct(){
				axios.get('/api/product')
					.then(({data})=>(this.products = data))
					.catch()
			}
			
		},
		created(){
			this.allProduct()
		}
	}
</script>
<style>
	
</style>