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

<style>
  .bg-1 { 
      background-color: #1abc9c;
      color: #ffffff;
  }
  .bg-2 { 
      background-color: #474e5d;
      color: #ffffff;
  }
  .bg-3 { 
      background-color:  #F5F5F5; /* White */
      color: #555555;
      }
      .bg-4 { 
      background-color:  #D3D3D3; /* Dimgrey */
      color: #555555;
      }
  </style>

<!-- Include jQuery Validator plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>


<!-- Include SmartWizard JavaScript source -->
<script type="text/javascript" src="<?php echo base_url('includes/SmartWizard/dist/js/jquery.smartWizard.min.js') ?>"></script>

<script type="text/javascript">
    $(document).ready(function(){

        $("tooltip").tooltip('enable');

        $('#whatAppDoText').hover(function() {
            $('html, body').animate({
                scrollTop: $(this).offset().top + $(this).outerHeight()
            }, 2000);
        });

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

            $("#roleName_1, #roleName_2").html($("#jobRole option:selected").text());

            var reqListAndCategJson = $.ajax({
                url: "home/reqListAndCategJson",
                method: "POST",
                data: { id : this.value },
                dataType: "json"
            });

            reqListAndCategJson.done(function( msg ) {
                //console.log(msg); return;
                if (jQuery.isEmptyObject(msg)) {
                    alert('no items found in this role!');
                }

                $('#skillList').empty();
                $.each(msg, function(key, value)
                {
                    $('#skillList').append('<div style="float: left; width: 33%; padding: 10px; background: #dedfec; box-sizing: border-box; border: 1px solid #9fa0a9;"><h4>'+key+'</h4> <p>'+ value +'</p></div>');
                })
            });

            reqListAndCategJson.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });


            var mostPrefjson = $.ajax({
                url: "home/mostPrefjson",
                method: "POST",
                data: { id : this.value },
                dataType: "json"
            });

            mostPrefjson.done(function( msg ) {
                //console.log(msg); return;
                if (jQuery.isEmptyObject(msg)) {
                    alert('no items found in this role!');
                }

                $('#mostPrefList').empty();
                $.each(msg, function(key, value)
                {
                    $('#mostPrefList').append('<div style="float: left; width: 33%; padding: 10px; background: #dedfec; box-sizing: border-box; border: 1px solid #9fa0a9;"><h4>'+key+'</h4> <p>'+value+'</p></div>');
                })
            });

            mostPrefjson.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });


            var topRankedSkillsJson = $.ajax({
                url: "home/topRankedSkillsJson",
                method: "POST",
                data: { id : this.value },
                dataType: "json"
            });

            topRankedSkillsJson.done(function( msg ) {
                //console.log(msg); return;
                if (jQuery.isEmptyObject(msg)) {
                    alert('no items found in this role!');
                }

                $('#topRankedSkills').empty();
                var i = 1;
                $.each(msg, function(key, value)
                {
                    if (i == 1){
                        var rankInfoText = 'occupy the '+i+'st rank!';
                    }else if (i == 2){
                        var rankInfoText = 'occupy the '+i+'nd rank!';
                    }else if (i == 3){
                        var rankInfoText = 'occupy the '+i+'rd rank!';
                    } else{
                        var rankInfoText = 'occupy the '+i+'th rank!';
                    }
                    $('#topRankedSkills').append('<b><li class="list-group-item d-flex justify-content-between align-items-center">'+value.name+' '+rankInfoText+'</b><span data-toggle="tooltip" data-html="true" title="<em>Repeated '+value.repeated+' times on job postings and other resources that we analysed!</em>" class="badge badge-primary badge-pill tooltipInfo">'+value.repeated+'</span></li>');
                    $(".tooltipInfo").tooltip('enable');
                    i++;
                })
            });

            topRankedSkillsJson.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });



        });


        $('#smartwizard').smartWizard("reset");

    });
