<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$jobRoles = $jobRoles['data'];
$requirements = $requirements['data'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Data</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>includes/fastselect.min.css">
<script src="<?php echo base_url();?>includes/fastselect.standalone.js"></script>	
</head>
<body>

	<div class="container">
		<h2>Add Data</h2>
		<form action="/action_page.php">

			<div class="form-group">
				<label for="jobTitle">Job Title:</label> <input type="text"
					class="form-control" id="jobTitle" placeholder="Enter Job Title"
					name="jobTitle">
			</div>

			<div class="form-group">
				<label for="jobRole">Job Role:</label> <select class="form-control"
					id="jobRole" name="jobRole">
					<?php foreach ($jobRoles as $jobRole){echo "<option value=".$jobRole->id.">".$jobRole->role."</option>";}?>					
				</select>
			</div>

			<div class="form-group">
				<label for="url">URL:</label> <input type="text"
					class="form-control" id="url" placeholder="Enter URL" name="url">
			</div>

			<div class="form-group">
				<label for="requirements">Requirements:</label>
				<textarea class="form-control multipleInputDynamic" rows="5" id="requirements"
					name="requirements" placeholder="Enter Requirements" multiple data-url="suggestReq"></textarea>
			</div>

			<button type="submit" class="btn btn-default">Submit</button>
		</form>
	</div>

</body>
<script type="text/javascript">
$('.multipleInputDynamic').fastselect();
</script>


</html>
