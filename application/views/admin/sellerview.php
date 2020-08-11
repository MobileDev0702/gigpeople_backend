<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
 <script>
        $(document).ready(function() {
    $('#example').DataTable();
    $('#example1').DataTable();
} );
    </script>


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>admin/assets/icon/themify-icons/themify-icons.css">
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>admin/assets/icon/icofont/css/icofont.css">
<!-- feather Awesome -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>admin/assets/icon/feather/css/feather.css">

<style>
.checked {
color: #FF6F00;
}
</style>
<script type="text/javascript">

$( document ).ready(function() {

document.getElementById("customerMenu").className = "active";
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
<h4>User Details</h4>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> </a>
</li>
<li class="breadcrumb-item"><a href="#!">Users</a>
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
<li class="nav-item" onclick="MyList(1)">
<a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Basic Info</a>
<div class="slide" id="slide1" style="width:100%"></div>
</li>

<li class="nav-item"  onclick="MyList(2)">
<a class="nav-link" data-toggle="tab" href="#review" role="tab">Gigs</a>

<div class="slide" id="slide2" style="width:100%"></div>
</li>
<li class="nav-item"  onclick="MyList(3)">
<a class="nav-link" data-toggle="tab" href="#binfo" role="tab">Reviews</a>
<div class="slide" id="slide3" style="width:100%"></div>
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

?>
<table class="table m-0">
<tbody>
<!-- <tr>
<th scope="row">Registration Number</th>
<td>56787</td>
</tr> -->
<tr>
<th scope="row">Contact Number</th>
<td><?php echo $seller_details->phone_no; ?></td>
</tr>
<tr>
<th scope="row">Email Id</th>
<td><?php echo $seller_details->email; ?></td>
</tr>
<tr>
<th scope="row">Amount in Wallet </th>
<td>
<?php echo "$ ".$seller_details->wallet; ?>
</td>
</tr>
<tr>
<th scope="row">Mobile Verification Status </th>
<td>
<?php if($seller_details->is_mobile_verified=='1') { ?>

    <label class="label label-inverse-success">Verified</label>

<?php } else { ?>

    <label class="label label-inverse-warning">Unverified</label>

<?php } ?>
</td>
</tr>
<tr>
<th scope="row">Email Verification Status</th>
<td>
<?php if($seller_details->is_email_verified=='1') { ?>

    <label class="label label-inverse-success">Verified</label>

<?php } else { ?>

    <label class="label label-inverse-warning">Unverified</label>

<?php } ?>
</td>
</tr>
<tr>
<th scope="row">Address</th>
<td><?php echo $seller_details->address; ?></td>
</tr>
<tr>
<th scope="row">Country</th>
<td><?php echo $seller_details->country; ?></td>
</tr>
<tr>
<th scope="row">Language</th>
<td><?php echo $seller_details->language; ?></td>
</tr>
<tr>
<th scope="row">About Us</th>
<td><?php echo $seller_details->about; ?></td>
</tr>
<tr>
<th scope="row">Skills</th>
<td><?php echo $seller_details->skills; ?></td>
</tr>
<tr>
<th scope="row">Rating</th>
<td>
     <div class="stars-example-css review-star">
<i class="icofont icofont-star"></i>
<i class="icofont icofont-star"></i>
<i class="icofont icofont-star"></i>
<i class="icofont icofont-star"></i>
<i class="icofont icofont-star"></i>
</div>

</td>
</tr> 
                      
</tbody>
</table>
</div>
</div>

<div class="col-lg-6 col-xl-3 col-md-6">
<div class="card rounded-card user-card" style="height:150px;width:150px;">
<div class="card-block" >
<div class="img-hover">

<?php if(!empty($seller_details->profile_picture)) { ?>

<img class="img-fluid img-radius" src="<?php echo base_url()?>uploads/profile/<?php echo $seller_details->profile_picture;?>" alt="round-img">

<?php } else { ?> 

<img class="img-fluid img-radius" src="<?php echo base_url();?>/uploads/profile/profile.png" alt="round-img">
<?php } ?>

</div>
<div class="user-content">
<h4 class=""><?php echo $seller_details->first_name." ".$seller_details->last_name; ?></h4>
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
<div class="tab-pane" id="binfo" role="tabpanel">
<div class="card">
<div class="card-header">

</div>
<div class="card-block">
<div class="col-sm-12">

<div class="col-sm-10">
<ul class="media-list">
<?php 
$i=1;
foreach ($review_details as $key => $value) 
{
$user_id=$value['buyer_id'];

$CI =& get_instance();
?>
<li class="media">
<div class="media-left">
<a href="#">
<?php if(!empty( $CI->getUserDetails($user_id)->profile_picture)) { ?>
<img src="<?php echo base_url()?>uploads/profile/<?php echo $CI->getUserDetails($user_id)->profile_picture;?>" style="width:80px;height:80px;border-radius:50%"; alt="">
<?php } else { ?>                                        
<img src="<?php echo base_url(); ?>/uploads/profile/profile.png" style="width:80px;height:80px;border-radius:50%"; alt="">
<?php } ?>
</a>
</div>
<div class="media-body">
<h6 class="media-heading"> <?php echo $CI->getUserDetails($user_id)->first_name;?><span class="f-12 text-muted m-l-5"><?php echo date('d /m /Y',strtotime($value['created_at']));?></span></h6>
<?php
  if($value['seller_rating']==1)
     {

     ?>
    <span class="fa fa-star checked"></span>
  <span class="fa fa-star"></span>
  <span class="fa fa-star"></span>
  <span class="fa fa-star"></span>
  <span class="fa fa-star"></span>


    <?php
      }
   if($value['seller_rating']==2)
      {
     ?>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star"></span>
  <span class="fa fa-star"></span>
  <span class="fa fa-star"></span>
     <?php
    }
     if($value['seller_rating']==3)
      {

   ?>
     <span class="fa fa-star checked"></span>
      <span class="fa fa-star checked"></span>
      <span class="fa fa-star checked"></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
 <?php }if($value['seller_rating']==4)
      { ?>
      <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked "></span>
        <span class="fa fa-star "></span>
        <?php
    }
     if($value['seller_rating']==5)
      {

   ?>

       <span class="fa fa-star checked"></span>
       <span class="fa fa-star checked"></span>
      <span class="fa fa-star checked"></span>
      <span class="fa fa-star checked"></span>
      <span class="fa fa-star checked "></span>
  


        <?php } ?>

<p class="m-b-0"><?php echo $value['seller_review']?></p>

</div>
</li>
<hr>


<?php
$i++;   
}
?>
</ul>
</div>
<div class="col-sm-2"></div>
</div>
</div>
</div>
</div>  
<div class="tab-pane" id="review" role="tabpanel">
    <div class="card">
        <div class="card-header"> </div>
        
        <div class="card-block">
        <div class="col-sm-12">
            <div class="dt-responsive table-responsive">
                <table id="example1"
                class="table table-striped table-bordered nowrap ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Gig Title</th>
                            <th>Category Name</th>
                            <th>Price</th>
                            <th>Delivery Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i=1;
                        foreach ($gig_list as $key => $value) 
                        {
                            $id = $value['category_id'];
                            $ids = $value['sub_category_id'];
                            
                            $CI =& get_instance();
                            
                            ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $value['title'];?></td>
                                <td><?php echo $CI->getCategory($id);?> / <?php echo $CI->getCategory($ids);?></td>
                                <td>$<?php echo $value['price'];?></td>
                                <td><?php echo $value['delivery_time'];?> Days</td>
                                <td>
                                <?php 
                                    if($value['status']==0) { 
                                        echo '<label class="label label-inverse-danger">New / Pending</label>';
                                    }
                                    if($value['status']==2) { 
                                        echo '<label class="label label-inverse-success">Pubilsh</label>';
                                    }
                                    if($value['status']==3) { 
                                        echo '<label class="label label-inverse-warning">Denied</label>';
                                    } 
                                ?> 
                                </td>
                                <td><a href="<?php echo site_url();?>admin/gigview/<?php echo $value['id']?>" class="btn btn-info"><i class="fa fa-eye"></i></button></a></td>
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

<script type="text/javascript">

MyList(1);

function MyList(value)
{
    if(value=='1')
    {
        $("#slide1").show();
        $("#slide2").hide();
        $("#slide3").hide();
    
    }
    else if(value=='2')
    {
        $("#slide1").hide();
        $("#slide2").show();
        $("#slide3").hide();
    
    }
    else if(value=='3')
    {
        $("#slide1").hide();
        $("#slide2").hide();
        $("#slide3").show();
    
    }
}
</script>
