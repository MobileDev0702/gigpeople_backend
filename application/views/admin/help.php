<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script type="text/javascript">    
$( document ).ready(function() {

       document.getElementById("cmsMenu").className = "pcoded-hasmenu pcoded-trigger";
     document.getElementById("helpMenu").className = "active";
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
                                <h4>Help</h4>
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
                                <li class="breadcrumb-item"><a href="#!">Help</a>
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
                          <h5>Help List</h5>
                          <ul class="list-inline mb-0">
                            <li><a href="<?php echo site_url();?>admin/addhelp" class="btn btn-info round btn-min-width mr-1 mb-1 btn-bg-gradient-x-purple-blue" style=""  ><i class="ft-plus-circle"></i> Add New question</a></li>
                          </ul>
                        </div>

                        <div class="card-block">
                          <div class="dt-responsive table-responsive">
                            <table id="example" class="table table-striped table-bordered nowrap">
                              <thead>
                                <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Help Question</th>
                                <th>Help Answer</th>
                                <th>Action</th>
                                </tr>
                              </thead>
                            <tbody>
                                 <?php

                                        $i=1;
                                                           
                                        foreach ($help_list as $h) 
                                        {   

                                          ?>
                              <tr>
                              <td><?php echo $i;?></td>
                              <td><?php echo $h['category_name']; ?></td>
                              <td><?php echo wordwrap($h['help'],35,"<br>\n"); ?></td>
                              <td><?php echo wordwrap($h['description'],80,"<br>\n"); ?></td>
                              <td>                                  
                            
                              <a href="<?php echo site_url();?>admin/edithelp/<?php echo $h['help_id']?>" class="btn btn-info" ><i class="fa fa-pencil"></i></a>
                               <!-- <a href="<?php echo site_url();?>admin/helpview/<?php echo $h['help_id']?>" class="btn btn-info"  ><i class="fa fa-eye"></i></a> -->
                              <a href="#"  id="<?php echo $h['help_id']; ?>" class="btn btn-danger" data-toggle="modal"  data-target="#delete" onclick="delete1(this.id)"><i class="fa fa-trash-o"></i></a>
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
                      Are you sure want to Deactivate this Qusetion?
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
                Are you sure want to Activate this Question?
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
                Are you sure want to Delete this Question?
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
          <h4 class="modal-title" style=""> Add New Question</h4>
        </div>
        <form method="POST" enctype="multipart/form-data" id="addCategory">
        <div class="modal-body">          
            
                <table align="center">
                   <tbody>
                    <tr>
                    <td width="200">Help Category Type</td>
                    <td>      
                      <select name="select" id="select" style=" height:34px;" class="form-control" >
                        <option value="0">Select One Value Only</option>
                        <?php foreach 
                        ($help_category as $key => $value) 
                        {
                        ?>
                       <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                       <?php
                        }
                       ?>
                      </select>
                    </td>
                  </tr>
                 </tbody>
               </table> <br><br>   
                 <table align="center">
                   <tbody>
                    <tr>
                    <td width="200">Question</td>
                    <td><input type="text" name="name" id="name" class="form-control" required=""></td>
                  </tr>
                 </tbody>
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
          <h4 class="modal-title" style="">Edit Question</h4>
        </div>
        <form method="POST" enctype="multipart/form-data" id="editCategory">
           <input type="hidden" name="help_idE" id="help_idE" class="form-control" required="">
        <div class="modal-body">
                <table align="center">
                   <tbody>
                    <tr>
                    <td width="200">Help Category Type</td>
                    <td>      
                        <select name="select" id="select" style=" height:40px;" class="form-control" >
                        <option value="0">Select One Value Only</option>
                        <?php foreach 
                        ($help_category as $key => $value) 
                        {
                        ?>
                       <option value="<?php echo $value['id']; ?>"><?php echo $value['category']; ?></option>
                       <?php
                        }
                       ?>
                      </select>
                    </td>
                  </tr>
                 </tbody>
               </table> <br><br>   
                 <table align="center">
                   <tbody>
                    <tr>
                    <td width="200">Question</td>
                    <td><input type="text" name="nameE" id="nameE" class="form-control" required=""></td>
                  </tr>
                 </tbody>
               </table>       
                  
                <br><br>
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
      $("#addCategory").submit(function(event) {

        event.preventDefault();
        $.ajax({
              url : '<?php echo site_url();?>admin/addquestion',
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
            url : '<?php echo site_url();?>admin/questionStatus',
            type : 'POST',
            dataType:"json",
            data :
            {
               question_id:id,
               question_status:'3',
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
                      message="Question deleted successfully";            
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

    function edit(id)
    {
        $.ajax({
          url : '<?php echo site_url();?>admin/viewQuestion',
          type : 'POST',
          dataType:"json",
          data :
          {
             help_id:id,
          },
          success:function(data) 
          {
              var help_id=data['help_details']['help_id'];
              var help=data['help_details']['help'];
               var category=data['help_details']['category'];
              $("#help_idE").val(help_id);
              $("#nameE").val(help);
              $("#categoryE").val(category);
              

          },
          error:function(data) {
            alert("Something went wrong");
          }
      });  
    }

      $("#editCategory" ).submit(function( event ) {

        event.preventDefault();
        $.ajax({
              url : '<?php echo site_url();?>admin/editQuestion',
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
</script>

<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>