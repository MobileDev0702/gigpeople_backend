<script type="text/javascript">
    
$( document ).ready(function() {

    document.getElementById("settingMenu").className = "menu active";
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
                                    <h4>Settings</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item"><a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#!">Settings</a>
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
                                      <form class="md-float-material form-material" method="POST" id="SettingsUpdate" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="admin_name" id="admin_name" value="<?php echo $admin_details->admin_name?>" placeholder="Input Name">
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" value="<?php echo $admin_details->email?>" id="admin_email"  name="admin_email" placeholder="Enter valid e-mail address">
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Commission %</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="commission_per"   name="commission_per" value="<?php echo $admin_details->commission_per?>" placeholder="Enter Commision %">
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2"></label>
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-primary m-b-0">update</button>
                                                </div>
                                            </div>
                                        </form>
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

$("#SettingsUpdate").submit(function( event ) {

    event.preventDefault();
    
    $.ajax({
        url : '<?php echo site_url();?>admin/adminProfile',
        type : 'POST',
        dataType:"json",
        data :  $("#SettingsUpdate").serialize(),
        
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