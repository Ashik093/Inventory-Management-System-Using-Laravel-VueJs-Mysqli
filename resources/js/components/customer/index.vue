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
							<li class="breadcrumb-item active">All Customer</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<div class="row">

			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-primary">
						<h3 class="card-title">All Customer</h3>
						<router-link to="/add-customer" class="btn btn-success btn-sm float-sm-right">Add Customer</router-link>
				 	</div>
					<!-- /.card-header -->
					<div class="card-body">
						<label for="">Search</label>
						<input type="text" class="form-control mb-4" style="width: 20%;" v-model="search">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Image</th>
									<th>Address</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="customer in filterSearch" :key="customer.id">
									<td>{{ customer.name }}</td>
									<td><img :src="customer.photo" alt="" style="width: 40px;height: 40px;"></td>
									<td>{{ customer.address }}</td>
									<td><div class="btn-group"><router-link :to="{name:'editcustomer',params:{id:customer.id}}" class="bnt btn-info btn-sm"><i class="fas fa-edit"></i></router-link><button class="btn btn-danger btn-sm" @click="deleteCustomer(customer.id)"><i class="fas fa-trash-alt"></i></button></div></td>
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
				customers:[],
				search:''
			}
		},
		computed:{
			filterSearch(){
				return this.customers.filter(customer =>{
					return customer.name.match(this.search)
				})
			}
		},
		methods:{
			allCustomers(){
				axios.get('/api/customer')
					.then(({data})=>(this.customers = data))
					.catch()
			},
			deleteCustomer(id){
				const swalWithBootstrapButtons = Swal.mixin({
				  customClass: {
				    confirmButton: 'btn btn-success',
				    cancelButton: 'btn btn-danger mr-1'
				  },
				  buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonText: 'Yes, delete it!',
				  cancelButtonText: 'No, cancel!',
				  reverseButtons: true
				}).then((result) => {
				  if (result.value) {
				  	axios.delete('/api/customer/'+id)
				  		.then(()=>{
				  			this.customers = this.customers.filter(customer=>{
				  				return customer.id != id
				  			})
				  		})
				  		.catch()
				    swalWithBootstrapButtons.fire(
				      'Deleted!',
				      'Your file has been deleted.',
				      'success'
				    )
				  } else if (
				    /* Read more about handling dismissals below */
				    result.dismiss === Swal.DismissReason.cancel
				  ) {
				    swalWithBootstrapButtons.fire(
				      'Cancelled',
				      'Your imaginary file is safe :)',
				      'error'
				    )
				  }
				})
			}
			
		},
		created(){
			this.allCustomers()
		}
	}
</script>
<style>
	
</style>