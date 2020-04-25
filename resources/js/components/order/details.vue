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
							<li class="breadcrumb-item active">Order Details</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
				  <div class="card-header bg-info text-center">
				    Customer Details
				  </div>
				  <div class="card-body">
				  	<div class="row">
					  	<div class="col-md-6 border-right">
					  		<ul class="list-group list-group-flush">
					  		  <li class="list-group-item"><span style="font-weight: bold;">Name</span>:<span style="font-weight: bold;float: right;color: blue;">{{ orders.customer.name }}</span></li>
					  		  <li class="list-group-item"><span style="font-weight: bold;">Phone</span>:<span style="font-weight: bold;float: right;color: blue;">{{ orders.customer.phone }}</span></li>
					  		  <li class="list-group-item"><span style="font-weight: bold;">Address</span>:<span style="font-weight: bold;float: right;color: blue;">{{ orders.customer.address }}</span></li>
					  		  <li class="list-group-item"><span style="font-weight: bold;">Order date</span>:<span style="font-weight: bold;float: right;color: blue;">{{ orders.order_date }}</span></li>
					  		  <li class="list-group-item"><span style="font-weight: bold;">Quantity</span>:<span style="font-weight: bold;float: right;color: blue;">{{ orders.quantity }}</span></li>
					  		</ul>
					  	</div>
					  	<div class="col-md-6">
					  		<ul class="list-group list-group-flush">
					  		  <li class="list-group-item"><span style="font-weight: bold;">Sub Total</span>:<span style="font-weight: bold;float: right;color: blue;">{{ orders.subtotal }} TK</span></li>
					  		  <li class="list-group-item"><span style="font-weight: bold;">Vat</span>:<span style="font-weight: bold;float: right;color: blue;">{{ orders.vat }}% </span></li>
					  		  <li class="list-group-item"><span style="font-weight: bold;">Total</span>:<span style="font-weight: bold;float: right;color: blue;">{{ orders.total }} TK</span></li>
					  		  <li class="list-group-item"><span style="font-weight: bold;">Pay</span>:<span style="font-weight: bold;float: right;color: blue;">{{ orders.pay }} TK</span></li>
					  		  <li class="list-group-item"><span style="font-weight: bold;">Due</span>:<span style="font-weight: bold;float: right;color: blue;">{{ orders.due }} TK</span></li>
					  		</ul>
					  	</div>
				  	</div>
				  </div>
				  <div class="card-footer text-muted">
				      Pay Through: <span class="badge badge-success">{{ orders.payby }}</span>
				    </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-primary">
						<h3 class="card-title">Order Details</h3>	
				 	</div>
					<!-- /.card-header -->
					<div class="card-body">
						<label for="">Search</label>
						<input type="text" class="form-control mb-4" style="width: 20%;" v-model="search">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Code</th>
									<th>Image</th>
									<th>Quantity</th>
									<th>Unit Price</th>
									<th>Total</th>
									
								</tr>
							</thead>
							<tbody>
								<tr v-for="orderdetail in filterSearch" :key="orderdetail.id">
									<td>{{ orderdetail.product.name }}</td>
									<td>{{ orderdetail.product.code }}</td>
									<td><img :src="'/'+orderdetail.product.picture" alt="" style="width: 40px;height: 40px;"></td>
									<td>{{ orderdetail.product_quantity }}</td>
									<td>{{ orderdetail.product.selling_price }}</td>
									<td>{{ orderdetail.subtotal }}</td>
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
				orders:[],
				orderdetails:[],
				search:''
			}
		},
		computed:{
			filterSearch(){
				return this.orderdetails.filter(orderdetail =>{
					return orderdetail.product.name.match(this.search)
				})
			}
		},
		methods:{
			order(){
				let id = this.$route.params.id
				axios.get('/api/view-order/'+id)
					.then(({data})=>(this.orders = data))
					.catch()
			},
			orderDetail(){
				let id = this.$route.params.id
				axios.get('/api/view-order-deatils/'+id)
					.then(({data})=>(this.orderdetails = data))
					.catch()
			}
			
		},
		created(){
			this.order()
			this.orderDetail()
		}
	}
</script>
<style>
	
</style>