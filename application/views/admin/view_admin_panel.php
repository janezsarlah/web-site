    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Add new</a>
        </h2>
      </div>

      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'delete')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Image was deleted with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> Image was not deleted.';
          echo '</div>';          
        }
      }
      ?>

      
      <div class="row">
        <div class="col-md-12">    

          <?php 
          $gallery_type_attributes = array(0 => 'All');
          foreach ($galleryTypes as $row) {
            $gallery_type_attributes[$row->id] = $row->type;
          }

          $column_options = array("position" => '#', "type" => 'Type', "post_date" => "Post date");   

          $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

          $attributes = array('class' => 'form-inline filter-form', 'id' => 'myform');

          $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');

          echo '<div class="panel panel-default"><div class="panel-body">';
          echo form_open('admin/gallery', $attributes);
           
           echo '<div class="col-sm-12 col-md-5 form-group">';
            echo form_label('Filter by gallery type:', 'type_id');
            echo form_dropdown('order_images_type', $gallery_type_attributes, $order_images_type_selected, 'class=form-control');
            
            echo '</div> <div class="col-sm-12 col-md-5 form-group">';

            echo form_label('Order by:', 'order');
            echo form_dropdown('order_by_column_name', $column_options, $order_by_column_name_selected, 'class=form-control');
            
            echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class=form-control');

            echo '</div> <div class="col-md-1 col-md-offset-1 form-group">';

            echo form_submit($data_submit);
            echo '</div></div>';
          echo form_close().'</div></div>';


           ?>


          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Title</th>
                <th class="header">Path</th>
                <th class="header">Type</th>
                <th class="header">Post date</th>
                <th class="header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($gallery as $row) {
                echo '<tr>';
                echo '<td>'.$row->position.'</td>';
                echo '<td>'.$row->title.'</td>';
                echo '<td>'.$row->path_small.'</td>';
                echo '<td>'.$row->type.'</td>';
                echo '<td>'.$row->post_date.'</td>';
                echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/gallery/update/'.$row->id.'" class="btn btn-info">view & edit</a>  
                  <a href="'.site_url("admin").'/gallery/delete/'.$row->id.'" class="btn btn-danger">delete</a>
                  </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          
          

      </div>
    </div>