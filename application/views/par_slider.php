<!-- FlexSlider -->
<section id="slider">
	<div class="flexslider">
	  <ul class="slides"> 
	  	
	  	<?php 
		  	foreach ($slides as $row) {
		  		echo '<li><img class="img-responsive" src="' . $row->slide_path . '" /></li>';
		  	}
	  	?>

	  </ul>
	</div>
</section>