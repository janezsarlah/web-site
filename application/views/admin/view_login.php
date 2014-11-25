<?php 
    $attributes_open = array(
      'class'   => 'form-signin',
      'role'    => 'form'
    );
    $attributes_username = array(
      'placeholder' => 'Username',
      'class'       => 'form-control',
      'autofocus'   => 'autofocus',
      'name'        => 'username'
    );
    $attributes_password = array(
      'placeholder' => 'Password',
      'class'       => 'form-control',
      'type'        => 'password',
      'name'        => 'password'
    );
    $attributes_ckeck = array(
      'type'        => 'checkbox',
      'value'       => 'remember-me'
    );
    $attributes_button = array(
      'class'       => 'btn btn-lg btn-primary btn-block login'
    );
?>

<?php echo doctype("html5"); ?>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Graphic design">
    <meta name="author" content="Klemen Šarlah">

  <title><?php echo $title; ?></title>

  <!-- Stylesheets -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bower_components/normalize.css/normalize.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bower_components/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bower_components/font-awsome/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/styles1.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/styles2.css">
    
</head>
  <body>
    

<div class="container">
  <?php    

    echo form_open("user/validateLogin", $attributes_open); 
    echo validation_errors();
    echo '<h2 class="form-signin-heading">Please login</h2>';
    echo form_input($attributes_username, $this->input->post("username"));
    echo form_input($attributes_password);
    echo '<div class="checkbox"><label>' . form_input($attributes_ckeck) . "Remember me" . '</label></div>';
    echo form_submit($attributes_button, "Submit");
    echo form_close();

  ?>
</div> 

<!-- Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>bower_components/jquery/dist/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/javascript1.js"></script>


</body>
</html>