<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
 <script>
        $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>

<script type="text/javascript">

$( document ).ready(function() {

document.getElementById("requestMenu").className = "active";
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
      <h4>Request List</h4>
  </div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
   <ul class="breadcrumb-title">
      <li class="breadcrumb-item"><a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="breadcrumb-item"><a href="#!">Request List</a>
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
                        <h5>Request List</h5>
              </div>

            <div class="row">
                   <div class="col-sm-3" style="left:1%;">
                    <form class="form" method="POST" id="disputeList">
                    <select name="statusfliter" id="statusfliter" onchange='confirmFilter(this.value)' class="form-control" style="height: 35px">
                        <option value="0">---Select Status---</option>
                        <option value="1"<?php if($status == '1'): ?> selected="selected"<?php endif; ?>>Active </option>
                        <option value="2"<?php if($status == '2'): ?> selected="selected"<?php endif; ?>>Inactive </option> 
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
                       <th>User Details</th>
                       <th>Category</th>
                       <th>Price</th>
                       <th>Delivery Time</th>
                       <!--<th>Date</th>-->
                       <th>Status</th>
                       <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php 
                    $i=1;
                     foreach ($list as $key => $value) 
                      {

                          $category_id=$value['category'];

                          $sub_category_id=$value['subcategory'];




                          $CI =& get_instance();
                   ?>
                     <tr>
                         <td><?php echo $i;?></td>
                         <td><?php if(!empty($value['profile_picture'])) { ?>
                           <img src="<?php echo base_url()."uploads/profile/".$value['profile_picture'];?>" style="width:80px;height:80px;border-radius:50%";
                              alt="">
                            <?php } else { ?>                                        
                            <img src="<?php echo base_url(); ?>/uploads/profile/profile.png" style="width:80px;height:80px;border-radius:50%";
                              alt="">
                             <?php } ?><br>
                             <?php echo $value['first_name']." ".$value['last_name'];?><br>

                               <?php echo $value['email']?><br>
                              <?php echo $value['phone_no']?></td>
                         <td><?php echo $CI->getCategory($category_id);?>/<?php echo $CI->getCategory($sub_category_id);?></td>
                         <td>$ <?php echo $value['price']?></td>
                         <td><?php echo $value['deliverytime']?> Days</td>
                         <!--<td><?php echo date('d /m /Y',strtotime($value['posted_at']));?></td>-->

                         <td>
                            <?php
                            if($value['request_status']==1)
                            {
                            ?>
                            <label class="label label-inverse-success">Active</label>
                            <?php
                             }
                             else
                             {
                             ?>
                             <label class="label label-inverse-danger">Inactive</label>
                             <?php
                              }
                              ?>                                            
                          </td>
                         <td> <a href="<?php echo site_url();?>admin/requestview/<?php echo $value['request_id']?>" class="btn btn-primary"  id="<?php echo $value['request_id']?>" onclick=""><i class="fa fa-eye"></i></button></a></td>



            
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
    if(id=='1')
    {
        window.location.href="<?php echo site_url();?>admin/requestlist/1";
    }
    else if(id=='2')
    {
        window.location.href="<?php echo site_url();?>admin/requestlist/2";
    }
    else
    {
        window.location.href="<?php echo site_url();?>admin/requestlist";            
    }        
}
</script>