<?php require_once 'includes/header.php'; ?>
<?php require_once 'php_action/fetchSize.php' ; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">size</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage sizes</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addsizeModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add size </button>
				</div> <!-- /div-action -->				
				
				<table class="table table-striped table-bordered" id="sizedata" >
					<thead>
						<tr>							
							<th>Size</th>
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
	  
	    <li><a type="button" data-toggle="modal" data-target="#editsizeModal" onclick="editSize('.$output['data'][$key][2].')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	   
	    <li><form name="monform" id="monform" method="GET" action="php_action/removeSize"><a href="php_action/removeSize.php?sizeId='.$output['data'][$key][2].'"value="'.$output['data'][$key][2].'" id="'.$output['data'][$key][2].'" onclick="sure();" name"btnSubmit"> <i class="glyphicon glyphicon-trash"></i> Remove</a></form></li>       
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

<div class="modal fade" id="addsizeModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" action="php_action/createsize.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add size</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-size-messages"></div>

	        <div class="form-group">
	        	<label for="sizeName" class="col-sm-3 control-label">Size: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="sizeName" placeholder="size" name="sizeName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	         	        
	        
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createsizeBtn" data-loading-text="Loading..." autocomplete="off">Save Changes</button>
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
<div class="modal fade" id="editsizeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" action="php_action/editsize.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit size</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-size-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-size-result">
		      	<div class="form-group">
		        	<label for="editsizeName" class="col-sm-3 control-label">Size: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editsizeName" placeholder="size Name" name="editsizeName" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->	         	        
		        
		      </div>         	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editsizeFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editsizeBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove size</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removesizeFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removesizeBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove brand -->
<script src="custom/js/size.js"></script>
<script>
	$(document).ready(function(){  
      $('#sizedata').DataTable();  
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