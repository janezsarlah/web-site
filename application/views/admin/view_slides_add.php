    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
        </li>
        <li class="active">
          Add new
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Add <?php echo "Slide"; //ucfirst($this->uri->segment(2));?>
        </h2>
      </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> New slide was saved success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-danger" role="alert">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> Change a few things and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php

      $attributes = array('class' => 'form-horizontal', 'id' => '', 'role' => 'form');

      $input_text_attributes = array('name' => 'name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Name');

      //form validation
      echo validation_errors(); 
      
      echo form_open_multipart('admin/slides/add', $attributes);
      ?>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
              <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
              <div class="col-sm-9">
                <?php echo form_input($input_text_attributes); ?>
              </div>
          </div>
          <div class="form-group">
            <blockquote class="blockquote-reverse">
              <p>For the best image display in the slider, make sure that the images are all the same size (recomended 3000x1300).</p>
              <footer>Website administrator</footer>
            </blockquote>
          </div>
          
        </div>

        <div class="col-md-6">
          <div class="text-center">
            <div class="fileinput fileinput-new" data-provides="fileinput">
              <div class="fileinput-new thumbnail" style="width: 400px; height: 200px;">
                <img data-src="holder.js/100%x100%" alt="...">
              </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 400px; max-height: 300px;"></div>
                <div>
                  <span class="btn btn-file btn-success"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="upload_image"></span>
                  <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-12 text-center padded-top">
          <button type="submit" class="btn btn-primary">Upload</button>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>" style="color:#fff;"><button type="button" class="btn btn-danger">Cancel</button></a>
        </div>

      </div>

      <?php echo form_close(); ?>

    </div>
     