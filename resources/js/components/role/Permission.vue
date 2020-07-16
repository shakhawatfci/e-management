<template>
	<div id="RolePermission" class="modal fade" aria-hidden="true">
		<div class="modal-dialog modal-xl custom-modal">
			<div class="modal-content">
				<div class="modal-header text-right flex">
                     <h4 class="modal-title">Permission Given to {{ role.role_name }}</h4>
                     <h4 class="modal-title">
                         <button class="btn btn-sm btn-default " data-dismiss="modal">X</button>
                     </h4>
				</div>
				<div class="modal-body">

							<form @submit.prevent="AssignRole()" role="form">

								<div class="row" v-for="(value,index) in role.menus" :key="index">
									<div v-if="index !== 0" class="col-md-12 text-left">
										<hr>
									</div>									
									<div class="col-md-12 text-left">
									<h5>{{ value.name }}</h5>
				                    <div class="switch" v-if="value.sub_menu.length === 0">

                                        <label  class="switch s-icons s-outline s-outline-danger mr-2">
                                            <input :value="value.id" :id="value.id"  v-model="value.check" 
                                            type="checkbox">
                                            <span class="slider round"></span>
                                        </label>

				                    </div>
								    </div>


                                    <!-- if sub menu  -->
									<div class="col-md-3" v-for="(sub,indexs) in value.sub_menu" :key="indexs+'sub'">
										<p style="margin-top: 20px;font-weight:bold" class="text-info">{{ sub.name }}</p>
				                    <div class="switch">

                                        <label  class="switch s-icons s-outline s-outline-danger mr-2">
                                            <input :value="sub.id" :id="sub.id"  v-model="sub.check" 
                                            type="checkbox">
                                            <span class="slider round"></span>
                                        </label>
				                    </div>										

									</div>

                                    <!-- sub menu part 									 -->

								</div>
							
                        
									
								<div class="row">
									<div class="col-md-12">
									<button style="margin-top: 20px;" 
                                     class="btn btn-lg  btn-primary float-right "
                                      type="submit">
                                      <div class="spinner-grow text-white mr-2 align-self-center loader-sm" v-if="button_name != 'Update'">.</div> <strong>{{ button_name }}</strong>
                                      </button>										
									</div>

								</div>
							</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	
	import {EventBus} from  '../../vue-assets';
	import Mixin from  '../../mixin';
	
	export default{
		mixins:[Mixin],
		data(){
			return{
				role : {
					id : 0,
					role_name : '',
					menus : [],
				},
				button_name : 'Update',
				
				errors : null
			}
		},
		created(){
			let vm = this;
			EventBus.$on('assign-permission',function(role){
				vm.role.id = role.id;
				vm.role.role_name = role.role_name;
				vm.getMenus(role.id);
				$('#RolePermission').modal('show');
			});
			// $('#RolePermission').on('hidden.bs.modal', function(){
			// 	vm.closeModal();
			// });
		},
		methods : {
			getMenus(id){
				axios.get(base_url+'role/'+id)
				.then(response => {
                   
                   this.role.menus = response.data;
				})
			},
			AssignRole(){
                this.button_name = 'Updating.....';
				axios.post(base_url+'permission',this.role)
				.then(res => {
					console.log(res);
					if(res.data.status == 'success'){
						this.successMessage(res.data);
						this.button_name = 'Update';
						EventBus.$emit('role-created',1);
						this.closeModal();
						$('#RolePermission').modal('hide');
					}
					else{
					 this.successMessage(res.data);
					 this.button_name = 'Update';
					}
					
				})
				.catch(err => {
					if(err.response){
						this.errors = err.response.data.errors;
					}
					this.button_name = 'Update';
				})
								
			},
			closeModal(){
				EventBus.$emit('role-created',1);
			}			
		}
	}	
</script>