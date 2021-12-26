<?php require_once 'includes/header.php'; ?>
<?php require_once 'php_action/fetchGender.php' ; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Gender</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Genders</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addGenderModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Gender </button>
				</div> <!-- /div-action -->				
				
				<table class="table table-striped table-bordered" id="genderdata">
					<thead>
						<tr>							
							<th>Gender Name</th>
							<th style="width:5%;">Options</th>
						</tr>
					</thead>
					<?php  
                          foreach ($output['data'] as $key => $value)
                          {  
                          	echo '  
                               <tr>  
                                    <td>'.$output['data'][$key][0].'</td>   
                                    <td>'.'<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	  
	    <li><a type="button" data-toggle="modal" data-target="#editGenderModal" onclick="editGender('.$output['data'][$key][2].')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	   
	    <li><form name="monform" id="monform" method="GET" action="php_action/removeGender"><a href="php_action/removeGender.php?genderId='.$output['data'][$key][2].'"value="'.$output['data'][$key][2].'" id="'.$output['data'][$key][2].'" onclick="sure();" name"btnSubmit"> <i class="glyphicon glyphicon-trash"></i> Remove</a></form></li>       
	  </ul>
	</div>'.'</td>
                               </tr>  
                               ';  

                          }
                          ?>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addGenderModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitGenderForm" action="php_action/createGender.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Gender</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-gender-messages"></div>

	        <div class="form-group">
	        	<label for="genderName" class="col-sm-3 control-label">Gender Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="genderName" placeholder="Gender" name="genderName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	         	        
	        
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createGenderBtn" data-loading-text="Loading..." autocomplete="off">Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / add modal -->

<!-- edit brand -->
<div class="modal fade" id="editGenderModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editGenderForm" action="php_action/editGender.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Gender</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-gender-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-gender-result">
		      	<div class="form-group">
		        	<label for="editGenderName" class="col-sm-3 control-label">Gender Name: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editGenderName" placeholder="Gender Name" name="editGenderName" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->	         	        
		        
		      </div>         	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editGenderFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editGenderBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / add modal -->
<!-- /edit brand -->

<!-- remove brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Gender</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeGenderFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeGenderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove brand -->

<script src="custom/js/gender.js"></script>
<script>
	$(document).ready(function(){  
      $('#genderdata').DataTable();  
 }); 
	function sure() {
     var x;
     if (confirm("Are you sure?") == true) {
        document.getElementById("monform").submit();
     } else {
         x = "You pressed Cancel!";
     }
     return x; 

}
</script>
<?php require_once 'includes/footer.php'; ?>