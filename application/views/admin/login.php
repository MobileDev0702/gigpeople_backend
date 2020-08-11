
    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                        <form class="md-float-material form-material" method="POST" id="login" enctype="multipart/form-data">
                            <div class="auth-box card">
                                <div class="card-block">
                                       <div class="text-center">
                                         <img src="<?php echo base_url();?>assets_backend/images/logo/applogo1.png" alt="logo.png" height="80" width="180">
                                       </div>
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Sign In</h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="email" name="email" id="email" class="form-control" placeholder=" Email Address" required>
                                        <span class="form-bar"></span>
                                    </div>
                                     <div class="col-12">
                                         <div class="checkbox-fade fade-in-primary d-">
                                            
                                            </div>
                                            <div class="forgot-phone text-right f-right">
                            
                                            </div>
                                     </div>
                                    <div class="form-group form-primary">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" >
                                        <span class="form-bar"></span>
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary d-">
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit" name="button" id="button" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign in</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>


<script type="text/javascript">
$("#login").submit(function(event) {
    
    event.preventDefault();
    
    $.ajax({
        url : '<?php echo site_url();?>Adminlogin/adminLogin',
        type : 'POST',
        dataType:"json",
        data :  $("#login").serialize(),
        
        success:function(data) 
        {
            var status=data['status'];
            var message=data['message'];
            
            if(status==0)
            {
                toastr.warning(message,"Failed !!");
            }
            else
            {
                toastr.success(message,"Success !!");
                setTimeout(function() {
                    window.location.href="<?php echo site_url();?>admin/dashboard";
                }, 2000);
            }
        },
        error:function(data) {
        }
    });  
});
</script>