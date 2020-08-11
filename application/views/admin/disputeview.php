<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>admin/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>admin/assets/icon/icofont/css/icofont.css">
    <!-- feather Awesome -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>admin/assets/icon/feather/css/feather.css">

<script type="text/javascript">
    
$( document ).ready(function() {

    document.getElementById("disputeMenu").className="menu active";
});
</script>         

<?php 

$CI =& get_instance();

if($Orders->type=='1')
{
    $gig_id = $Orders->product_id;
    
    $title        = $CI->getGig($gig_id)->title;
    
    $deliverytime = $CI->getGig($gig_id)->delivery_time;
    
    $cid = $CI->getGig($gig_id)->category_id;
    
    $sid = $CI->getGig($gig_id)->sub_category_id;
    
    $category = $CI->getCategory($cid).' / '.$CI->getCategory($sid);
}

if($Orders->type=='2')
{
    $request_id = $Orders->product_id;
    
    $title = '';
    
    $deliverytime = $CI->getRequest($request_id)->deliverytime;
    
    $deliverytime = $CI->getRequest($request_id)->deliverytime;
    
    $cid = $CI->getRequest($request_id)->category;
    
    $sid = $CI->getRequest($request_id)->subcategory;
    
    $category = $CI->getCategory($cid).' / '.$CI->getCategory($sid);
}

$seller_id = $Orders->seller_id;

?>

