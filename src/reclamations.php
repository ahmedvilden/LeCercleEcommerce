<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'php_action/fetchReclamation.php' ; ?>
<?php require_once 'includes/header.php'; ?>
<style type="text/css">
table.dataTable tbody td {
  vertical-align: middle;
}
</style>
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Product</li>
		</ol>



		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Product</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

						
				
				<table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="productsdata">
					<thead>
						<tr>							
							<th>Sent date</th>
							<th >Sender full name</th>
							<th>Email</th>
							<th>Subject</th>
							<th width="60%">Message</th>
							<th style="width:15%;">Reply</th>
						</tr>
					</thead>
					<?php  
                          foreach ($output['data'] as $key => $value)
                          {  
                          	echo '  
                               <tr> 
                               		
                               		<td> '.$output['data'][$key][6].'</div> </td>                                 		
                                    <td>'.$output['data'][$key][1] .' '. $output['data'][$key][2].'</td>
                                    <td>'.$output['data'][$key][3].'</td>
                                    <td>'.$output['data'][$key][4].'</td>    
                                    <td>'.$output['data'][$key][5].'</td>  
                                    <td> <a href="https://mail.google.com/mail/u/0/#inbox?compose=new"><button class="btn btn-primary">Reply</button></a> </td>
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


<!-- add product -->
<script>
	$(document).ready(function(){  
      $('#productsdata').DataTable({
      	"columnDefs": [
        {"className": "dt-body-center", "targets": "_all"}
      ]
      });  
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
function sure2() {
     var x;
     if (confirm("Are you sure?") == true) {
        document.getElementById("monform2").submit();
     } else {
         x = "You pressed Cancel!";
     }
     return x;
}
</script>
<?php require_once 'includes/footer.php'; ?>