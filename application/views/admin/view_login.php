<div class="container">
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
      'class'       => 'btn btn-lg btn-primary btn-block'
    );

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