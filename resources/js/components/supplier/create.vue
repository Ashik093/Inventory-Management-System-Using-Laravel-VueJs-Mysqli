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
		              <li class="breadcrumb-item active">Add Supplier</li>
		            </ol>
		          </div><!-- /.col -->
		        </div><!-- /.row -->
		    </div><!-- /.container-fluid -->
		</div>
		<div class="card card-primary">
            <div class="card-header">
          		<h3 class="card-title">Add Supplier</h3>
          		<router-link to="/all-supplier" class="btn btn-success btn-sm float-sm-right">All Supplier</router-link>
           	</div>
           	<div class="card-body">
           		<form @submit.prevent="insertSupplier" method="post" enctype="multipart/form-data">
           			<div class="row">
           				<div class="col-md-6">
           					<small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
           					<div class="form-group">
           					    <label>Supplier Name</label>
          			                <input type="text" class="form-control" placeholder="Enter Supplier Name" v-model="form.name">
           					</div>

           					<small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
           					<div class="form-group">
           					    <label>Supplier Phone</label>
          			                <input type="text" class="form-control" placeholder="Enter Supplier Phone" v-model="form.phone">
           					</div>

           					<small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
           					<div class="form-group">
           					    <label>Supplier Address</label>
          			                <input type="text" class="form-control" placeholder="Enter Supplier Address" v-model="form.address">
           					</div>

           					
           				</div>
           				<div class="col-md-6">
           					<small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
           					<div class="form-group">
           					    <label>Supplier Email</label>
          			                <input type="email" class="form-control" placeholder="Enter Supplier Email" v-model="form.email">
           					</div>
           					<small class="text-danger" v-if="errors.shop_name">{{ errors.shop_name[0] }}</small>
           					<div class="form-group">
           					    <label>Supplier Shop Name</label>
          			                <input type="text" class="form-control" placeholder="Enter Supplier Shop Name" v-model="form.shop_name">
           					</div>
           					<div class="form-group">
           					    <label>Supplier Photo</label>
          			                <input type="file" class="form-control" @change="onFileSelected">
           					</div>
           					<div class="form-group">
           					    <img :src="form.photo" alt="" style="width: 50px;height: 50px;">
           					</div>
           				</div>
           			</div>
           			<button type="submit" class="btn btn-primary">Add Supplier</button>
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
					name:null,
					email:null,
					phone:null,
					address:null,
					shop_name:null,
					photo:null
				},
				errors:{}
			}
		},
		methods:{
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
			insertSupplier(){
				axios.post('/api/supplier',this.form)
					.then(()=>{
						Notification.success()
						this.$router.push({name:'allsupplier'})

					})
					.catch(error => this.errors = error.response.data.errors)
			}
		}
	}
</script>
<style>
	
</style>