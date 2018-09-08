<?php
$jobCateg = $jobCateg['data'];
$jobRoles = $jobRoles['data'];
$rawData  = $rawData['data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <!-- Include SmartWizard CSS -->
    <link href="<?php echo base_url('includes/SmartWizard/dist/css/smart_wizard.css" rel="stylesheet" type="text/css') ?>" />

    <!-- Optional SmartWizard theme -->
    <link href="<?php echo base_url('includes/SmartWizard/dist/css/smart_wizard_theme_circles.css" rel="stylesheet') ?>" type="text/css" />
    <link href="<?php echo base_url('includes/SmartWizard/dist/css/smart_wizard_theme_arrows.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('includes/SmartWizard/dist/css/smart_wizard_theme_dots.css') ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


</head>
<body>
<?php include "nav_bar.php"; ?>
<div class="container">
    <br />
    <form action="#" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8">

        <!-- SmartWizard html -->
        <div id="smartwizard">
            <ul>
                <li><a href="#step-1">Step 1<br /><small>Choose Category</small></a></li>
                <li><a href="#step-2">Step 2<br /><small>Choose Role</small></a></li>
                <li><a href="#step-3">See Jobs<br /><small>Common Jobs</small></a></li>
                <li><a href="#step-4">See Skills<br /><small>Most Preferred Skills</small></a></li>
            </ul>

            <div>
                <div id="step-1">
                    <h2>Choose a category</h2>
                    <div id="form-step-0" role="form" data-toggle="validator">
                        <div class="form-group">
                            <select class="form-control" id="jobCateg" name="jobCateg" required="required">
                                <option value="">select a category</option>
                                <?php foreach ($jobCateg as $categ){echo "<option value=".$categ->id.">".$categ->category."</option>";}?>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                </div>
                <div id="step-2">
                    <h2>Choose a role</h2>
                    <div id="form-step-1" role="form" data-toggle="validator">
                        <div class="form-group">
                            <select class="form-control" id="jobRole" name="jobRole" required="required">
                                <option value="">Choose a role</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div id="step-3">
                    <h2>Common jobs</h2>
                    <div id="form-step-2" role="form" data-toggle="validator">
                        <div class="form-group">
                            <label for="address">These are the most common jobs for you</label>
                            <div id="jobList"></div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div id="step-4" class="">
                    <h2>Preferred Skills</h2>
                    <div id="form-step-3" role="form" data-toggle="validator">
                        <div class="form-group">
                            <label for="terms">These are the most preferred skills/qualifications for you</label>
                            <div id="skillList"></div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </form>

</div>

<!-- Include jQuery Validator plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>


<!-- Include SmartWizard JavaScript source -->
<script type="text/javascript" src="<?php echo base_url('includes/SmartWizard/dist/js/jquery.smartWizard.min.js') ?>"></script>

<script type="text/javascript">
    $(document).ready(function(){

        // Toolbar extra buttons
        var btnFinish = $('<button></button>').text('Finish')
            .addClass('btn btn-info')
            .on('click', function(){
                if( !$(this).hasClass('disabled')){
                    var elmForm = $("#myForm");
                    if(elmForm){
                        elmForm.validator('validate');
                        var elmErr = elmForm.find('.has-error');
                        if(elmErr && elmErr.length > 0){
                            alert('Oops we are sorry that you couldn`t find what you were looking for!');
                            elmForm.submit();
                            return false;
                        }else{
                            alert('Great! we are glad that you found what you were looking for!');
                            elmForm.submit();
                            return false;
                        }
                    }
                }
            });
        var btnCancel = $('<button></button>').text('Cancel')
            .addClass('btn btn-danger')
            .on('click', function(){
                $('#smartwizard').smartWizard("reset");
                $('#myForm').find("input, textarea").val("");
            });



        // Smart Wizard
        $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'dots',
            transitionEffect:'fade',
            toolbarSettings: {toolbarPosition: 'bottom',
                toolbarExtraButtons: [btnFinish, btnCancel]
            },
            anchorSettings: {
                markDoneStep: true, // add done css
                markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
            }
        });

        $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
            var elmForm = $("#form-step-" + stepNumber);
            // stepDirection === 'forward' :- this condition allows to do the form validation
            // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
            if(stepDirection === 'forward' && elmForm){
                elmForm.validator('validate');
                var elmErr = elmForm.children('.has-error');
                if(elmErr && elmErr.length > 0){
                    // Form validation failed
                    return false;
                }
            }
            return true;
        });

        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
            // Enable finish button only on last step
            if(stepNumber == 3){
                $('.btn-finish').removeClass('disabled');
            }else{
                $('.btn-finish').addClass('disabled');
            }
        });


        $('#jobCateg').on('change', function() {
            var request = $.ajax({
                url: "home/getJobRolesByCateg",
                method: "POST",
                data: { id : this.value },
                dataType: "json"
            });

            request.done(function( msg ) {
                $('#jobRole').empty();
                $('#jobRole').append('<option value= "">Choose a role</option>');
                $.each(msg, function(key, value)
                {
                    $('#jobRole').append('<option value=' + value.id + '>' + value.role + '</option>');
                })
            });

            request.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });
        });


        $('#jobRole').on('change', function() {
            var jobListRrequest = $.ajax({
                url: "home/getJobsAndSkillByRole",
                method: "POST",
                data: { id : this.value },
                dataType: "json"
            });

            jobListRrequest.done(function( msg ) {
                if (jQuery.isEmptyObject(msg.jobs)) {
                        alert('no jobs found in this role!');
                }

                $('#jobList').empty();
                $.each(msg.jobs, function(key, value)
                {
                    $('#jobList').append('  <a target="_blank" href="' + value.url + '" class="btn btn-primary">' + value.job_title + ' <i class="fas fa-external-link-alt"></i></a>  ');
                })
                $('#skillList').empty();
                $.each(msg.skills, function(key, value)
                {
                    $('#skillList').append('<div style="float: left; width: 33%; padding: 10px; background: #dedfec; box-sizing: border-box; border: 1px solid #9fa0a9;"><h4>'+value.cName+'</h4> <p>'+value.name+'</p></div>');
                })
            });

            jobListRrequest.fail(function( jqXHR, textStatus ) {
                alert( "Job List Request failed: " + textStatus );
            });
        });


        $('#smartwizard').smartWizard("reset");

    });
</script>
</body>
<?php include "footer.php"; ?>
</html>