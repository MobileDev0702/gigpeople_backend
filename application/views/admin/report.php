<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $( document ).ready(function() {
       document.getElementById("reportMenu").className = "active";
       
       $('#example').DataTable();
    });
</script>         

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
                                                    <h4>Report</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item"><a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
                                                    <li class="breadcrumb-item"><a href="#!">Report List</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                           <div class="page-body">
                               <div class="row">
                                 <div class="col-sm-12">
                                        <!-- Zero config.table start -->
                                     <div class="card">
                                          <div class="card-header">
                                                    <h5>Report List</h5>
                                          </div>
                                          <div class="card-block">
                                             <div class="dt-responsive table-responsive">
                                               <table id="example"
                                                    class="table table-striped table-bordered nowrap ">
                                                <thead>
                                                <tr>
                                                   <th>#</th>
                                                   <th>Order Id</th>
                                                   <th>User Details</th>
                                                   <th>Report</th>
                                                   <th>Posted At</th>
                                               </tr>
                                            </thead>
                                          <tbody>
                                            <?php 
                                            $i=1;
                                            foreach ($user_list as $key => $value) 
                                            {
                                            
                                            $CI =& get_instance();
                                            
                                            $user_id = $value['from_user_id'];
                                            
                                            ?>
                                            
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $value['order_id']?></td>
                                                <td>
                                                <?php if(!empty($CI->getUserDetails($user_id)->profile_picture)) { ?>
                                                
                                                    <img src="<?php echo base_url()?>uploads/profile/<?php echo $CI->getUserDetails($user_id)->profile_picture; ?>" style="width:80px;height:80px;border-radius:50%"; alt="">
                                                
                                                <?php } else { ?>                                        
                                                    <img src="<?php echo base_url(); ?>/uploads/profile/profile.png" style="width:80px;height:80px;border-radius:50%"; alt="">
                                                <?php } ?><br>
                                                <?php echo $CI->getUserDetails($user_id)->first_name." ".$CI->getUserDetails($user_id)->last_name;?><br>
                                                
                                                <?php echo $CI->getUserDetails($user_id)->email; ?><br>
                                                <?php echo $CI->getUserDetails($user_id)->phone_no; ?></td>
                                               
                                                <td> <?php echo $value['details']?></td>
                                                <td><?php echo date('d /m /Y',strtotime($value['created_at']));?>
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
                 </div>
            </div>
        </div>
     </div>
  </div>
</div>
