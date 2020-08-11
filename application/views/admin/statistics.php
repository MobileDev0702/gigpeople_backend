
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

<script type="text/javascript">
    
$( document ).ready(function() {

    document.getElementById("statisticsMenu").className = "active";
});
</script>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
               <div class="page-header">    
                 <div class="row align-items-end">
                     <div class="col-lg-8">
                         <div class="page-header-title">
                             <div class="d-inline">
                                  <h4>Statistics</h4>
                              </div>
                            </div>
                        </div>
                                        <div class="col-lg-4">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item"><a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
                                                    <li class="breadcrumb-item"><a href="#!">Statistics</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                               
                           <div class="page-body">
                              <div class="row">
                                              <div class="col-md-12 col-xl-4">
                                                  <div class="card widget-statstic-card">
                                                      <div class="card-header">
                                                          <div class="card-header-left">
                                                              <h5>User Earned</h5>
                                                             
                                                          </div>
                                                      </div>
                                                      <div class="card-block">
                                                          <i class="feather icon-users st-icon bg-c-yellow"></i>
                                                          <div class="text-left">
                                                              <h3 class="d-inline-block">$<?php echo $user_cost ?>  </h3>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-md-6 col-xl-4">
                                                  <div class="card widget-statstic-card">
                                                      <div class="card-header">
                                                          <div class="card-header-left">
                                                              <h5>Commission</h5>
                                                          </div>
                                                      </div>
                                                      <div class="card-block">
                                                          <i class="feather icon-sliders st-icon bg-c-pink txt-lite-color"></i>
                                                          <div class="text-left">
                                                              <h3 class="d-inline-block">$<?php echo $company_cost ?> </h3>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-md-6 col-xl-4">
                                                  <div class="card widget-statstic-card">
                                                      <div class="card-header">
                                                          <div class="card-header-left">
                                                              <h5>Total Amount</h5>
                                                          </div>
                                                      </div>
                                                       <div class="card-block">
                                                        <i class="feather icon-shopping-cart st-icon bg-c-blue"></i>
                                                    <div class="text-left">
                                                  <h3 class="d-inline-block">$<?php echo $total_cost ?> </h3>
                                              </div>
                                           </div>
                                        </div>
                                    </div>
                                             
                                </div>
                               <div class="row">
                                 <div class="col-sm-12">
                                        <!-- Zero config.table start -->
                                     <div class="card">
                                          <div class="card-header">
                                                    <h5>Statistics</h5>
                                          </div>
                                              <div class="row">
                                               <div class="col-sm-3" style="left:2%;">
                                                <form class="form" method="POST" id="disputeList">
                                                <select name="statusfliter" id="statusfliter" onchange='confirmFilter(this.value)' class="form-control">
                                                    <option value="0">---Select Category---</option>
                                                                                  <?php 
                                          
                                           foreach ($category_details as $key => $value) 
                                            {

                                            ?>
                                                    <option value="<?php echo $value['id']?>"<?php if($status == $value['id']): ?> selected="selected"<?php endif; ?>><?php echo $value['category_name']?> </option> 
                                            <?php
                                          
                                              }
                                            ?>
                                                </select>
                                              </form>
                                              </div>
                                              <div class="col-sm-8"></div>                            
                                          </div>
                                          <div class="card-block">
                                             <div class="dt-responsive table-responsive">
                                               <table id="example"
                                                    class="table table-striped table-bordered nowrap ">
                                                <thead>
                                                 <tr>
                                                   <th>#</th>
                                                   <th>Order Id</th>
                                                   <th>Order Type</th>
                                                   <th>User Details</th>
                                                   <th>User Earned</th>
                                                   <th>Commission</th>
                                                   <th>Total Amount</th>
                                                   <th>Date</th>
                                                </tr>
                                              </thead>
                                          <tbody>
                                         <?php 
                                           $i=1;
                                           foreach ($order_list as $key => $value) 
                                            {
                                                $seller_id = $value['seller_id'];

                                                $buyer_id  = $value['buyer_id'];
                                                
                                                $CI =& get_instance();
                                            ?>
                               
                                            <tr>
                                              <td><?php echo $i;?></td>
                                              <td><?php echo $value['id']?></td>
                                              <td>          
                                                <?php 
                                                    if($value['type']==1)
                                                          {
                                                 ?>
                                               <label class="label label-inverse-success">Gig</label>
                                                  <?php

                                                  }
                                                 else{
                                                   ?>
                                                  <label class="label label-inverse-warning">Request</label>
                                                 <?php 
                                                   }
                                                 ?></td>
                                                 
                                                 <td>
                                                    <img src="<?php echo base_url()?>uploads/profile/<?php echo !empty($CI->getUserDetails($seller_id)->profile_picture) ? $CI->getUserDetails($seller_id)->profile_picture : 'profile.png';?>" style="width:80px;height:80px;border-radius:50%";><br>
                                                    <?php echo $CI->getUserDetails($seller_id)->first_name.' '.$CI->getUserDetails($seller_id)->last_name;?><br>
                                                    <?php echo $CI->getUserDetails($seller_id)->email;?><br>
                                                    <?php echo $CI->getUserDetails($seller_id)->phone_no;?>
                                                <td>$<?php echo $value['company_amount']?></td>
                                                <td>$<?php echo $value['total_amount']?></td>
                                                <td><?php echo date('d /m /Y',strtotime($value['completed_at']));?></td>
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
                 </div>
            </div>
        </div>
     </div>
  </div>
</div>

<script>

function confirmFilter(id)
{
    if(id)
    {
        window.location.href="<?php echo site_url();?>admin/statistics/"+id;
    }
    else
    {
        window.location.href="<?php echo site_url();?>admin/statistics";            
    }       
}

$(document).ready(function() {
    $('#example').DataTable();
});
</script>