<!--  for modals -->

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header">
                     <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                   <h4>Order Details</h4>
                                </div>
                            </div>
                        </div>
                       <div class="col-lg-4">
                      <div class="page-header-breadcrumb">
                           <ul class="breadcrumb-title">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> </a>
                                </li>
                                <li class="breadcrumb-item"><a href="<?php echo site_url();?>admin/dispute">Dispute</a></li>
                                <li class="breadcrumb-item"><a href="#!">Details</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="row">
                     <div class="col-xl-12 col-md-12">
                          <div class="card table-card">
                               <div class="card-header" style="text-align: center;">
                                    <h5><a href="#" class="btn btn-success" data-toggle="modal" data-target="#Dispute" id="" onclick="Dispute(this.id)"><i class="fa fa-user"></i> Dispute</a>

                                      <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addModal" id="" onclick="Sendmail(this.id)"><i class="fa fa-user"></i> Send Mail</a>

                                    </h5>
                                        
                                </div>

                                <div class="card-header">
                                    <!--<h5>Details</h5>-->
                                        <div class="card-header-right">
                                             <ul class="list-unstyled card-option">
                                                <li><i class="fa fa-minus minimize-card"></i></li>
                                             </ul>
                                       </div>
                                </div>

                                <div class="card-block">
                                                 <div class="view-info">
                                                    <div class="row">
                                                       <div class="col-lg-12">
                                                            <div class="general-info">
                                                               <div class="row">
                                                                    <div class="col-lg-12 col-xl-6">
                                                                        <div class="table-responsive">
                                                                                <table class="table m-0">
                                                                                    <tbody>
                                                                                     <tr>
                                                                                      <th scope="row">Order Title</th>
                                                                                      <td><?php echo $title; ?></td>
                                                                                     </tr>
                                                                                     <tr>
                                                                                      <th scope="row">
                                                                                      Category</th>
                                                                                      <td><?php echo $category; ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                      <th scope="row">Ordr Date</th>
                                                                                      <td><?php echo date('d /m /Y',strtotime($Orders->created_at)); ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                      <th scope="row">Order Value </th>
                                                                                      <td>$ <?php echo $Orders->price; ?></td>
                                                                                    </tr>
                                                                             </tbody>
                                                                     </table>
                                                                </div>
                                                           </div>
                                                          <div class="col-lg-12 col-xl-6">
                                                               <div class="table-responsive">
                                                                    <table class="table m-0">
                                                                         <tbody>
                                                                          <tr>
                                                                            <th scope="row">Quantity</th>
                                                                            <td><?php echo $Orders->quantity; ?> </td>
                                                                          </tr>
                                                                             <tr>
                                                                                <th scope="row">Duration</th>
                                                                                  <td><?php echo $deliverytime; ?> Days</td>
                                                                             </tr>              <tr>
                                                                                <th scope="row">Shipping Price</th>
                                                                                  <td>$ <?php echo $Orders->shipping_cost; ?></td>
                                                                             </tr>                                                                             
                                                                            
                                                                              <tr>
                                                                                <th scope="row">Total Amount</th>
                                                                                  <td>$ <?php echo $Orders->final_cost; ?></td>
                                                                             </tr>
                                                                          </tbody>
                                                                    </table>
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
                                      
                                            <div class="col-xl-6 col-md-12">
                                                <div class="card feed-card">
                                                    <div class="card-header">
                                                        <h5>Dispute</h5>
                                                    </div>
                                                    <div class="card-block">
                                                      <div class="dt-responsive table-responsive">
                                                         <table id="example" class="table table-striped table-bordered nowrap ">
                                                         <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Seller Details</th>
                                                                <th>Comments</th>
                                                                <th>Posted At</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        
                                                            $i=1;
                                                            foreach ($seller_dispute as $key => $value) 
                                                            {
                                                                $user_id=$value->from_user_id;
                                                                
                                                                $Json = json_decode($value->details);
                                                                
                                                                $fromr_id   = $Json->from;
                                                                $to_id  = $Json->to;
                                                                $message    = $Json->message;
                                                                $is_date    = $Json->is_date;
                                                                
                                                                $CI =& get_instance();
                                                                ?>
                                                                <tr>
                                                                <td><?php echo $i;?></td>
                                                                <td>
                                                                    <img src="<?php echo base_url()?>uploads/profile/<?php echo !empty($CI->getUserDetails($user_id)->profile_picture) ? $CI->getUserDetails($user_id)->profile_picture : 'profile.png';?>" style="width:80px;height:80px;border-radius:50%";><br>
                                                                    <?php echo $CI->getUserDetails($user_id)->first_name;?><br>
                                                                    <?php echo $CI->getUserDetails($user_id)->email;?><br>
                                                                    <?php echo $CI->getUserDetails($user_id)->phone_no;?>
                                                                </td>
                                                                <td> <?php echo $message; ?></td>
                                                                <td><?php echo date('d /m /Y',strtotime($is_date)); ?>
                                                                </td>
                                                                </tr>
                                                                <?php
                                                                $i++;   
                                                            }
                                                        
                                                        ?>    
                                                     </tbody>
                                                     </table>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                          </div>

                                              
                                            <div class="col-xl-6 col-md-12">
                                                <div class="card feed-card">
                                                    <div class="card-header">
                                                        <h5>Dispute</h5>
                                                    </div>
                                                    <div class="card-block">
                                                      <div class="dt-responsive table-responsive">
                                                         <table id="example1" class="table table-striped table-bordered nowrap ">
                                                         <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Buyer Details</th>
                                                                <th>Comments</th>
                                                                <th>Posted At</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        
                                                            $i=1;
                                                            foreach ($buyer_dispute as $key => $value) 
                                                            {
                                                                $user_id=$value->from_user_id;
                                                                
                                                                $Json = json_decode($value->details);
                                                                
                                                                $fromr_id   = $Json->from;
                                                                $to_id  = $Json->to;
                                                                $message    = $Json->message;
                                                                $is_date    = $Json->is_date;
                                                                
                                                                $CI =& get_instance();
                                                                ?>
                                                                <tr>
                                                                <td><?php echo $i;?></td>
                                                                <td>
                                                                    <img src="<?php echo base_url()?>uploads/profile/<?php echo !empty($CI->getUserDetails($user_id)->profile_picture) ? $CI->getUserDetails($user_id)->profile_picture : 'profile.png';?>" style="width:80px;height:80px;border-radius:50%";><br>
                                                                    <?php echo $CI->getUserDetails($user_id)->first_name;?><br>
                                                                    <?php echo $CI->getUserDetails($user_id)->email;?><br>
                                                                    <?php echo $CI->getUserDetails($user_id)->phone_no;?>
                                                                </td>
                                                                <td> <?php echo $message; ?></td>
                                                                <td><?php echo date('d /m /Y',strtotime($is_date)); ?>
                                                                </td>
                                                                </tr>
                                                                <?php
                                                                $i++;   
                                                            }
                                                        
                                                        ?>    
                                                     </tbody>
                                                     </table>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                              
                                            <div class="col-xl-12 col-md-12">
                                                <div class="card user-card-full">
                                                    <div class="row m-l-0 m-r-0">
                                                        <div class="col-sm-4 bg-c-lite-green user-profile">
                                                            <div class="card-block text-center text-white">
                                                                <div class="m-b-25">
                                                                    <img src="<?php echo base_url()?>uploads/profile/<?php echo !empty($CI->getUserDetails($seller_id)->profile_picture) ? $CI->getUserDetails($seller_id)->profile_picture : 'profile.png';?>" style="height:250px;width:auto" class="img-radius" alt="User-Profile-Image">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="card-block">
                                                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Seller Information</h6>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Name</p>
                                                                        <h6 class="text-muted f-w-400"><?php echo $CI->getUserDetails($seller_id)->first_name;?>  <?php echo $CI->getUserDetails($seller_id)->last_name;?></h6>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Country</p>
                                                                        <h6 class="text-muted f-w-400"><?php echo $CI->getUserDetails($seller_id)->country;?></h6>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Email</p>
                                                                        <h6 class="text-muted f-w-400"><?php echo $CI->getUserDetails($seller_id)->email;?></h6>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Phone</p>
                                                                        <h6 class="text-muted f-w-400"><?php echo $CI->getUserDetails($seller_id)->phone_no;?></h6>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Member Since</p>
                                                                        <h6 class="text-muted f-w-400">
                                                                            <?php
                                                                            
                                                                            $created_at = $CI->getUserDetails($seller_id)->created_at;
                                                                            $unixtime = strtotime($created_at);
                                                                                echo date('F', $unixtime).' '.date('Y', $unixtime); //month
                                                
                                                                            
                                                                            ?>
                                                                            
                                                                            
                                                                            </h6>
                                                                    </div>
                                                                    <!--<div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">
                                                                          Order Completed
                                                                        </p>
                                                                        <h6 class="text-muted f-w-400">2</h6>
                                                                    </div>-->
                                                                </div>
                                                                </div>
                                                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                                                   
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        <div class="col-lg-12">
                                          <div class="card product-detail-page">
                                            <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active f-18 p-b-0" data-toggle="tab" href="#description" role="tab">Feed Back</a>
                                                    <div class="slide"></div>
                                                </li>
                                               <!--  <li class="nav-item m-b-0">
                                                    <a class="nav-link f-18 p-b-0" data-toggle="tab" href="#review" role="tab">Review</a>
                                                    <div class="slide"></div>
                                                </li> -->
                                              
                                            </ul>
                                        </div>
                                      </div>
                                        <!-- Nav tabs start-->

                                        <!-- Nav tabs card start-->
                                        <div class="card">
                                            <div class="card-block">
                                                <!-- Tab panes -->
                                                <div class="tab-content bg-white">
                                                    <div class="tab-pane active" id="description" role="tabpanel">
                                                        <div class="col-sm-2"></div>
                                                    <div class="col-sm-10">
                                                       <ul class="media-list">
                                                        <?php if(!empty($reviews->buyer_rating)) { ?>   
                                                        <li class="media">
                                                            <div class="media-left">
                                                                <a href="#">
                                                                <img src="<?php echo base_url()?>uploads/profile/<?php echo !empty($CI->getUserDetails($reviews->seller_id)->profile_picture) ? $CI->getUserDetails($reviews->seller_id)->profile_picture : 'profile.png';?>" class="media-object img-radius comment-img">
                                                                </a>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="media-heading"> <?php echo $CI->getUserDetails($reviews->seller_id)->first_name;?>  <?php echo $CI->getUserDetails($reviews->seller_id)->last_name;?> <span class="f-12 text-muted m-l-5"><?php echo date('d /m /Y',strtotime($reviews->created_at)); ?> </span></h6>
                                                                <div class="stars-example-css review-star">
                                                                    <i class="icofont icofont-star"></i>
                                                                    <i class="icofont icofont-star"></i>
                                                                    <i class="icofont icofont-star"></i>
                                                                    <i class="icofont icofont-star"></i>
                                                                    <i class="icofont icofont-star"></i>
                                                                </div>
                                                                 <p class="m-b-0"><?php echo $reviews->seller_review; ?>.</p>
                                                            </div>
                                                        </li>
                                                     
                                                        <hr>
                                                        <?php } if(!empty($reviews->seller_rating)) { ?>   
                                                          <div class="media mt-2">
                                                                <li class="media">
                                                                <div class="media-left">
                                                                   <a href="#">
                                                                        <img src="<?php echo base_url()?>uploads/profile/<?php echo !empty($CI->getUserDetails($reviews->buyer_id)->profile_picture) ? $CI->getUserDetails($reviews->buyer_id)->profile_picture : 'profile.png';?>" class="media-object img-radius comment-img">
                                                                    </a>
                                                                </div>
                                                               <div class="media-body">
                                                                  <h6 class="media-heading"><?php echo $CI->getUserDetails($reviews->buyer_id)->first_name;?>  <?php echo $CI->getUserDetails($reviews->buyer_id)->last_name;?> <span class="f-12 text-muted m-l-5"><?php echo date('d /m /Y',strtotime($reviews->updated_at)); ?></span></h6>
                                                                      <div class="stars-example-css review-star">
                                                                                <i class="icofont icofont-star"></i>
                                                                                <i class="icofont icofont-star"></i>
                                                                                <i class="icofont icofont-star"></i>
                                                                                <i class="icofont icofont-star"></i>
                                                                                <i class="icofont icofont-star"></i>
                                                                            </div>
                                                              
                                                                  <p class="m-b-0"><?php echo $reviews->buyer_review; ?>.</p>
                                                                </div>
                                                              </li>
                                                            </div>
                                                             <?php } ?>   
                                                          </ul>
                                                        </div>
                                                      
                                                    </div>
                                                    <div class="tab-pane" id="review" role="tabpanel">
                                                    <div class="col-sm-2"></div>
                                                    <div class="col-sm-10">
                                                       <ul class="media-list">
                                                        <li class="media">
                                                          <div class="media-left">
                                                            <a href="#">
                                                              <img class="media-object img-radius comment-img" src="<?php echo base_url();?>admin/assets/images/avatar-1.jpg" alt="Generic placeholder image">
                                                          </a>
                                                       </div>
                                                       <div class="media-body">
                                                          <h6 class="media-heading">Sortino media<span class="f-12 text-muted m-l-5">08/07/2019</span></h6>

                                                             <p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                                         </div>
                                                     </li>
                                                    </ul>
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
                              
                                           

                                            
     <!-- Modal -->
  <div class="modal fade" id="Dispute" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="display: block;background-color:#2dcee3">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="">Dispute Confirmation</h4>
        </div>
        <form class="form" method="POST" id="disputeList">
        <div class="modal-body">
          <table align="center">
          <tbody>
          <tr>          
          <td>
            <input type="radio" name="dispute" id="dispute" value="1"> Buyer<br>
            <input type="radio" name="dispute" id="dispute" value="2"> Seller<br>
          </td>
          </tr>
          </tbody>
          </table>         

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-success" onclick="confirm()">Yes</button>
        </div>
      </form>
      </div>
      
    </div>
  </div>                                      


