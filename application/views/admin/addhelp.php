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
     document.getElementById("helpMenu").className = "active";
});
</script> 
       <!--  for modals -->
<style>
  .btn-md
  {
    margin-left:180px;

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
                                 <li class="breadcrumb-item"><a href="#!">Help & Support</a>
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
                                <h5>Help & Support</h5>
                              </div>
                              <div class="card-block">
                                 <form class="form" method="POST" id="helpAdd">
                                     <div class="form-body">
                                        <div class="form-group">
                                           <div class="adjoined-bottom">
                                              <div class="grid-container">
                                                  <div class="grid-width-100">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Category Type</label>
                                                        <div class="col-sm-8">
                                                            
                                                            <select name="parent" id="parent" class="form-control">
                                                            </select>
                                                        </div>
                                                      </div>
                                                     <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Question</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="question" id="question" value="" placeholder="Input Question">
                                                            <span class="messages"></span>
                                                        </div>
                                                      </div>
                                                       <div class="form-group row">
                                                         <label class="col-sm-2 col-form-label">Answer</label>
                                                          <div class="col-sm-8">
                                                          <textarea name="content" class="editor" id="editor" ></textarea>
                                                       </div>
                                                     </div>
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


        $( function() {

          categoryAutocomplete();


        });

        function categoryAutocomplete()
        {
          $.ajax({

              url : '<?php echo site_url();?>admin/categoryDropDown',

              type : 'POST',

              dataType:"json",

              
              
              success:function(data) 
              {

                    var length=data['category_list'].length;

                    $("#parent").append("<option value='0'>Select Parent category</option>");
                    $("#parentE").append("<option value='0'>Select Parent category</option>");

                    for(var i=0;i<=length;i++)
                    {

                          $("#parent").append("<option value='"+data['category_list'][i]['id']+"'>"+data['category_list'][i]['category_name']+"</option>")
                          $("#parentE").append("<option value='"+data['category_list'][i]['id']+"'>"+data['category_list'][i]['category_name']+"</option>")
                    }

              },
              error:function(data) {
              }
          });  

        }

    $( "#helpAdd" ).submit(function( event ) {

        event.preventDefault();

        var terms=CKEDITOR.instances.editor.getData();

        var question=$("#question").val();

        var type=$("#parent").val();


       
               $.ajax({

              url : '<?php echo site_url();?>admin/addquestion',

              type : 'POST',

              dataType:"json",

               
              data:
              {
                  
                  help: CKEDITOR.instances.editor.getData(),

                  question:question,

                  parent:type,
                  
                                    
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
                                    window.location.href="<?php echo site_url();?>admin/help";
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
