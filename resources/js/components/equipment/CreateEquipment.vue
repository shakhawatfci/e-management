<template>
                                        <!-- Modal -->
                                    <div class="modal fade" id="createEquipment" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                                                    <div class="add-contact-box">
                                                        <div class="add-contact-content">
                                                            <form id="addContactModalTitle">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="contact-name">
                                                                            <i class="flaticon-user-11"></i>
                                                                            <input type="text" id="c-name" class="form-control" placeholder="Name">
                                                                            <span class="validation-text"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="contact-email">
                                                                            <i class="flaticon-mail-26"></i>
                                                                            <input type="text" id="c-email" class="form-control" placeholder="Email">
                                                                            <span class="validation-text"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="contact-occupation">
                                                                            <i class="flaticon-fill-area"></i>
                                                                            <input type="text" id="c-occupation" class="form-control" placeholder="Occupation">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="contact-phone">
                                                                            <i class="flaticon-telephone"></i>
                                                                            <input type="text" id="c-phone" class="form-control" placeholder="Phone">
                                                                            <span class="validation-text"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="contact-location">
                                                                            <i class="flaticon-location-1"></i>
                                                                            <input type="text" id="c-location" class="form-control" placeholder="Location">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="btn-edit" class="float-left btn">Save</button>

                                                    <button class="btn" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Discard</button>

                                                    <button id="btn-add" class="btn">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
</template>

<script>
import { EventBus  } from '../../vue-assets';
export default {
   
//    data()
//    {
//        return 
//        {
         
//        }
//    },

//    mounted() {

//    }
   
}
</script>