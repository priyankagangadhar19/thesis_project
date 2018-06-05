<!DOCTYPE html>
<html>
<head>
	<title>Requirements Category List</title>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
	
	<script src="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
	
	<script src="http://cdn.jsdelivr.net/cookiejs/0.1/cookie.min.js"></script>
    <script src="http://cdn.jsdelivr.net/storagejs/2.0/storage.js"></script>
</head>
<body>

<style>
.btn {
    margin: 0px 0px 0px 5px;
}
</style>


<div class="container">
	<h2>Requirements Category List</h2>


	<table id="item-list" class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
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
    $('#item-list').DataTable({
        "ajax": {
            url : "reqCategListJson",
            type : 'GET'
        },
        dom: 'l<"toolbar">frtip',
        initComplete: function(){
           $("div.toolbar")
              .html(' <button type="button" class="btn btn-info pull-right">Add Item</button> ');           
        }
    });

  //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'popup';     
    
    //make username editable
    $('#username').editable();
    
    //make status editable
    $('#status').editable({
        type: 'select',
        title: 'Select status',
        placement: 'right',
        value: 2,
        source: [
            {value: 1, text: 'status 1'},
            {value: 2, text: 'status 2'},
            {value: 3, text: 'status 3'}
        ]
        /*
        //uncomment these lines to send data on server
        ,pk: 1
        ,url: '/post'
        */
    });

    $('#item-list').on('click', '#statusToggle', function (){
    	
        $.ajax({
            type: "POST",
            url: "reqcateglistStatusToggle",
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

</html>