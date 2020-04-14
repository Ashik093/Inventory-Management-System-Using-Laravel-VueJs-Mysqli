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
		              <li class="breadcrumb-item active">Pay Salary</li>
		            </ol>
		          </div><!-- /.col -->
		        </div><!-- /.row -->
		    </div><!-- /.container-fluid -->
		</div>
		<div class="card card-primary">
            <div class="card-header">
          		<h3 class="card-title">Pay Salary</h3>
          		<router-link to="/all-salary" class="btn btn-success btn-sm float-sm-right">All Salary</router-link><router-link to="/add-salary" class="btn btn-success btn-sm float-sm-right">Give Salary</router-link>
           	</div>
           	<div class="card-body">
           		<form @submit.prevent="giveSalary" method="post">
           			<div class="row">
           				<div class="col-md-6">
           					<div class="form-group">
           					    <label>Employee Name</label>
          			            <input type="text" class="form-control" v-model="form.name" readonly>
          			            <input type="hidden" v-model="form.id">
           					</div>
           					<small class="text-danger" v-if="errors.month">{{ errors.month[0] }}</small>
           					<div class="form-group">
           					    <label>Month</label>
          			            <select class="form-control" v-model="form.month">
          			            	<option selected="" disabled="" value="undefined">Select A Month</option>
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
           				</div>
           				<div class="col-md-6">
           					<div class="form-group">
           					    <label>Employee Salary</label>
          			                <input type="text" class="form-control" v-model="form.salary" readonly>
           					</div>
           				</div>
           			</div>
           			<button type="submit" class="btn btn-primary">Pay Now</button>
           		</form>
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
			return {
				form:{
					id:null,
					name:null,
					salary:null,
					month:null
				},
				errors:{}
			}
		},
		methods:{
			giveSalary(){
				axios.post('/api/give-salary',this.form)
					.then((res)=>{
						if (res.data =='1') {
							Notification.success()
							this.$router.push({name:'allsalary'})
						}else if(res.data == '0'){
							Notification.salaryAlert()
						}
					})
					.catch(error => this.errors = error.response.data.errors)
			}
		},
		created(){
			let id = this.$route.params.id
			axios.get('/api/employee/'+id)
				.then(({data})=>(this.form = data))
				.catch()
		}
	}
</script>
<style>
	
</style>