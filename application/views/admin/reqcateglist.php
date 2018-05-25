<?php

// print_r($jsonList);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Required Category List</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
</head>
<body>
	<h2>Required Category List</h2>
	<table id="reqCategList-table">
		<thead>
			<tr>
				<td>ID</td>
				<td>Name</td>
				<td>Description</td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</body>
<script type="text/javascript">
$(document).ready(function(){
    $('#reqCategList-table').DataTable( {
        "ajax": 'reqCategListJson',
        "dataSrc": '',
         "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "description" }
        ]
    });
});
</script>

</html>