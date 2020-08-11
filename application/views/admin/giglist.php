<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


<script type="text/javascript">
$( document ).ready(function() {
document.getElementById("gigMenu").className = "active";
 $('#example').DataTable();
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
                                          <h4>Gigs</h4>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-4">
                                  <div class="page-header-breadcrumb">
                                      <ul class="breadcrumb-title">
                                          <li class="breadcrumb-item"><a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
                                          <li class="breadcrumb-item"><a href="#!">Gigs</a>
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
                                          <h5>Gig List</h5>
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
                                                    <th>User details</th>
                                                    <th>Category</th>
                                                    <th>Price</th>
                                                    <th>Posted At</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            $i=1;
                                            foreach ($gigs_details as $key => $value) 
                                            {
                                            $category_id = $value['category_id'];
                                            $user_id=$value['user_id'];
                                            $gig_id = $value['id'];
                                              
                                            $CI =& get_instance();
                                            ?>
                                            <tr>
                                            <td><?php echo $i;?></td>
                                            </td>
                                            <td><?php if(!empty( $CI->getUserDetails($user_id)->profile_picture))
                                            { ?>
                                            <img src="<?php echo base_url()?>uploads/profile/<?php echo $CI->getUserDetails($user_id)->profile_picture;?>" style="width:80px;height:80px;border-radius:50%"; alt="">
                                            
                                            <?php } else { ?>                                        
                                            <img src="<?php echo base_url(); ?>/uploads/profile/profile.png" style="width:80px;height:80px;border-radius:50%"; alt="">
                                            <?php } ?><br>
                                            <?php echo $CI->getUserDetails($user_id)->first_name;?><br>
                                            
                                            <?php echo $CI->getUserDetails($user_id)->email;?><br>
                                            <?php echo $CI->getUserDetails($user_id)->phone_no;?>
                                            
                                            </td>
                                            
                                            <td> <?php echo $CI->getCategory($category_id);?>
                                            </td>
                                            <td>$<?php echo $value['price'];?></td>
                                            <td><?php echo date('d /m /Y',strtotime($value['created_at']));?></td>
                                            <td>
                                            <?php
                                            if($value['status']==0)
                                            {
                                            ?>
                                                <label class="label label-inverse-danger">New / Pending</label>
                                            <?php
                                            }
                                            if($value['status']==2)
                                            {
                                            ?>
                                                <label class="label label-inverse-success">Pubilsh</label>
                                            <?php
                                            }
                                            if($value['status']==3)
                                            {
                                            ?>
                                                <label class="label label-inverse-warning">Denied</label>
                                            <?php
                                            }
                                            ?>
                                            
                                            </td>
                                            <td>
                                            
                                            <?php
                                            if($value['status']==0)
                                            {
                                            ?>
                                                <a href="<?php echo site_url();?>admin/gigview/<?php echo $value['id']?>" class="btn btn-info"  id="" onclick=""><i class="fa fa-eye"></i></button></a>

                                            <?php
                                            }
                                            if($value['status']==2)
                                            {
                                            ?>
                                                <button class="btn btn-warning" data-toggle="modal"  data-target="#deactivate" id="<?php echo $value['id'];?>" onclick="deactive(this.id)"><i class="fa fa-thumbs-down"></i></button>
                                                <a href="<?php echo site_url();?>admin/gigview/<?php echo $value['id']?>" class="btn btn-info"  id="" onclick=""><i class="fa fa-eye"></i></button></a>

                                            <?php
                                            }
                                            if($value['status']==3)
                                            {
                                            ?>
                                                <button class="btn btn-success" data-toggle="modal"  data-target="#activate" id="<?php echo $value['id'];?>" onclick="activate(this.id)"><i class="fa fa-thumbs-up"></i></button>
                                                <a href="<?php echo site_url();?>admin/gigview/<?php echo $value['id']?>" class="btn btn-info"  id="" onclick=""><i class="fa fa-eye"></i></button></a>

                                            <?php
                                            }
                                            ?>
                                            
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

          Are you sure want to Deactivate this Gig?
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

          Are you sure want to Approve this Gig?
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
<button type="button" class="btn btn-success" onclick="confirmActivate()">Yes</button>
</div>
</div>

</div>
</div>


<script type="text/javascript">

function confirmFilter(id)
{
    if(id=='1')
    {
        window.location.href="<?php echo site_url();?>admin/giglist/1";
    }
    else if(id=='2')
    {
        window.location.href="<?php echo site_url();?>admin/giglist/2";
    }
    else
    {
        window.location.href="<?php echo site_url();?>admin/giglist";            
    }           
}


function deactive(id)
{
    $("#deactivateUserId").val(id);
}

function confirmDeactivate()
{
    var id=$("#deactivateUserId").val();
    
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
                    window.location.reload()
                }, 2000);
            }
        },
        error:function(data) {
        }
    });  
}

</script>