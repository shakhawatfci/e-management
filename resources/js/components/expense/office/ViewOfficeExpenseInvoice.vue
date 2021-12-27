<template>
  <div>
    <div class="row">
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
          @input="getOfficeExpenseInvoice()"
        ></vue-monthly-picker>
      </div>
      <div class="col-md-3" style="margin-bottom: 10px">
        <input
          type="text"
          v-model="keyword"
          class="form-control"
          placeholder="Search Office Expense"
          @keyup="getOfficeExpenseInvoice()"
        />
      </div>

      <div class="col-md-2" style="margin-bottom: 15px">
        <button type="button" class="btn btn-danger" @click="filterClear()">
          Clear
        </button>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12" v-if="!isLoading">
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-4">
            <thead>
              <tr>
                <th>SL</th>
                <th>Invoice No</th>
                <th>Date</th>
                <th>Month</th>
                <th>Amount</th>
                <th>Document Link</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(value,index) in offices.data" :key="index">
                <td>{{ index+1 }}</td>
                <td>{{ value.invoice_no }}</td>
                <td>{{ value.date | dateToString }}</td>
                <td>{{ value.month | monthToString }}</td>
                <td>{{ value.total_amount }}</td>
                <td>{{ value.document_link }}</td>
                <td class="text-center">
                  <button
                    class="btn btn-warning mb-2 mr-2 rounded-circle"
                    title="View"
                    @click.prevent="showOfficeExpenseInvoice(value)"
                  >
                    <i class="far fa-eye"></i>
                  </button>
                  <button
                    class="btn btn-dark mb-2 mr-2 rounded-circle"
                    title="Edit"
                    @click.prevent="editOfficeExpense(value)"
                  >
                    <i class="far fa-edit"></i>
                  </button>
                  <button
                    class="btn btn-danger mb-2 mr-2 rounded-circle"
                    title="Delete"
                    @click.prevent="deleteOfficeExpense(value.id)"
                  >
                    <i class="far fa-trash-alt"></i>
                  </button>
                </td>
              </tr>
              <tr v-if="offices.length > 0">
                <td colspan="6">
                  <a
                    :href="
                      url +
                      `office-expense-print-pdf?action=pdf&keyword=${keyword}&office_head=${office_expense_head_id}&start_month=${start_month._i}&end_month=${end_month._i}`
                    "
                    class="btn btn-primary btn-sm"
                    ><i class="fa fa-file-pdf-o"></i> PDF</a
                  >
                  <a
                    :href="
                      url +
                      `office-expense-print-pdf?action=print&keyword=${keyword}&office_head=${office_expense_head_id}&start_month=${start_month._i}&end_month=${end_month._i}`
                    "
                    class="btn btn-danger btn-sm"
                    target="_blank"
                    ><i class="fa fa-file-pdf-o"></i> Print</a
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
    <show-officeexpense />
    <update-officeexpense-invoice> </update-officeexpense-invoice>
    <div class="row">
      <div class="col-md-12 text-center mb-10 mt-10">
        <!-- import pagination here  -->
        <pagination :pageData="this.offices"> </pagination>
      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
import VueMonthlyPicker from "vue-monthly-picker";
import Pagination from "../../pagination/Pagination";
import UpdateOfficeexpense from "./UpdateOfficeExpense";
import ViewOfficeexpense from "./SingleViewOfficeExpenseInvoice";
export default {
  mixins: [Mixin],
  components: {
    pagination: Pagination,
    'update-officeexpense-invoice': UpdateOfficeexpense,
    'show-officeexpense': ViewOfficeexpense,
    VueMonthlyPicker,
  },
  data() {
    return {
      offices: [],
      office_heads: [],
      office_expense_head_id: "",
      keyword: "",
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
      url: base_url,
      isLoading: false,
    };
  },

  mounted() {
    var _this = this;

    EventBus.$on("OfficeExpense-created", function () {
      _this.getOfficeExpenseInvoice();
    });

    this.getOfficeExpenseInvoice();
  },

  methods: {
    getOfficeExpenseInvoice(page = 1) {
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
            `office-expense-invoice-list?page=${page}&keyword=${this.keyword}&start_month=${st_mo}&end_month=${lt_mo}`
        )
        .then((response) => {
          this.offices = response.data;
          this.isLoading = false;
        });
    },

    editOfficeExpense(value) {
      EventBus.$emit("officeexpense-update", value);
    },

    showOfficeExpenseInvoice(value) {
      EventBus.$emit("officeexpense-invoice", value);
    },

    deleteOfficeExpense(id) {
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
          axios.delete(`${base_url}office-expense/${id}`).then((response) => {
            this.successMessage(response.data);
            EventBus.$emit('OfficeExpense-created');
            this.getOfficeExpenseInvoice();
          });
        }
      });
    },

    filterClear() {
      this.office_expense_head_id = "";
      this.start_month = "";
      this.end_month = "";
      this.keyword = "";
      this.getOfficeExpenseInvoice();
    },

    pageClicked(page) {
      this.getOfficeExpenseInvoice(page);
    },
  },
};
</script>