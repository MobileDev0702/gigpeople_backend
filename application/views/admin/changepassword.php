<script type="text/javascript">
    
$( document ).ready(function() {

    document.getElementById("passwordMenu").className = "menu active";
});
</script>
      <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page-header start -->
                                <div class="page-header">
                                    <div class="row align-items-end">
                                        <div class="col-lg-8">
                                            <div class="page-header-title">
                                                <div class="d-inline">
                                                    <h4>Change Password</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item"><a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> Dashboard</a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#!">Change Password</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Page-header end -->
                                   
                                    <!-- Page body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Basic Inputs Validation start -->
                                                <div class="card">
                                                    <div class="card-header">

                                                    </div>
                                                    <div class="card-block">
                                                        <form id="changePassword" method="post" action="" novalidate>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Old Password</label>
                                                                <div class="col-sm-10">
                                                                    <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Input old Password">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">New Password</label>
                                                                <div class="col-sm-10">
                                                                    <input type="password" class="form-control"  id="new_password"  name="new_password" placeholder="Input New Password">
                                                                    <span class="messages"></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2"></label>
                                                                <div class="col-sm-10">
                                                                    <button type="submit" class="btn btn-primary m-b-0">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page body end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    
    $( "#changePassword" ).submit(function( event ) {

        event.preventDefault();

        $.ajax({

              url : '<?php echo site_url();?>admin/changePasswordConfirm',

              type : 'POST',

              dataType:"json",

              data :  $("#changePassword").serialize(),
              
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
      });
</script>