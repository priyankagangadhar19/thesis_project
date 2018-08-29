<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html>
<head>
<title>Job Categories</title>

<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css"
	href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css" />
<script type="text/javascript"
	src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<script type="text/javascript"
	src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>

<script
	src="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

</head>
<body>

	<style>
.btn {
	margin: 0px 0px 0px 5px;
}
</style>


	<div class="container">
		<h2>Job Categories</h2>



		<table id="item-list"
			class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>ID</th>
					<th>Category</th>
					<th>Description</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>


			</tbody>
		</table>
	</div>


	<!--     <div class="container">

      <h1>X-editable starter template</h1>

      <div>
        <span>Username:</span>
        <a href="#" id="username" data-type="text" data-placement="right" data-title="Enter username">superuser</a>
      </div>
      
      <div>
        <span>Status:</span>
        <a href="#" id="status"></a>
      </div>

      
    </div> -->


</body>


<script type="text/javascript">
$(document).ready(function() {
	$("#error_msg").hide();
	$("#success_msg").hide();
	
    $('#item-list').DataTable({
        "ajax": {
            url : "jobCategJson",
            type : 'GET'
        },
        dom: 'l<"toolbar">frtip',
        initComplete: function(){
           $("div.toolbar")
              .html(' <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#addItem" id="addItemButton">Add Item</button> ');           
        }
    });

  //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'popup';     
    
    

    $('.modal-footer').on('click', '#addItemButtonAdd', function (){

    	var itemName        = $("input[name=itemName]").val();
    	var itemDescription = $('textarea#itemDescription').val();
    	var itemStatus      = $('#itemStatus').val();


    	if(itemName == ""){
    		$("#error_msg").show();
            $("#error_msg").fadeTo(5000, 500).slideUp(500, function(){
               		$("#error_msg").slideUp(500);
            });

            return false;
        }
        
    	$.ajax({
            type: "POST",
            url: "addJobCategItem",
            data: { 
            	itemName: itemName,
            	itemDescription: itemDescription,
            	itemStatus: itemStatus
            },
            success: function(result) {
                if(result == 'true'){
                    			$("#success_msg").show();
            					$("#success_msg").fadeTo(1000, 500).slideUp(500, function(){
               					$("#success_msg").slideUp(500);
           							 });
            					setTimeout( function(){ 
            						//location.reload();
            					  }  , 2000 );
          					  return true;
      			}
                else{alert('Error while updating data!');}
            },
            error: function(result) {
                alert('AJAX error!');
            }
        });
    });

$('#item-list').on('click', '#statusToggleButton', function (){
    	
        $.ajax({
            type: "POST",
            url: "jobcategStatusToggle",
            data: { 
                id: $(this).attr('itemId'),
                status: $(this).attr('action')
            },
            success: function(result) {
                if(result == 'true'){location.reload();}
                else{alert('Error while updating data!');}
            },
            error: function(result) {
                alert('AJAX error!');
            }
        });
    });


});


</script>



<!-- Modal -->
<div class="modal fade" id="addItem" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add an item</h4>
			</div>
			<div class="modal-body">
				<p>
					<label for="itemName">Item Name:</label> 
					<input type="text" class="form-control" id="itemName" name="itemName"> 
					<label for="itemDescription">Description:</label>
					<textarea class="form-control" rows="5" id="itemDescription" name="itemDescription"></textarea>
					<label for="itemStatus">Status:</label> <select class="form-control" id="itemStatus" name="itemStatus">
						<option value="active">Active</option>
						<option value="disabled">Disabled</option>
					</select>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary"  id="addItemButtonAdd">Add</button>
			</div>
		</div>
	</div>
		<div id="error_msg" class="alert alert-danger" role="alert" hidden="true">
  			<strong>Oh snap!</strong> <a href="#" class="alert-link">Item Name can't be empty</a> add Item Name and try adding again.
		</div>
		
		<div id="success_msg" class="alert alert-success" role="alert" hidden="true">
  			<strong>Success!</strong> Item added to database!.
		</div>
</div>

</html>