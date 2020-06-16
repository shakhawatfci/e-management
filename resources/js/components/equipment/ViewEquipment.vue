<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="vendor_id" @change="getEquipment()">
          <option value="" >Filter By Vendor</option>
          <option v-for="vd in vendors" :key="vd.id" :value="vd.id">{{ vd.vendor_name }}</option>
        </select>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search Equipment" @change="getEquipment()" />
      </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
    <table class="table table-bordered table-hover  mb-4">
        <thead>
            <tr>
                <th>Equipment Name</th>
                <th>Vendor</th>
                <th>Model</th>
                <th>Capacity</th>
                <th class="text-center">Status</th>
                <th class="text-center">action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in equipments.data" :key="value.id">
                <td>{{ value.eq_name }}</td>
                <td>{{ value.vendor.vendor_name }}</td>
                <td>{{ value.eq_model }}</td>
                <td>{{ value.eq_capacity }}</td>
                <td class="text-center">
                    <span class="text-success">Active</span>
                </td>
                <td class="text-center">
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle"><i class="far fa-edit"></i></button>
                    <button class="btn btn-danger mb-2 mr-2 rounded-circle"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
    
        </div>
    </div>

    <div class="row">
      <div class="col-md-12 text-center mb-10 mt-10">
       <!-- import pagination here  -->
       <pagination :pageData="this.equipments"> </pagination>

      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
import Pagination from '../pagination/Pagination';
export default {
  mixins: [Mixin],
  props: ["vendors"],
  components : {
   'pagination' : Pagination
  },
  data() {
    return {
     equipments : [],
     vendor_id : '',
     keyword   : '',
     isLoading : false,
    }
  },

  mounted() {

      var _this = this;

      EventBus.$on('equipment-created',function(){
          _this.getEquipment();
      })

      this.getEquipment();

  },

  methods: {
     
     getEquipment(page = 1) 
     {
         this.isLoading = true;
         axios
         .get(base_url+`equipment-list?page=${page}&vendor_id=${this.vendor_id}&keyword=${this.keyword}`)
         .then(response =>
          {
            this.equipments = response.data;
            this.isLoading = false;
         });
     },

     pageClicked(page)
     {
         this.getEquipment(page);
     }

    }
    }
</script>



