<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

<script type="text/javascript">
    
    $( document ).ready(function() {
    
        document.getElementById("withdrawMenu").className = "active";
        
        $('#example').DataTable();
        
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
                                  <h4>Withdraw List</h4>
                              </div>
                            </div>
                        </div>
                         <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                               <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#!">Withdraw List</a></li>
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
                                                    <h5>Withdraw List</h5>
                                          </div>
                                          <div class="card-block">
                                             <div class="dt-responsive table-responsive">
                                               <table id="example"
                                                    class="table table-striped table-bordered nowrap ">
                                                <thead>
                                                 <tr>
                                                   <th>#</th>
                                                   <th>User Details</th>
                                                   <th>User Amount</th>
                                                   <th>Date</th>
                                                </tr>
                                              </thead>
                                            <tbody>
                                            <?php 
                                            $i=1;
                                            foreach ($list as $key => $value) 
                                            {
                                            ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php if(!empty($value['profile_picture'])) { ?>
                                                    <img src="<?php echo base_url()."uploads/profile/".$value['profile_picture'];?>" style="width:80px;height:80px;border-radius:50%"; alt="">
                                                    <?php } else { ?>                                        
                                                    <img src="<?php echo base_url(); ?>/uploads/profile/profile.png" style="width:80px;height:80px;border-radius:50%"; alt="">
                                                    <?php } ?><br>
                                                    <?php echo $value['first_name']." ".$value['last_name'];?><br>
                                                    <?php echo $value['email']?><br>
                                                    <?php echo $value['phone_no']?></td>
                                                    <td>$<?php echo $value['wallet']?></td>
                                                    <td><?php echo date('d /m /Y',strtotime($value['updated_at']));?></td>
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