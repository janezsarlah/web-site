<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "load_content";
$route['404_override'] = '';


/* Custom routs */


$route['admin/gallery/add'] 			= 'admin/add';
$route['admin/gallery/update'] 			= 'admin/update'; 
$route['admin/gallery/update/(:any)'] 	= 'admin/update/$1'; 
$route['admin/gallery/delete/(:any)'] 	= 'admin/delete/$1'; 

$route['admin/types'] 					= 'types/load_types';
$route['admin/types/add']				= 'types/add_new_type';
$route['admin/types/update/(:any)']		= 'types/update_type/$1';
$route['admin/types/delete/(:any)']		= 'types/delete_type/$i';

$route['admin/slides']					= 'slides/load_slides';
$route['admin/slides/add']				= 'slides/add_new_slide';
$route['admin/slides/delete/(:any)']	= 'slides/remove_slide/$1';

$route['send_email']					= 'email/send_email';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
