
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>admin/assets/icon/themify-icons/themify-icons.css">
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>admin/assets/icon/icofont/css/icofont.css">
<!-- feather Awesome -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>admin/assets/icon/feather/css/feather.css">
<script type="text/javascript">

$( document ).ready(function() {

document.getElementById("gigMenu").className = "active";
});
</script>         <!--  for modals -->

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
<h4>Gig Details</h4>
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
<li class="breadcrumb-item"><a href="#!">Gig Details</a></li>
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
<a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Gigs Details</a>
<div class="slide"></div>
</li>

<?php 

$Gig_Id = $gig_details->id;

if($gig_details->status!='0')
{

?>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#review" role="tab">Reviews</a>
<div class="slide"></div>
</li> 
<?php 

}

?>

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
<table class="table m-0">
    <tbody>
    <?php
    $CI =& get_instance();
    
    $id = $gig_details->category_id;
    $ids = $gig_details->sub_category_id ;
    
    ?>
      <tr>
      <th scope="row">Gig Title</th>
      <td><?php echo $gig_details->title; ?></td>
      </tr>
      <tr>
       <th scope="row">Category Name</th>
       <td>
       <?php echo $CI->getCategory($id);?>
          </td>

       </td>
     </tr>
     <tr>
        <th scope="row">Sub category Name</th>
        <td><?php echo $CI->getCategory($ids);?></td>
    </tr>
    <tr>
        <th scope="row">Price </th>
        <td>
         $ <?php echo $gig_details->price; ?>
      </td>
      </tr>
      <tr>
      <th scope="row">Delivery Time</th>
      <td>  <?php echo $gig_details->delivery_time; ?> Days</td>
      </tr>
      <tr>
    <th scope="row">Shipping</th>
    <td> <?php
    if($gig_details->shipping==1)
    {
    ?>
    <label class="label label-inverse-info">No</label>
    <?php
    }
    if($gig_details->shipping==2)
    {
    ?>
    <label class="label label-inverse-success">Yes</label>
    <?php
    }
    ?>
    
    </tr>
      <tr>
      <th scope="row">Shipping price</th>
      <td>$ <?php echo $gig_details->shipping_price; ?> </td>
      </tr>
      <tr>
      <th scope="row">Total price</th>
      <td>$ <?php echo $gig_details->total_cost; ?> </td>
      </tr>
      <tr>
      <th scope="row">Description</th>
      <td> <?php echo wordwrap($gig_details->description,60,"<br>\n"); ?></td>
      </tr>
        <?php 
        
        if($gig_details->status!='0')
        {
        
        ?>
      <tr>
      <th scope="row">Rating</th>
        <td>
        <?php
        if($gig_rating==1)
        {
        
        ?>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
        
        <?php
        }
        if($gig_rating==2)
        {
        ?>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
        
        <?php
        }
        if($gig_rating==3)
        {
        
        ?>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
        
        <?php }if($gig_rating==4)
        { ?>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
        
        <?php }
        if($gig_rating==5)
        {?>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
        <?php } ?>
        
        </td>
        </tr>
        <?php 

        } else {
        
        ?>
        <tr>
            <td>
                <button type="button" class="btn btn-success" onclick="confirmActivate(<?php echo $Gig_Id; ?>)">Approve</button>
            </td>
            <td>
                <button type="button" class="btn btn-danger" onclick="confirmDeactivate(<?php echo $Gig_Id; ?>)">Declined</button>
            </td>
        </tr>
        
        <?php 

        } 
        
        ?>
</tbody>
</table>
</div>
</div>
<div class="col-lg-6 col-xl-3 col-md-6">
<div class="card rounded-card user-card" style="height:150px;width:150px;">
<div class="card-block" >
<div class="img-hover">

<?php 

$image = json_decode($gig_details->image); 
 
 $gig_image = $image->image_list[0]->thumnail;
//print_r($gig_image);die();

 if(!empty($gig_details->image)) { ?>

<img class="img-fluid img-radius" src="<?php echo base_url();?>/uploads/gig_image/<?php echo $gig_image; ?>" alt="round-img">

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

<?php 

if($gig_details->status!='0')
{

?>
    <div class="tab-pane" id="review" role="tabpanel">
<div class="card">
<div class="card-header">

</div>
<div class="card-block">
<div class="col-sm-12">
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
  if($value['order_rating']==1)
     {

     ?>
    <span class="fa fa-star checked"></span>
  <span class="fa fa-star"></span>
  <span class="fa fa-star"></span>
  <span class="fa fa-star"></span>
  <span class="fa fa-star"></span>


    <?php
      }
   if($value['order_rating']==2)
      {
     ?>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star"></span>
  <span class="fa fa-star"></span>
  <span class="fa fa-star"></span>
     <?php
    }
     if($value['order_rating']==3)
      {

   ?>
     <span class="fa fa-star checked"></span>
      <span class="fa fa-star checked"></span>
      <span class="fa fa-star checked"></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
 <?php }if($value['order_rating']==4)
      { ?>
      <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked "></span>
        <span class="fa fa-star "></span>
        <?php
    }
     if($value['order_rating']==5)
      {

   ?>

       <span class="fa fa-star checked"></span>
       <span class="fa fa-star checked"></span>
      <span class="fa fa-star checked"></span>
      <span class="fa fa-star checked"></span>
      <span class="fa fa-star checked "></span>
  


        <?php } ?>

<p class="m-b-0"><?php echo $value['order_review']?></p>

</div>
</li>
<hr>


<?php
$i++;   
}
?>
</ul>
</div>
</div>
</div>
</div>

<?php 

}

?>
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
$('#example').DataTable();
$('#example1').DataTable();
} );
</script>

<script type="text/javascript">

function confirmDeactivate(id)
{
    //var id=$("#deactivateUserId").val();
    
    $.ajax({
    
        url : '<?php echo site_url();?>admin/gigStatus',
        
        type : 'POST',
        
        dataType:"json",
        
        data :
        {
            gig_id:id,
            
            status:'3',
        },
        
        success:function(data) 
        {
        
            var status=data['status'];
            
            var message=data['message'];
            
            if(status==0)
            {
                toastr.warning(message,"Failed !!");
                
                setTimeout(function() {
                window.location.reload()
                }, 2000);
            
            }
            else
            {
                toastr.success(message,"Success !!");
                
                setTimeout(function() {
                    window.location.href="<?php echo site_url();?>admin/giglist";
                }, 2000);
            }
        },
        error:function(data) {
        }
    });  
}


function confirmActivate(id)
{
    //var id=$("#activateUserId").val();
    
    $.ajax({
    
        url : '<?php echo site_url();?>admin/gigStatus',
        
        type : 'POST',
        
        dataType:"json",
        
        data :
        {
            gig_id:id,
            
            status:2,
        },
        
        success:function(data) 
        {
            var status=data['status'];
            
            var message=data['message'];
            
            if(status==0)
            {
                toastr.warning(message,"Failed !!");
                
                setTimeout(function() {
                    window.location.reload()
                }, 2000);
            }
            else
            {
                toastr.success(message,"Success !!");
                
                setTimeout(function() {
                    window.location.href="<?php echo site_url();?>admin/giglist";
                }, 2000);
            }
        },
        error:function(data) {
        }
    });  
}

</script>