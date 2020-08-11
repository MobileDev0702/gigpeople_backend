<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() 
    {
        $('#example').DataTable();
        document.getElementById("buyerMenu").className = "active";
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
  <h4>Buyer List</h4>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item"><a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
     <li class="breadcrumb-item"><a href="#!">Buyer List</a>
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
                    <h5>Buyer List</h5>
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
                   <th>Profile Image</th>
                   <th>Name</th>
                   <th>Contact Number</th>
                   <th>Email Id</th>
                   <th>Mobile Verification</th>
                   <th>Email Verification</th>
                   <th>Country</th>
                   <th>Status</th>
                   <th>Action</th>
                </tr>
              </thead>
          <tbody>
<?php 
$i=1;
foreach ($buyer_details as $key => $value) 
{
    $user_id = $value['id'];
?>

<tr>
    <td><?php echo $i;?></td>
    <td><img src="<?php echo base_url()?>uploads/profile/<?php echo !empty($value['profile_picture']) ? $value['profile_picture'] : 'profile.png';?>" style="width:80px;height:80px;border-radius:50%";></td>
    
    <td><?php echo $value['first_name'];?></td>
    
    <td><?php echo $value['phone_no'];?></td>
    
    <td><?php echo $value['email'];?></td>
    
    <td>
    <?php if($value['is_mobile_verified']=='1') { ?>
    
        <label class="label label-inverse-success">Verified</label>
    
    <?php } else { ?>
    
        <label class="label label-inverse-warning">Unverified</label>
    
    <?php } ?>
    </td>
    
    <td>
    <?php if($value['is_email_verified']=='1') { ?>
    <label class="label label-inverse-success">Verified</label>
    <?php } else { ?>
    <label class="label label-inverse-warning">Unverified</label>
    <?php } ?>
    </td>
    
    <td><?php echo $value['country'];?></td>
    
    <td>
    <?php
    if($value['account_status']==0)
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
    <td>
        <?php
        if($value['account_status']==1)
        {
        ?>
        <button class="btn btn-success" data-toggle="modal"  data-target="#activate" id="<?php echo $user_id;?>" onclick="activate(this.id)"><i class="fa fa-thumbs-up"></i></button>
        </div>
        <?php
        }
        else
        {
        ?>
        <button class="btn btn-warning" data-toggle="modal"  data-target="#deactivate" id="<?php echo $user_id;?>" onclick="deactive(this.id)"><i class="fa fa-thumbs-down"></i></button>
        <?php
        }
        ?>
        <a href="<?php echo site_url();?>admin/buyerview/<?php echo $user_id?>" class="btn btn-info"  id="" onclick=""><i class="fa fa-eye"></i></button></a>
        
        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete" id="<?php echo $user_id;?>" onclick="delete1(this.id)"><i class="fa fa-trash-o"></i></a>
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



<!-- Modal -->
<div class="modal fade" id="deactivate" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="display: block;background-color:#2dcee3">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="">Confirmation</h4>
</div>
<div class="modal-body">
<input type="hidden" name="deactivateUserId" id="deactivateUserId">

Are you sure want to Deactivate this User Account?

<b>Note:</b>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
<button type="button" class="btn btn-success" onclick="confirmDeactivate()">Yes</button>
</div>
</div>

</div>
</div>

<!-- Modal -->
<div class="modal fade" id="activate" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="display: block;background-color:#2dcee3">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="">Confirmation</h4>
</div>
<div class="modal-body">
<input type="hidden" name="activateUserId" id="activateUserId">

Are you sure want to Activate this User Account?
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
<button type="button" class="btn btn-success" onclick="confirmActivate()">Yes</button>
</div>
</div>

</div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete" role="dialog">
<div class="modal-dialog">    
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="display: block;background-color:#2dcee3">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="">Confirmation</h4>
</div>
<div class="modal-body">
<input type="hidden" name="deleteId" id="deleteId">
Are you sure want to Delete this User Account?
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
<button type="button" class="btn btn-success" onclick="confirmDelete()">Yes</button>
</div>
</div>      
</div>
</div>




<script type="text/javascript">

function deactive(id)
{
$("#deactivateUserId").val(id);
}
function confirmDeactivate()
{
var id=$("#deactivateUserId").val();

$.ajax({

url : '<?php echo site_url();?>admin/userStatus',

type : 'POST',

dataType:"json",

data :
{

user_id:id,

account_status:'0',

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
    window.location.reload()
    }, 2000);






}



},
error:function(data) {
}
});  


}
function activate(id)
{
$("#activateUserId").val(id);
}
function confirmActivate()
{
var id=$("#activateUserId").val();

$.ajax({

url : '<?php echo site_url();?>admin/userStatus',

type : 'POST',

dataType:"json",

data :
{

user_id:id,

account_status:'0',

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
    window.location.reload()
    }, 2000);
}

},
error:function(data) {
}
});  


}

function delete1(id)
{
$("#deleteId").val(id);
}
function confirmDelete()
{
var id=$("#deleteId").val();
$.ajax({
url : '<?php echo site_url();?>admin/userStatus',
type : 'POST',
dataType:"json",
data :
{
user_id:id,

account_status:'3',

buyer:'1',

 
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
message="Deleted Successfully";            
toastr.success(message,"Success !!");
setTimeout(function() {
  window.location.reload()
  }, 2000);
}
},
error:function(data) {
alert("Something went wrong");
}
});  
}

function confirmFilter(id)
{

if(id=='1')
{
window.location.href="<?php echo site_url();?>admin/buyerlist/1";
}
else if(id=='2')
{
window.location.href="<?php echo site_url();?>admin/buyerlist/2";
}
else
{
window.location.href="<?php echo site_url();?>admin/buyerlist";         
}
}
</script>
