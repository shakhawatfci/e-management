<template>
            <!-- Modal -->
    <div class="modal animated rotateInDownLeft custo-rotateInDownLeft" id="viewAssign" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" >
            <div class="modal-content" v-if="equipment">
                <div class="modal-header">
                    <h4 class="modal-title">Details About Assigned Equipment {{ equipment.equipement.eq_name }}</h4>
                </div>
                <div class="modal-body" >
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">
                          <div class="row">
                              <div class="col-md-12">
                                  <div id="ct" class="note-container note-grid">

                                    <div class="note-item all-notes note-personal">
                                        <div class="note-inner-content">
                                            <div class="note-content">
                                                <p class="note-title"
                                                 data-notetitle="Project"><i class="fa fa-compass"></i> Project</p>
                                                 <hr>
                                                <div class="note-description-content">
                                                    <p class="note-description"
                                                     data-notedescription="project">
                                                     <strong>Project Name:</strong> {{ equipment.project.project_name }}.</p>
                                                    <p class="note-description"
                                                     data-notedescription="project">
                                                     Project location: {{ equipment.project.project_location }}.</p>
                                                    <p class="note-description"
                                                     data-notedescription="Agreement">
                                                     Project Agreement With: {{ equipment.project.project_argument_with }}.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="note-item all-notes note-social">
                                        <div class="note-inner-content">
                                            <div class="note-content">
                                                <p class="note-title"
                                                 data-notetitle="Project"><i class="fa fa-truck"></i> Equipment </p>
                                                 <hr>
                                                <div class="note-description-content">
                                                    <p class="note-description"
                                                     data-notedescription="Vendor">
                                                     <strong>Vendor Name:</strong> {{ equipment.vendor.vendor_name }}.</p>
                                                    <p class="note-description"
                                                     data-notedescription="Equipment">
                                                     Equipment Type: {{ equipment.equipment_type.name }}.</p>
                                                    <p class="note-description"
                                                     data-notedescription="Equipment">
                                                     Equipment: {{ equipment.equipement.eq_name }}.</p>
                                                    <p class="note-description"
                                                     data-notedescription="Equipment">
                                                     Equipment Model: {{ equipment.equipement.eq_model }}.</p>
                                                    <p class="note-description"
                                                     data-notedescription="Operator">
                                                     Operator: {{ equipment.operator.name }}.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="note-item all-notes note-important">
                                        <div class="note-inner-content">
                                            <div class="note-content">
                                                <p class="note-title"
                                                 data-notetitle="Project"><i class="fa fa-dollar"></i> Hour and Pricing </p>
                                                 <hr>
                                                <div class="note-description-content">
                                                    <p class="note-description"
                                                     data-notedescription="Vendor">
                                                     <strong>Total Contact Hour:</strong> {{ equipment.total_hour }}.</p>
                                                    <p class="note-description"
                                                     data-notedescription="Project Amount">
                                                     Project Amount: {{ equipment.total_project_amount }} (Hourly {{ equipment.project_rate_per_hour }}).</p>
                                                    <p class="note-description"
                                                     data-notedescription="Vendor Amount">
                                                     Vendor Amount: {{ equipment.total_vendor_amount }} (Hourly {{ equipment.vendor_rate_per_hour }}).</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="note-item all-notes note-work">
                                        <div class="note-inner-content">
                                            <div class="note-content">
                                                <p class="note-title"
                                                 data-notetitle="Project"><i class="fa fa-clock"></i> Date and Status </p>
                                                 <hr>
                                                <div class="note-description-content">
                                                    <p class="note-description"
                                                     data-notedescription="Vendor">
                                                     <strong>Assigned Date:</strong> {{ equipment.assign_date | dateToString }} Entry By 
                                                     {{ equipment.user.name }}.</p>
                                                    <p class="note-description" v-if="equipment.release_status == 1">
                                                       Status : currently Active at project
                                                     </p>
                                                    <p class="note-description" v-else>
                                                       Released at  {{ equipment.release_date | dateToString }} <br>
                                                       Reason : {{ equipment.release_note }}
                                                     </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="note-item all-notes">
                                        <div class="note-inner-content">
                                            <div class="note-content">
                                                <p class="note-title"
                                                 data-notetitle="Project"><i class="fa fa-file-alt"></i> Document Links </p>
                                                 <hr>
                                                <div class="note-description-content">
                                                    <p class="note-description"
                                                     data-notedescription="Vendor">
                                                     {{ equipment.documents_link }}
                                                     </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button class="btn btn-default" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { EventBus } from '../../../vue-assets'
import Mixin from '../../../mixin'
export default {
    mixins : [Mixin],
    data()
    {
        return {
            equipment : null,
        }
    },

    mounted() {
        var _this = this;
        EventBus.$on('assign-details',function(id) {

            _this.getAssignEquipment(id);
            $('#viewAssign').modal('show');
        })
    },

    methods : {

        getAssignEquipment(id) {
            axios.get(base_url+'assign-equipment/'+id)
            .then(response => {
                this.equipment = response.data;
            })
        }
    }

}
</script>