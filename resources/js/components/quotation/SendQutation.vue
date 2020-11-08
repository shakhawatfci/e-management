<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="SendQuotation"
    tabindex="-1"
    role="dialog"
    aria-labelledby="addContactModalTitle"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-xl" role="document" v-if="quotation">
      <form @submit.prevent="save()">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">
              Send Quotation To {{ quotation.to }} ({{ quotation.company }})
            </h4>
          </div>
          <div class="modal-body">
            <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
            <div class="add-contact-box">
              <div class="add-contact-content">
                <div class="row">
                  <div class="col-md-12">
                    <div class="contact-name text-left">
                      <i class="flaticon-user-11"></i>
                      <span>To Email *</span>
                      <input
                        type="email"
                        v-model="form_data.to"
                        id="c-to"
                        class="form-control"
                        placeholder="to: eg, limmexbd@gmail.com ..."
                      />
                      <span
                        v-if="validation_error.hasOwnProperty('to')"
                        class="text-danger"
                      >
                        {{ validation_error.to[0] }}
                      </span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="contact-name text-left">
                      <i class="flaticon-user-11"></i>
                      <span>CC (Separate Each Email with comma ,)</span>
                      <input
                        type="text"
                        v-model="form_data.cc"
                        id="c-to"
                        class="form-control"
                        placeholder="to: eg, limmexbd@gmail.com,business@limmexbd.com"
                      />
                      <span
                        v-if="validation_error.hasOwnProperty('cc')"
                        class="text-danger"
                      >
                        {{ validation_error.cc[0] }}
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
                        v-model="form_data.subject"
                        id="c-to"
                        class="form-control"
                        placeholder="Write Your Subject"
                      />
                      <span
                        v-if="validation_error.hasOwnProperty('subject')"
                        class="text-danger"
                      >
                        {{ validation_error.subject[0] }}
                      </span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="contact-name text-left">
                      <i class="flaticon-user-11"></i>
                      <span>Message Or Email Body</span>
                      <vue-editor v-model="form_data.email_body" />
                      <span
                        v-if="validation_error.hasOwnProperty('email_body')"
                        class="text-danger"
                      >
                        {{ validation_error.email_body[0] }}
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
                v-if="button_name != 'Send'"
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
  components: { VueEditor },
  data() {
    return {
      quotation: {},
      form_data: {
        id: "",
        subject: "",
        to: "",
        cc: "",
        email_body: "",
        status: "",
      },
      validation_error: {},
      button_name: "Send",
    };
  },

  mounted() {
    var _this = this;
    EventBus.$on("send-quotation", function (value) {
      _this.form_data.id = value.id;
      _this.form_data.subject = value.subject;
      _this.form_data.id = value.id;
      _this.quotation = value;
      $("#SendQuotation").modal("show");
    });
  },

  methods: {
    save() {
      this.button_name = "Sending...";
      axios
        .post(base_url + "quotation/send/" + this.form_data.id, this.form_data)
        .then((response) => {
          if (response.data.status === "success") {
            $("#SendQuotation").modal("hide");
            this.successMessage(response.data);
            EventBus.$emit("quotation-crated");
            this.button_name = "Send";
            this.resetForm();
          } else {
            this.successMessage(response.data);
            this.button_name = "Send";
          }
        })
        .catch((err) => {
          if (err.response.status == 422) {
            this.validation_error = err.response.data.errors;
            this.validationError();
            this.button_name = "Send";
          } else {
            this.successMessage(err);
            this.button_name = "Send";
          }
        });
    },

    resetForm() {
      this.form_data = {
        id: "",
        subject: "",
        to: "",
        cc: "",
        message: "",
        status: "",
      };
      this.validation_error = {};
    },
  },
};
</script>