<!-- Add Modal -->
  <div class="modal fade" id="addModal" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="display: block;background-color:#2dcee3">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style=""> Send Mail</h4>
        </div>
        
        <div class="page-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Zero config.table start -->
                        <div class="card">
                             
                              <div class="card-block">
                                 <form class="form" method="POST" id="helpAdd">
                                     <div class="form-body">
                                        <div class="form-group">
                                           <div class="adjoined-bottom">
                                              <div class="grid-container">
                                                  <div class="grid-width-100">
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">User Type</label>
                                                        <div class="col-sm-8">
                                                            
                                                            <select name="parent" id="parent" class="form-control">
                                                              <option value="">---Select---</option>
                                                              <option value="0">All</option>
                                                              <option value="1">Buyer</option>
                                                              <option value="2">Seller</option>
                                                            </select>
                                                        </div>
                                                      </div>
                                                     
                                                       <div class="form-group row">
                                                         <label class="col-sm-4 col-form-label">Message</label>
                                                          <div class="col-sm-8">
                                                          <textarea name="content"  class="form-control" id="editor" ></textarea>
                                                       </div>
                                                     </div>
                                                  </div>
                                               </div>
                                             </div>
                                         </div>
                                      </div>
                                     <div class="form-actions">
                                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                     <input type="submit" class="btn btn-success" id="addSave" value="Send">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      </div>      
    </div>
  </div>

<script>
$("#helpAdd").submit(function(event) {
    
    event.preventDefault();
    
    toastr.success("Mail Send Successfully !!!");
    setTimeout(function() {
        window.location.reload()
    }, 2000);

});

function confirm(id)
{
    var disputeList= $("#disputeList").serialize();
    
    if(disputeList=='dispute=1')
    {
        toastr.success("Buyer Winning !!");
        setTimeout(function() {
            window.location.reload()
        }, 2000);
    }
    else if(disputeList=='dispute=2')
    {
        toastr.success("Seller Winning !!");
        setTimeout(function() {
            window.location.reload()
        }, 2000);
    }       
    else
    {
        toastr.info("Please Select !!");
        setTimeout(function() {
            window.location.reload()
        }, 2000);
    }
}

$(document).ready(function() {
    $('#example').DataTable();
    $('#example1').DataTable();
});
</script> 