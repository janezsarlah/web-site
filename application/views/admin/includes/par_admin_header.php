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
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
			  	<div class="navbar-header page-scroll">
				    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse">
				    	<span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				    </button>
				</div>

				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li <?php if($this->uri->segment(2) == 'gallery'){echo 'class="active"';}?>>
					    	<a href="<?php echo base_url(); ?>admin/gallery">Gallery</a>
					  	</li>
					  	<li <?php if($this->uri->segment(2) == 'types'){echo 'class="active"';}?>>
					    	<a href="<?php echo base_url(); ?>admin/types">Types</a>
					  	</li>

					    <li class="dropdown">
					      	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">System <span class="caret"></span></a>
					      	<ul class="dropdown-menu" role="menu">
						    	<li>
						      		<a href="<?php echo base_url(); ?>user/logout">Logout</a>
						    	</li>
						  	</ul>
					  	</li>
					</ul>
				</div>
			</div>	
		</div>

