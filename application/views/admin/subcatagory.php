<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script type="text/javascript">    
$( document ).ready(function() {


     document.getElementById("categoryMenu").className = "menu active";
});
</script>        
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
                                <h4>List Of categories</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="page-header-breadcrumb">
                            <ul class="breadcrumb-title">
                                <li class="breadcrumb-item"><a href="<?php echo site_url();?>admin/dashboard"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#!">Category</a>
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
                          <h5>Category List</h5>
                          <ul class="list-inline mb-0">
                            <li><button type="button" class="btn btn-info round btn-min-width mr-1 mb-1 btn-bg-gradient-x-purple-blue" style="" data-toggle="modal" data-target="#addModal" ><i class="ft-plus-circle"></i> Add New Category</button></li>
                          </ul>
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
                            <table id="example" class="table table-striped table-bordered nowrap">
                              <thead>
                                <tr>
                                <th>#</th>
                                <th>Category Icon</th>
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                              </thead>
                            <tbody>
                             <?php 

                                    $i=1;
                                    foreach ($subcategory_list as $key => $value) 
                                    {

                                      $CI =& get_instance();

                                      if($CI->getCategory($value['parent_category_id']==""))
                                      {
                                        $category_name=$value['category_name'];
                                      }
                                      else
                                      {

                                        $category_name=($CI->getCategory($value['parent_category_id'])!="") ? $CI->getCategory($value['parent_category_id'])."  &nbsp;>&nbsp;  ".$value['category_name'] : $value['category_name'] ;

                                      }

                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>

                                     

                                        <td><img src="<?php echo base_url()."uploads/category/".$value['category_icon'];?>" style="width:50px;height:50px;border-radius: 50%";
                                            alt=""></td>

                                            <td><?php echo $category_name;?></td>

                                        <td>
                                            <?php
                                            if($value['category_status']==1)
                                            {
                                            ?>
                                            <label class="label label-inverse-success">Active</label>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <label class="label label-inverse-danger">Inactive</label>
                                            <?php
                                            }
                                            ?>
                                                
                                        </td>
                                        <td>
                                           <?php
                                           if($value['category_status']==0)
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
                      Are you sure want to Deactivate this category?
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
                Are you sure want to Activate this category?
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
                Are you sure want to Delete this category?
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
          <h4 class="modal-title" style=""> Add New Category</h4>
        </div>
        <form method="POST" enctype="multipart/form-data" id="addCategory">
        <div class="modal-body">          
              <table align="center">
                  <tr height="40">
                    <td width="">
                    <div class="image-upload">
                        <label for="file-input">
                            <img src="<?php echo base_url();?>/uploads/admin/placeholder.png" style="width: 100px;height: 100px;border-radius: 50%" id="blash" alt=""/>
                        </label> 
                        <input id="file-input" type="file" onchange="readURL(this,'add');">
                        <input type="hidden" name="category_icon" id="category_icon" class="form-control">
                    </div>             
                    </td>
                  </tr>
                </table>
                <br><br>
                 <table align="center">
                   <tbody>
                    <tr>
                    <td width="200">Category Type</td>
                    <td>      
                      <select name="parent" id="parent" style=" height:34px;" class="form-control" >
                      </select>
                    </td>
                  </tr>
                 </tbody>
               </table> <br><br>   
                 <table align="center">
                   <tbody>
                    <tr>
                    <td width="200">Catagory Name</td>
                    <td><input type="text" name="name" id="name" class="form-control" required=""></td>
                  </tr>
                 </tbody>
               </table>                                   
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
          <h4 class="modal-title" style="">Edit Category</h4>
        </div>
        <form method="POST" enctype="multipart/form-data" id="editCategory">
        <div class="modal-body">
            <table align="center">
              <tr height="40">
                <td width="">
                <div class="image-upload">
                    <label for="file-input">
                        <img src="<?php echo base_url();?>/uploads/admin/placeholder.png" style="width: 100px;height: 100px;border-radius: 50%" id="blashE" alt=""/>
                    </label> 
                    <input id="file-inputE" type="file" onchange="readURL(this,'edit');">
                    <input type="hidden" name="category_iconE" id="category_iconE" class="form-control" required="">
                    <input type="hidden" name="category_idE" id="category_idE" class="form-control" required="">
                </div>                                                 
                </td>
                </tr>
              </table>
            <br><br>
               <table align="center">
                   <tbody>
                    <tr>
                    <td width="200">Category Type</td>
                    <td>      
                      <select name="parentE" id="parentE" style=" height:34px;" class="form-control" >
                      </select>
                    </td>
                  </tr>
                 </tbody>
               </table> <br><br>   
             <table align="center">
               <tbody>                    
                <tr>
                <td width="200">Category Name</td>
                <td><input type="text" name="nameE" id="nameE" class="form-control" required=""></td>
              </tr>                  
             </tbody></table>                                  
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

      function confirmFilter(id)
      {

          if(id=='1')
          {
              window.location.href="<?php echo site_url();?>admin/subadmin/1";
          }
          else if(id=='2')
          {
              window.location.href="<?php echo site_url();?>admin/subadmin/2";
          }
          else
          {

              window.location.href="<?php echo site_url();?>admin/subcategory";            
          }            
          
      }

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
        form_data.append("file_type", "category_image")
                
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
                       $("#category_icon").val(image_name);
                       $("#category_iconE").val(image_name);
                                                                            
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

   
$("#addCategory").submit(function(event) {

        event.preventDefault();

         
        $.ajax({
              url : '<?php echo site_url();?>admin/addSubCategory',
              type : 'POST',
              dataType:"json",
              data :  $("#addCategory").serialize(),              
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
                  else if(status==2)
                  {
                      toastr.info(message,"info !!");
                      setTimeout(function() {

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
          url : '<?php echo site_url();?>admin/viewSubCategory',
          type : 'POST',
          dataType:"json",
          data :
          {
             category_id:id,
          },
          success:function(data) 
          {
              var category_id=data['category_details']['id'];
              var parent_category=data['category_details']['parent_category_id'];
              var category_name=data['category_details']['category_name'];
              var category_icon=data['category_details']['category_icon'];

              $("#category_idE").val(category_id);
              $("#nameE").val(category_name);
              $("#parentE").val(parent_category);
              $("#category_iconE").val(category_icon);

              var url="<?php echo base_url(); ?>/uploads/category/"+category_icon;

              if(category_icon!="")
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

    $("#editCategory" ).submit(function( event ) {

        event.preventDefault();
        $.ajax({
              url : '<?php echo site_url();?>admin/editSubCategory',
              type : 'POST',
              dataType:"json",
              data :  $("#editCategory").serialize(),              
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
            url : '<?php echo site_url();?>admin/subcategoryStatus',
            type : 'POST',
            dataType:"json",
            data :
            {
               category_id:id,
               category_status:'2',
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
                      message="Category deleted successfully";            
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
          url : '<?php echo site_url();?>admin/subcategoryStatus',
          type : 'POST',
          dataType:"json",
          data :
          {
             category_id:id,
             category_status:'0',
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
          url : '<?php echo site_url();?>admin/subcategoryStatus',
          type : 'POST',
          dataType:"json",
          data :
          {
             category_id:id,
             category_status:'1',
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

<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>