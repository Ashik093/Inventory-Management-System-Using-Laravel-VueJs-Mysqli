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
							<li class="breadcrumb-item active">Search Orders</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<form @submit.prevent="searchOrderByDate" method="post" class="form-inline">
						  <div class="input-group mb-2 mr-sm-2">
						    <div class="input-group-prepend">
						      <div class="input-group-text"><i class="fas fa-search"></i></div>
						    </div>
						    <input type="date" class="form-control" placeholder="Search By Order Date" v-model="date">
						  </div>
						  <button type="submit" class="btn btn-primary mb-2">Search By Date</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<form @submit.prevent="searchOrderByMonth" method="post" class="form-inline">
						  <div class="input-group mb-2 mr-sm-2">
						    <div class="input-group-prepend">
						      <div class="input-group-text"><i class="fas fa-search"></i></div>
						    </div>
						    <select class="form-control" v-model="month">
						        <option selected="" disabled="" value="null">Select A month</option>
						        <option value="January">January</option>
						        <option value="February">February</option>
						        <option value="March">March</option>
						        <option value="April">April</option>
						        <option value="May">May</option>
						        <option value="June">June</option>
						        <option value="July">July</option>
						        <option value="August">August</option>
						        <option value="September">September</option>
						        <option value="October">October</option>
						        <option value="November">November</option>
						        <option value="December">December</option>
						    </select>
						  </div>
						  <button type="submit" class="btn btn-primary mb-2">Search By Month</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">

			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-primary">
						<h3 class="card-title">Orders</h3>
				 	</div>
					<!-- /.card-header -->
					<div class="card-body">
						<label for="">Search</label>
						<input type="text" class="form- mb-4" style="width: 20%;" v-model="search">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Customer Name</th>
									<th>Qty</th>
									<th>Sub Total</th>
									<th>Vat</th>
									<th>Total</th>
									<th>Pay</th>
									<th>Due</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="order in filterSearch" :key="order.id">
									<td>{{ order.customer.name }}</td>
									<td>{{ order.quantity }}</td>
									<td>{{ order.subtotal }}</td>
									<td>{{ order.vat }}%</td>
									<td>{{ order.total }}</td>
									<td>{{ order.pay }}</td>
									<td>{{ order.due }}</td>
									<td><router-link :to="{name:'orderdetails',params:{id:order.id}}" class="btn btn-info">View</router-link></td>
								</tr>
								
							</tbody>
							<tfoot v-if="orders.length > 0">
								<td><b>Total</b></td>
								<td><b>{{ qty }} pieces</b></td>
								<td><b>{{ subtotal }} Taka</b></td>
								<td><b></b></td>
								<td><b>{{ total }} Taka</b></td>
								<td><b>{{ pay }} Taka</b></td>
								<td><b>{{ due }} Taka</b></td>
								<td><b></b></td>
							</tfoot>
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
				date:null,
				month:null,
				orders:[],
				search:''
			}
		},
		computed:{
			filterSearch(){
				return this.orders.filter(order =>{
					return order.customer.name.match(this.search)
				})
			},
			qty(){
				let sum = 0;
				for (var i = 0; i < this.orders.length; i++) {
					sum += parseFloat(this.orders[i].quantity)
				}
				return sum
			},
			subtotal(){
				let sum = 0;
				for (var i = 0; i < this.orders.length; i++) {
					sum += parseFloat(this.orders[i].subtotal)
				}
				return sum
			},
			total(){
				let sum = 0;
				for (var i = 0; i < this.orders.length; i++) {
					sum += parseFloat(this.orders[i].total)
				}
				return sum
			},
			pay(){
				let sum = 0;
				for (var i = 0; i < this.orders.length; i++) {
					sum += parseFloat(this.orders[i].pay)
				}
				return sum
			},
			due(){
				let sum = 0;
				for (var i = 0; i < this.orders.length; i++) {
					sum += parseFloat(this.orders[i].due)
				}
				return sum
			}
		},
		methods:{
			searchOrderByDate(){
				var date = {date:this.date}
				axios.post('/api/search-orders-by-date',date)
					.then(({data})=>(this.orders=data))
					.catch()
			},
			searchOrderByMonth(){
				var month = {month:this.month}
				axios.post('/api/search-orders-by-month',month)
					.then(({data})=>(this.orders=data))
					.catch()
			}
			
		},
		created(){
			
		}
	}
</script>
<style>
	
</style>