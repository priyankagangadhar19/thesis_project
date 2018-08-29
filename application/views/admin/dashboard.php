<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Profile Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>

<div class="container">
  <div class="row">
    <div class="col-md-4">

      <table class="table table-bordered table-striped">


        <tr>
          <th colspan="2"><h4 class="text-center">Admin Info</h3></th>

        </tr>
          <tr>
            <td>User's Name</td>
            <td><?php echo $this->session->userdata('user_name'); ?></td>
          </tr>
          <tr>
            <td>User Email</td>
            <td><?php echo $this->session->userdata('user_email');  ?></td>
          </tr>
          <tr>
            <td>User Role</td>
            <td><?php echo $this->session->userdata('user_role');  ?></td>
          </tr>
          <tr>
            <td>Username</td>
            <td><?php echo $this->session->userdata('username');  ?></td>
          </tr>
      </table>


    </div>
    
    <div class="col-md-4">
    <table class="table table-bordered table-striped">


        <tr>
          <th colspan="2"><h4 class="text-center">Menu Items</h3></th>

        </tr>
          <tr>
            <td>Job Category</td>
            <td><a href="<?php echo base_url()."admin/jobcateg";?>">link</a></td>
          </tr>
          <tr>
            <td>Job Role</td>
            <td><a href="<?php echo base_url()."admin/jobroles";?>">link</a></td>
          </tr>
          <tr>
            <td>Req Categ List</td>
            <td><a href="<?php echo base_url()."admin/reqcateglist";?>">link</a></td>
          </tr>
          <tr>
            <td>Req List</td>
            <td><a href="<?php echo base_url()."admin/reqlist";?>">link</a></td>
          </tr>
          <tr>
            <td>Add Data</td>
            <td><a href="<?php echo base_url()."admin/adddata";?>">link</a></td>
          </tr>
      </table>
    </div>
    
  </div>
<a href="<?php echo base_url('admin/logout');?>" >  <button type="button" class="btn-primary">Logout</button></a>
</div>
  </body>
</html>
