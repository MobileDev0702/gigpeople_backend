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
                                                    <li class="breadcrumb-item">
                                                        <a href="<?php echo site_url();?>/admin/dashboard"> <i class="fa fa-dashboard"></i> </a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="<?php echo site_url();?>/admin/dashboard">Dashboard</a>
                                                    </li>
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
                                          <div class="card-block">
                                             <div class="dt-responsive table-responsive">
                                               <table id="example"
                                                    class="table table-striped table-bordered nowrap ">
                                                <thead>
                                                <tr>
                                                   <th>#</th>
                                                   <th>Order Id</th>
                                                   <th>Buyer Details</th>
                                                   <th>Seller Details</th>
                                                   <th>Comments</th>
                                                   <th>Posted At</th>
                                                   <th>Action</th>
                                               </tr>
                                            </thead>
                                          <tbody>
                                                         <?php 
                                $i=1;
                                foreach ($dispute_list as $key => $value) 
                                {
                                               $user_id=$value['buyer_id'];

                                               $seller_id=$value['dipute_seller_id'];

                                                $CI =& get_instance();
                                ?>
                               
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $value['product_order_id']?></td>
                                    <td><?php if(!empty( $CI->getUserDetails($user_id)->profile_picture)) { ?>
                                                   <img src="<?php echo base_url()?>uploads/profile/<?php echo $CI->getUserDetails($user_id)->profile_picture;?>" style="width:80px;height:80px;border-radius:50%"; alt="">
                                                   <?php } else { ?>                                        
                                                    <img src="<?php echo base_url(); ?>/uploads/profile/profile.png" style="width:80px;height:80px;border-radius:50%"; alt="">
                                                  <?php } ?><br>
                                                   <?php echo $CI->getUserDetails($user_id)->first_name;?><br>

                                                  <?php echo $CI->getUserDetails($user_id)->email;?><br>
                                                 <?php echo $CI->getUserDetails($user_id)->phone_no;?>
                                     </td>
                                    <td> <?php echo $value['comments']?>
                                      
                                            
                                    </td>
                                    <td><?php echo date('d /m /Y',strtotime($value['posted_at']));?>
                              





                                 </td>
                                 <td><a href="<?php echo site_url();?>/users/gigview/<?php echo $value['id']?>" class="btn btn-info"  id="" onclick=""><i class="fa fa-eye"></i></button></a></td>
                                    
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

                    Are you sure want to Deactivate?
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

                    Are you sure want to Activate?
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
                Are you sure want to Delete?
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

              //url : '<?php echo site_url();?>/users/userStatus',

              type : 'POST',

              dataType:"json",

              data :
              {

                 user_id:id,

                 account_status:'2',

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

              //url : '<?php echo site_url();?>/users/userStatus',

              type : 'POST',

              dataType:"json",

              data :
              {

                 user_id:id,

                 account_status:'1',

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
             //url : '<?php echo site_url();?>/users/userStatus',
            type : 'POST',
            dataType:"json",
            data :
            {
                user_id:id,

                account_status:'3',
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
    </script>










 <script>
        $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
