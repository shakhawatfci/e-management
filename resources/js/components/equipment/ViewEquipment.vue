<template>
 <div>
     
                            <div class="row">

                            <div class="col-md-3" style="margin-bottom:10px;">
                               <select class="form-control">
                                <option value="">Filter By Vendor</option>
                                <option value="">Filter By Vendor</option>
                                <option value="">Filter By Vendor</option>
                                <option value="">Filter By Vendor</option>
                                <option value="">Filter By Vendor</option>
                               </select> 
                              </div>
                              
                              <div class="col-md-3" style="margin-bottom:10px;">
                               <input type="text" class="form-control"  placeholder="Search Equipment"/> 
                              </div>


                            </div>
                            <div class="row">
                            <div class="col-md-12 searchable-items list">

                                <div class="items items-header-section">
                                    <div class="item-content text-left">
                                        <div class="">
                                            <h4>Name</h4>
                                        </div>
                                        <div class="user-email">
                                            <h4>Email</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">Location</h4>
                                        </div>
                                        <div class="user-phone">
                                            <h4 style="margin-left: 3px;">Phone</h4>
                                        </div>
                                        <div class="action-btn">
                                           action
                                        </div>
                                    </div>
                                </div>

                                <div class="items">
                                    <div class="item-content text-left">
                                        <div class="user-profile">

                                            <div class="user-meta-info">
                                                <p class="user-name" data-name="Alan Green">Alan Green</p>
                                                <p class="user-work" data-occupation="Web Developer">Web Developer</p>
                                            </div>
                                        </div>
                                        <div class="user-email">
                                            <p class="info-title">Email: </p>
                                            <p class="usr-email-addr" data-email="alan@mail.com">alan@mail.com</p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title">Location: </p>
                                            <p class="usr-location" data-location="Boston, USA">Boston, USA</p>
                                        </div>
                                        <div class="user-phone">
                                            <p class="info-title">Phone: </p>
                                            <p class="usr-ph-no" data-phone="+1 (070) 123-4567">+1 (070) 123-4567</p>
                                        </div>
                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" 
                                            height="24" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" 
                                             stroke-linecap="round" stroke-linejoin="round"
                                              class="feather feather-edit-2 edit">
                                              <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                              </path>
                                              </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                             width="24" height="24" viewBox="0 0 24 24" 
                                             fill="none" stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"
                                               class="feather feather-user-minus delete">
                                               <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                               <circle cx="8.5" cy="7" r="4"></circle>
                                               <line x1="23" y1="11" x2="17" y2="11"></line>
                                               </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-center mb-10 mt-10">
                            <div class="paginating-container pagination-default">
                                <ul class="pagination">
                                    <li class="prev"><a href="javascript:void(0);">Prev</a></li>
                                    <li><a href="javascript:void(0);">1</a></li>
                                    <li class="active"><a href="javascript:void(0);">2</a></li>
                                    <li><a href="javascript:void(0);">3</a></li>
                                    <li class="next"><a href="javascript:void(0);">Next</a></li>
                                </ul>
                            </div>
                            </div>
                         

                            </div>
 </div>
</template>

