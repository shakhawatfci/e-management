<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom: 10px">
        <input
          type="text"
          class="form-control"
          placeholder="Search By Bill No: eg 101"
          v-model="bill_no"
          @keyup="getBillList()"
        />
      </div>

      <div class="col-md-3" style="margin-bottom: 10px">
        <select
          class="form-control"
          v-model="project_id"
          @change="getBillList()"
        >
          <option value>All Projects</option>
          <option
            v-for="project in projects"
            :key="project.id"
            :value="project.id"
          >
            {{ project.project_name }}
          </option>
        </select>
      </div>

      <div class="col-md-3" style="margin-bottom: 10px">
        <select
          class="form-control"
          v-model="equipment_type_id"
          @change="getBillList()"
        >
          <option value>All Equipment Type</option>
          <option
            v-for="eq_type in equipment_types"
            :key="eq_type.id"
            :value="eq_type.id"
          >
            {{ eq_type.name }}
          </option>
        </select>
      </div>

      <div class="col-md-3" style="margin-bottom: 10px">
        <select
          class="form-control"
          v-model="vendor_id"
          @change="getVendorEquipments()"
        >
          <option value>All Vendor</option>
          <option v-for="vd in vendors" :key="vd.id" :value="vd.id">
            {{ vd.vendor_name }}
          </option>
        </select>
      </div>

      <div class="col-md-3" style="margin-bottom: 10px">
        <select
          class="form-control"
          v-model="operator_id"
          @change="getBillList()"
        >
          <option value>All Operator</option>
          <option v-for="operat in operator" :key="operat.id" :value="operat.id">
            {{ operat.name }}
          </option>
        </select>
      </div>

      <div class="col-md-3" style="margin-bottom: 10px">
        <select
          class="form-control"
          v-model="equipment_id"
          @change="getBillList()"
        >
          <option value>All Equipment</option>
          <option v-for="eq in equipments" :key="eq.id" :value="eq.id">
            {{ eq.eq_name }}
          </option>
        </select>
      </div>

      <div class="col-md-3" style="margin-bottom: 10px">
        <select
          class="form-control"
          v-model="payment_status"
          @change="getBillList()"
        >
          <option value>Project Payment Status</option>
          <option value="1">Paid</option>
          <option value="0">Unpaid</option>
        </select>
      </div>

      <div class="col-md-3" style="margin-bottom: 10px">
        <vue-monthly-picker
          :monthLabels="pickermonth.lebel"
          placeHolder="Start Month"
          v-model="start_month"
        ></vue-monthly-picker>
      </div>

      <div class="col-md-3" style="margin-bottom: 10px">
        <vue-monthly-picker
          :monthLabels="pickermonth.lebel"
          placeHolder="End Month"
          v-model="end_month"
          @input="getBillList()"
        ></vue-monthly-picker>
      </div>
    </div>

    <div class="row" style="margin-top: 20px">
      <div class="col-md-12" v-if="!isLoading">
        <div class="table-responsive" style="min-height: 60vh !important">
          <table class="table table-bordered table-hover mb-4">
            <thead>
              <tr>
                <!-- <th>Bill</th> -->
                <th>Project</th>
                <th>Equipment</th>
                <!-- <th>Total Hour</th> -->
                <!-- <th>Project Amount</th>
                <th>Vendor Amount</th> -->
                <th>Bill</th>
                <th>Paid</th>
                <th>Due</th>
                <th class="text-center">action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="value in fooding_bill.data" :key="value.id">
                <td> {{ value.project.project_name }}</td>
                <td>{{ value.equipement.eq_name }}</td>
                <td>{{ value.total_fooding_amount }}</td>
                <td>{{
                    Number(value.operator_adjustment_payment) +
                    Number(value.operator_payment_amount)
                  }}
                  
                </td>
                <td>{{
                    value.total_fooding_amount -
                    (Number(value.operator_adjustment_payment) +
                      Number(value.operator_payment_amount))
                  }}</td>

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
                   
                    <div
                      class="dropdown-menu"
                      aria-labelledby="dropdownMenuLink2"
                    >
                      <a
                        class="dropdown-item"
                        href
                        @click.prevent="viewMore(value)"
                        >View Bill Details</a
                      >
                      <a
                        class="dropdown-item"
                        :href="url + 'bill-print/' + value.id"
                        target="_blank"
                        >Print & PDF</a
                      >
                      

                      <a
                        class="dropdown-item"
                        href
                        @click.prevent="operatorPaymentHistory(value)"
                        >Operator Payment History</a
                      >
                      <a
                        class="dropdown-item"
                        href
                        @click.prevent="deleteBill(value.id)"
                        >Delete Bill</a
                      >
                    </div>
                  </div>
                </td>
              </tr>
              <tr class="float-rigth" v-if="fooding_bill.data.length > 0">
                <td colspan="7">
                  <a
                    :href="
                      url +
                      `bill-list-pdf/print?action='pdf'&vendor_id=${vendor_id}&equipment_type_id=${equipment_type_id}&project_id=${project_id}&equipment_id=${equipment_id}&payment_status=${payment_status}&bill_no=${bill_no}&start_month=${start_month._i}&end_month=${end_month._i}`
                    "
                    class="btn btn-primary btn-sm"
                    ><i class="fa fa-file-pdf-o"></i> PDF</a
                  >

                  <a
                    :href="
                      url +
                      `bill-list-pdf/print?action=print&vendor_id=${vendor_id}&equipment_type_id=${equipment_type_id}&project_id=${project_id}&equipment_id=${equipment_id}&payment_status=${payment_status}&bill_no=${bill_no}&start_month=${start_month._i}&end_month=${end_month._i}`
                    "
                    class="btn btn-danger btn-sm"
                    ><i class="fa fa-print" target="_blank"></i> Print</a
                  >
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-md-12 text-center" style="margin-top: 30px" v-else>
        <!-- <img :src="url+'images/logo/loading.gif'" class="img-fluid"> -->
        <div class="loader multi-loader mx-auto loader-xl"></div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 text-center mb-10 mt-10" v-if="fooding_bill.data.length > 0">
        <!-- import pagination here  -->
        
        <!-- <bill-details></bill-details> -->
        <pagination :pageData="fooding_bill"></pagination>
      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
