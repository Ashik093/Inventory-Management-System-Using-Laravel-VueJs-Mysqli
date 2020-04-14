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
							<li class="breadcrumb-item active">Give Salary To Employee</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<div class="row">

			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-primary">
						<h3 class="card-title">All Employee</h3>
						<router-link to="/all-salary" class="btn btn-success btn-sm float-sm-right">All Salary</router-link>
				 	</div>
					<!-- /.card-header -->
					<div class="card-body">
						<label for="">Search</label>
						<input type="text" class="form- mb-4" style="width: 20%;" v-model="search">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Image</th>
									<th>Salary</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="employee in filterSearch" :key="employee.id">
									<td>{{ employee.name }}</td>
									<td><img :src="employee.photo" alt="" style="width: 40px;height: 40px;"></td>
									<td>{{ employee.salary }}</td>
									<td><div class="btn-group"><router-link :to="{name:'paysalary',params:{id:employee.id}}" class="bnt btn-info btn-sm">Pay Salary</router-link></div></td>
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
				employees:[],
				search:''
			}
		},
		computed:{
			filterSearch(){
				return this.employees.filter(employee =>{
					return employee.name.match(this.search)
				})
			}
		},
		methods:{
			allEmployee(){
				axios.get('/api/employee')
					.then(({data})=>(this.employees = data))
					.catch()
			}
			
		},
		created(){
			this.allEmployee()
		}
	}
</script>
<style>
	
</style>