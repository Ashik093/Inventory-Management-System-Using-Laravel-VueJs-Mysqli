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
						<button class="btn btn-success btn-sm float-sm-right" data-toggle="modal" data-target="#exampleModal">Add Customer</button>
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
								<tr v-for="cart in carts" :key="cart.id">
									<td>{{ cart.product_name }}</td>
									<td><input type="text" readonly="" style="width: 30%;" :value="cart.product_quantity"><div class="btn-group"><button class="btn btn-success btn-sm" style="height: 25px;">+</button><button class="btn btn-danger btn-sm" style="height: 25px;">-</button></div></td>
									<td>{{ cart.product_price }}</td>
									<td>{{ cart.sub_total }}</td>
									<td><span class="btn btn-danger btn-sm" @click="removeCartItem(cart.id)"><i class="fas fa-minus-circle"></i></span></td>
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
			          			               	<option v-for="customer in customers" :value="customer.id">{{ customer.name }}</option>
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
						  	    <button class="btn btn-sm" @click.prevent="addToCart(product.id)">
						  	    	<img class="card-img-top" :src="product.picture" style="width: 100px;height: 60px;margin: auto;" alt="Card image cap">
						  	    	<div class="card-body">
						  	    	  <center><p class="card-text" style="margin: auto;font-weight: bold;">{{ product.name }}</p></center>
						  	    	   <center>
						  	    	   	<p v-if="product.quantity < 10 && product.quantity > 0"><span class="badge badge-warning">Low Stock({{ product.quantity }})</span></p>
						  	    	   	<p v-else-if="product.quantity < 1"><span class="badge badge-danger">Out Of Stock({{ product.quantity }})</span></p>
						  	    	   	<p v-else=""><span class="badge badge-success">Available({{ product.quantity }})</span></p>
						  	    	   </center>     
						  	    	</div>
						  	    </button>
						  	  </div>
						  	  </div>
						  	</div>
						  </div>

						  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
						  	<label for="">Search</label>
						  	<input type="text" class="form-control mb-4" style="width: 100%;" v-model="getSearch">

						  	<div class="card-group">
						  	  <div class="row">
						  	  	<div class="card col-md-3" v-for="product in getfilterSearch" :key="product.id">
						  	  	<button class="btn btn-sm" @click.prevent="addToCart(product.id)">
							  	    <img class="card-img-top" :src="product.picture" style="width: 100px;height: 60px;margin: auto;" alt="Card image cap">
							  	    <div class="card-body">
							  	      <center><p class="card-text" style="margin: auto;font-weight: bold;">{{ product.name }}</p></center>
							  	       <center>
							  	       	<p v-if="product.quantity < 10 && product.quantity > 0"><span class="badge badge-warning">Low Stock({{ product.quantity }})</span></p>
							  	       	<p v-else-if="product.quantity < 1"><span class="badge badge-danger">Out Of Stock({{ product.quantity }})</span></p>
							  	       	<p v-else=""><span class="badge badge-success">Available({{ product.quantity }})</span></p>
							  	       </center>     
							  	    </div>
						  	    </button>
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
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Add New Customer</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeBtn">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form @submit.prevent="insertCustomer" method="post" enctype="multipart/form-data">
           			<div class="row">
           				<div class="col-md-6">
           					<small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
           					<div class="form-group">
           					    <label>Customer Name</label>
          			                <input type="text" class="form-control" placeholder="Enter Customer Name" v-model="form.name">
           					</div>

           					<small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
           					<div class="form-group">
           					    <label>Customer Phone</label>
          			                <input type="text" class="form-control" placeholder="Enter Customer Phone" v-model="form.phone">
           					</div>
           					<div class="form-group">
           					    <label>Customer Photo</label>
          			                <input type="file" class="form-control" @change="onFileSelected">
           					</div>
           				</div>
           				<div class="col-md-6">
           					<small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
           					<div class="form-group">
           					    <label>Customer Email</label>
          			                <input type="email" class="form-control" placeholder="Enter Customer Email" v-model="form.email">
           					</div>
           					<small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
           					<div class="form-group">
           					    <label>Customer Address</label>
          			                <input type="text" class="form-control" placeholder="Enter Customer Address" v-model="form.address">
           					</div>
           					<div class="form-group">
           					    <img :src="form.photo" alt="" style="width: 50px;height: 50px;">
           					</div>
           				</div>
           			</div>
           			<button type="submit" class="btn btn-primary">Add Customer</button>
           		</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      </div>
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
				form:{
					name:null,
					email:null,
					phone:null,
					address:null,
					photo:null
				},
				errors:{},
				customers:{},
				carts:{}
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
			},
			onFileSelected(event){
				let file = event.target.files[0]
				if (file.size > 1048770) {
					Notification.image()
				}else{
					let reader = new FileReader()
					reader.onload = event =>{
						this.form.photo = event.target.result
					};
					reader.readAsDataURL(file)
				}
			},
			insertCustomer(){
				axios.post('/api/customer',this.form)
					.then(()=>{
						$('#closeBtn').click()
						Notification.success()
						Reload.$emit('AfterCustomerAdd')

					})
					.catch(error => this.errors = error.response.data.errors)
			},
			getCustomer(){
				axios.get('/api/customer')
					.then(({data})=>(this.customers=data))
					.catch()
			},
			addToCart(id){
				axios.get('/api/add-to-cart/'+id)
					.then(()=>{
						Notification.success()
						Reload.$emit('AfterAddToCart')
					})
					.catch()
			},
			getCartProduct(){
				axios.get('/api/get-cart-product')
					.then(({data})=>(this.carts=data))
					.catch()
			},
			removeCartItem(id){
				axios.get('/api/remove-from-cart/'+id)
					.then(()=>{
						Notification.success()
						Reload.$emit('AfterAddToCart')
					})
					.catch()
			}
			
		},
		created(){
			this.allProduct()
			this.allCategory()
			this.getCustomer()
			this.getCartProduct()
			Reload.$on('AfterCustomerAdd',()=>{
				this.getCustomer()
			})
			Reload.$on('AfterAddToCart',()=>{
				this.getCartProduct()
			})
			
		}
	}
</script>
<style>
	
</style>