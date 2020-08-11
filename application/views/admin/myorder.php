<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
    
$( document ).ready(function() {
   document.getElementById("myOrderMenu").className = "active";
   
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
                                                    <h4>Orders</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item"><a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
                                                    <li class="breadcrumb-item"><a href="#!">Order</a>
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
                                                    <h5>Order List</h5>
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
<table id="example" class="table table-striped table-bordered nowrap ">
<thead>
<tr>
<th>#</th>
<th>Order Id</th>
<!--<th>Seller Details</th>-->
<th>Buyer Details</th>
<th>Order Type</th>
<th>Current Status</th>
<th>Action</th>
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

<!--<td>
    <img src="<?php echo base_url()?>uploads/profile/<?php echo !empty($CI->getUserDetails($seller_id)->profile_picture) ? $CI->getUserDetails($seller_id)->profile_picture : 'profile.png';?>" style="width:80px;height:80px;border-radius:50%";><br>
    <?php echo $CI->getUserDetails($seller_id)->first_name;?><br>
    <?php echo $CI->getUserDetails($seller_id)->email;?><br>
    <?php echo $CI->getUserDetails($seller_id)->phone_no;?>
</td>-->

<td>
    <img src="<?php echo base_url()?>uploads/profile/<?php echo !empty($CI->getUserDetails($buyer_id)->profile_picture) ? $CI->getUserDetails($buyer_id)->profile_picture : 'profile.png';?>" style="width:80px;height:80px;border-radius:50%";><br>
    <?php echo $CI->getUserDetails($buyer_id)->first_name;?><br>
    <?php echo $CI->getUserDetails($buyer_id)->email;?><br>
    <?php echo $CI->getUserDetails($buyer_id)->phone_no;?>
</td>

<td>    
<?php
if($value['type']==1)
{
?>
<label class="label label-inverse-success">Gig<label>
<?php
}
else
{
?>
<label class="label label-inverse-success">Request</label>
<?php
}
?>
</td>

<td>    
<?php
if($value['order_status']==3)
{
?>
<label class="label label-inverse-danger">Order Started<label>
<?php
}
if($value['order_status']==4)
{
?>
<label class="label label-inverse-success">Completed/Delivered</label>
<?php
}
?>
</td>
<td> <a href="<?php echo site_url();?>admin/orderview/<?php echo $value['id']?>" class="btn btn-info"  id="" onclick=""><i class="fa fa-eye"></i></button></a></td>
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

<script type="text/javascript">

function confirmFilter(id)
{
    if(id=='1')
    {
        window.location.href="<?php echo site_url();?>admin/myorder/1";
    }
    else if(id=='2')
    {
        window.location.href="<?php echo site_url();?>admin/myorder/2";
    }
    else
    {
        window.location.href="<?php echo site_url();?>admin/myorder";            
    } 
}

</script>
