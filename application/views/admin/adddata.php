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
</head>
<body>


<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="dashboard">ThesisName</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="dashboard">Dashboard</a></li>
            <li><a href="jobcateg">Job Category</a></li>
            <li><a href="jobroles">Job Role</a></li>
            <li><a href="reqcateglist">Req Categ List</a></li>
            <li><a href="reqlist">Req List</a></li>
            <li class="active"><a href="adddata">Add Data</a></li>
        </ul>
    </div>
</nav>


	<div class="container">
		<h2>Add Data</h2>
		<form id="addDataForm" action="saveRawData" method="post">

			<div class="form-group">
				<label for="jobTitle">Job Title:</label> <input type="text"
					class="form-control" id="jobTitle" placeholder="Enter Job Title"
					name="jobTitle" required="required">
			</div>

			<div class="form-group">
				<label for="jobRole">Job Role:</label> <select class="form-control"
					id="jobRole" name="jobRole">
					<?php foreach ($jobRoles as $jobRole){echo "<option value=".$jobRole->id.">".$jobRole->role."</option>";}?>					
				</select>
			</div>

			<div class="form-group">
				<label for="url">URL:</label> <input type="text"
					class="form-control" id="url" placeholder="Enter URL" name="url" required="required">
			</div>

			<div class="form-group">
				<label for="requirements">Requirements:</label>
                <select class="form-control" style="height: auto;padding-bottom: 5%;" id="requirements" name="requirements[]" multiple="multiple">
                    <?php foreach ($requirements as $requirement){echo "<option value=".$requirement->id.">".$requirement->name."</option>";}?>
                </select>
			</div>

			<button type="submit" class="btn btn-default">Submit</button>
		</form>
	</div>

    <div class="alert alert-info fade out" id="bsalert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Info!</strong> <message id="message">This alert box could indicate a neutral informative or action</message>
    </div>

</body>
<script type="text/javascript">
    // Variable to hold request
    var request;

    // Bind to the submit event of our form
    $("#addDataForm").submit(function(event){

        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        // Abort any pending request
        if (request) {
            request.abort();
        }
        // setup some local variables
        var $form = $(this);

        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");

        // Serialize the data in the form
        var serializedData = $form.serialize();

        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);

        // Fire off the request to /form.php
        request = $.ajax({
            url: "saveRawData",
            type: "post",
            data: serializedData
        });

        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR){
            $("#message").html(response);
            $('#addDataForm').trigger("reset");
            $(".alert").toggleClass('in out');
            setTimeout(function() {
                $(".alert").toggleClass('out in');
            }, 1000);
            return false;

        });

        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function () {
            // Reenable the inputs
            $inputs.prop("disabled", false);
        });

    });
</script>

<?php include "footer.php"; ?>
</html>
