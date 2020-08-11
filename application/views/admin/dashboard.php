<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<script type="text/javascript">
    
$( document ).ready(function() {

    document.getElementById("dashboardMenu").className = "active";
});
</script>

<div class="pcoded-main-container" style="margin-top: 56px;">
  <div class="pcoded-content">
    <div class="pcoded-inner-content">
       <div class="main-body">
         <div class="page-wrapper">
           <div class="page-body">
             <div class="row">
                 <div class="col-md-6 col-xl-6">
                      <div class="card widget-card-1">
                        <div class="card-block-small">
                          <i class="feather icon-users bg-c-blue card1-icon"></i>
                          <span class="text-c-blue f-w-600">Buyer</span>
                          <h4><?php echo $buyer_count; ?></h4>
                            <div>
                                <span class="f-left m-t-10 text-muted">
                                    <a href="<?php echo site_url();?>admin/buyerlist"><i class="text-c-blue f-16 feather icon-eye m-r-10"></i>View more</a>
                                </span>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 col-xl-6">
                      <div class="card widget-card-1">
                        <div class="card-block-small">
                          <i class="feather icon-users bg-c-pink card1-icon"></i>
                          <span class="text-c-pink f-w-600">Seller</span>
                          <h4><?php echo $seller_count; ?></h4>
                            <div>
                                <span class="f-left m-t-10 text-muted">
                                    <a href="<?php echo site_url();?>admin/sellerlist"><i class="text-c-pink f-16 feather icon-eye m-r-10"></i>View more</a>
                                </span>
                            </div>
                        </div>
                      </div>
                    </div>
                <!--    <div class="col-md-6 col-xl-3">-->
                <!--<div class="card widget-card-1">-->
                <!--  <div class="card-block-small">-->
                <!--    <i class="feather icon-users bg-c-blue card1-icon"></i>-->
                <!--    <span class="text-c-blue f-w-600">Users</span>-->
                <!--    <h4><?php echo $user_count; ?></h4>-->
                <!--      <div>-->
                <!--          <span class="f-left m-t-10 text-muted">-->
                <!--              <a href="#"><i class="text-c-blue f-16 feather "></i><br></a>-->
                <!--          </span>-->
                <!--      </div>-->
                <!--    </div>-->
                <!--   </div>-->
                <!--  </div>-->
                    <div class="col-md-4 col-xl-4">
                      <div class="card widget-card-1">
                          <div class="card-block-small">
                              <i class="feather icon-briefcase  bg-c-pink card1-icon"></i>
                              <span class="text-c-pink f-w-600">Gigs</span>
                               <h4><?php echo $gigs_count; ?></h4>
                              <div>
                                  <span class="f-left m-t-10 text-muted">
                                     <a href="<?php echo site_url();?>admin/giglist"><i class="text-c-blue f-16 feather icon-eye m-r-10"></i>View more</a>
                                  </span>
                              </div>
                          </div>
                      </div>
                   </div>
                    <div class="col-md-4 col-xl-4">
                      <div class="card widget-card-1">
                        <div class="card-block-small">
                          <i class="feather icon-box bg-c-green card1-icon"></i>
                          <span class="text-c-green f-w-600">Orders</span>
                           <h4><?php echo $orders_count; ?></h4>
                           <div>
                             <span class="f-left m-t-10 text-muted">
                               <a href="<?php echo site_url();?>admin/myorder"><i class="text-c-blue f-16 feather icon-eye m-r-10"></i>View more</a>
                             </span>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 col-xl-4">
                      <div class="card widget-card-1">
                        <div class="card-block-small">
                          <i class="feather icon-credit-card bg-c-yellow card1-icon"></i>
                          <span class="text-c-yellow f-w-600">Financial</span>
                           <h4>$<?php echo $total_cost; ?></h4>
                           <div>
                             <span class="f-left m-t-10 text-warning">
                               <a href="<?php echo site_url();?>admin/statistics"><i class="text-c-blue f-16 feather icon-eye m-r-10"></i>View more</a>
                             </span>
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
        
                



                               
                                    