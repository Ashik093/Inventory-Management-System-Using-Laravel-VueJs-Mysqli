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
							<li class="breadcrumb-item active">Point Of Sale</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<div class="row">
			<div class="col-md-5">
				<div class="card">
					<div class="card-header bg-primary">
						<h3 class="card-title">Cart</h3>
						<button class="btn btn-success btn-sm float-sm-right">Add Customer</button>
				 	</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Qty</th>
									<th>Unit</th>
									<th>Total</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Dell</td>
									<td>1</td>
									<td>455555</td>
									<td>458966</td>
									<td><span class="btn btn-danger btn-sm"><i class="fas fa-minus-circle"></i></span></td>
								</tr>
								<tr>
									<td>Dell</td>
									<td>1</td>
									<td>455555</td>
									<td>458966</td>
									<td><span class="btn btn-danger btn-sm"><i class="fas fa-minus-circle"></i></span></td>
								</tr>
								<tr>
									<td>Dell</td>
									<td>1</td>
									<td>455555</td>
									<td>458966</td>
									<td><span class="btn btn-danger btn-sm"><i class="fas fa-minus-circle"></i></span></td>
								</tr>
								<tr>
									<td>Dell</td>
									<td>1</td>
									<td>455555</td>
									<td>458966</td>
									<td><span class="btn btn-danger btn-sm"><i class="fas fa-minus-circle"></i></span></td>
								</tr>
								
							</tbody>
						</table>
	
						<div class="card mt-3" style="width: 100%;">
						  <ul class="list-group list-group-flush">
						    <li class="list-group-item">Total Quantity: <span style="float: right;font-weight: bold;">12</span></li>
						    <li class="list-group-item">Sub Total: <span style="float: right;font-weight: bold;">200000</span></li>
						    <li class="list-group-item">Vat: <span style="float: right;font-weight: bold;">5%</span></li>
						    <li class="list-group-item">Total: <span style="float: right;font-weight: bold;">2500000</span></li>
						  </ul>
						</div>
						<div class="mt-3" style="width: 100%;">
						  	<form>
			           			<div class="row">
			           				<div class="col-md-12">
			           			
			           					<div class="form-group">
			           					    <label>Customer Name</label>
			          			            <select class="form-control">
			          			            	<option selected="" disabled="" value="null">Select Customer Name</option>
			          			               	<option value="">Customer 1</option>
			          			               	<option value="">Customer 2</option>
			          			               	<option value="">Customer 3</option>
			          			            </select>
			           					</div>
			           					<div class="form-group">
			           					    <label>Pay</label>
			          			            <input type="text" class="form-control">
			           					</div>
			           					<div class="form-group">
			           					    <label>Due</label>
			          			            <input type="text" class="form-control">
			           					</div>
										<div class="form-group">
			           					    <label>Payment By</label>
			          			            <select class="form-control">
			          			            	<option selected="" disabled="" value="null">Select Payment Method</option>
			          			               	<option value="">HandCash</option>
			          			               	<option value="">Cheque</option>
			          			               	<option value="">Visa</option>
			          			            </select>
			           					</div>
			           					
			           				</div>
			           				
			           			</div>
			           			<button type="submit" class="btn btn-primary">Submit</button>
			           		</form>
						</div>
					</div>
					<!-- /.card-body -->
				</div>
			</div>
			<div class="col-md-7">
				<div class="card">
					<div class="card-header bg-primary">
						<h3 class="card-title">Products</h3>
				 	</div>
					<!-- /.card-header -->
					<div class="card-body">
						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All Product</a>
						  </li>
						  <li class="nav-item" v-for="category in allcategories" :key="category.id">
						    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" @click="getProductByCategory(category.id)">{{ category.name }}</a>
						  </li>
						</ul>
						<div class="tab-content" id="pills-tabContent">

						  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
						  	<label for="">Search</label>
						  	<input type="text" class="form-control mb-4" style="width: 100%;" v-model="search">

						  	<div class="card-group">
						  	  <div class="row">
						  	  	<div class="card col-md-3" v-for="product in filterSearch" :key="product.id">
						  	    <img class="card-img-top" :src="product.picture" style="width: 100px;height: 60px;margin: auto;" alt="Card image cap">
						  	    <div class="card-body">
						  	      <center><p class="card-text" style="margin: auto;font-weight: bold;">{{ product.name }}</p></center>
						  	       <center>
						  	       	<p v-if="product.quantity < 10 && product.quantity > 0"><span class="badge badge-warning">Low Stock({{ product.quantity }})</span></p>
						  	       	<p v-else-if="product.quantity < 1"><span class="badge badge-danger">Out Of Stock({{ product.quantity }})</span></p>
						  	       	<p v-else=""><span class="badge badge-success">Available({{ product.quantity }})</span></p>
						  	       </center>     
						  	    </div>
						  	  </div>
						  	  </div>
						  	</div>
						  </div>

						  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
						  	<label for="">Search</label>
						  	<input type="text" class="form-control mb-4" style="width: 100%;" v-model="getSearch">

						  	<div class="card-group">
						  	  <div class="row">
						  	  	<div class="card" v-for="product in getfilterSearch" :key="product.id">
						  	    <img class="card-img-top" :src="product.picture" style="width: 100px;height: 60px;margin: auto;" alt="Card image cap">
						  	    <div class="card-body">
						  	      <center><p class="card-text" style="margin: auto;font-weight: bold;">{{ product.name }}</p></center>
						  	       <center>
						  	       	<p v-if="product.quantity < 10 && product.quantity > 0"><span class="badge badge-warning">Low Stock({{ product.quantity }})</span></p>
						  	       	<p v-else-if="product.quantity < 1"><span class="badge badge-danger">Out Of Stock({{ product.quantity }})</span></p>
						  	       	<p v-else=""><span class="badge badge-success">Available({{ product.quantity }})</span></p>
						  	       </center>     
						  	    </div>
						  	  </div>
						  	  </div>
						  	</div>
						  </div>
						  
						</div>
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
				search:'',
				allcategories:{},
				getproducts:[],
				getSearch:'',
			}
		},
		computed:{
			filterSearch(){
				return this.products.filter(product =>{
					return product.name.match(this.search)
				})
			},
			getfilterSearch(){
				return this.getproducts.filter(getproduct =>{
					return getproduct.name.match(this.getSearch)
				})
			}
		},
		methods:{
			allProduct(){
				axios.get('/api/product')
					.then(({data})=>(this.products = data))
					.catch()
			},
			allCategory(){
				axios.get('/api/category')
					.then(({data})=>(this.allcategories=data))
					.catch()
			},
			getProductByCategory(id){
				axios.get('/api/get-product/'+id)
					.then(({data})=>(this.getproducts=data))
					.catch()
			}
			
		},
		created(){
			this.allProduct()
			this.allCategory()
		}
	}
</script>
<style>
	
</style>