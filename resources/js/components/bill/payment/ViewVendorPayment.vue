<template>
        <!-- Modal -->
    <div class="modal animated rotateInDownLeft custo-rotateInDownLeft" id="ViewVendorPayment" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl custom-modal" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-if="bill">Vendor Payment History  For {{ bill.vendor.vendor_name }} 
                        for {{ bill.equipement.eq_name }} in
                          {{ bill.project.project_name  }}
                           Bill No {{ bill.bill_no }}</h4>
                </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">

                                <div class="row">
                                  
                                  <div class="col-md-12" v-if="!isLoading">
                                      <div class="table-responsive" v-if="payments.length > 0">
                                         <table class="table table-bordered table-hover mb-4 text-white">
                                             <tr>
                                              <th>Date</th>
                                              <th>Entry By</th>
                                              <th>Amount</th>
                                              <th>Note</th>
                                              <th>Action</th>
                                             </tr>

                                             <tr v-for="(value,index) in payments" :key="value.id">
                                              <th>{{ value.date | dateToString }}</th>
                                              <th>{{ value.user.name }}</th>
                                              <th>{{ value.amount }}</th>
                                              <th>{{ value.note }}</th>
                                              <th>
                                                  <a href=""
                                                   @click.prevent="deletePayment(value.id,index)"
                                                   class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                              </th>
                                             </tr>

                                              <tr>
                                                <td colspan="2" class="text-right">Total Paid Amount</td>
                                                <td>{{ totalPayment }}</td>
                                                <td></td>
                                                <td></td>
                                              </tr>
                                         </table>
                                      </div>
                                      <div class="text-center" v-else>
                                        <h3>No Payment Yet</h3>
                                      </div>
                                  </div>

                                <div class="col-dm-12 text-center" v-else>
                                   <h3>Loading....</h3>
                                </div>
                                
                                    
                                </div>



                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">
                         <i class="flaticon-delete-1"></i> close</button>
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
         bill : null,  
         payments : [],
         isLoading : true
       }
   },

   mounted() {
        var _this = this;
        EventBus.$on('view-vendor-payment',function(bill) {
                _this.bill = bill;
                _this.getProjectPayment(bill.id);
           $('#ViewVendorPayment').modal('show');
        });
   },

 methods : {

 getProjectPayment(id)
 {
   this.isLoading = true;
     axios.get(base_url+'vendor-payment/'+id)
          .then(response => {
            this.payments = response.data;
            this.isLoading = false;
          });

 },

deletePayment(id,index) {
      Swal.fire(
        {
          title: "Are you sure ?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        },
        () => {}
      ).then(result => {
        if (result.value) {
          axios.delete(`${base_url}project-payment/${id}`)
              .then(response => {
            this.successMessage(response.data);
            if(response.data.status === 'success')
            {
             this.payments.splice(index,1);
             EventBus.$emit('bill-changed');
            }
          });
        }
      });
    },

 },

 computed : {

   totalPayment() {
     let total = 0;
     this.payments.forEach((payment) => {
       total += Number(payment.amount);
     });
     return total;
   }

 }
 
  
}

</script>

<style  scoped>
.custom-modal {
 min-width: 95% !important;
}
</style>