<template>
<!-- Modal -->
    <div id="ShowOperator" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content">
                         <div class="layout-spacing">
                        <div class="widget widget-table-one">
                          <div class="widget-heading">
                                <h5 class="">View Operator</h5>
                            </div>
                            <div class="widget-content">
                        <div class="row">
                            <div class="col-2 offset-5 transactions-list">
                                
                                
                                <span class="avatar-title rounded-circle">
                                    <img :src="url+'images/operator/'+operator.file" class="img-fluid" height="120" width="120">
                                </span>
                            </div>
                        </div>
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
                                                <h4>Name</h4>
                                                <p class="meta-date">{{ operator.name }}</p>
                                            </div>

                                        </div>
                                       
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">VN</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Vendor</h4>
                                                <p class="meta-date">{{ operator.vendor.vendor_name }}</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">ET</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Equipment Type</h4>
                                                <p class="meta-date">{{ operator.equipment_type.name }} </p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">EQ</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Equipment</h4>
                                                <p class="meta-date">{{ operator.equipement.eq_name }} {{ operator.equipement.eq_model }} </p>
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
                                                <h4>Email</h4>
                                                <p class="meta-date">{{ operator.email }}</p>
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
                                                <h4>Mobile</h4>
                                                <p class="meta-date">{{ operator.mobile }}</p>
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
                                                <h4>B-kash</h4>
                                                <p class="meta-date">{{ operator.bkash_number }}</p>
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
                                                <h4>Join Date</h4>
                                                <p class="meta-date">{{ operator.join_date }}</p>
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
                                                <h4>NID</h4>
                                                <p class="meta-date">{{ operator.nid }}</p>
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
                                                <h4>Date of Birth</h4>
                                                <p class="meta-date">{{ operator.date_of_birth }}</p>
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
                                                <h4>Salary</h4>
                                                <p class="meta-date">{{ operator.salary }}</p>
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
                                                <p class="meta-date" v-if="operator.status == 1">Active</p>
                                                <p class="meta-date" v-else>Inactive</p>
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
                                            <p class="meta-date"><a :href="operator.documents_link" target="_blank">{{ operator.documents_link }}</a></p>
                                           
                                        </div>

                                    </div>
                                    
                                </div>
                            </div>
                              <div class="col-12 transactions-list">
                                  <div class="t-item">
                                      <div class="t-company-name">
                                          <div class="t-icon">
                                              <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">AD</span>
                                                </div>
                                          </div>
                                          <div class="t-name">
                                              <h4>Address</h4>
                                              <p class="meta-date">{{ operator.address }}</p>
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
         operator : {
              name : '',
              mobile : '',
              address : '',
              email : '',
              bkash_number : '',
              join_date : '',
              nid : '',
              date_of_birth : '',
              file : '',
              documents_link : '',
              salary : '',
              status : ''
            },
            url : base_url
       }
   },

   mounted() {
      var _this = this;
      EventBus.$on('operator-show', function(value){
        $('#ShowOperator').modal('show')
        console.log(value)
          _this.operator = value;
      })
   },
   
}
</script>