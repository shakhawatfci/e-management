<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <input
          type="text"
          class="form-control"
          placeholder="Search By Bill No: eg 2020-06-1"
          v-model="bill_no"
          @keyup="getBillList()"
        />
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="project_id" @change="getBillList()">
          <option value>All Projects</option>
          <option
            v-for="project in projects"
            :key="project.id"
            :value="project.id"
          >{{ project.project_name }}</option>
        </select>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="equipment_type_id" @change="getBillList()">
          <option value>All Equipment Type</option>
          <option
            v-for="eq_type in equipment_types"
            :key="eq_type.id"
            :value="eq_type.id"
          >{{ eq_type.name }}</option>
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

      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="payment_status" @change="getBillList()">
          <option value>Project Payment Status</option>
          <option value="1">Paid</option>
          <option value="0">Unpaid</option>
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
                <td>
                  No : {{ value.bill_no }}
                  <br />
                  Month : {{ value.month | monthToString }}
                </td>
                <td>{{ value.project.project_name }}</td>
                <td>
                  <span>Equipment Type : {{ value.equipment_type.name }}.</span>
                  <br />
                  <span>
                    Vendor :
                    <strong>{{ value.vendor.vendor_name }}.</strong>
                  </span>
                  <br />
                  <span>Equipment Name : {{ value.equipement.eq_name }}.</span>
                  <br />
                </td>
                <td>{{ value.total_hour }}</td>
                <td>

                  Total Amount : {{ value.total_project_amount }}
                  <br />
                  Paid Amount : {{ Number(value.project_payment)+Number(value.project_adjustment_payment) }}
                  <br />
                  OutStanding : {{ value.total_project_amount - (Number(value.project_payment)+Number(value.project_adjustment_payment)) }}
                  <br />
                  Status :    <span class="badge badge-success" v-if="value.payment_status == 1">Paid</span>
                                      <span class="badge badge-danger" v-else>Unpaid</span>
                </td>
                <td>
                  Total Amount : {{ value.total_vendor_amount }}
                  <br />
                  Paid Amount : {{ Number(value.vendor_payment)+Number(value.vendor_adjustment_payment) }}
                  <br />
                  OutStanding : {{ value.total_vendor_amount - (Number(value.vendor_payment)+Number(value.vendor_adjustment_payment)) }}
                  <br />
                  Status :   <span class="badge badge-success" v-if="value.vendor_payment_status == 1">Paid</span>
                                      <span class="badge badge-danger" v-else>Unpaid</span>
                </td>

                <td class="text-center">
                  <div class="dropdown custom-dropdown">
                    <a
                      class="dropdown-toggle"
                      href="#"
                      role="button"
                      id="dropdownMenuLink2"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="fa fa-cogs fa-2x"></i>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                      <a
                        class="dropdown-item"
                        href
                        @click.prevent="viewMore(value)"
                      >View Bill Details</a>
                      <a
                        class="dropdown-item"
                        :href="url+'bill-print/'+value.bill_no"
                        target="_blank"
                      >Print & PDF</a>
                      <a class="dropdown-item" href @click.prevent="edit(value)">Edit</a>
                      <a
                        class="dropdown-item"
                        href
                        @click.prevent="makeProjectPayment(value)"
                      >Make Project Payment</a>
                      <a
                        class="dropdown-item"
                        href
                        @click.prevent="projectPaymentHistory(value)"
                      >
                      Project Paymetn History
                      </a>
                      <a
                        class="dropdown-item"
                        href
                        @click.prevent="makeVendorPayment(value)"
                      >Make Vendor Payment</a>

                      <a
                        class="dropdown-item"
                        href
                        @click.prevent="vendorPaymentHistory(value)"
                      >Vendor Payment History</a>
                      <a
                        class="dropdown-item"
                        href
                        @click.prevent="deleteBill(value.id)"
                      >Delete Bill</a>
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
        <edit-bill></edit-bill>
        <crate-project-payment></crate-project-payment>
        <view-project-payment></view-project-payment>
        <crate-vendor-payment></crate-vendor-payment>
        <view-vendor-payment></view-vendor-payment>
        <bill-details></bill-details>
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
import ViewProjectPayment from "./payment/ViewProjectPayment";
import CreateVendortPayment from "./payment/CreateVendorPayment";
import ViewVendorPayment from "./payment/ViewVendorPayment";
import EditBill from "./EditBill";
import BillDetails from "./BillDetails";
export default {
  mixins: [Mixin],
  props: ["vendors", "equipment_types", "projects"],
  components: {
    pagination: Pagination,
    "crate-project-payment"  : CreateProjectPayment,
    "crate-vendor-payment"   : CreateVendortPayment,
    "view-project-payment"   : ViewProjectPayment,
    "view-vendor-payment"    : ViewVendorPayment,
    "bill-details"           : BillDetails,
    "edit-bill"              : EditBill
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
      url: base_url
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

    edit(value)
    {
      // passing bill by event bus 
       EventBus.$emit('edit-bill',value);
    },

    viewMore(id) {
      EventBus.$emit("bill-details", id);
    },

    deleteBill(id) {
      Swal.fire(
        {
          title: "Are you sure ?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        },
        () => {}
      ).then(result => {
        if (result.value) {
          axios.delete(`${base_url}bill/${id}`).then(response => {
            this.successMessage(response.data);
            this.getBillList();
          });
        }
      });
    },

    makeProjectPayment(bill) {
      EventBus.$emit("make-project-payment", bill);
    },

    projectPaymentHistory(bill)
    {
      EventBus.$emit('view-project-payment',bill);
    },

    makeVendorPayment(bill) {
      EventBus.$emit("make-vendor-payment", bill);
    },

    vendorPaymentHistory(bill)
    {
      EventBus.$emit('view-vendor-payment',bill);
    },
    getVendorEquipments() {
      axios
        .get(`${base_url}equipment-by-vendor/0/${this.vendor_id}`)
        .then(response => {
          this.equipments = response.data;
        });
      this.getBillList();
    },

    pageClicked(page) {
      this.getBillList(page);
    },
    calculatePercent(total_amount, percentage) {
      if (percentage == 0) {
        return 0;
      }
      return (total_amount * percentage) / 100;
    }
  }
};
</script>


<style  scoped>
/* .bg-green {
  background-color : green;
 } */
</style>




