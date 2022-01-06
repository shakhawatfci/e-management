<template>
<!-- Modal -->
    <div id="ShowEquipmentExpense" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content">
                         <div class="layout-spacing">
                        <div class="widget widget-table-one">
                          <div class="widget-heading">
                              <!-- <h5 class="">View Equipment Expense Invoice : {{ equipment.invoice_no }}</h5> -->
                          </div>
                        <div class="widget-content">
                          <div class="row">
                            <div class="col-md-12 mb-4 mx-2 d-flex justify-content-between">
                                <div>
                                    <h6>Invoice : {{ equipment.invoice_no }}</h6>
                                    <p>Month : {{ equipment.month }}</p>
                                    <p>Equipment : {{ equipment.equipement.eq_name }}</p>
                                    <p>Payment Date : {{ equipment.payment_date | dateToString }}</p>
                                    <p>Paid By : {{ equipment.payment_method }}</p>
                                </div>
        
                                <div>
                                    <h6>Project</h6>
                                    <p>Project : {{ equipment.project.project_name }}</p>
                                    <p>Vendor : {{ equipment.vendor.vendor_name }}</p>
                                    <p>Operator : {{ equipment.operator.name }}</p>
                                    <p class="text-wrap">Note : {{ equipment.note }}</p>
                                </div>
                            </div>
                            <div class="col-md-12" v-if="!isLoading">
                                <div class="table-responsive">
                                <table class="table table-hover mb-4">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Expense Category</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody v-if="expense_category.length > 0">
                                    <tr v-for="(category,index) in expense_category" :key="index">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ category.equipment_expense_head.head_name }}</td>
                                        <td>{{ category.amount }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-right">TOTAL</td>
                                        <td><strong>{{ equipment.total_amount }}</strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                                <div class="ml-1" v-if="expense_category.length > 0">
                                    <!-- <a :href="url+'invoice-list-print-pdf?action=pdf&id='+equipment.id" class="btn btn-primary btn-sm"><i class="fa fa-file-pdf-o"></i> PDF</a> -->
                                    <a :href="url+'invoice-list-print-pdf?action=print&id='+equipment.id" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-file-pdf-o"></i> Print</a>    
                                </div>
                            </div>
                            <div class="col-md-12 text-center" style="margin-top: 30px" v-else>
                                <!-- <img :src="url+'images/logo/loading.gif'" class="img-fluid"> -->
                                <div class="loader multi-loader mx-auto loader-xl"></div>
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
            project : {id:'',project_name:''},
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
          expense_category : {},
          url: base_url,
          isLoading: false,
       }
   },

   mounted() {
      var _this = this;
      EventBus.$on('equipmentexpense-invoice', function(value){
          _this.equipment = value;
         _this.getSingleInvoiceExpense(value.id)
        $('#ShowEquipmentExpense').modal('show')
      })
   },

   methods: {
        getSingleInvoiceExpense(id)
        {
            axios.get(`${base_url}get-single-invoice-expense/${id}`)
                .then(response => {
                this.expense_category = response.data;
            });
        },
   }
   
}
</script>
<style scoped>
    .table,.table th,.table td,.table tr {
        background-color: transparent !important;
    }
</style>