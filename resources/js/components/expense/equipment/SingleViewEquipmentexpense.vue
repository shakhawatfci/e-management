<template>
<!-- Modal -->
    <div id="ShowEquipmentExpense" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content">
                         <div class="layout-spacing">
                        <div class="widget widget-table-one">
                          <div class="widget-heading">
                                <h5 class="">View Equipment Expense</h5>
                            </div>
                            <div class="widget-content">
                          <div class="row">
                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">PR</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Project</h4>
                                                <p class="meta-date">{{ equipment.project.project_name }}</p>
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
                                                <p class="meta-date">{{ equipment.equipment_type.name }}</p>
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
                                                <p class="meta-date">{{ equipment.vendor.vendor_name }}</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">EN</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Equipement</h4>
                                                <p class="meta-date">{{ equipment.equipement.eq_name }}</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">EC</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Expense Category</h4>
                                                <p class="meta-date">{{ equipment.equipment_expense_head.head_name }}</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">PD</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Payment Date</h4>
                                                <p class="meta-date">{{ equipment.payment_date | dateToString }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">MN</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Month</h4>
                                                <p class="meta-date">{{ equipment.month | monthToString }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">AM</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Amount</h4>
                                                <p class="meta-date">{{ equipment.amount }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-12 transactions-list">
                                <div class="t-item">
                                    <div class="t-company-name">
                                        <div class="t-icon">
                                            <div class="avatar avatar-xl">
                                                <span class="avatar-title rounded-circle">DL</span>
                                            </div>
                                        </div>
                                        <div class="t-name">
                                            <h4>Document Link</h4>
                                            <p class="meta-date"><a :href="equipment.documents_link" target="_blank">{{ equipment.documents_link }}</a></p>
                                           
                                        </div>

                                    </div>
                                    
                                </div>
                            </div>
                              <div class="col-12 transactions-list">
                                  <div class="t-item">
                                      <div class="t-company-name">
                                          <div class="t-icon">
                                              <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">EN</span>
                                                </div>
                                          </div>
                                          <div class="t-name">
                                              <h4>Expense Note</h4>
                                              <p class="meta-date">{{ equipment.note }}</p>
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
         equipment : {
            project : {id:'',head_name:''},
            vendor : {id:'',vendor_name:''},
            equipment_type : {id:'',name:''},
            equipement : {id:'',eq_name:''},
            equipment_expense_head : {id:'',head_name:''},
            month : '',
            payment_date : '',
            amount : '',
            documents_link : '',
            note : ''
          },
       }
   },

   mounted() {
      var _this = this;
      EventBus.$on('equipmentexpense-view', function(value){
        $('#ShowEquipmentExpense').modal('show')
          _this.equipment = value;
      })
   },
   
}
</script>