import VueMonthlyPicker from "vue-monthly-picker";
import Pagination from "../../pagination/Pagination";
// import BillDetails from "./BillDetails";
export default {
  mixins: [Mixin],
  props: ["vendors", "equipment_types", "projects","operator"],
  components: {
    VueMonthlyPicker,
    pagination: Pagination,
  },
  data() {
    return {
      fooding_bill: [],
      equipments: [],
      vendor_id: "",
      operator_id: "",
      equipment_type_id: "",
      project_id: "",
      equipment_id: "",
      payment_status: "",
      keyword: "",
      bill_no: "",
      pickermonth: {
        lebel: [
          "JAN",
          "FEB",
          "MAR",
          "APR",
          "MAY",
          "JUN",
          "JUL",
          "AUG",
          "SEP",
          "OCT",
          "NOM",
          "DEC",
        ],
        text: "Search By Month",
      },
      start_month: "",
      end_month: "",
      isLoading: false,
      url: base_url,
    };
  },

  mounted() {
    var _this = this;

    // EventBus.$on("", function () {
    //   _this.getBillList();
    // });
    // console.log(this.operator)
    this.getBillList();
  },

  methods: {
    getBillList(page = 1) {
      this.isLoading = true;
      var st_mo = "";
      var lt_mo = "";
      if (this.end_month != "") {
        if (this.start_month === "")
          this.successMessage({
            status: "error",
            message: "Select start Month",
          });
        st_mo = this.start_month._i;
        lt_mo = this.end_month._i;
      }
      axios
        .get(
          base_url +
            `operator-fooding-list?page=${page}
            &vendor_id=${this.vendor_id}
            &equipment_type_id=${this.equipment_type_id}
            &project_id=${this.project_id}
            &operator_id=${this.operator_id}
            &equipment_id=${this.equipment_id}
            &payment_status=${this.payment_status}
            &bill_no=${this.bill_no}
            &start_month=${st_mo}
            &end_month=${lt_mo}`
        )
        .then((response) => {
          this.fooding_bill = response.data;
          this.isLoading = false;
        });
    },

    edit(value) {
      // passing bill by event bus
      EventBus.$emit("edit-bill", value);
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
          confirmButtonText: "Yes, delete it!",
        },
        () => {}
      ).then((result) => {
        if (result.value) {
          axios.delete(`${base_url}bill/${id}`).then((response) => {
            this.successMessage(response.data);
            this.getBillList();
          });
        }
      });
    },

    makeProjectPayment(bill) {
      EventBus.$emit("make-project-payment", bill);
    },

    projectPaymentHistory(bill) {
      EventBus.$emit("view-project-payment", bill);
    },

    makeVendorPayment(bill) {
      EventBus.$emit("make-vendor-payment", bill);
    },

    vendorPaymentHistory(bill) {
      EventBus.$emit("view-vendor-payment", bill);
    },

    makeOperatorPayment(bill) {
      EventBus.$emit("make-operator-payment", bill);
    },

    operatorPaymentHistory(bill) {
      EventBus.$emit("view-operator-payment", bill);
    },

    getVendorEquipments() {
      axios
        .get(`${base_url}equipment-by-vendor/0/${this.vendor_id}`)
        .then((response) => {
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
    },
  },
};
</script>


<style  scoped>
/* .bg-green {
  background-color : green;
 } */
</style>