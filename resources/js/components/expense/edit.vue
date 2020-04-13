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
		              <li class="breadcrumb-item active">Edit Expense</li>
		            </ol>
		          </div><!-- /.col -->
		        </div><!-- /.row -->
		    </div><!-- /.container-fluid -->
		</div>
		<div class="card card-primary">
            <div class="card-header">
          		<h3 class="card-title">Update Expense</h3>
          		<router-link to="/all-expense" class="btn btn-success btn-sm float-sm-right">All Expense</router-link><router-link to="/add-expense" class="btn btn-success btn-sm float-sm-right">Add Expense</router-link>
           	</div>
           	<div class="card-body">
           		<form @submit.prevent="updateExpense" method="post">
           			<div class="row">
           				<div class="col-md-6">
           					<small class="text-danger" v-if="errors.detail">{{ errors.detail[0] }}</small>
           					<div class="form-group">
           					    <label>Expense Details</label>
          			                <textarea class="form-control" v-model="form.detail" rows="3"></textarea>
           					</div>
           					<small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
           					<div class="form-group">
           					    <label>Amount</label>
          			                <input type="text" class="form-control" v-model="form.amount" placeholder="Enter Amount">
           					</div>
           					<button type="submit" class="btn btn-primary">Update Expense</button>
           				</div>
           			</div>	
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
					detail:null,
					amount:null
				},
				errors:{}
			}
		},
		methods:{
			updateExpense(){
				let id = this.$route.params.id
				axios.patch('/api/expense/'+id,this.form)
					.then(()=>{
						Notification.success()
						this.$router.push({name:'allexpense'})

					})
					.catch(error => this.errors = error.response.data.errors)
			}
		},
		created(){
			let id = this.$route.params.id
			axios.get('/api/expense/'+id)
				.then(({data})=>(this.form = data))
				.catch()
		}
	}
</script>
<style>
	
</style>