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
							<li class="breadcrumb-item active">All Salary</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<div class="row">

			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-primary">
						<h3 class="card-title">All Salary</h3>
						<router-link to="/add-salary" class="btn btn-success btn-sm float-sm-right">Give Salary</router-link>
				 	</div>
					<!-- /.card-header -->
					<div class="card-body">
						<label for="">Search</label>
						<input type="text" class="form- mb-4" style="width: 20%;" v-model="search">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Month</th>
									<th>Year</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="salary in filterSearch" :key="salary.month">
									<td>{{ salary.month }}</td>			
									<td>{{ salary.year }}</td>			
									<td><div class="btn-group"><router-link :to="{name:'viewsalary',params:{month:salary.month,year:salary.year}}" class="bnt btn-info btn-sm">View Salary</router-link></div></td>
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
				salaries:[],
				search:''
			}
		},
		computed:{
			filterSearch(){
				return this.salaries.filter(salary =>{
					return salary.month.match(this.search)
				})
			}
		},
		methods:{
			allSalary(){
				axios.get('/api/all-salary')
					.then(({data})=>(this.salaries = data))
					.catch()
			}
			
		},
		created(){
			this.allSalary()
		}
	}
</script>
<style>
	
</style>