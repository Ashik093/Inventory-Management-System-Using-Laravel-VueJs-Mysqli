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
							<li class="breadcrumb-item active">This Month Orders</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<div class="row">

			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-primary">
						<h3 class="card-title">This Month Order</h3>
				 	</div>
					<!-- /.card-header -->
					<div class="card-body">
						<label for="">Search</label>
						<input type="text" class="form- mb-4" style="width: 20%;" v-model="search">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Customer Name</th>
									<th>Total Amount</th>
									<th>Pay</th>
									<th>Due</th>
									<th>Pay By</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="order in filterSearch" :key="order.id">
									<td>{{ order.customer.name }}</td>
									<td>{{ order.total }}</td>
									<td>{{ order.pay }}</td>
									<td>{{ order.due }}</td>
									<td>{{ order.payby }}</td>
									<td>{{ order.order_date }}</td>
									<td><router-link :to="{name:'orderdetails',params:{id:order.id}}" class="btn btn-info">View</router-link></td>
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
				search:''
			}
		},
		computed:{
			filterSearch(){
				return this.orders.filter(order =>{
					return order.customer.name.match(this.search)
				})
			}
		},
		methods:{
			monthlyOrder(){
				axios.get('/api/monthly-orders')
					.then(({data})=>(this.orders=data))
					.catch()
			}
			
		},
		created(){
			this.monthlyOrder()
		}
	}
</script>
<style>
	
</style>