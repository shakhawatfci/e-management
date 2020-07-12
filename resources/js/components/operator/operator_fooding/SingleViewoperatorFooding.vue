<template>
<!-- Modal -->
    <div id="ShowOperatorSalary" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content">
                         <div class="layout-spacing">
                        <div class="widget widget-table-one">
                          <div class="widget-heading">
                                <h5 class="">View Operator Salary</h5>
                            </div>
                            <div class="widget-content">
                          <div class="row">
                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">NM</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Operator</h4>
                                                <p class="meta-date">{{ salary.operator.name }}</p>
                                            </div>

                                        </div>
                                       
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">EM</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Month</h4>
                                                <p class="meta-date">{{ salary.month }}</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">PH</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Payment Date</h4>
                                                <p class="meta-date">{{ salary.payment_date }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">BK</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Payment Amount</h4>
                                                <p class="meta-date">{{ salary.payment_amount }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">JD</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Mode</h4>
                                                <p class="meta-date">{{ salary.mode }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">NID</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Bank Note</h4>
                                                <p class="meta-date">{{ salary.bank_note }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">DB</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Bkash Note</h4>
                                                <p class="meta-date">{{ salary.bkash_note }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">SA</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Salary Type</h4>
                                                <p class="meta-date">{{ salary.salary_type }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">ST</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Status</h4>
                                                <p class="meta-date" v-if="salary.status == 1">Active</p>
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
            salary : {
              operator : {id:'',name:''},
              month : '',
              payment_date : '',
              payment_amount : '',
              mode : '',
              bank_note : '',
              bkash_note : '',
              salary_type : '',
              status : ''
            },
            url : base_url
       }
   },

   mounted() {
      var _this = this;
      EventBus.$on('operator-salary-show', function(value){
        $('#ShowOperatorSalary').modal('show')
          _this.salary = value;
      })
   },
   
}
</script>