<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>-->
       
<style>
  .list-inline
  {
    margin-left:650px;
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
                                <h4>List Of Banners</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="page-header-breadcrumb">
                            <ul class="breadcrumb-title">
                                <li class="breadcrumb-item"><a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#!">Banner</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
              </div>

  <!-- Page-body start -->
              <div class="page-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card">
                        
                        <div class="card-header">
                          <h5>Banner List</h5>
                          <ul class="list-inline mb-0">
                            <li><button type="button" class="btn btn-info round btn-min-width mr-1 mb-1 btn-bg-gradient-x-purple-blue" style="" data-toggle="modal" data-target="#addModal" ><i class="ft-plus-circle"></i> Add New Banner</button></li>
                          </ul>
                        </div>

                        <div class="card-block">
                          <div class="dt-responsive table-responsive">
                            <table id="example" class="table table-striped table-bordered nowrap">
                              <thead>
                                <tr>
                                <th>#</th>
                                <th width="30%">Banner Image</th>
                                <th width="30%">Status</th>
                                <th width="25%">Action</th>
                                </tr>
                              </thead>
                            <tbody>

                              <?php 

                      $i=1;
                      foreach ($banner_list as $key => $value) 
                      {
                      ?>
                      <tr>
                          <td><?php echo $i;?></td>

                          <td><img src="<?php echo base_url()."uploads/banner_images/".$value['banner_image'];?>" style="width:200px;height:100px;";
                              alt=""></td>

                          <td>
                              <?php
                              if($value['status']==1)
                              {
                              ?>
                              <label class="label label-inverse-success">Active</label>
                              <?php
                              }
                              else
                              {
                              ?>
                              <label class="label label-inverse-warning">Inactive</label>
                              <?php
                              }
                              ?>
                                  
                          </td>
                          <td>
                             <?php
                             if($value['status']==0)
                             {
                              ?>
                               <a href="#" class="btn btn-success" data-toggle="modal" data-target="#activate" id="<?php echo $value['id'];?>" onclick="activate(this.id)"><i class="fa fa-thumbs-up"></i></a>                                     
                            <?php
                             }
                             else
                             {
                             ?>
                              <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#deactivate" id="<?php echo $value['id'];?>" onclick="deactive(this.id)"><i class="fa fa-thumbs-down"></i></a>
                       
                           <?php
                            }
                            ?>

                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editModal" id="<?php echo $value['id'];?>" onclick="edit(this.id)"><i class="fa fa-pencil"></i></a>

                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete" id="<?php echo $value['id'];?>" onclick="delete1(this.id)"><i class="fa fa-trash-o"></i></a>
                           
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

  <!-- Page-body end -->




    <!-- Deactivate Modal -->
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
                      Are you sure want to Deactivate this Banner?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-success" onclick="confirmDeactivate()">Yes</button>
          </div>
        </div>      
      </div>
    </div>

    <!-- Activate Modal -->
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
                Are you sure want to Activate this Banner?
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
                Are you sure want to Delete this Banner?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-success" onclick="confirmDelete()">Yes</button>
          </div>
        </div>      
      </div>
    </div>

  <!-- Add Modal -->
  <div class="modal fade" id="addModal" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="display: block;background-color:#2dcee3">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style=""> Add New Banner</h4>
        </div>
        <form method="POST" enctype="multipart/form-data" id="addBanner">
        <div class="modal-body">          
              <table align="center">
                  <tr height="40">
                    <td width="">
                    <div class="image-upload">
                        <label for="file-input">
                            <img src="<?php echo base_url();?>/uploads/banner_images/images.jpg" style="width: 200px;height: 100px;border-radius:10%" id="blash" alt="" >

                        </label> 
                        <input id="file-input" type="file" onchange="readURL(this,'add');" required="please select image">
                        <input type="hidden" name="banner_icon" id="banner_icon" class="form-control" required="">
                    </div>             
                    </td>
                  </tr>
                </table>
                <br><br>                                 
           </div>              
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
             <input type="submit" class="btn btn-success" id="addSave" value="Save">
          </div>
        </form>
      </div>      
    </div>
  </div>

  <div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="display: block;background-color:#2dcee3">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="">Edit Banner</h4>
        </div>
        <form method="POST" enctype="multipart/form-data" id="editBanner">
        <div class="modal-body">
            <table align="center">
              <tr height="40">
                <td width="">
                <div class="image-upload">
                    <label for="file-input">
                         <img src="<?php echo base_url();?>/uploads/banner_images/images.jpg" style="width: 200px;height: 100px;border-radius:10%" id="blashE" alt=""/>
                    </label> 
                    <input id="file-inputE" type="file" onchange="readURL(this,'edit');">
                    <input type="hidden" name="banner_iconE" id="banner_iconE" class="form-control" required="">
                    <input type="hidden" name="banner_idE" id="banner_idE" class="form-control" required="">
                </div>                                                 
                </td>
                </tr>
              </table>
            <br><br>                                  
          </div>              
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>          
          <input type="submit" class="btn btn-success" id="update" value="update">
        </div>
        </form>
      </div>      
    </div>
  </div>
  
  
  <script type="text/javascript">    
$( document ).ready(function() {

       document.getElementById("bannerMenu").className = "menu active";
       
        $('#example').DataTable();
       
      
});
</script> 
<script type="text/javascript">

    function readURL(input,type) 
    {
        if(type=="add")
        {          
            var doc_file = $("#file-input").prop("files")[0]; 
        }
        else
        {
            var doc_file = $("#file-inputE").prop("files")[0]; 
        }

        var form_data = new FormData(); 
        form_data.append("file_name", doc_file)
        form_data.append("file_type", "banner_images")
                
        $.ajax({
                url : '<?php echo site_url();?>Admin/doUpload',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                async:false,
                success: function(data)
                {
                       var image_name=data['file_name'];
                       var image_url=data['file_url'];
                       $("#banner_icon").val(image_name);
                       $("#banner_iconE").val(image_name);
                                                                            
                       if (input.files && input.files[0]) 
                       {
                          var reader = new FileReader();
                          reader.onload = function (e) {

                            $('#blash').attr('src', e.target.result).width(200).height(100);
                            $('#blashE').attr('src', e.target.result).width(200).height(100);
                          };
                        reader.readAsDataURL(input.files[0]);
                       }                                                    
                },
                error: function(data) 
                {
                    alert("Something went wrong");
                }          
          });  
    }

   
$("#addBanner").submit(function(event) {

        event.preventDefault();
        $.ajax({
              url : '<?php echo site_url();?>admin/addBanner',
              type : 'POST',
              dataType:"json",
              data :  $("#addBanner").serialize(),              
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
                alert("Something went wrong");
              }
          });  
    });

    function edit(id)
    {
        $.ajax({
          url : '<?php echo site_url();?>admin/viewBanner',
          type : 'POST',
          dataType:"json",
          data :
          {
             banner_id:id,
          },
          success:function(data) 
          {
              var banner_id=data['banner_details']['id'];
              var banner_icon=data['banner_details']['banner_image'];

              $("#banner_idE").val(banner_id);
              $("#banner_iconE").val(banner_icon);

              var url="<?php echo base_url(); ?>/uploads/banner_images/"+banner_icon;

              if(banner_icon!="")
              {
                  $('#blashE')
                      .attr('src', url)
                      .width(200)
                      .height(100);
              }
          },
          error:function(data) {
            alert("Something went wrong");
          }
      });  
    }

    $("#editBanner" ).submit(function( event ) {

        event.preventDefault();
        $.ajax({
              url : '<?php echo site_url();?>admin/editBanner',
              type : 'POST',
              dataType:"json",
              data :  $("#editBanner").serialize(),              
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
                alert("Something went wrong");
              }
          });    
    });

    function delete1(id)
    {
      $("#deleteId").val(id);
    }
    function confirmDelete()
    {
        var id=$("#deleteId").val();
          $.ajax({
            url : '<?php echo site_url();?>admin/bannerStatus',
            type : 'POST',
            dataType:"json",
            data :
            {
               banner_id:id,
               banner_status:'2',
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
                      message="Banner deleted successfully";            
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
        
    function deactive(id)
    {
        $("#deactivateUserId").val(id);
    }

    function confirmDeactivate()
    {
        var id=$("#deactivateUserId").val();
        $.ajax({
          url : '<?php echo site_url();?>admin/bannerStatus',
          type : 'POST',
          dataType:"json",
          data :
          {
             banner_id:id,
             banner_status:'0',
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
            alert("Something went wrong");
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
          url : '<?php echo site_url();?>admin/bannerStatus',
          type : 'POST',
          dataType:"json",
          data :
          {
             banner_id:id,
             banner_status:'1',
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
            alert("Something went wrong");
          }
      });          
    }
</script>

