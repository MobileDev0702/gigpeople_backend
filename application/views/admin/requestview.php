<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>admin/assets/icon/themify-icons/themify-icons.css">
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>admin/assets/icon/icofont/css/icofont.css">
<!-- feather Awesome -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>admin/assets/icon/feather/css/feather.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<script type="text/javascript">

$( document ).ready(function() {

document.getElementById("requestMenu").className = "active";
});
</script>         

<!--  for modals -->

<style>
    .checked {
        color: orange;
    }
</style>

<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
<h4>Request Details</h4>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> </a>
</li>
<li class="breadcrumb-item"><a href="#!">Request</a>
</li>
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
<div class="card-header">
<h5>Details</h5>
<div class="card-header-right">
<ul class="list-unstyled card-option">
<li><i class="fa fa-minus minimize-card"></i></li>
</ul>
</div>
</div>
<div class="card-block">
<div class="tab-header card">
<ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Request Info</a>
<div class="slide"></div>
</li>
</ul>
</div>
<div class="tab-content">
<div class="tab-pane active" id="personal" role="tabpanel">
<div class="card">
<div class="card-header">
</div> 
<div class="card-block">
<div class="view-info">
<div class="row">
<div class="col-lg-12">
<div class="general-info">
<div class="row">
<div class="col-lg-12 col-xl-8">
<div class="table-responsive">
<?php

$CI =& get_instance();

$category_id=$view->category;

$sub_category_id=$view->subcategory
?>
<table class="table m-0">
<tbody>
<!-- <tr>
<th scope="row">Registration Number</th>
<td>56787</td>
</tr> -->
<tr>
<th scope="row">Category</th>
<td> <?php echo $CI->getCategory($category_id);?> / <?php echo $CI->getCategory($sub_category_id);?></td>
</tr>
<tr>
<th scope="row">Price</th>
<td>$ <?php echo $view->price; ?></td>
</tr>
<tr>
<th scope="row">Delivery Time </th>
<td>
<?php echo $view->deliverytime; ?> Days
</td>
</tr>
<tr>
<th scope="row">Description</th>
<td><?php echo wordwrap($view->description,60,"<br>\n"); ?></td>
</tr>   
<tr>
<th scope="row">Posted At</th>
<td><?php echo date('d /m /Y',strtotime($view->posted_at));?></td>
</tr> 
</tbody>
</table>
</div>
</div>

<div class="col-lg-6 col-xl-3 col-md-6">
<div class="card rounded-card user-card" style="height:150px;width:150px;">
<div class="card-block" >
<div class="img-hover">

<?php if(!empty($view->image)) { ?>

<img class="img-fluid img-radius" src="<?php echo base_url();?>/uploads/request_image/<?php echo $view->image?>" alt="round-img" style="height: 150px;" class="img-responsive">

<?php } else { ?> 

<img class="img-fluid img-radius" src="<?php echo base_url();?>/uploads/banner_images/images.jpg" alt="round-img">
<?php } ?>

</div>
<div class="user-content">

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
</div>

</div>
</div>
</div>
</div>
<div class="col-xl-12 col-md-12">
<div class="card table-card">
<div class="card-header">
<h5>Details</h5>
<div class="card-header-right">
<ul class="list-unstyled card-option">
<li><i class="fa fa-minus minimize-card"></i></li>
</ul>
</div>
</div>
<div class="card-block">
<div class="tab-header card">
<ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Offer's Received</a>
<div class="slide"></div>
</li>
</ul>
</div>
<div class="tab-content">
<div class="tab-pane active" id="personal" role="tabpanel">
<div class="card">
<div class="card-header">
</div> 
<div class="card-block">
<div class="col-lg-12">

<div class="dt-responsive table-responsive">
<table id="example"
class="table table-striped table-bordered nowrap ">
<thead>
<tr>
<th>#</th>
<th>Seller Details</th>
<th>Price</th>
<th>Description</th>
<th>Delivery Time</th>
 <th>Offer Status</th>
<th>Offer At</th>
</tr>
</thead>
<tbody>
<?php 
$i=1;
foreach ($offer_view as $key => $value) 
{
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
<?php echo $value['phone_no']?>
</td>
<td>$<?php echo $value['offer_price']?></td>
<td><?php echo wordwrap($value['offer_description'],25,"<br>\n"); ?></td>
<td><?php echo $value['deliver_time']; ?> Days</td>
<td>
<?php
if($value['offer_status']==1)
{
?>
<label class="label label-inverse-success">Acceped</label>
<?php
}
elseif($value['offer_status']==2)
{
?>
<label class="label label-inverse-danger">Rejected</label>
<?php
} else {
?>             
<label class="label label-inverse-warning">Waiting</label>
<?php } ?>
</td>
<td><?php echo date('d /m /Y',strtotime($value['posted_at']));?></td>
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
$('#example').DataTable()
} );
</script>