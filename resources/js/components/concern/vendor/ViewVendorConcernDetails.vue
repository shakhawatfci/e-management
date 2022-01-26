<template>
<!-- Modal -->
    <div id="ViewVendorConcernDetails" class="modal animated fadeInLeft custo-fadeInLeft show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" v-if="vendor_concern">
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content">
                         <div class="layout-spacing">
                        <div class="widget widget-table-one">
                          <div class="widget-heading">
                                <h5 class="">Project Concern Details</h5>
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
                                                <h4>Concern Name</h4>
                                                <p class="meta-date">{{ vendor_concern.name }}</p>
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
                                                <p class="meta-date">{{ vendor_concern.email }}</p>
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
                                                <h4>Phone</h4>
                                                <p class="meta-date">{{ vendor_concern.phone }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-8 transactions-list">
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
                                                <h4>Concern Address</h4>
                                                <p class="meta-date">{{ vendor_concern.address }}</p>
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
                                                        <i class="fa fa-ravelry"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Company Name</h4>
                                                <p class="meta-date">{{ vendor_concern.company_name }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-8 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                        <i class="fa fa-map-marker"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Company Address</h4>
                                                <p class="meta-date">{{ vendor_concern.company_address }}</p>
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
                                                       <i class="fa fa-user" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Introducer Name</h4>
                                                <p class="meta-date">{{ vendor_concern.introduce_by }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>
                                

                                <div class="col-8 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                       <i class="fa fa-podcast" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Available Equipment</h4>
                                                <p class="meta-date">{{ vendor_concern.available_equipment }}</p>
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
                                                       <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Rating</h4>
                                                <p class="meta-date">{{ vendor_concern.rating }}</p>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-8 transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                       <i class="fa fa-comments-o" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Note</h4>
                                                <p class="meta-date">{{ vendor_concern.note }}</p>
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
                                                       <i class="fa fa-asterisk" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Status</h4>
                                                <p class="meta-date">{{ vendor_concern.status == 1 ? 'Active' : 'Inactive'}}</p>
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
                                                       <i class="fa fa-user-o" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Stored By</h4>
                                                <p class="meta-date">{{ vendor_concern.user.name }}</p>
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
            vendor_concern : null,
            url : base_url
       }
   },

   mounted() {
      var _this = this;
      EventBus.$on('view-details', function(value){
        $('#ViewVendorConcernDetails').modal('show')
          _this.vendor_concern = value;
      })
   },
   
}
</script>