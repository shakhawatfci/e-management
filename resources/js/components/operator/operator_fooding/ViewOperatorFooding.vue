<template>
  <div>
    <div class="row">
      <!-- <div class="col-md-3" style="margin-bottom: 10px">
        <input
          type="text"
          class="form-control"
          placeholder="Search By Bill No: eg 101"
          v-model="bill_no"
          @keyup="getBillList()"
        />
      </div> -->

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

      <!-- <div class="col-md-3" style="margin-bottom: 10px">
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
      </div> -->

      <div class="col-md-3" style="margin-bottom: 10px">
        <select
          class="form-control"
          v-model="operator_id"
          @change="getBillList()"
        >
          <option value>All Operator</option>
          <option v-for="operat in operators" :key="operat.id" :value="operat.id">
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
          <option v-for="eq in equipements" :key="eq.id" :value="eq.id">
            {{ eq.eq_name }}
          </option>
        </select>
      </div>

      <div class="col-md-3" style="margin-bottom: 10px">
         <button type="button" class="btn btn-danger" @click="clearField()">Clear</button>
      </div>

      <!-- <div class="col-md-3" style="margin-bottom: 10px">
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
      </div> -->
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
                <th>Operator</th>
                <!-- <th>Project Amount</th>
                <th>Vendor Amount</th> -->
                <th>Fooding Bill</th>
                <th>Paid Amount</th>
                <th>Due</th>
                <th class="text-center">action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="value in fooding_bill.data" :key="value.id">
                <td> {{ value.project.project_name }}</td>
                <td>{{ value.equipement.eq_name }}</td>
                <td> {{ value.operator.name }}</td>
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
                  <button
                    class="btn btn-warning mb-2 mr-2 rounded-circle"
                    title="View"
                    @click="viewMore(value)"
                  >
                    <i class="far fa-eye"></i>
                  </button>
                
                  <button
                    class="btn btn-danger mb-2 mr-2 rounded-circle"
                    title="Delete"
                    @click.prevent="deleteBill(value.id)"
                  >
                    <i class="far fa-trash-alt"></i>
                  </button>
                </td>
              </tr>
              <tr class="float-rigth" v-if="fooding_bill.data.length > 0">
                <td colspan="7">
                  <a target="_blank"  
                    :href="
                      url +
                      `operator-fooding-list-pdf/print?action='pdf'&project_id=${project_id}&equipment_id=${equipment_id}&operator_id=${operator_id}&no_paginate=yes`
                    "
                    class="btn btn-primary btn-sm"
                    ><i class="fa fa-file-pdf-o"></i> PDF</a
                  >

                  <a target="_blank"
                    :href="
                      url +
                      `operator-fooding-list-pdf/print?action=print&project_id=${project_id}&equipment_id=${equipment_id}&operator_id=${operator_id}&no_paginate=yes`
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

        <pagination :pageData="fooding_bill"></pagination>
      </div>
        <fooding-details></fooding-details>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
import VueMonthlyPicker from "vue-monthly-picker";
import Pagination from "../../pagination/Pagination";
import FoodingDetails from "./SingleViewoperatorFooding";
export default {
  mixins: [Mixin],
  props: ["equipements", "projects","operators"],
  components: {
    'fooding-details': FoodingDetails,
    VueMonthlyPicker,
    pagination: Pagination,
  },
  data() {
    return {
      fooding_bill: [],
      // equipments: [],
      // vendor_id: "",
      operator_id: "",
      // equipment_type_id: "",
      project_id: "",
      equipment_id: "",
      // payment_status: "",
      // keyword: "",
      // bill_no: "",
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
      // start_month: "",
      // end_month: "",
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

      axios
        .get(
          base_url +
            `operator-fooding-list?page=${page}
            &project_id=${this.project_id}
            &operator_id=${this.operator_id}
            &equipment_id=${this.equipment_id}`
        )
        .then((response) => {
          this.fooding_bill = response.data;
          this.isLoading = false;
        });
    },

    viewMore(value) {
      EventBus.$emit("operator-fooding-details", value);
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
   
    pageClicked(page) {
      this.getBillList(page);
    },

    clearField(){
      this.fooding_bill = []
      this.operator_id = ""
      this.project_id = ""
      this.equipment_id = ""
      this.getBillList();
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