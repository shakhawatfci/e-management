<template>
  <div>
    <div class="row">

      <div class="col-md-6" style="margin-bottom:10px;">
        <input
          type="text"
          v-model="keyword"
          class="form-control"
          placeholder="Search by keyword"
          @keyup="getrole()"
        />
      </div>
    </div>

    <div class="row">
      <div class="col-md-12" v-if="!isLoading">
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-4">
           
                        <thead>
                        <tr>
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(value,index) in roles.data" :key="index">
                            <td>{{ value.role_name }}</td>
                            <td><a @click.prevent="perMission(value.id)" href="" class="btn btn-sm btn-secondary rounded"><i class="fa fa-key"></i></a></td>
                            <td>
                                <a @click.prevent="edit(value)" class="btn btn-sm btn-primary" href="#"><i class="fa fa-edit" title="Edit"></i></a> 
                                <a @click.prevent="deleterole(value.id)" class="btn btn-sm btn-danger" href="#"><i class="fa fa-trash" title="Delete"></i></a>
                            </td>
                        </tr>

                        </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-12 text-center" style="margin-top:30px;" v-else>
        <!-- <img :src="url+'images/logo/loading.gif'" class="img-fluid"> -->
        <div class="loader multi-loader mx-auto loader-xl"></div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 text-center mb-10 mt-10">
        <!-- import pagination here  -->
        <pagination :pageData="roles"></pagination>
        <!-- <edit-role ></edit-role>
        <role-permission></role-permission> -->
      </div>
    </div>
  </div>
</template>

<script>

    import { EventBus } from  '../../vue-assets';

    import Mixin from  '../../mixin';

    import Pagination from  '../pagination/Pagination';

    import UpdateRole from './EditRole';
    import Permission from './Permission';
	
	export default {

        mixins : [Mixin],

        components : {
         
         'pagination' : Pagination,
         'edit-role' : UpdateRole,
         'role-permission' : Permission,

        },

       data(){
         
         return {
            
            roles : [],

            isLoading : false,

            keyword : '',

            url : base_url,

         }

       },

       mounted(){


        // this  will not work in eventBus that why 
        // we are initializing with _this

        var _this = this;

        _this.getrole();

        EventBus.$on('role-created',function(){

            // getting updated data when insert update delete happend 

        _this.getrole();


        });



       },

       methods : {
       

        getrole(page = 1){
         this.isLoading = true;
         axios.get(base_url+'role-list?page='+page+'&keyword='+this.keyword)
              .then(response => {
               this.roles = response.data;
               this.isLoading = false;
              });
        },

        pageClicked(pageNo){
        var vm = this;
        vm.getrole(pageNo);
        },

        // edit role 

        edit(id){           
            EventBus.$emit('update-role',id);
        },

        perMission(id){
          
          this.successMessage({ status : 'error' , message : 'Work On Progress'  });
          EventBus.$emit('assign-permission',id);

        },


        // delete role 

        deleterole(id){
        Swal.fire({
            title: 'Are you sure ?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        },() => {

        }).then((result) => {
            if (result.value) {

                axios.get(base_url+'role/delete/'+id)
                .then(res => {

                    this.successMessage(res.data);
                    this.getrole();
                })
            }
        }) 

       },



       }

	}

</script>