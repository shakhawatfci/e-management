<template>
<!-- Modal -->
    <div id="ShowSalary" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content">
                         <div class="layout-spacing">
                        <div class="widget widget-table-one">
                          <div class="widget-heading">
                                <h5 class="">View {{ salary.employee.name }}</h5>
                            </div>
                            <div class="widget-content">
                          <div class="row">
                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">EN</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Employee Name</h4>
                                                <p class="meta-date">{{ salary.employee.name }}</p>
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
                                                <p class="meta-date">{{ salary.month | monthToString }}</p>
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
                                                <p class="meta-date">{{ salary.date | dateToString }}</p>
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
                                                <h4>Salary Amount</h4>
                                                <p class="meta-date">{{ salary.salary_amount }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">BS</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Bonus</h4>
                                                <p class="meta-date">{{ salary.bonus }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">DC</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Deduction</h4>
                                                <p class="meta-date">{{ salary.deduction }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">BR</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Bonus Reason</h4>
                                                <p class="meta-date">{{ salary.bonus_reason }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">TS</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Total Salary</h4>
                                                <p class="meta-date">{{ salary.total_salary_amount }}</p>
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
                                                    <span class="avatar-title rounded-circle">NT</span>
                                                </div>
                                          </div>
                                          <div class="t-name">
                                              <h4>Salary Note</h4>
                                              <p class="meta-date">{{ salary.salary_note }}</p>
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
           employee : {id:'',name:''},
           month: '',
           date: '',
           salary_amount: 0,
           bonus: 0,
           deduction: 0,
           bonus_reason: '',
           deduction_reason: '',
           total_salary_amount : 0,  
           salary_note: ''      
         },
       }
   },

   mounted() {
      var _this = this;
      EventBus.$on('view-salary', function(salary){
        $('#ShowSalary').modal('show')
          _this.salary = salary;
      })
   },
   
}
</script>