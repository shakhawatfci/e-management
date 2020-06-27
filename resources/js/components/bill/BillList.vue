<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
       <input type="text" class="form-control" placeholder="Search By Bill No: eg 2020-06-1" v-model="bill_no" @keyup="getBillList()">
      </div>
      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="payment_status" @change="getBillList()">
          <option value="">Payment Status</option>
          <option value="1">Paid</option>
          <option value="0">Unpaid</option>
   
        </select>
      </div>
      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="project_id" @change="getBillList()">
          <option value>All Projects</option>
          <option v-for="project in projects" :key="project.id"
           :value="project.id">{{ project.project_name }}</option>
        </select>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="equipment_type_id" @change="getBillList()">
          <option value>All Equipment Type</option>
          <option v-for="eq_type in equipment_types" :key="eq_type.id"
           :value="eq_type.id">{{ eq_type.name }}</option>
        </select>
      </div>


      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="vendor_id" @change="getVendorEquipments()">
          <option value>All Vendor</option>
          <option v-for="vd in vendors" :key="vd.id" :value="vd.id">{{ vd.vendor_name }}</option>
        </select>
      </div>


      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="equipment_id" @change="getBillList()">
          <option value>All Equipment</option>
          <option v-for="eq in equipments" :key="eq.id" :value="eq.id">{{ eq.eq_name }}</option>
        </select>
      </div>

    </div>

    <div class="row" style="margin-top:20px">
      <div class="col-md-12" v-if="!isLoading">
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-4">
            <thead>
              <tr>
                <th>Bill</th>
                <th>Project</th>
                <th>Equipment</th>
                <th>Total Hour</th>
                <th>Project Amount</th>
                <th>Vendor Amount</th>
                <th class="text-center">action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="value in bill_list.data" :key="value.id">
                <td>No : {{ value.bill_no }} <br>
                 Month : {{ value.bill_no | monthToString }}</td>
                <td>{{ value.project.project_name }}</td>
                <td>
                    <span>Equipment Type : {{ value.equipment_type.name }}.</span><br>
                    <span>Vendor : <strong>{{ value.vendor.vendor_name }}.</strong></span><br>
                    <span>Equipment Name : {{ value.equipement.eq_name }}.</span><br>
                </td>
                <td>{{ value.total_hour }}</td>
                <td :class="value.payment_status == 1 ? 'bg-green' : ''">
                    Net Amount (R*H) : ({{ value.project_rate_per_hour }} * {{ value.total_hour }}) = {{ value.project_amount }}<br>
                    Vat : {{ value.project_vat }}% =   {{ ((value.project_amount*value.project_vat)/100) | formatPrice }}<br>
                    Ait : {{ value.project_ait }}% =   {{ ((value.project_amount*value.project_ait)/100) | formatPrice }}<br>
                    Others Vat: {{ value.project_sup }}% =   {{ ((value.project_amount*value.project_sup)/100) | formatPrice }}<br>
                    Total Amount  : {{ value.total_project_amount }}<br>

                    Paid Amount : {{ Number(value.project_payment)+Number(value.project_adjustment_payment) }} <br>

                    OutStanding : {{ value.total_project_amount - (Number(value.project_payment)+Number(value.project_adjustment_payment)) }} <br>

                    Status : {{ value.payment_status == 1 ? 'Paid' : 'Unpaid' }}
                </td>
                <td>
                    Vendor Amount (R*H) : ({{ value.vendor_rate_per_hour }} * {{ value.total_hour }}) = {{ value.vendor_amount }}<br>
                    Vat : {{ value.vendor_vat }}% =   {{ ((value.vendor_amount*value.vendor_vat)/100) | formatPrice }}<br>
                    Ait : {{ value.vendor_ait }}% =   {{ ((value.vendor_amount*value.vendor_ait)/100) | formatPrice }}<br>
                    Others Vat: {{ value.vendor_supt }}% =   {{ ((value.vendor_amount*value.vendor_sup)/100) | formatPrice }}<br>
                    Total Amount  : {{ value.total_vendor_amount }}<br>

                    
                    Paid Amount : {{ Number(value.vendor_payment)+Number(value.vendor_adjustment_payment) }} <br>

                    OutStanding : {{ value.total_vendor_amount - (Number(value.vendor_payment)+Number(value.vendor_adjustment_payment)) }} <br>

                    Status : {{ value.vendor_payment_status == 1 ? 'Paid' : 'Unpaid' }}
                </td>

                <td class="text-center">
                    <div class="dropdown custom-dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cogs fa-2x"></i>
                            
                        </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">

                             <a class="dropdown-item" href=""
                              @click.prevent="viewMore(value.id)">View Bill Details</a>
                             <a class="dropdown-item" href=""
                              @click.prevent="edit(value)">Edit</a>
                             <a class="dropdown-item" href=""
                              @click.prevent="makeProjectPayment(value)">Make Project Payment</a>
                             <a class="dropdown-item" href=""
                              @click.prevent="makeVendorPayment(value.id)">Make Vendor Payment</a>
                             <a class="dropdown-item" href=""
                             @click.prevent="projectPaymentHistory(value.id)">Project Paymetn History</a>
                             <a class="dropdown-item" href=""
                              @click.prevent="vendorPaymentHistory(value.id)">Vendor Payment History</a>
                     </div>
                    </div>
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
        <crate-project-payment></crate-project-payment>
        <pagination :pageData="bill_list"></pagination>
      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
import Pagination from "../pagination/Pagination";
import CreateProjectPayment from "./payment/CreateProjectPayment";
export default {
  mixins: [Mixin],
  props: ["vendors",'equipment_types','projects'],
  components: {
    'pagination': Pagination,
    'crate-project-payment': CreateProjectPayment,
  },
  data() {
    return {
      bill_list: [],
      equipments: [],
      vendor_id: "",
      equipment_type_id: "",
      project_id: "",
      equipment_id: "",
      payment_status: "",
      keyword: "",
      bill_no: "",
      isLoading: false,
      url : base_url
    };
  },

  mounted() {
    var _this = this;

    EventBus.$on("bill-changed", function() {
      _this.getBillList();
    });

    this.getBillList();
  },

  methods: {
    getBillList(page = 1) {
      this.isLoading = true;
      axios
        .get(
          base_url +
           `bill-list?page=${page}
            &vendor_id=${this.vendor_id}
            &equipment_type_id=${this.equipment_type_id}
            &project_id=${this.project_id}
            &equipment_id=${this.equipment_id}
            &payment_status=${this.payment_status}
            &bill_no=${this.bill_no}`
        )
        .then(response => {
          this.bill_list = response.data;
          this.isLoading = false;
        });
    },


    viewMore(id) 
    {
      alert('work on progress check project payment option');
    EventBus.$emit('bill-details',id);
    },

    makeProjectPayment(bill)
    {
     EventBus.$emit('make-project-payment',bill);
    },
    
     getVendorEquipments()
     {
       
       axios.get(`${base_url}equipment-by-vendor/0/${this.vendor_id}`)
            .then(response => {
              this.equipments = response.data;
            });
       this.getBillList();
     },

    pageClicked(page) {
      this.getBillList(page);
    },
    calculatePercent(total_amount,percentage)
     {
         if(percentage == 0)
         {
          return 0;
         }
         return  total_amount*percentage/100;
     },
  }
};
</script>


<style  scoped>
 .bg-green {
  background-color : green;
 }
</style>




