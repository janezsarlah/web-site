    <div class="container top">

      <ol class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ol>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Add new</a>
        </h2>
      </div>

      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'success')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Slide was deleted with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> Slide must not be removed.';
          echo '</div>';          
        }
      }
      ?>
      
      <div class="row">
        <div class="col-md-12">          
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="header">Name</th>
                <th class="header">Path</th>
                <th class="header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($slides as $row) {
                echo '<tr>';
                echo '<td>'.$row->id.'</td>';
                echo '<td>'.$row->name.'</td>';
                echo '<td>'.$row->slide_path.'</td>';
                echo '<td class="crud-actions">  
                  <a href="'.site_url("admin").'/slides/delete/'.$row->id.'" class="btn btn-danger">delete</a>
                  </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>
      </div>
    </div>