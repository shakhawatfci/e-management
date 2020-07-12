<template>
<!-- Modal -->
    <div id="ViewVendorDetails" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" v-if="vendor">
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content">
                         <div class="layout-spacing">
                        <div class="widget widget-table-one">
                          <div class="widget-heading">
                                <h5 class="">View vendor</h5>
                            </div>
                            <div class="widget-content">

                          <div class="row">
                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                        <i class="fa fa-user-secret" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Vendor Name</h4>
                                                <p class="meta-date">{{ vendor.vendor_name }}</p>
                                            </div>

                                        </div>
                                       
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                        <i class="fa fa-envelope-open" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Email</h4>
                                                <p class="meta-date">{{ vendor.vendor_email }}</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Vendor Phone</h4>
                                                <p class="meta-date">{{ vendor.vendor_phone }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Vendor Address</h4>
                                                <p class="meta-date">{{ vendor.vendor_address }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                        <i class="fa fa-users"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Concerned Person</h4>
                                                <p class="meta-date">{{ vendor.concerned_person }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Alternative phone Number</h4>
                                                <p class="meta-date">{{ vendor.phone_number_2 }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                       <i class="fa fa-money" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Bkash</h4>
                                                <p class="meta-date">{{ vendor.bkash_number }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>


                                <div class="col-4 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                       <i class="fa fa-university" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Bank Details</h4>
                                                <p class="meta-date">{{ vendor.bank_details }}</p>
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
import { EventBus  } from '../../vue-assets';
import Mixin from '../../mixin';
export default {
   mixins : [Mixin],
   data()
   {
        
       return {
            vendor : null,
            url : base_url
       }
   },

   mounted() {
      var _this = this;
      EventBus.$on('view-details', function(value){
        $('#ViewVendorDetails').modal('show')
          _this.vendor = value;
      })
   },
   
}
</script>