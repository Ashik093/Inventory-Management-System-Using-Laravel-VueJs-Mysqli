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
	              <li class="breadcrumb-item"><a href="#">Home</a></li>
	              <li class="breadcrumb-item active">Dashboard</li>
	            </ol>
	          </div><!-- /.col -->
	        </div><!-- /.row -->
	      </div><!-- /.container-fluid -->
	</div>
	<div class="row">
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-info">
				<div class="inner">
					<h5>{{ sell }} Taka</h5>
					<h3>Today Sell</h3>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<h5>{{ income }} Taka</h5>
					<h3>Today Income</h3>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-warning">
				<div class="inner">
					<h5>{{ due }} Taka</h5>
					<h3>Today Due</h3>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-danger">
				<div class="inner">
					<h5>{{ expense }} Taka</h5>
					<h3>Today Expense</h3>
				</div>
				<div class="icon">
					<i class="ion ion-pie-graph"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
	</div>
	<div class="row">

		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-danger">
					<h3 class="card-title">Stock Out Product</h3>
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
								<th>Buying Price</th>
								<th>Root</th>
								<th>Quantity</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="product in filterSearch" :key="product.id">
								<td>{{ product.name }}</td>
								<td>{{ product.code }}</td>
								<td><img :src="product.picture" alt="" style="width: 40px;height: 40px;"></td>
								<td>{{ product.buying_price }}</td>
								<td>{{ product.root }}</td>
								<td>{{ product.quantity }}</td>
								<td><span class="badge badge-danger">Out Of Stock</span></td>
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
	export default{
		mounted(){
			if (!User.loggedIn()) {
				this.$router.push({name:'/'})
			}
		},
		data(){
			return{
				sell:'',
				income:'',
				due:'',
				expense:'',
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
			todaySell(){
				axios.get('/api/today-sell')
					.then(({data})=>(this.sell=data))
					.catch()
			},
			todayIncome(){
				axios.get('/api/today-income')
					.then(({data})=>(this.income=data))
					.catch()
			},
			todayDue(){
				axios.get('/api/today-due')
					.then(({data})=>(this.due=data))
					.catch()
			},
			todayExpense(){
				axios.get('/api/today-expense')
					.then(({data})=>(this.expense=data))
					.catch()
			},
			stockOut(){
				axios.get('/api/stock-out')
					.then(({data})=>(this.products=data))
					.catch()
			}
		},
		created(){
			this.todaySell()
			this.todayIncome()
			this.todayDue()
			this.todayExpense()
			this.stockOut()
		}
	}
</script>
<style>
	
</style>