<!-- Gallery section -->
	<section id="gallery" class="<text-center1 padded-both">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="">Latest work.</h4>
                </div>
            </div>

            <div id="filters" class="button-group" style="text-align:center;">
            	<?php
	        		echo '<button class="button btn btn-default btn-lg is-checked" data-filter="*">All</button>';
	        		foreach ($gallery_type as $row) {
	        			$disable = $row->id_gallery_type != null ? '' : 'disabled';
	        			echo '<button class="button btn btn-default btn-lg ' . $disable . '" data-filter=".' . $row->type . '">' . $row->type . '</button>';
	        		}
	        	?>
			</div>
			

			<div class="row">
				<div class="isotope">	
					<?php 
						foreach ($gallery as $row) {
							echo '<div class="col-sm-4 iso-item ' . $row->type . '"  data-category="' . $row->type . '">' .
				    			 '<a class="fancybox" rel="' . $row->type . '" href="' . $row->path_original . '">'.
				    			 '<img src="' . $row->path_small . '" class="img-responsive" alt=""></a></div>';
						}
					?>		
			  	</div>	
			</div> 
        </div>
    </section>