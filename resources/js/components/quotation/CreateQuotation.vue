<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="CreateQoutation"
    tabindex="-1"
    role="dialog"
    aria-labelledby="addContactModalTitle"
    aria-hidden="true"
  >
    <div
      class="modal-dialog modal-custom custom_modal custom-modal"
      role="document"
    >
      <form @submit.prevent="save()">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Create Quotation</h4>
          </div>
          <div class="modal-body">
            <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
            <div class="add-contact-box">
              <div class="add-contact-content">
                <div class="row">
                  <div class="col-md-4">
                    <div class="contact-name text-left">
                      <i class="flaticon-user-11"></i>
                      <span>To Designation</span>
                      <input
                        type="text"
                        v-model="quotation.to"
                        id="c-name"
                        class="form-control"
                        placeholder="Eg : CEO"
                      />
                      <span
                        v-if="validation_error.hasOwnProperty('to')"
                        class="text-danger"
                      >
                        {{ validation_error.to[0] }}
                      </span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="contact-name text-left">
                      <i class="flaticon-user-11"></i>
                      <span>To Company</span>
                      <input
                        type="text"
                        v-model="quotation.company"
                        id="c-name"
                        class="form-control"
                        placeholder="Eg : Limmex Construction"
                      />
                      <span
                        v-if="validation_error.hasOwnProperty('company')"
                        class="text-danger"
                      >
                        {{ validation_error.company[0] }}
                      </span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="contact-name text-left">
                      <i class="flaticon-user-11"></i>
                      <span>To Comapny Address</span>
                      <input
                        type="text"
                        v-model="quotation.address"
                        id="c-name"
                        class="form-control"
                        placeholder="Eg : Mirpur 1 , Dhaka"
                      />
                      <span
                        v-if="validation_error.hasOwnProperty('company')"
                        class="text-danger"
                      >
                        {{ validation_error.company[0] }}
                      </span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="contact-name text-left">
                      <i class="flaticon-user-11"></i>
                      <span>Subject</span>
                      <input
                        type="text"
                        v-model="quotation.subject"
                        id="c-name"
                        class="form-control"
                        placeholder="Eg : Subject"
                      />
                      <span
                        v-if="validation_error.hasOwnProperty('subject')"
                        class="text-danger"
                      >
                        {{ validation_error.subject[0] }}
                      </span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="contact-name text-left">
                      <i class="flaticon-user-11"></i>
                      <span>Requested Text</span>
                      <textarea
                        type="text"
                        v-model="quotation.request"
                        id="c-name"
                        class="form-control"
                        placeholder="Eg : Request"
                      ></textarea>
                      <span
                        v-if="validation_error.hasOwnProperty('request')"
                        class="text-danger"
                      >
                        {{ validation_error.request[0] }}
                      </span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div
                      class="table-responsive mt-4 mb-4"
                      v-for="(value, index) in quotation.history"
                      :key="index"
                    >
                      <table
                        class="table table-hover table-striped text-center text-white"
                      >
                        <tr>
                          <th>{{ index + 1 }}</th>
                          <th>Description</th>
                          <th>Rate</th>
                          <th>Unit</th>
                          <th>Qty</th>
                          <th>Total Amount</th>
                          <th>Action</th>
                        </tr>
                        <tr>
                          <td>Equipment</td>
                          <td>
                            <input
                              v-model="value.equipment_description"
                              type="text"
                              class="form-control"
                              placeholder="Ex : Dump Truck 10 Wheels"
                            />
                          </td>
                          <td>
                            <input
                              v-model="value.equipment_rate"
                              type="text"
                              class="form-control"
                              placeholder="Ex : Rate"
                            />
                          </td>
                          <td>
                            <input
                              v-model="value.equipment_rate"
                              type="text"
                              class="form-control"
                              placeholder="Ex : Dump Truck"
                            />
                          </td>
                          <td></td>
                          <td></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
              <div
                class="spinner-grow text-white mr-2 align-self-center loader-sm"
                v-if="button_name != 'Save'"
              >
                .
              </div>
              {{ button_name }}
            </button>

            <button class="btn btn-default" data-dismiss="modal">
              <i class="flaticon-delete-1"></i> Discard
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
export default {
  mixins: [Mixin],
  props: ["vendors"],
  data() {
    return {
      quotation: {
        to: "",
        company: "",
        address: "",
        subject: "Qoutation for ",
        request:
          "Sir, <br> Please find the quotation herewith and seek your valuable approval to send the equipment(s):",
        terms: "",
        name: "",
        designation: "",
        history: [
          {
            equipment_description: "",
            equipment_rate: 0,
            equipment_unit: "Month",
            equipment_qty: 1,
            total_equipment_amount: 0,
            operator_description: "",
            operator_rate: 0,
            operator_unit: "Day",
            operator_qty: 30,
            total_operator_amount: 0,
            total_operator_amount: 0,
            mobilization_description: "Mobilization",
            demobilization_description: "Demobilization",
            mobilization_amount: "",
            demobilization_amount: "",
          },
        ],
      },
      validation_error: {},
      button_name: "Save",
    };
  },

  mounted() {},

  methods: {
    save() {
      this.button_name = "Saving...";
      axios
        .post(base_url + "equipment-type", this.equipment)
        .then((response) => {
          if (response.data.status === "success") {
            $("#CreateQoutation").modal("hide");
            this.successMessage(response.data);
            EventBus.$emit("equipment-type-created");
            this.button_name = "Save";
            this.resetForm();
          } else {
            this.successMessage(response.data);
            this.button_name = "Save";
          }
        })
        .catch((err) => {
          if (err.response.status == 422) {
            this.validation_error = err.response.data.errors;
            this.validationError();
            this.button_name = "Save";
          } else {
            this.successMessage(err);
            this.button_name = "Save";
          }
        });
    },

    resetForm() {
      this.equipment = {
        name: "",
        note: "",
        status: "",
      };
      this.validation_error = {};
    },
  },
};
</script>