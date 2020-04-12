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
							<li class="breadcrumb-item active">All Product</li>
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
						<input type="text" class="form- mb-4" style="width: 20%;" v-model="search">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Category Name</th>
									<th>Supplier Name</th>
									<th>Image</th>
									<th>Selling Price</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="product in filterSearch" :key="product.id">
									<td>{{ product.name }}</td>
									<td>{{ product.category.name }}</td>
									<td>{{ product.supplier.name }}</td>
									<td><img :src="product.picture" alt="" style="width: 40px;height: 40px;"></td>
									<td>{{ product.selling_price }}</td>
									<td><div class="btn-group"><router-link :to="{name:'editproduct',params:{id:product.id}}" class="bnt btn-info btn-sm">Edit</router-link><button class="btn btn-danger btn-sm" @click="deleteProduct(product.id)">Delete</button></div></td>
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
			},
			deleteProduct(id){
				const swalWithBootstrapButtons = Swal.mixin({
				  customClass: {
				    confirmButton: 'btn btn-success',
				    cancelButton: 'btn btn-danger mr-1'
				  },
				  buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonText: 'Yes, delete it!',
				  cancelButtonText: 'No, cancel!',
				  reverseButtons: true
				}).then((result) => {
				  if (result.value) {
				  	axios.delete('/api/product/'+id)
				  		.then(()=>{
				  			this.products = this.products.filter(product=>{
				  				return product.id != id
				  			})
				  		})
				  		.catch()
				    swalWithBootstrapButtons.fire(
				      'Deleted!',
				      'Your file has been deleted.',
				      'success'
				    )
				  } else if (
				    /* Read more about handling dismissals below */
				    result.dismiss === Swal.DismissReason.cancel
				  ) {
				    swalWithBootstrapButtons.fire(
				      'Cancelled',
				      'Your imaginary file is safe :)',
				      'error'
				    )
				  }
				})
			}
			
		},
		created(){
			this.allProduct()
		}
	}
</script>
<style>
	
</style>