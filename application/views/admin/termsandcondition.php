
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets_backend/editor/samples.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets_backend/editor/neo.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets_backend/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets_backend/icon/icofont/css/icofont.css">
    <!-- feather Awesome -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets_backend/icon/feather/css/feather.css">
<script src="<?php echo base_url();?>assets_backend/editor/ckeditor.js"></script>
<script src="<?php echo base_url();?>assets_backend/editor/sample.js"></script>
<script src="<?php echo base_url();?>assets_backend/editor/sample1.js"></script>
<script src="<?php echo base_url();?>assets_backend/editor/sample2.js"></script>
<script src="<?php echo base_url();?>assets_backend/editor/sample3.js"></script>
       

<script type="text/javascript">
    
$( document ).ready(function() {

    document.getElementById("cmsMenu").className = "pcoded-hasmenu pcoded-trigger";
     document.getElementById("termsMenu").className = "active";
});
</script>         <!--  for modals -->


 <!--  for modals -->
<style>
  .btn-md
  {
    margin-left:40px;

    height:40px;
    
    width:auto;
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
                                          <h4>Terms&Conditions</h4>
                                      </div>
                                  </div>
                              </div>
                          <div class="col-lg-4">
                              <div class="page-header-breadcrumb">
                                 <ul class="breadcrumb-title">
                                      <li class="breadcrumb-item">
                                          <a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> </a>
                                      </li>
                                      <li class="breadcrumb-item"><a href="">CMS</a>
                                        </li>
                                      <li class="breadcrumb-item"><a href="#!">Terms&Conditions</a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
                 <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                             <div class="card">
                                  <div class="card-header">
                                     <h5>Terms&Condition</h5>
                                  </div>
                            <div class="card-block">
                               <form class="form" method="POST" id="termsAdd">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <div class="adjoined-bottom">
                                                <div class="grid-container">
                                                     <div class="grid-width-100">
                                                          <textarea name="content" class="editor" id="editor" ><?php echo $admin_details->terms?></textarea>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="form-actions">
                                        <button class="btn btn-success btn-md"><i class="icofont icofont-upload-alt"></i>Update</button>
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

    $( "#termsAdd" ).submit(function( event ) {

        event.preventDefault();

        var terms=CKEDITOR.instances.editor.getData();


       
               $.ajax({

              url : '<?php echo site_url();?>admin/updateTerms',

              type : 'POST',

              dataType:"json",

               
              data:
              {
                  
                  terms: CKEDITOR.instances.editor.getData(),
                  
                                    
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


       

       
        
  
});







    </script>


  
<script>
  initSample();
  initSample1();
  initSample2();
  initSample3();
</script>