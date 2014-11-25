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
          Update
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          <?php echo "Update image"; //ucfirst($this->uri->segment(2));?>
        </h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Image was updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> Image was not updated. Change a few things and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '', 'role' => 'form');

      $position_attributes = array();
      for ($i=1; $i<=$all_positions; $i++) {
        $position_attributes[$i] = $i;
      }

      $gallery_type_attributes = array();
      foreach ($galleryTypes as $row) {
        $gallery_type_attributes[$row->id] = $row->type;
      }

      //form validation
      echo validation_errors();
      
      echo form_open_multipart('admin/gallery/update/'.$this->uri->segment(4).'', $attributes);
      ?>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
              <label class="col-sm-3 control-label">Title</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="title" id="inputTitle" placeholder="Title" value="<?php echo $image_title; ?>">
              </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Position</label>
            <div class="option-position col-sm-9">
              <?php echo form_dropdown('position', $position_attributes, $position_selected_original, 'class=form-control'); ?>
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Image Type</label>
            <div class="option-type col-sm-9">
              <?php echo form_dropdown('galleryType', $gallery_type_attributes, $gallery_type_id, 'class=form-control'); ?>
            </div>
          </div>
         
        </div>


        <div class="col-md-6">
          <div class="text-center">
            <div class="fileinput fileinput-new" data-provides="fileinput" value="<?php echo $path; ?>">
              <div class="fileinput-new thumbnail" style="width: 400px; height: 200px;">
                <img src="<?php echo $path; ?>" alt="...">
              </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 400px; max-height: 300px;"></div>
                
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
     