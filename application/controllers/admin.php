<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	/**
	* Auto load model involving gallery
	*
	* @return void
	*/
	public function __construct() {
		parent::__construct();
		$this->load->model('model_gallery');
		$this->load->model('model_gallery_type');

		if(!$this->session->userdata('is_logged_in')){
            redirect('user/login');
        }
	}

	public function index() {
		$this->gallery();
	}

	/**
	* Load images and images type
	*
	* @return void
	*/
	public function gallery() {

		// Posts sent by the view
        $order_images_type = $this->input->post('order_images_type');        
        $order_by_column_name = $this->input->post('order_by_column_name');        
        $order_type = $this->input->post('order_type'); 


        //if order type was changed
        if($order_type){
            $filter_session_data['order_type_selected'] = $order_type;
        } else {
            if($this->session->userdata('order_type_selected')) {
                $order_type = $this->session->userdata('order_type_selected');    
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Desc';    
            }
        }

        if($order_by_column_name) {
        	$filter_session_data["order_by_column_name_selected"] = $order_by_column_name;
        } else {
        	if($this->session->userdata('order_by_column_name_selected')) 
        		$order_by_column_name = $this->session->userdata('order_by_column_name_selected');
        	else
        		$order_by_column_name = "post_date";
        }


        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type; 
        $data['order_by_column_name_selected'] = $order_by_column_name;

        if($order_images_type !== false) {
        	/*
			* If first if is true save data to session for stored values
			* If first if false then data is already stored in session, so get that data 
			* and store it in variable for database filtering
			* At the end store data in variable to be displayed in view (in filter form)	
        	*/

        	if($order_images_type !== 0) 
        		$filter_session_data['order_images_type_selected'] = $order_images_type;
        	else
        		$order_images_type = $this->session->userdata('order_images_type_selected');

        	$data['order_images_type_selected'] = $order_images_type;


        	if($order_by_column_name)
        		$filter_session_data['order_by_column_name_selected'] = $order_by_column_name;
        	else
        		$order_by_column_name = $this->session->userdata('order_by_column_name_selected');

        	$data['order_by_column_name_selected'] = $order_by_column_name;


        	if($order_type)
        		$filter_session_data['order_type_selected'] = $order_type;
        	else
        		$order_type = $this->session->userdata('order_type_selected');

        	$data['order_type_selected'] = $order_type;


        	$this->session->set_userdata($filter_session_data);

        	$data['galleryTypes'] = $this->model_gallery_type->getGalleryTypes();

    	
    		if($order_images_type)
    			$data['gallery'] = $this->model_gallery->getImages($order_images_type, $order_by_column_name, $order_type);
    		else
    			$data['gallery'] = $this->model_gallery->getImages('', $order_by_column_name, $order_type);


        } else {
        	// Reset session data
        	$filter_session_data['order_images_type_selected'] = null;
        	$filter_session_data['order_by_column_name_selected'] = null;
        	$filter_session_data['order_type_selected'] = null;
        	$this->session->set_userdata($filter_session_data);

        	//pre selected options
        	$data['order_images_type_selected'] = 0;

        	$data['galleryTypes'] = $this->model_gallery_type->getGalleryTypes();
        	$data['gallery'] = $this->model_gallery->getImages('', $order_by_column_name, $order_type);
        }


		$data["title"] = "Admin panel";		
		
		$data["main_content"] = "admin/view_admin_panel";  

		$this->load->view("admin/template", $data);	
	}

	/**
    * Add new image to assets and database
    *
    * @return void
    */
	public function add() {

		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$this->form_validation->set_rules('title', 'title', 'required');
			//$this->form_validation->set_rules('uploadImage', 'upload image', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

			if ($this->form_validation->run()) {
				ini_set('memory_limit', '200M' );
				ini_set('upload_max_filesize', '200M');  
				ini_set('post_max_size', '200M');  
				ini_set('max_input_time', 3600);  
				ini_set('max_execution_time', 3600);

				$config = array(
					'upload_path'     => "./assets/uploads/",
			        'upload_url'      => base_url() . "assets/uploads/",
			        'allowed_types'   => "gif|jpg|png|jpeg",
			        'max_size'        => "5000",
			        'max_height'      => "4000",
			        'max_width'       => "4000"  
				);
				
				$this->load->library('upload', $config);

				if ($this->upload->do_upload("uploadImage")) {

					$image_data = $this->upload->data();

					unset($config);

					$resSettings = $this->resizeSettings($image_data);
					
					// Resize image 
					$config = array(
						'image_library' 	=> 'gd2',
						'source_image'		=> $image_data['full_path'],
						'create_thumb'		=> TRUE,
						'maintain_ratio'	=> TRUE,
						'width'				=> $resSettings['res_w']
					);

					$this->load->library('image_lib', $config);
					$this->image_lib->initialize($config);

					$this->image_lib->resize();

					$this->load->library('image_lib', $config);
					unset($config);

					$image_size = getimagesize($image_data['file_path'] . $image_data['raw_name'] . '_thumb' . $image_data['file_ext']);
					
					// Crop image
					$config = array(
						'image_library' 	=> 'gd2',
						'source_image'		=> $image_data['file_path'] . $image_data['raw_name'] . '_thumb' . $image_data['file_ext'],
						'create_thumb'		=> FALSE,
						'maintain_ratio'	=> FALSE,
						'width'				=> $resSettings['crop_w'],
						'height'			=> $resSettings['crop_h'],
						'x_axis'			=> (($image_size[0] - $resSettings['crop_w']) / 2),
						'y_axis'			=> (($image_size[1] - $resSettings['crop_h']) / 2)
					);

					$this->load->library('image_lib', $config);
					$this->image_lib->initialize($config);



					if($this->image_lib->crop()) {
						$data = array(
							'title'				=> $this->input->post('title'),
							'position'			=> $this->model_gallery->count_images($this->input->post('galleryType'))+1,
							'path_small'		=> 'assets/uploads/' . $image_data['raw_name'] . "_thumb" . $image_data['file_ext'],
							'path_original'		=> 'assets/uploads/' . $image_data['orig_name'],
							'post_date'			=> date('Y-m-d H:i:s'),
							'id_user'			=> $this->session->userData("is_logged_in"),
							'id_gallery_type'	=> $this->input->post('galleryType')			
						);
					}

					if($this->model_gallery->addImage($data)) 
						$data['flash_message'] = TRUE; 
	                else
	                    $data['flash_message'] = FALSE; 
				} 		
			}
		}

		$data["title"] = "Admin panel :: Add";

		$data["main_content"] = "admin/view_gallery_add";

		$data['galleryTypes'] = $this->model_gallery_type->getGalleryTypes();

		$this->load->view("admin/template", $data);	
	}

	/**
	* Update image by it's id
	*
	* @param int $image_id
	* @return void
	*/
	public function update() {
		$id = $this->uri->segment(4);

		$data['image'] = $this->model_gallery->getImageById($id);

		foreach ($data['image'] as $row) {
			$data['image_title'] = $row->title;
			$data['path'] = base_url() . $row->path_small;
			$data['position_selected_original'] = $row->position;
			$data['gallery_type_id'] = $row->id_gallery_type; 
			$data['path_small'] = $row->path_small;
			$data['path_original'] = $row->path_original;
			$data['post_date'] = $row->post_date;
		}
       

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$this->form_validation->set_rules('title', 'title', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

			if ($this->form_validation->run()) {
				$data_to_store_new = array(
				    'title' 			=> $this->input->post('title'),
				    'position' 			=> $this->input->post('position'),
				    'path_small'		=> $data['path_small'],
				    'path_original' 	=> $data['path_original'],
				    'post_date'			=> $data['post_date'],
				    'id_user'			=> $this->session->userData("is_logged_in"),
				    'id_gallery_type' 	=> $this->input->post('galleryType')  
				);

				$image_old = $this->model_gallery->getOldImageById($data['gallery_type_id'], $this->input->post('position'));
				
				foreach ($image_old as $row) {
					$data_to_store_old = array(
						'title' 			=> $row->title,
						'position' 			=> $data['position_selected_original'],
						'path_small'		=> $row->path_small,
						'path_original' 	=> $row->path_original,
						'post_date'			=> $row->post_date,
						'id_user'			=> $row->id_user,
						'id_gallery_type' 	=> $row->id_gallery_type
					);

					$id_old_image = $row->id;
				}

				if($this->model_gallery->updateImage($id, $data_to_store_new) && $this->model_gallery->updateImage($id_old_image, $data_to_store_old)) {
					$this->session->set_flashdata('flash_message', 'updated');
				} else {
					$this->session->set_flashdata('flash_message', 'error');
				}

				redirect('admin/gallery/update/'.$id.'');
			}
		}

		$data['all_positions'] = $this->model_gallery->count_images($data['gallery_type_id']);
	
		$data['galleryTypes'] = $this->model_gallery_type->getGalleryTypes();

		$data['title'] = "Admin panel :: Update";
        
        $data['main_content'] = 'admin/view_gallery_update';

        $this->load->view('admin/template', $data);  
	}	

	/**
	* Remove image with the specific id
	*
	* @return void
	*/
	public function delete() {
		$id = $this->uri->segment(4);

		$image_data = $this->model_gallery->getImageById($id);

		foreach ($image_data as $row) {
			$data['path_small'] = LOCAL_UPLOAD_PATH.$row->path_small;
			$data['path_original'] = LOCAL_UPLOAD_PATH.$row->path_original;
			$gallery_type = $row->id_gallery_type;
			$position = $row->position;
		}

		foreach ($this->model_gallery->getForRepositioning($gallery_type, $position) as $row) {
			$this->model_gallery->repositionImages($row->id);
		}	

		if($this->model_gallery->deleteImage($id)) { 
			$this->session->set_flashdata('flash_message', 'delete');

			chmod(LOCAL_UPLOAD_PATH.$data['path_small'], 0777);
			if(is_writable($data['path_small'])) {
				unlink($data['path_small']);
			} else {
				echo "small not";die();	
			}

			chmod(LOCAL_UPLOAD_PATH.$data['path_original'], 0777);
			if(is_writable($data['path_original'])) {
				unlink($data['path_original']);	
			} 
		}
		else 
			$this->session->set_flashdata('flash_message', 'error');

		
		
		redirect('admin/gallery');
	}
	
	/**
	* Receva image options and returning image manipulation options 
	*
	* @return array
	*/
	public function resizeSettings($image) {
		$settings['old_w'] = $image['image_width'];
		$settings['old_h'] = $image['image_height'];

		if($image['image_width'] > $image['image_height']) {
			$settings['res_w'] = 600;
			$settings['res_h'] = 400;
			$settings['crop_w'] = 360;
			$settings['crop_h'] = 240;
		} else {
			$settings['res_w'] = 400;
			$settings['res_h'] = 600;
			$settings['crop_w'] = 270;
			$settings['crop_h'] = 390;
		}

		if($this->scaleHeight($settings) >= $settings['crop_h']) {
			return $settings;
		} else {
			$settings['res_w'] = $this->scaleWidth($settings);
			return $settings;
		}
	}

	/**
	* Scale image with fixed height
	*
	* @return int (width)
	*/
	public function scaleWidth($settings) {
		return $settings['old_w']/$settings['old_h']*$settings['res_h'];
	}

	/**
	* Scale image with fixed width
	*
	* @return int (height)
	*/
	public function scaleHeight($settings) {
		return $settings['old_h']/$settings['old_w']*$settings['res_w']; 
	}
}