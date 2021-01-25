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
        <div class="table-responsive" style="min-height: 320px">
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
                        href=""
                        @click.prevent="sendQuotation(value)"
                        >Send Email</a
                      >
                      <a
                        class="dropdown-item"
                        :href="url + 'quotation/' + value.id"
                        target="_blank"
                        >View Details</a
                      >
                      <a
                        class="dropdown-item"
                        :href="url + 'quotation/print/' + value.id"
                        >Download PDF</a
                      >
                      <a
                        class="dropdown-item"
                        href=""
                        @click.prevent="edit(value)"
                        >Edit or Regenerate</a
                      >
                      <a
                        class="dropdown-item"
                        href=""
                        @click.prevent="deleteQuotation(value.id)"
                        >Delete</a
                      >
                    </div>
                  </div>
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
        <edit-quotation></edit-quotation>
        <SendQuotation />
      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
import Pagination from "../pagination/Pagination";
import UpdateQuotation from "./EditQuotation";
import SendQuotation from "./SendQutation";
export default {
  mixins: [Mixin],
  components: {
    pagination: Pagination,
    SendQuotation,
    "edit-quotation": UpdateQuotation,
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
          axios.delete(`${base_url}quotation/${id}`).then((response) => {
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



