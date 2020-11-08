<template>
  <div>
    <div class="row">
      <div class="col-md-6" style="margin-bottom: 10px">
        <input
          type="text"
          v-model="keyword"
          class="form-control"
          placeholder="Search by Qoutation NO , To or Subject"
          @keyup="getQuotation()"
        />
      </div>
    </div>

    <div class="row">
      <div class="col-md-12" v-if="!isLoading">
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-4">
            <thead>
              <tr>
                <th>Quotation No</th>
                <th>To</th>
                <th>Subject</th>
                <th>Total Equipment Type</th>
                <th class="text-center">action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="value in quotations.data" :key="value.id">
                <td>
                  {{ value.id }}
                </td>
                <td>
                  {{ value.to }} <br />
                  {{ value.company }} <br />
                  {{ value.address }}
                </td>
                <td>{{ value.subject }}</td>
                <td>{{ value.total_equipment }}</td>

                <td class="text-center">
                  <button
                    @click="sendQuotation(value)"
                    class="btn btn-danger mb-2 mr-2 rounded-circle"
                    title="Send Quotation in Email"
                  >
                    <i class="far fa-envelope-open"></i>
                  </button>
                  <button
                    @click="edit(value)"
                    class="btn btn-dark mb-2 mr-2 rounded-circle"
                  >
                    <i class="far fa-edit"></i>
                  </button>
                  <button
                    @click="deleteQuotation(value.id)"
                    class="btn btn-danger mb-2 mr-2 rounded-circle"
                  >
                    <i class="far fa-trash-alt"></i>
                  </button>
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
      <div class="col-md-12 text-center mb-10 mt-10">
        <!-- import pagination here  -->
        <pagination :pageData="quotations"></pagination>
        <!-- <edit-equipment-type></edit-equipment-type> -->
        <SendQuotation />
      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
import Pagination from "../pagination/Pagination";
// import UpdateEquipmentType from "./UpdateEquipmentType";
import SendQuotation from "./SendQutation";
export default {
  mixins: [Mixin],
  components: {
    pagination: Pagination,
    SendQuotation,
    // "edit-equipment-type": UpdateEquipmentType,
  },
  data() {
    return {
      quotations: [],
      keyword: "",
      isLoading: false,
      url: base_url,
    };
  },

  mounted() {
    var _this = this;

    EventBus.$on("qoutation-created", function () {
      _this.getQuotation();
    });

    this.getQuotation();
  },

  methods: {
    getQuotation(page = 1) {
      this.isLoading = true;
      axios
        .get(base_url + `qoutation-list?page=${page}&keyword=${this.keyword}`)
        .then((response) => {
          this.quotations = response.data;
          this.isLoading = false;
        });
    },

    edit(quotation) {
      EventBus.$emit("edit-quotation", quotation);
    },

    sendQuotation(quote) {
      EventBus.$emit("send-quotation", quote);
    },

    deleteQuotation(id) {
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
          axios.delete(`${base_url}qoutation/${id}`).then((response) => {
            this.successMessage(response.data);
            this.getQuotation();
          });
        }
      });
    },
    pageClicked(page) {
      this.getQuotation(page);
    },
  },
};
</script>



