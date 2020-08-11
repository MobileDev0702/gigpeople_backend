<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
    
    
$( document ).ready(function() {

    document.getElementById("cmsMenu").className = "pcoded-hasmenu pcoded-trigger";
     document.getElementById("contactMenu").className = "active";
});
</script>         <!--  for modals -->

        
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

              <div class="page-header">
                                    <div class="row align-items-end">
                                        <div class="col-lg-8">
                                            <div class="page-header-title">
                                                <div class="d-inline">
                                                    <h4>Contact</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item">
                                                        <a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> </a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#!">CMS</a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#!">Contact Us</a>
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
                                                    <h5>ContactUs List</h5>
                                          </div>
                                          <div class="card-block">
                                             <div class="dt-responsive table-responsive">
                                               <table id="example"
                                                    class="table table-striped table-bordered nowrap ">
                                                <thead>
                                                 <tr>
                                                   <th >#</th>
                                                   <th >User Details</th>
                                                   <th >Type</th>
                                                   <th >Report</th>
                                                   <th >Created at</th>
                                                </tr>
                                              </thead>
                                          <tbody>
                                             <?php

                                        $i=1;
                                                           
                                        foreach ($contact_list as $c) 
                                        {   

                                          ?>
                                            <tr>
                                              <td><?php echo $i;?></td>
                                              <td> 
                                                 <?php if(!empty($c['profile_picture'])) { ?>
                                          <img src="<?php echo base_url()."uploads/profile/".$c['profile_picture'];?>" style="width:80px;height:80px;border-radius:50%";
                                        alt="">
                                          <?php } else { ?>                                        
                                          <img src="<?php echo base_url(); ?>/uploads/profile/profile.png" style="width:80px;height:80px;border-radius:50%";
                                        alt="">
                                               <?php } ?><br>
                                                    <?php echo $c['first_name']; ?><?php echo $c['last_name']; ?><br>
                                                    <?php echo $c['email']; ?><br>
                                                   <?php echo $c['phone_no']; ?>
                                                  </td>
                                                 <td><?php echo $c['type']; ?></td>
                                                <td style="width:40px"><?php echo $c['content']; ?></td>
                                                <td><?php echo date('d /m /Y',strtotime($c['created_at']));?></td>
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
        $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
