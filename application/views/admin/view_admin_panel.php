<?php 
	$attributes_image = array(
		'type'	=> 'file',
		'name'	=> 'uploadImage'
	);

	$attributes_submit = array(
		'type'	=> 'submit',
		'value'	=> 'Upload',
		'class'	=> 'btn btn-primary'
	);
?>


<div class="container text-center">
	<a class="pull-right" href="<?php echo base_url(); ?>user/logout">Logout</a>


	<div class="row">
		<div class="col-md-3 col-md-offset-2">
			<div class="fileinput fileinput-new" data-provides="fileinput">
	  			<div class="fileinput-new thumbnail" style="width: 400px; height: 300px;"></div>
	  			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 400px; max-height: 300px;"></div>
	  
	  			<div>
				    <span class="btn btn-file btn-success"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
				    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
				</div>
			</div>
			<div>
		  		<select class="form-control">
		  			<?php 
		  				foreach ($galleryTypes as $row) {
		  					echo "<option>" . $row->type . "</option>";
		 	 			}
		  			?>
				</select>
		  	</div>
	  		<button type="button" class="btn btn-primary">Upload</button>
		</div>


		<div class="col-md-3 col-md-offset-2 text-center">
			<?php 
			  	echo form_open_multipart('upload/uploadImage');
			  	echo '<div class="fileinput-new thumbnail" style="width: 400px; height: 300px;"></div>';
			  	echo form_input($attributes_image, $this->input->post("uploadImage"));
			  	echo '<select class="form-control" name="galleryType">';
 
  				foreach ($galleryTypes as $row) {
  					echo "<option>" . $row->type . "</option>";
 	 			}
		  			
				echo '</select>';
				echo form_submit($attributes_submit);
			  	echo form_close();
				
			?>
		</div>

		<div class="col-md-12">
			<p><?php echo $upload_error;?></p>
			<p><?php echo $upload_success; ?></p>
		</div>

	</div>
</div>