</script>
<body>
<?php include "nav_bar.php"; ?>
<div class="container">
    <br />

    <div class="row">
    <div class="col-lg-12 bg-1 text-center">
  <h1>Discover The Skills You Must Have!</h1>
  <p>Career Guidance System Based on Most Demanded Skills</p>
</div>
    </div>
    <div class="row">
<div class="col-lg-12 bg-2 text-center">
  <h3>How it works?</h3>
  <p>Our smart algorithm scans job portals and other online resources for most demanded skills and qualifications for each role.</p>
</div>
    </div>
</br>
</br>
<form action="#" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8">
    <!-- SmartWizard html -->
        <div id="smartwizard">
            <ul>
                <li><a href="#step-1">Step 1<br /><small>Choose Category</small></a></li>
                <li><a href="#step-2">Step 2<br /><small>Choose Role</small></a></li>
                <li><a href="#step-3">See Skills<br /><small>Common Skills</small></a></li>
                <li><a href="#step-4">See Most Preferred<br /><small>Most Preferred Skills</small></a></li>
                <li><a href="#step-5">Top Skills<br /><small>These are to ranked Skills</small></a></li>
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
                    <h2>Common Skills for <i id="roleName_1"></i></h2>
                    <div id="form-step-2" role="form" data-toggle="validator">
                        <div class="form-group">
                            <label for="address">These are the skills/qualifications you must have</label> <tooltip data-toggle="tooltip" data-html="true" title="<em>Our application scans job portals and other resources for your selected job role and we extracted the common skills that you must have for this role you selected!</em>" class="fas fa-info-circle fa-1x"></tooltip>
                            <div id="skillList"></div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div id="step-4" class="">
                    <h2>Most Demanded Skills by Category for <i id="roleName_2"></i></h2>
                    <div id="form-step-3" role="form" data-toggle="validator">
                        <div class="form-group">
                            <label for="terms">These are the most demanded skills/qualifications for you</label> <tooltip data-html="true" title="<em>Out of all information we analysed, these are the most demanded abilities on market for every classification we showed.</em>" class="fas fa-info-circle fa-1x"></tooltip>
                            <div id="mostPrefList"></div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                </div>
                <div id="step-5" class="">
                    <h2>Top Ranked Skills</h2>
                    <div id="form-step-4" role="form" data-toggle="validator">
                        <div class="form-group">
                            <label for="terms">These are the top ranked skills/qualifications for you</label> <tooltip data-toggle="tooltip" data-html="true" title="<em>We analysed total skills and abilities that are demanded for this role you selected and this is a list of them sorted and ranked in such a way that, top skill is the most repeated on job postings and other resources out of all categories!</em>" class="fas fa-info-circle fa-1x"></tooltip>
                            <ul id="topRankedSkills" class="list-group">
                            </ul>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </form>
</div>
<!-- Third Container (Grid) -->
<div class="container-fluid bg-3 text-center">    
  <h3 id="whatAppDoText" class="margin">What This App Can Do?</h3><br>
  </br>
  </br>
  <div class="row">
    <div class="col-sm-4">
      <h4>COMMON SKILLS</h4>
      <p>Accurately understand how to enhance your technical strengths and skills. Select the perfect step for your career.We recommend technical skills which are prioritized and you assess your strengths and align them for your career choice. Know your strengths and weaknesses.</p>
    </div>
    <div class="col-sm-4"> 
          <h4>MOST DEMANDED SKILLS</h4>
          <P>Get to know the most preferred skills suitble for the job roles of your dream. This is based on the analysis we provide from numerous job posting, we show the most preferred skills which you can work towards before entering the technical field of your choice.</P>      
    </div>
    <div class="col-sm-4"> 
          <h4>TOP RANKED SKILLS</h4>
      <p>We analyze total skills and abilities that are demanded for a role you select makes a list of them sorted and ranked in such a way that, top skill is the most repeated on job postings and other resources out of all categories!</p>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>

</body>
</html>