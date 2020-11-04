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
                        placeholder="Eg : XYZ Construction"
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
                        v-model="quotation.request_text"
                        id="c-name"
                        class="form-control"
                        placeholder="Eg : Request"
                      ></textarea>
                      <span
                        v-if="validation_error.hasOwnProperty('request_text')"
                        class="text-danger"
                      >
                        {{ validation_error.request_text[0] }}
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
                          <th>
                            <a
                              v-if="quotation.history.length > 1"
                              @click.prevent="removeEquipment(index)"
                              class="btn btn-danger mb-2 mr-2 rounded-circle"
                              >X</a
                            >
                            {{ index + 1 }}
                          </th>
                          <th class="w-40">Description</th>
                          <th>Rate</th>
                          <th>Unit</th>
                          <th>Qty</th>
                          <th>Total Amount</th>
                        </tr>
                        <tr>
                          <td>Equipment</td>
                          <td class="w-40">
                            <input
                              v-model="value.equipment_description"
                              type="text"
                              class="form-control"
                              placeholder="Ex : Dump Truck 10 Wheels"
                            />
                            <span
                              v-if="
                                validation_error.hasOwnProperty(
                                  'history.' + index + '.equipment_description'
                                )
                              "
                              class="text-danger"
                            >
                              {{
                                validation_error[
                                  "history." + index + ".equipment_description"
                                ][0]
                              }}
                            </span>
                          </td>
                          <td>
                            <input
                              v-model="value.equipment_rate"
                              type="text"
                              class="form-control"
                              placeholder="Ex : 1500"
                            />
                            <span
                              v-if="
                                validation_error.hasOwnProperty(
                                  'history.' + index + '.equipment_rate'
                                )
                              "
                              class="text-danger"
                            >
                              {{
                                validation_error[
                                  "history." + index + ".equipment_rate"
                                ][0]
                              }}
                            </span>
                          </td>
                          <td>
                            <input
                              v-model="value.equipment_unit"
                              type="text"
                              class="form-control"
                              placeholder="Ex : Equipment Unit"
                            />
                            <span
                              v-if="
                                validation_error.hasOwnProperty(
                                  'history.' + index + '.equipment_unit'
                                )
                              "
                              class="text-danger"
                            >
                              {{
                                validation_error[
                                  "history." + index + ".equipment_unit"
                                ][0]
                              }}
                            </span>
                          </td>
                          <td>
                            <input
                              v-model="value.equipment_qty"
                              type="number"
                              class="form-control"
                              placeholder="Ex : Qty"
                            />
                            <span
                              v-if="
                                validation_error.hasOwnProperty(
                                  'history.' + index + '.equipment_qty'
                                )
                              "
                              class="text-danger"
                            >
                              {{
                                validation_error[
                                  "history." + index + ".equipment_qty"
                                ][0]
                              }}
                            </span>
                          </td>
                          <td>
                            <input
                              type="hidden"
                              :value="
                                (value.total_equipment_amount =
                                  value.equipment_qty * value.equipment_rate)
                              "
                            />
                            {{ value.total_equipment_amount }}/-
                          </td>
                        </tr>
                        <tr>
                          <td>Operator</td>
                          <td class="w-40">
                            <input
                              v-model="value.operator_description"
                              type="text"
                              class="form-control"
                              placeholder="Ex : Operator Food"
                            />
                            <span
                              v-if="
                                validation_error.hasOwnProperty(
                                  'history.' + index + '.operator_description'
                                )
                              "
                              class="text-danger"
                            >
                              {{
                                validation_error[
                                  "history." + index + ".operator_description"
                                ][0]
                              }}
                            </span>
                          </td>
                          <td>
                            <input
                              v-model="value.operator_rate"
                              type="text"
                              class="form-control"
                              placeholder="Ex : 1500"
                            />
                            <span
                              v-if="
                                validation_error.hasOwnProperty(
                                  'history.' + index + '.operator_rate'
                                )
                              "
                              class="text-danger"
                            >
                              {{
                                validation_error[
                                  "history." + index + ".operator_rate"
                                ][0]
                              }}
                            </span>
                          </td>
                          <td>
                            <input
                              v-model="value.operator_unit"
                              type="text"
                              class="form-control"
                              placeholder="Ex : operator Unit"
                            />
                            <span
                              v-if="
                                validation_error.hasOwnProperty(
                                  'history.' + index + '.operator_unit'
                                )
                              "
                              class="text-danger"
                            >
                              {{
                                validation_error[
                                  "history." + index + ".operator_unit"
                                ][0]
                              }}
                            </span>
                          </td>
                          <td>
                            <input
                              v-model="value.operator_qty"
                              type="number"
                              class="form-control"
                              placeholder="Ex : Qty"
                            />
                            <span
                              v-if="
                                validation_error.hasOwnProperty(
                                  'history.' + index + '.operator_qty'
                                )
                              "
                              class="text-danger"
                            >
                              {{
                                validation_error[
                                  "history." + index + ".operator_qty"
                                ][0]
                              }}
                            </span>
                          </td>
                          <td>
                            <input
                              type="hidden"
                              :value="
                                (value.total_operator_amount =
                                  value.operator_qty * value.operator_rate)
                              "
                            />
                            {{ value.total_operator_amount }}/-
                          </td>
                        </tr>
                        <tr>
                          <td>Mobilization</td>
                          <td class="w-40">
                            <input
                              v-model="value.mobilization_description"
                              type="text"
                              class="form-control"
                              placeholder="Ex : Field Name"
                            />
                            <span
                              v-if="
                                validation_error.hasOwnProperty(
                                  'history.' +
                                    index +
                                    '.mobilization_description'
                                )
                              "
                              class="text-danger"
                            >
                              {{
                                validation_error[
                                  "history." +
                                    index +
                                    ".mobilization_description"
                                ][0]
                              }}
                            </span>
                          </td>
                          <td colspan="4">
                            <input
                              v-model="value.mobilization_amount"
                              type="text"
                              class="form-control text-center"
                              placeholder="Ex : 15000"
                            />
                            <span
                              v-if="
                                validation_error.hasOwnProperty(
                                  'history.' + index + '.mobilization_amount'
                                )
                              "
                              class="text-danger"
                            >
                              {{
                                validation_error[
                                  "history." + index + ".mobilization_amount"
                                ][0]
                              }}
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td>Demobilization</td>
                          <td class="w-40">
                            <input
                              v-model="value.demobilization_description"
                              type="text"
                              class="form-control"
                              placeholder="Ex : Field Name"
                            />
                            <span
                              v-if="
                                validation_error.hasOwnProperty(
                                  'history.' +
                                    index +
                                    '.demobilization_description'
                                )
                              "
                              class="text-danger"
                            >
                              {{
                                validation_error[
                                  "history." +
                                    index +
                                    ".demobilization_description"
                                ][0]
                              }}
                            </span>
                          </td>
                          <td colspan="4">
                            <input
                              v-model="value.demobilization_amount"
                              type="text"
                              class="form-control text-center"
                              placeholder="Ex : 15000"
                            />
                            <span
                              v-if="
                                validation_error.hasOwnProperty(
                                  'history.' + index + '.demobilization_amount'
                                )
                              "
                              class="text-danger"
                            >
                              {{
                                validation_error[
                                  "history." + index + ".demobilization_amount"
                                ][0]
                              }}
                            </span>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <a
                      @click.prevent="addMore()"
                      class="btn btn-success flot-left"
                      href=""
                      >Add One More Equipment</a
                    >
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 text-left">
                    <span>Terms & Condition</span>
                    <vue-editor v-model="quotation.terms" />
                    <span
                      v-if="validation_error.hasOwnProperty('terms')"
                      class="text-danger"
                    >
                      {{ validation_error.terms[0] }}
                    </span>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="contact-name text-left">
                      <i class="flaticon-user-11"></i>
                      <span>From Name</span>
                      <input
                        type="text"
                        v-model="quotation.name"
                        id="c-name"
                        class="form-control"
                        placeholder="Eg : Tushar"
                      />
                      <span
                        v-if="validation_error.hasOwnProperty('name')"
                        class="text-danger"
                      >
                        {{ validation_error.name[0] }}
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="contact-name text-left">
                      <i class="flaticon-user-11"></i>
                      <span>From Designation</span>
                      <input
                        type="text"
                        v-model="quotation.designation"
                        id="c-name"
                        class="form-control"
                        placeholder="Eg : CEO"
                      />
                      <span
                        v-if="validation_error.hasOwnProperty('designation')"
                        class="text-danger"
                      >
                        {{ validation_error.designation[0] }}
                      </span>
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
import { VueEditor } from "vue2-editor";
export default {
  mixins: [Mixin],
  props: ["vendors"],
  components: { VueEditor },
  data() {
    return {
      quotation: {
        to: "",
        company: "",
        address: "",
        subject: "Qoutation for ",
        request_text:
          "Sir, <br> Please find the quotation herewith and seek your valuable approval to send the equipment(s):",
        terms:
          "<p><br></p><ol><li>&nbsp;&nbsp;&nbsp;One (1) Excavator-0.9m3, monthly rent (For 240 hour monthly and 08 hours Daily) Tk 2,85, 000.00 (Two Lac &amp; Eighty Five Thousand Taka Only).</li><li>&nbsp;&nbsp;&nbsp;Equipment working time: 8 AM-5 PM (Including 01 hour lunch break).</li><li>&nbsp;&nbsp;&nbsp;After 5 PM, any working will be counted as over time and over time working hour(s) rate will be counted as per regular hourly rate. </li><li>&nbsp;&nbsp;Operator and helper fooding Tk1,500.00 (For daily 8 hours).</li><li>&nbsp;&nbsp;&nbsp;If operator and helper work more than 08 hours or work after 5 PM, overtime will be counted as per ratio. </li><li>&nbsp;&nbsp;&nbsp;Operator’s accommodation will be provided by 2nd party.</li><li>&nbsp;&nbsp;&nbsp;Agreement period is for Six month.</li><li>&nbsp;&nbsp;&nbsp;2nd party will pay Mobilization payment.</li><li>&nbsp;&nbsp;If equipment works less than 720 hours, 2nd party will pay demobilization also.</li><li>&nbsp;&nbsp;&nbsp;Due to any kind of machinery’s problem, if the job stopped, 2nd party doesn’t pay any payment for those days or moments.</li><li>&nbsp;&nbsp;&nbsp;2nd party will bear all machinery’s security.</li><li>&nbsp;&nbsp;&nbsp;2nd party has to arrange Fuel, Equipment safety and working environment.</li><li>&nbsp;&nbsp;&nbsp;If 2nd party does any illegal job, 1st party will not be responsible for that type of job.</li><li>&nbsp;&nbsp;&nbsp;1st Party holds the right to bring the equipment back anytime if 2nd party doesn’t comply with the agreement properly.</li><li>&nbsp;&nbsp;&nbsp;After getting invoice, 2nd party will pay monthly bill within 10 days.</li><li>&nbsp;&nbsp;&nbsp;This rate is excluding VAT and AIT.</li></ol>",
        name: "Md Rafiqul Islam",
        designation: "Proprietor",
        history: [
          {
            equipment_description: "",
            equipment_rate: 0,
            equipment_unit: "Month",
            equipment_qty: 1,
            total_equipment_amount: 0,
            operator_description: "Operator Food Allowance (Daily 8 Hours)",
            operator_rate: 0,
            operator_unit: "Day",
            operator_qty: 30,
            total_operator_amount: 0,
            mobilization_description: "Mobilization",
            demobilization_description: "Demobilization",
            mobilization_amount: "As per actual",
            demobilization_amount: "As per actual",
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
        .post(base_url + "quotation", this.quotation)
        .then((response) => {
          if (response.data.status === "success") {
            $("#CreateQoutation").modal("hide");
            this.successMessage(response.data);
            EventBus.$emit("qoutation-created");
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

    addMore() {
      this.quotation.history.push({
        equipment_description: "",
        equipment_rate: 0,
        equipment_unit: "Month",
        equipment_qty: 1,
        total_equipment_amount: 0,
        operator_description: "Operator Food Allowance (Daily 8 Hours)",
        operator_rate: 0,
        operator_unit: "Day",
        operator_qty: 30,
        total_operator_amount: 0,
        mobilization_description: "Mobilization",
        demobilization_description: "Demobilization",
        mobilization_amount: "As per actual",
        demobilization_amount: "As per actual",
      });
    },

    removeEquipment(index) {
      Swal.fire(
        {
          title: "Are you sure ?",
          text: "You won't be able to revert this!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        },
        () => {}
      ).then((result) => {
        if (result.value) {
          this.quotation.history.splice(index, 1);
        }
      });
    },

    resetForm() {
      this.quotation = {
        to: "",
        company: "",
        address: "",
        subject: "Qoutation for ",
        request_text:
          "Sir, <br> Please find the quotation herewith and seek your valuable approval to send the equipment(s):",
        terms:
          "<p><br></p><ol><li>&nbsp;&nbsp;&nbsp;One (1) Excavator-0.9m3, monthly rent (For 240 hour monthly and 08 hours Daily) Tk 2,85, 000.00 (Two Lac &amp; Eighty Five Thousand Taka Only).</li><li>&nbsp;&nbsp;&nbsp;Equipment working time: 8 AM-5 PM (Including 01 hour lunch break).</li><li>&nbsp;&nbsp;&nbsp;After 5 PM, any working will be counted as over time and over time working hour(s) rate will be counted as per regular hourly rate. </li><li>&nbsp;&nbsp;Operator and helper fooding Tk1,500.00 (For daily 8 hours).</li><li>&nbsp;&nbsp;&nbsp;If operator and helper work more than 08 hours or work after 5 PM, overtime will be counted as per ratio. </li><li>&nbsp;&nbsp;&nbsp;Operator’s accommodation will be provided by 2nd party.</li><li>&nbsp;&nbsp;&nbsp;Agreement period is for Six month.</li><li>&nbsp;&nbsp;&nbsp;2nd party will pay Mobilization payment.</li><li>&nbsp;&nbsp;If equipment works less than 720 hours, 2nd party will pay demobilization also.</li><li>&nbsp;&nbsp;&nbsp;Due to any kind of machinery’s problem, if the job stopped, 2nd party doesn’t pay any payment for those days or moments.</li><li>&nbsp;&nbsp;&nbsp;2nd party will bear all machinery’s security.</li><li>&nbsp;&nbsp;&nbsp;2nd party has to arrange Fuel, Equipment safety and working environment.</li><li>&nbsp;&nbsp;&nbsp;If 2nd party does any illegal job, 1st party will not be responsible for that type of job.</li><li>&nbsp;&nbsp;&nbsp;1st Party holds the right to bring the equipment back anytime if 2nd party doesn’t comply with the agreement properly.</li><li>&nbsp;&nbsp;&nbsp;After getting invoice, 2nd party will pay monthly bill within 10 days.</li><li>&nbsp;&nbsp;&nbsp;This rate is excluding VAT and AIT.</li></ol>",
        name: "Md Rafiqul Islam",
        designation: "Proprietor",
        history: [
          {
            equipment_description: "",
            equipment_rate: 0,
            equipment_unit: "Month",
            equipment_qty: 1,
            total_equipment_amount: 0,
            operator_description: "Operator Food Allowance (Daily 8 Hours)",
            operator_rate: 0,
            operator_unit: "Day",
            operator_qty: 30,
            total_operator_amount: 0,
            total_operator_amount: 0,
            mobilization_description: "Mobilization",
            demobilization_description: "Demobilization",
            mobilization_amount: "As per actual",
            demobilization_amount: "As per actual",
          },
        ],
      };
      this.validation_error = {};
    },
  },
};
</script>

<style scoped>
.w-40 {
  width: 40%;
}
</style>