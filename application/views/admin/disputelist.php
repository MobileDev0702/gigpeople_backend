<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
    
$( document ).ready(function() {
   document.getElementById("disputeMenu").className = "active";
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
                                                    <h4>Dispute</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item"><a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
                                                    <li class="breadcrumb-item"><a href="#!">Dispute List</a>
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
                                                    <h5>Dispute List</h5>
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
                                                   <th>Order Id</th>
                                                   <th>User Details</th>
                                                   <th>Comments</th>
                                                   <th>Posted At</th>
                                                   <th>Status</th>
                                                   <th>Action</th>
                                               </tr>
                                            </thead>
                                        <tbody>
                                            <?php 
                                            $i=1;
                                            foreach ($dispute_list as $key => $value) 
                                            {
                                                $user_id=$value->from_user_id;
                                                
                                                $Json = json_decode($value->details);
                                                
                                                $fromr_id   = $Json->from;
                                                $to_id  = $Json->to;
                                                $message    = $Json->message;
                                                $is_date    = $Json->is_date;
                                                
                                                $CI =& get_instance();
                                                ?>
                                                <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $value->order_id; ?></td>
                                                <td>
                                                    <img src="<?php echo base_url()?>uploads/profile/<?php echo !empty($CI->getUserDetails($user_id)->profile_picture) ? $CI->getUserDetails($user_id)->profile_picture : 'profile.png';?>" style="width:80px;height:80px;border-radius:50%";><br>
                                                    <?php echo $CI->getUserDetails($user_id)->first_name;?><br>
                                                    <?php echo $CI->getUserDetails($user_id)->email;?><br>
                                                    <?php echo $CI->getUserDetails($user_id)->phone_no;?>
                                                </td>
                                                <td> <?php echo $message; ?></td>
                                                <td><?php echo date('d /m /Y',strtotime($is_date)); ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($value->status==1)
                                                        {
                                                        ?>
                                                            <label class="label label-inverse-success">Completd</label>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                            <label class="label label-inverse-danger">Ongoing</label>
                                                        <?php
                                                        }
                                                    ?>                                            
                                                </td>
                                                <td>
                                                    <a href="<?php echo site_url();?>admin/disputeview/<?php echo $value->order_id; ?>" class="btn btn-info"  id="" onclick=""><i class="fa fa-eye"></i></button></a>
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


<script type="text/javascript">

function confirmFilter(id)
{
    if(id=='1')
    {
        window.location.href="<?php echo site_url();?>admin/dispute/1";
    }
    else if(id=='2')
    {
        window.location.href="<?php echo site_url();?>admin/dispute/2";
    }
    else
    {
        window.location.href="<?php echo site_url();?>admin/dispute";            
    }   
}

function confirm(id)
{
    var disputeList= $("#disputeList").serialize();
    
    if(disputeList=='dispute=1')
    {
        toastr.success("Buyer Winning !!");
        setTimeout(function() {
            window.location.reload()
        }, 2000);
    }
    else if(disputeList=='dispute=2')
    {
        toastr.success("Seller Winning !!");
        setTimeout(function() {
            window.location.reload()
        }, 2000);
    }       
    else
    {
        toastr.info("Please Select !!");
        setTimeout(function() {
            window.location.reload()
        }, 2000);
    }
}

$(document).ready(function() {
    $('#example').DataTable();
});
</script>
