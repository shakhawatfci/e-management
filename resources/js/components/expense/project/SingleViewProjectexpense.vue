<template>
<!-- Modal -->
    <div id="ShowProjectExpense" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content">
                         <div class="layout-spacing">
                        <div class="widget widget-table-one">
                          <div class="widget-heading">
                                <h5 class="">View Project Expense</h5>
                            </div>
                            <div class="widget-content">
                          <div class="row">
                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">EH</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Project Expense Head</h4>
                                                <p class="meta-date">{{ project.project_expense_head.head_name }}</p>
                                            </div>

                                        </div>
                                       
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">PT</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Project Name</h4>
                                                <p class="meta-date">{{ project.project.project_name }}</p>
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
                                                <p class="meta-date">{{ project.date | dateToString  }}</p>
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
                                                <p class="meta-date">{{ project.month | monthToString }}</p>
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
                                                <p class="meta-date">{{ project.amount }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-6 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">DL</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Document Link</h4>
                                                <p class="meta-date"><a :href="project.document_link" target="_blank">{{ project.document_link }}</a></p>
                                               
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
                                                    <span class="avatar-title rounded-circle">EN</span>
                                                </div>
                                          </div>
                                          <div class="t-name">
                                              <h4>Expense Note</h4>
                                              <p class="meta-date">{{ project.note }}</p>
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
         project : {
            project_expense_head:{id:'',head_name:''},
            project:{id:'',project_name:''},
            month : '',
            date : '',
            amount : '',
            document_link : '',
            note : '',
            status : ''
          },
       }
   },

   mounted() {
      var _this = this;
      EventBus.$on('projectexpense-view', function(value){
        $('#ShowProjectExpense').modal('show')
          _this.project = value;
      })
   },
   
}
</script>