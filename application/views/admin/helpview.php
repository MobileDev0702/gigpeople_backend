<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="<?php echo base_url();?>/admin/assets/editor/samples.css">
<link rel="stylesheet" href="<?php echo base_url();?>/admin/assets/editor/neo.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/admin/assets/icon/themify-icons/themify-icons.css">

<!-- ico font -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/admin/assets/icon/icofont/css/icofont.css">

<!-- feather Awesome -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/admin/assets/icon/feather/css/feather.css">
<script src="<?php echo base_url();?>/admin/assets/editor/ckeditor.js"></script>
<script src="<?php echo base_url();?>/admin/assets/editor/sample.js"></script>
<script src="<?php echo base_url();?>/admin/assets/editor/sample1.js"></script>
<script src="<?php echo base_url();?>/admin/assets/editor/sample2.js"></script>
<script src="<?php echo base_url();?>/admin/assets/editor/sample3.js"></script>

<script type="text/javascript">
    
$( document ).ready(function() {

    document.getElementById("cmsMenu").className = "pcoded-hasmenu pcoded-trigger";
     document.getElementById("helpMenu").className = "active";
});
</script> 
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
                                     <h4>Help & Support</h4>
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
                                 <li class="breadcrumb-item"><a href="#!">Help and Support</a>
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
                                <h5>Help and Support</h5>
                              </div>
                              <div class="card-block">
                                 <form class="form" method="POST" id="helpAdd">
                                     <div class="form-body">
                                        <div class="form-group">
                                           <div class="adjoined-bottom">
                                              <div class="grid-container">
                                                  <div class="grid-width-100">
                                                    <input type="hidden" id="help_id" name="help_id" value="<?php echo $help_view->help_id?>">
                                                     <textarea name="content" class="editor" id="editor" ><?php echo $help_view->description?></textarea>
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

    $( "#helpAdd" ).submit(function( event ) {

        event.preventDefault();

        var help=CKEDITOR.instances.editor.getData();

        var id=$("#help_id").val();

        //alert(id);


       
               $.ajax({

              url : '<?php echo site_url();?>admin/updateHelp',

              type : 'POST',

              dataType:"json",

               
              data:
              {
                  
                  help: CKEDITOR.instances.editor.getData(),

                  help_id:id
                  
                                    
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
