<template>
<!-- Modal -->
    <div id="ShowOperatorFooding" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content">
                         <div class="layout-spacing">
                        <div class="widget widget-table-one">
                          <div class="widget-heading">
                                <h5 class="">View Operator Fooding</h5>
                            </div>
                            <div class="widget-content">
                          <div class="row">
                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">PT</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Project</h4>
                                                <p class="meta-date">{{ fooding.project.project_name }}</p>
                                            </div>

                                        </div>
                                       
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">VN</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Vendor</h4>
                                                <p class="meta-date">{{ fooding.vendor.vendor_name }}</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">ET</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Equipment Type</h4>
                                                <p class="meta-date">{{ fooding.equipment_type.name }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">EQ</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Equipment</h4>
                                                <p class="meta-date">{{ fooding.equipement.eq_name }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">DT</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Date</h4>
                                                <p class="meta-date">{{ fooding.date | dateToString }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">FA</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Fooding Amount</h4>
                                                <p class="meta-date">{{ fooding.fooding_amount }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">OP</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Operator</h4>
                                                <p class="meta-date">{{ fooding.operator.name }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">ST</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Status</h4>
                                                <p class="meta-date" v-if="fooding.status == 1">Active</p>
                                                <p class="meta-date" v-else>Inactive</p>
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
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Close</button>
                </div>
              </div>
        </div>
    </div>

</template>

<script>
import { EventBus  } from '../../../vue-assets';
import Mixin from '../../../mixin';
export default {
   mixins : [Mixin],
   data()
   {
        
       return {
        fooding : {
          project : {id : '', project_name : ''},
          vendor : {id : '', vendor_name : ''},
          equipment_type : {id : '', name : ''},
          equipement : {id : '', eq_name : ''},
          date : '',
          operator : {id : '', name : ''},
          fooding_amount : '',
          status : ''
        },
            url : base_url
       }
   },

   mounted() {
      var _this = this;
      EventBus.$on('operator-fooding-show', function(value){
        $('#ShowOperatorFooding').modal('show')
          _this.fooding = value;
      })
   },
   
}
</script>