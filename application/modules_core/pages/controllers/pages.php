<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller{
		
	public function view($page = 'home'){
		# if database isn't configured
		$this->load->dbutil();
		if($this->dbutil->database_exists('elibrary') == FALSE){
			#redirect to install
			redirect('../install');
		}
		
		
		# Default variables
		$checkpoint = 'application/modules_core/pages/views/public/';
		$header = 'header';
		$location = 'public/';
		$display_name = '';
		$fullname = '';
		$email = '';
		$phone = '';
		$mobile = '';
		$dob = '';
		$gender = '';
		$address = '';
		$country = '';
		$city = '';
		$state = '';
		$postal = '';
		$fax = '';
		$website = '';
		
		# check if user is logged in
		if($this->session->userdata('logged_in') == 1){
			$checkpoint = 'application/modules_core/pages/views/protected/';
			$header = 'header1';
			$location = 'protected/';
			# query the db for user info base on id
			$user = $this->User_model->Get($this->session->userdata('user_id'));
			$display_name = $user->display_name;
			# get system id base on user id
			$system = $this->System_model->Get($this->session->userdata('user_id'));
			# get user profile info
			$profile = $this->Profile_model->Get($system->id);
			$fullname = $profile->fullname;
			$email = $profile->email;
			$phone = $profile->phone;
			$mobile = $profile->mobilephone;
			$dob = $profile->dob;
			$gender = $profile->gender;
			$address = $profile->address;
			$country = $profile->country;
			$city = $profile->city;
			$state = $profile->state;
			$postal = $profile->zip;
			$fax = $profile->fax;
			$website = $profile->website;
		}
		
		# set admin default page
		if($this->session->userdata('role_id') == 9999 && $page == 'home'){
			$page = 'manage_users';
		}
		
		#
		
		
		if ( ! file_exists($checkpoint.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			redirect('home');
		}else{
			if($page == 'books'){
				$this->books();
			}else if($page == 'genres'){
				$this->genres();
			}else if($page == 'sms'){
				$this->sms();
			}else if($page == 'login'){
				# login/logout
				$this->login();
			}else if($page == 'update_profile'){
				# update profile
				$this->update_profile();
			}else if($page == 'update_password'){
				# update password
				$this->update_password();
			}else if($page == 'retrieve_password'){
				# update password
				$this->retrieve_password();
			}else if($page == 'add_user'){
				# add new user
				$this->add_user();
			}else if($page == 'my_history'){
				#check if user is logged in
				if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 1){
					# query the db for user info base on id
					$user = $this->User_model->Get($this->session->userdata('user_id'));
					
					# get system id base on user id
					$system = $this->System_model->Get($this->session->userdata('user_id'));
					
					# configure pagination
					$config['base_url'] = base_url().'my_history';
					$config['total_rows'] = $this->db->get_where('history',array('system_id'=>mysql_real_escape_string($system->id)))->num_rows();
					$config['uri_segment'] = 2;
					$config['per_page'] = 10;
					$config['num_links'] = 20;
					$config['full_tag_open'] = '<div class="pagination"><ul>';
					$config['full_tag_close'] = '</ul></div>';
					$config['first_link']      = 'First';
					$config['first_tag_open']  = '<li>';
					$config['first_tag_close'] = '</li>';
					
					$config['last_link']      = 'Last';
					$config['last_tag_open']  = '<li>';
					$config['last_tag_close'] = '</li>';
					
					$config['next_link']      = 'Next';
					$config['next_tag_open']  = '<li>';
					$config['next_tag_close'] = '</li>';
					
					$config['prev_link']      = 'Previous';
					$config['prev_tag_open']  = '<li>';
					$config['prev_tag_close'] = '</li>';
					
					$config['cur_tag_open']  = '<li class="active"><a>';
					$config['cur_tag_close'] = '</a></li>';
					
					$config['num_tag_open']  = '<li>';
					$config['num_tag_close'] = '</li>';
					
					$this->pagination->initialize($config);
					
					$query = $this->db->get_where('history',array('system_id'=>mysql_real_escape_string($system->id)),$config['per_page'], $this->uri->segment(2));
					
					# array of info to pass to site
					$data = array(
						'title'=>ucwords(str_replace('_',' ',$page)),
						'sitename'=>'ELibrary',
						'categories'=> $this->Category_model->Get(),
						'display_name'=>$display_name,
						'categoryModel'=>$this->Category_model,
						'historyModel'=>$this->History_model,
						'reservationModel'=>$this->Reservation_model,
						'authorModel'=>$this->Author_model,
						'publisherModel'=>$this->Publisher_model,
						'bookModel'=>$this->Book_model,
						'rows'=>$query->result_array()
					);
					
					// loads the header template
					$this->template->load($header,null,$data);
					// finds and load the page
					$this->load->view($location.$page,$data);
					// loads the footer template
					$this->template->load('footer',null,$data);
					
				}else{
					#redirect to login page
					redirect('home');
				}
			}else if($page == 'my_reservation'){
				#check if user is logged in
				if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 1){
					# query the db for user info base on id
					$user = $this->User_model->Get($this->session->userdata('user_id'));
					
					# get system id base on user id
					$system = $this->System_model->Get($this->session->userdata('user_id'));
					
					# configure pagination
					$config['base_url'] = base_url().'my_history';
					$config['total_rows'] = $this->db->get_where('history',array('system_id'=>mysql_real_escape_string($system->id)))->num_rows();
					$config['uri_segment'] = 2;
					$config['per_page'] = 10;
					$config['num_links'] = 20;
					$config['full_tag_open'] = '<div class="pagination"><ul>';
					$config['full_tag_close'] = '</ul></div>';
					$config['first_link']      = 'First';
					$config['first_tag_open']  = '<li>';
					$config['first_tag_close'] = '</li>';
					
					$config['last_link']      = 'Last';
					$config['last_tag_open']  = '<li>';
					$config['last_tag_close'] = '</li>';
					
					$config['next_link']      = 'Next';
					$config['next_tag_open']  = '<li>';
					$config['next_tag_close'] = '</li>';
					
					$config['prev_link']      = 'Previous';
					$config['prev_tag_open']  = '<li>';
					$config['prev_tag_close'] = '</li>';
					
					$config['cur_tag_open']  = '<li class="active"><a>';
					$config['cur_tag_close'] = '</a></li>';
					
					$config['num_tag_open']  = '<li>';
					$config['num_tag_close'] = '</li>';
					
					$this->pagination->initialize($config);
					
					$query = $this->db->get_where('history',array('system_id'=>mysql_real_escape_string($system->id)),$config['per_page'], $this->uri->segment(2));
					
					# array of info to pass to site
					$data = array(
						'title'=>ucwords(str_replace('_',' ',$page)),
						'sitename'=>'ELibrary',
						'categories'=> $this->Category_model->Get(),
						'display_name'=>$display_name,
						'categoryModel'=>$this->Category_model,
						'historyModel'=>$this->History_model,
						'reservationModel'=>$this->Reservation_model,
						'authorModel'=>$this->Author_model,
						'publisherModel'=>$this->Publisher_model,
						'bookModel'=>$this->Book_model,
						'rows'=>$query->result_array()
					);
					
					// loads the header template
					$this->template->load($header,null,$data);
					// finds and load the page
					$this->load->view($location.$page,$data);
					// loads the footer template
					$this->template->load('footer',null,$data);
					
				}else{
					#redirect to login page
					redirect('home');
				}
			}else if($page == 'request'){
				# request a book be added to the library collection
				#setting validation rules
				$this->form_validation->set_rules('bk_name','Required','required|trim|max_length[50]|xss_clean');
				$this->form_validation->set_rules('bk_author','Required','required|trim|max_length[50]|xss_clean');
				$this->form_validation->set_error_delimiters('<span class="alert alert-error">','</span>');
				
				if($this->form_validation->run() == FALSE){
					#redirect
					redirect('home');
				}else{
					# extracts user input
					extract($_POST);
					
					
					$book_request = $this->Request_model->Get(mysql_real_escape_string($bk_name));
					# checkpoint
					if(!empty($book_request)){
						$count = $book_request->requested + 1;
						
						# create an array of user inputs
						$data = array(
							'requested'=>mysql_real_escape_string($count)
						);
						# update data
						$this->Request_model->Update(mysql_real_escape_string($bk_name),$data);
						# set user notification
						$this->session->set_flashdata("noti_request_success",TRUE);
					}else{
						# create an array of user inputs
						$data = array(
							'title'=>mysql_real_escape_string($bk_name),
							'author'=>mysql_real_escape_string($bk_author)
						);
						# insert in database
						$request_id = $this->Request_model->Add($data);
						if(!empty($request_id)){
							# set user notification
							$this->session->set_flashdata("noti_request_success",TRUE);
						}else{
							# set user notification
							$this->session->set_flashdata("noti_request_error",TRUE);
						}
					}
					#redirect
					redirect('home');
				}
				
			}else if($page == 'loan'){
				# loan book
				#check if user is logged in
				if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 1){
					# query the db for user info base on id
					$user = $this->User_model->Get($this->session->userdata('user_id'));
					
					# get system id base on user id
					$system = $this->System_model->Get($this->session->userdata('user_id'));
					#==============================================================================================>ends	
					
					# get count of books user have
					$this->db->select('*');
					$this->db->from('history');
					$this->db->where('system_id', $system->id);
					$this->db->where('returned', 'N');
					$count = $this->db->count_all_results();
					
					# check the limit of books to loan
					if($count < 3){
						# get book id
						$pid = $this->uri->segment(2);
						
						# extract user input
						extract($_POST);
						
						# create data array
						$data = array(
							'ISBN'=>mysql_real_escape_string($pid),
							'system_id'=>mysql_real_escape_string($system->id),
							'date_out'=>date('Y-m-d'), // current date
							'date_due'=>date('Y-m-d',strtotime("+1 week")), // date_out + 1week
							'returned'=>mysql_real_escape_string('N')
						);
						
						# save the changes to db
						$hid = $this->History_model->Add($data);
						
						# check if booking was successful
						if(!empty($hid)){
							#set notification to user redirect
							$this->session->set_flashdata("noti_app",TRUE);
						}else{
							#set notification to user redirect
							$this->session->set_flashdata("book_error",TRUE);
						}
					}else{
						#set notification to user redirect
						$this->session->set_flashdata("book_max",TRUE);
					}
					
					#redirect to homepage
					redirect('home');
				}else{
					#redirect to login page
					redirect('home');
				}
			}else if($page == 'reserve'){
				# reserve book
				#check if user is logged in
				if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 1){
					# query the db for user info base on id
					$user = $this->User_model->Get($this->session->userdata('user_id'));
					
					# get system id base on user id
					$system = $this->System_model->Get($this->session->userdata('user_id'));
					#==============================================================================================>ends	
					
					# get count of fyps user have
					$this->db->select('*');
					$this->db->from('reservation');
					$this->db->where('system_id', $system->id);
					$count = $this->db->count_all_results();
					
					# checks the number of book user can loan
					if($count < 3){
						# get book ISBN
						$pid = $this->uri->segment(2);
						
						# extract user input
						extract($_POST);
						
						# create data array
						$data = array(
							'ISBN'=>mysql_real_escape_string($pid),
							'system_id'=>mysql_real_escape_string($system->id),
							'date_log'=>date('Y-m-d') // current date
						);
						
						# save the changes to db
						$this->Reservation_model->Add($data);
						
						#set notification to user redirect
						$this->session->set_flashdata("reserved",TRUE);
					}else{
						#set notification to user redirect
						$this->session->set_flashdata("reserve_max",TRUE);
					}
					
					#redirect to homepage
					redirect('home');
				}else{
					#redirect to login page
					redirect('home');
				}
			}else if($page == 'home'){
				# get user input from form
				extract($_POST);
				
				# configure pagination
				$config['base_url'] = base_url().'home';
				$config['total_rows'] = $this->db->get('book')->num_rows();
				$config['uri_segment'] = 2;
				$config['per_page'] = 10;
				$config['num_links'] = 20;
				$config['full_tag_open'] = '<div class="pagination"><ul>';
				$config['full_tag_close'] = '</ul></div>';
				$config['first_link']      = 'First';
				$config['first_tag_open']  = '<li>';
				$config['first_tag_close'] = '</li>';
				
				$config['last_link']      = 'Last';
				$config['last_tag_open']  = '<li>';
				$config['last_tag_close'] = '</li>';
				
				$config['next_link']      = 'Next';
				$config['next_tag_open']  = '<li>';
				$config['next_tag_close'] = '</li>';
				
				$config['prev_link']      = 'Previous';
				$config['prev_tag_open']  = '<li>';
				$config['prev_tag_close'] = '</li>';
				
				$config['cur_tag_open']  = '<li class="active"><a>';
				$config['cur_tag_close'] = '</a></li>';
				
				$config['num_tag_open']  = '<li>';
				$config['num_tag_close'] = '</li>';
				
				$this->pagination->initialize($config);
				
				$query = $this->db->get_where('book',null,$config['per_page'], $this->uri->segment(2));
				
				# array of info to pass to site
				$data = array(
					'title'=>ucwords(str_replace('_',' ',$page)),
					'sitename'=>'ELibrary',
					'categories'=> $this->Category_model->Get(),
					'display_name'=>$display_name,
					'categoryModel'=>$this->Category_model,
					'historyModel'=>$this->History_model,
					'reservationModel'=>$this->Reservation_model,
					'authorModel'=>$this->Author_model,
					'publisherModel'=>$this->Publisher_model,
					'rows'=>$query->result_array()
				);
				
				// loads the header template
				$this->template->load($header,null,$data);
				// finds and load the page
				$this->load->view($location.$page,$data);
				// loads the footer template
				$this->template->load('footer',null,$data);
			}else if($page == 'genre'){
				# get user input from form
				$cat_name = trim(ucwords(str_replace('+', ' ', $this->uri->segment(2))));
				# sanitize genre
				$cat_name = strip_tags($cat_name);
				
				
				# configure pagination
				$config['base_url'] = base_url().'genre'.$this->uri->segment(2);
				$config['total_rows'] = $this->db->get_where('book',array('cat_name'=>mysql_real_escape_string($cat_name)))->num_rows();
				$config['uri_segment'] = 3;
				$config['per_page'] = 10;
				$config['num_links'] = 20;
				$config['full_tag_open'] = '<div class="pagination"><ul>';
				$config['full_tag_close'] = '</ul></div>';
				$config['first_link']      = 'First';
				$config['first_tag_open']  = '<li>';
				$config['first_tag_close'] = '</li>';
				
				$config['last_link']      = 'Last';
				$config['last_tag_open']  = '<li>';
				$config['last_tag_close'] = '</li>';
				
				$config['next_link']      = 'Next';
				$config['next_tag_open']  = '<li>';
				$config['next_tag_close'] = '</li>';
				
				$config['prev_link']      = 'Previous';
				$config['prev_tag_open']  = '<li>';
				$config['prev_tag_close'] = '</li>';
				
				$config['cur_tag_open']  = '<li class="active"><a>';
				$config['cur_tag_close'] = '</a></li>';
				
				$config['num_tag_open']  = '<li>';
				$config['num_tag_close'] = '</li>';
				
				$this->pagination->initialize($config);
				
				$query = $this->db->get_where('book',array('cat_name'=>mysql_real_escape_string($cat_name)),$config['per_page'], $this->uri->segment(3));
				
				# array of info to pass to site
				$data = array(
					'title'=>ucwords(str_replace('_',' ',$page)),
					'sitename'=>'ELibrary',
					'categories'=> $this->Category_model->Get(),
					'display_name'=>$display_name,
					'rows'=>$query->result_array(),
					'categoryModel'=>$this->Category_model,
					'historyModel'=>$this->History_model,
					'reservationModel'=>$this->Reservation_model,
					'authorModel'=>$this->Author_model,
					'publisherModel'=>$this->Publisher_model,
					'genre'=>htmlspecialchars($cat_name)
				);
				
				// loads the header template
				$this->template->load($header,null,$data);
				// finds and load the page
				$this->load->view($location.$page,$data);
				// loads the footer template
				$this->template->load('footer',null,$data);
			}else if($page == 'search'){
				# get user input from form
				//extract($_GET);
				$title = $_GET['bk_title'];
				# get user input from form
				$title = trim(ucwords(str_replace('+', ' ', $title)));
				# sanitize genre
				$title = strip_tags($title);
				
				#
				$this->db->select('*');
				//$this->db->from('book');
				$this->db->where('title', $title); 
				$query = $this->db->get('book');
				
				# array of info to pass to site
				$data = array(
					'title'=>ucwords(str_replace('_',' ',$page)),
					'sitename'=>'ELibrary',
					'categories'=> $this->Category_model->Get(),
					'display_name'=>$display_name,
					'rows'=>$query->result_array(),
					'categoryModel'=>$this->Category_model,
					'historyModel'=>$this->History_model,
					'reservationModel'=>$this->Reservation_model,
					'authorModel'=>$this->Author_model,
					'publisherModel'=>$this->Publisher_model,
					'bk_name'=>htmlspecialchars($title)
				);
				
				// loads the header template
				$this->template->load($header,null,$data);
				// finds and load the page
				$this->load->view($location.$page,$data);
				// loads the footer template
				$this->template->load('footer',null,$data);
			}else if($page == 'manage_users'){
				#
				if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 9999){
					# get user input from form
					extract($_POST);
					
					# configure pagination
					$config['base_url'] = base_url().'manage_users';
					# check if seaching
					if(!empty($usrname)){
						$config['total_rows'] = $this->db->get_where('user_profile', array('fullname' => mysql_real_escape_string($usrname)))->num_rows();
					}else{
						$config['total_rows'] = $this->db->get('user_profile')->num_rows();
					}
					$config['uri_segment'] = 2;
					$config['per_page'] = 10;
					$config['num_links'] = 20;
					$config['full_tag_open'] = '<div class="pagination"><ul>';
					$config['full_tag_close'] = '</ul></div>';
					$config['first_link']      = 'First';
					$config['first_tag_open']  = '<li>';
					$config['first_tag_close'] = '</li>';
					
					$config['last_link']      = 'Last';
					$config['last_tag_open']  = '<li>';
					$config['last_tag_close'] = '</li>';
					
					$config['next_link']      = 'Next';
					$config['next_tag_open']  = '<li>';
					$config['next_tag_close'] = '</li>';
					
					$config['prev_link']      = 'Previous';
					$config['prev_tag_open']  = '<li>';
					$config['prev_tag_close'] = '</li>';
					
					$config['cur_tag_open']  = '<li class="active"><a>';
					$config['cur_tag_close'] = '</a></li>';
					
					$config['num_tag_open']  = '<li>';
					$config['num_tag_close'] = '</li>';
					
					$this->pagination->initialize($config);
					
					# check if seaching
					if(!empty($usrname)){
						$query = $this->db->get_where('user_profile', array('fullname' => mysql_real_escape_string($usrname)),$config['per_page'], $this->uri->segment(2));
					}else{
						$query = $this->db->get('user_profile', $config['per_page'], $this->uri->segment(2));
					}
					
					# array of info to pass to site
					$data = array(
						'title'=>ucwords(str_replace('_',' ',$page)),
						'sitename'=>'ELibrary',
						'categories'=> $this->Category_model->Get(),
						'display_name'=>$display_name,
						'rows'=>$query->result_array()
					);
					
					// loads the header template
					$this->template->load($header,null,$data);
					// finds and load the page
					$this->load->view($location.$page,$data);
					// loads the footer template
					$this->template->load('footer',null,$data);
				}else{
					# redirect to home
					redirect('home');
				}
			}else if($page == 'manage_books'){
				#
				if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 9999){
					# get user input from form
					extract($_POST);
										
					# configure pagination
					$config['base_url'] = base_url().'manage_books';
					# check if seaching
					if(!empty($bk_title)){
						if(is_numeric($bk_title)){
							$config['total_rows'] = $this->db->get_where('book', array('ISBN' => $bk_title))->num_rows();
						}else{
							$config['total_rows'] = $this->db->get_where('book', array('title' => $bk_title))->num_rows();
						}
					}else{
						$config['total_rows'] = $this->db->get('book')->num_rows();
					}
					$config['uri_segment'] = 2;
					$config['per_page'] = 10;
					$config['num_links'] = 20;
					$config['full_tag_open'] = '<div class="pagination"><ul>';
					$config['full_tag_close'] = '</ul></div>';
					$config['first_link']      = 'First';
					$config['first_tag_open']  = '<li>';
					$config['first_tag_close'] = '</li>';
					
					$config['last_link']      = 'Last';
					$config['last_tag_open']  = '<li>';
					$config['last_tag_close'] = '</li>';
					
					$config['next_link']      = 'Next';
					$config['next_tag_open']  = '<li>';
					$config['next_tag_close'] = '</li>';
					
					$config['prev_link']      = 'Previous';
					$config['prev_tag_open']  = '<li>';
					$config['prev_tag_close'] = '</li>';
					
					$config['cur_tag_open']  = '<li class="active"><a>';
					$config['cur_tag_close'] = '</a></li>';
					
					$config['num_tag_open']  = '<li>';
					$config['num_tag_close'] = '</li>';
					
					$this->pagination->initialize($config);
					
					# check if seaching
					if(!empty($bk_title)){
						if(is_numeric($bk_title)){
							$query = $this->db->get_where('book', array('ISBN' => $bk_title),$config['per_page'], $this->uri->segment(2));
						}else{
							$query = $this->db->get_where('book', array('title' => $bk_title),$config['per_page'], $this->uri->segment(2));
						}
					}else{
						$query = $this->db->get('book', $config['per_page'], $this->uri->segment(2));
					}
					
					# array of info to pass to site
					$data = array(
						'title'=>ucwords(str_replace('_',' ',$page)),
						'sitename'=>'ELibrary',
						'categories'=> $this->Category_model->Get(),
						'display_name'=>$display_name,
						'categoryModel'=>$this->Category_model,
						'authorModel'=>$this->Author_model,
						'publisherModel'=>$this->Publisher_model,
						'rows'=>$query->result_array()
					);
					
					// loads the header template
					$this->template->load($header,null,$data);
					// finds and load the page
					$this->load->view($location.$page,$data);
					// loads the footer template
					$this->template->load('footer',null,$data);
				}else{
					# redirect to home
					redirect('home');
				}
			}else if($page == 'categories'){
				#
				if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 9999){
					# get user input from form
					extract($_POST);
					
					# configure pagination
					$config['base_url'] = base_url().'categories';
					# check if seaching
					if(!empty($cat_name)){
						$config['total_rows'] = $this->db->get_where('category', array('name' => $cat_name))->num_rows();
					}else{
						$config['total_rows'] = $this->db->get('category')->num_rows();
					}
					$config['uri_segment'] = 2;
					$config['per_page'] = 10;
					$config['num_links'] = 20;
					$config['full_tag_open'] = '<div class="pagination"><ul>';
					$config['full_tag_close'] = '</ul></div>';
					$config['first_link']      = 'First';
					$config['first_tag_open']  = '<li>';
					$config['first_tag_close'] = '</li>';
					
					$config['last_link']      = 'Last';
					$config['last_tag_open']  = '<li>';
					$config['last_tag_close'] = '</li>';
					
					$config['next_link']      = 'Next';
					$config['next_tag_open']  = '<li>';
					$config['next_tag_close'] = '</li>';
					
					$config['prev_link']      = 'Previous';
					$config['prev_tag_open']  = '<li>';
					$config['prev_tag_close'] = '</li>';
					
					$config['cur_tag_open']  = '<li class="active"><a>';
					$config['cur_tag_close'] = '</a></li>';
					
					$config['num_tag_open']  = '<li>';
					$config['num_tag_close'] = '</li>';
					
					$this->pagination->initialize($config);
					
					# check if seaching
					if(!empty($cat_name)){
						$query = $this->db->get_where('category', array('name' => $cat_name),$config['per_page'], $this->uri->segment(2));
					}else{
						$query = $this->db->get('category', $config['per_page'], $this->uri->segment(2));
					}
					
					# array of info to pass to site
					$data = array(
						'title'=>ucwords(str_replace('_',' ',$page)),
						'sitename'=>'ELibrary',
						'categories'=> $this->Category_model->Get(),
						'display_name'=>$display_name,
						'categoryModel'=>$this->Category_model,
						'authorModel'=>$this->Author_model,
						'publisherModel'=>$this->Publisher_model,
						'rows'=>$query->result_array()
					);
					
					// loads the header template
					$this->template->load($header,null,$data);
					// finds and load the page
					$this->load->view($location.$page,$data);
					// loads the footer template
					$this->template->load('footer',null,$data);
				}else{
					# redirect to home
					redirect('home');
				}
			}else{
				# array of info to pass to site
				$data = array(
					'title'=>ucwords(str_replace('_',' ',$page)),
					'sitename'=>'ELibrary',
					'categories'=> $this->Category_model->Get(),
					'display_name'=>$display_name,
					'fullname'=>$fullname,
					'email'=>$email,
					'phone'=>$phone,
					'mobile'=>$mobile,
					'dob'=>$dob,
					'gender'=>$gender,
					'address'=>$address,
					'country'=>$country,
					'city'=>$city,
					'state'=>$state,
					'zip'=>$postal,
					'fax'=>$fax,
					'website'=>$website
				);
				
				// loads the header template
				$this->template->load($header,null,$data);
				// finds and load the page
				$this->load->view($location.$page,$data);
				// loads the footer template
				$this->template->load('footer',null,$data);
			}
		}
	}
	
	# books
	function books(){
		# configure pagination
		$config['base_url'] = base_url().'home';
		$config['total_rows'] = $this->db->get('book')->num_rows();
		$config['uri_segment'] = 2;
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['first_link']      = 'First';
		$config['first_tag_open']  = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_link']      = 'Last';
		$config['last_tag_open']  = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_link']      = 'Next';
		$config['next_tag_open']  = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_link']      = 'Previous';
		$config['prev_tag_open']  = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open']  = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open']  = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$query = $this->db->get_where('book',null,$config['per_page'], $this->uri->segment(2));
		$rows = $query->result_array();
		
		$data = null;
		foreach($rows as $row){
			$data = $data.'<div class="item"><div class="thumbnail"><h4>'.$row["title"].'</h4>';
		    if(!empty($row["image_url"])){
		    	$data = $data.'<img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="'.base_url().'assets/img/books/'.$row["image_url"].'" />';
		    }else{
		    	$data = $data.'<img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="'.base_url().'assets/img/pics.png" />';
		    }				
		    $data = $data.'<div class="caption"><!--<b><small>RM<?php echo $row["price"]; ?></small></b>--><p>';
		    if(!empty($row["description"])){
				if(strlen($row["description"])>150){
				    $text=substr($row["description"],0,150).'... <a href="#">Read more</a>';
				    $data = $data . $text;
				}
			}else{
				$data = $data . 'N/A';
			}
		    $data = $data .'</p>';
		    if($this->session->userdata('logged_in')){
		    	$data = $data . '<div class="btn-group">
		    						<a href="#" class="btn btn-primary">Loan</a>
		    						<!--<a href="#" class="btn">Reserve</a>-->
		    					</div>';
		    }					
		    					
		    					
		    $data = $data .	'</div>
		    			</div>
					</div>
			';
		}
		
		echo $data;
	}

	# genres
	function genres(){
		# get user input from form
		$cat_name = trim(ucwords(str_replace('+', ' ', $this->uri->segment(2))));
		# sanitize genre
		$cat_name = strip_tags($cat_name);
		
		# configure pagination
		$config['base_url'] = base_url().'genre'.$this->uri->segment(2);
		$config['total_rows'] = $this->db->get_where('book',array('cat_name'=>mysql_real_escape_string($cat_name)))->num_rows();
		$config['uri_segment'] = 3;
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['first_link']      = 'First';
		$config['first_tag_open']  = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_link']      = 'Last';
		$config['last_tag_open']  = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_link']      = 'Next';
		$config['next_tag_open']  = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_link']      = 'Previous';
		$config['prev_tag_open']  = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open']  = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open']  = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$query = $this->db->get_where('book',array('cat_name'=>mysql_real_escape_string($cat_name)),$config['per_page'], $this->uri->segment(3));
		$rows = $query->result_array();
		
		$data = null;
		foreach($rows as $row){
			$data = $data.'<div class="item"><div class="thumbnail"><h4>'.$row["title"].'</h4>';
		    if(!empty($row["image_url"])){
		    	$data = $data.'<img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="'.base_url().'assets/img/books/'.$row["image_url"].'" />';
		    }else{
		    	$data = $data.'<img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: 180px;" src="'.base_url().'assets/img/pics.png" />';
		    }				
		    $data = $data.'<div class="caption"><!--<b><small>RM<?php echo $row["price"]; ?></small></b>--><p>';
		    if(!empty($row["description"])){
				if(strlen($row["description"])>150){
				    $text=substr($row["description"],0,150).'... <a href="#">Read more</a>';
				    $data = $data . $text;
				}
			}else{
				$data = $data . 'N/A';
			}
		    $data = $data .'</p>';
		    if($this->session->userdata('logged_in')){
		    	$data = $data . '<div class="btn-group">
		    						<a href="#" class="btn btn-primary">Loan</a>
		    						<!--<a href="#" class="btn">Reserve</a>-->
		    					</div>';
		    }					
		    					
		    					
		    $data = $data .	'</div>
		    			</div>
					</div>
			';
		}
		
		echo $data;
	}

	# update profile
	function update_profile(){
		#setting validation rules
		$this->form_validation->set_rules('usr_fullname','Fullname','required|trim|max_length[50]|xss_clean');
		$this->form_validation->set_rules('usr_email','Email','required|valid_email|trim|max_length[200]|xss_clean');
		$this->form_validation->set_rules('usr_phone','Phone','trim|max_length[200]|xss_clean');
		$this->form_validation->set_rules('usr_mobile','Mobile','trim|max_length[200]|xss_clean');
		$this->form_validation->set_rules('usr_dob','DOB','trim|max_length[200]|xss_clean');
		$this->form_validation->set_rules('usr_gender','Gender','trim|max_length[200]|xss_clean');
		$this->form_validation->set_rules('usr_address','Address','trim|max_length[200]|xss_clean');
		$this->form_validation->set_rules('usr_country','Country','trim|max_length[200]|xss_clean');
		$this->form_validation->set_rules('usr_city','City','trim|max_length[200]|xss_clean');
		$this->form_validation->set_rules('usr_state','State','trim|max_length[200]|xss_clean');
		$this->form_validation->set_rules('usr_zip','Zip/Postal Code','trim|max_length[200]|xss_clean');
		$this->form_validation->set_rules('usr_fax','Fax','trim|max_length[200]|xss_clean');
		$this->form_validation->set_rules('usr_website','Website','trim|max_length[200]|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error">','</div>');
		
		# get system id base on user id
		$system = $this->System_model->Get($this->session->userdata('user_id'));
		# get user profile info
		$profile = $this->Profile_model->Get($system->id);
					
		if($this->form_validation->run() == FALSE){
			#redirect
			redirect('settings');
		}else{
			#process user input and login the user
			extract($_POST);
			$data = array(
				'fullname'=>$usr_fullname,
				'email'=> $usr_email,
				'phone'=> $usr_phone,
				'mobilephone'=> $usr_mobile,
				'dob'=> $usr_dob,
				'gender'=> $usr_gender,
				'address'=> $usr_address,
				'country'=> $usr_country,
				'city'=> $usr_city,
				'state'=> $usr_state,
				'zip'=> $usr_zip,
				'fax'=> $usr_fax,
				'website'=> $usr_website
			);
			
			# save the changes to db
			$pid = $this->Profile_model->Edit($profile->id,$data);
			# 
			if(!empty($pid)){
				#set notification to user redirect
				$this->session->set_flashdata("notification",TRUE);
			}else{
				#set notification to user redirect
				$this->session->set_flashdata("chg_pro_error",TRUE);
			}
			
			#redirect
			redirect('settings');
		}
	}
	
	# update password
	function update_password(){
		#setting validation rules
		$this->form_validation->set_rules('old_password','old password','alpha_numeric|required|trim|max_length[200]|xss_clean');
		$this->form_validation->set_rules('new_password1','new password','alpha_numeric|required|trim|min_length[5]|max_length[200]|xss_clean');
		$this->form_validation->set_rules('new_password2','confirm new password','alpha_numeric|required|trim|min_length[5]|max_length[200]|xss_clean|matches[new_password1]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error">','</div>');
		
		# query the db for user info base on id
		$user = $this->User_model->Get($this->session->userdata('user_id'));	
		# get system id base on user id
		$system = $this->System_model->Get($this->session->userdata('user_id'));
		
		if($this->form_validation->run() == FALSE){
			#redirect
			redirect('change_password');
		}else{
			#process user input
			extract($_POST); 
			#check if current password match stored password
			if(sha1($old_password.$old_password) == $user->password)
			{
				#hash the password
				$hash_password = mysql_real_escape_string(sha1($new_password1.$new_password1));
				# create array for database fields & data
				$data = array(
					'password'=>$hash_password
				);
				
				# update changes to db
				$this->User_model->Edit($this->session->userdata('user_id'),$data);
				
				#set notification to user redirect
				$this->session->set_flashdata("notification",TRUE);
			}else{
				#set eror message to user redirect
				$this->session->set_flashdata('chg_psw_error',TRUE);
			}
			#redirect
			redirect('change_password');
		}
	}
	
	# retrieve password
	function retrieve_password(){
		#setting validation rules
		$this->form_validation->set_rules('username','Email or Username','required|trim|max_length[255]|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error">','</div>');
		
		if($this->form_validation->run() == FALSE){
			# redirect to current page
			redirect('forgotpassword');
		}else{
			# extract post
			extract($_POST);
			
			# check input is username or email
			if(filter_var($username,FILTER_VALIDATE_EMAIL)){
			# valid email
				$query_str = 'SELECT id,email FROM `user` WHERE email = ?'; #query string
			}else{
				# invalid email
				$query_str = 'SELECT id,email FROM `user` WHERE username = ?'; #query string
			}
			
			# query the db and assign the response to result
			$result = $this->db->query($query_str, array($username));
			
			# check if user is a member
			if($result->num_rows() == 1){
				# email password to user
				$user_id = $result->row(0)->id;
				$email = $result->row(1)->email;
				# generate new password
				$password = get_random_password();
				$textMsg = 'Dear Member, You request to change password. Your new password is ' . $password . '.';
				
				# create an array of user profile
				$data=array(
					'password'=>sha1($password.$password)
				);
				
				# update changes to db
				$this->User_model->Edit($user_id,$data);
				
				# send email to user
				$this->email->clear();
						
				$this->email->set_newline("\r\n");
				$this->email->from('info@elibrary.com','ELibrary');
			    $this->email->to($email);
			    $this->email->subject('ELibrary - Change Password');
			    $this->email->message($textMsg);
			    $this->email->send();
				
				# enable to debug
				#echo $this->email->print_debugger();
				
				# notification for user
				$this->session->set_flashdata('msg',TRUE);
			}
			# redirect to current page
			redirect('forgotpassword');
		}
	}
	
	# add users
	function add_user(){
		#check if user is logged in
		if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 9999){
			# setting validation rules
			$this->form_validation->set_rules('fname','first name','required|trim|max_length[200]|xss_clean');
			$this->form_validation->set_rules('lname','last name','required|trim|max_length[200]|xss_clean');
			$this->form_validation->set_rules('usr_email','email','required|trim|max_length[200]|xss_clean');
			$this->form_validation->set_rules('username','username','required|trim|max_length[200]|xss_clean');
			$this->form_validation->set_rules('new_password1','password','alpha_numeric|required|trim|min_length[5]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('new_password2','repeat password','alpha_numeric|required|trim|min_length[5]|max_length[200]|xss_clean|matches[new_password1]');
			$this->form_validation->set_rules('usr_role','Role','required|trim|xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error">','</div>');
			
			# 
			if($this->form_validation->run() == FALSE){
				# set notification to user redirect
				$this->session->set_flashdata("error",TRUE);
				redirect('manage_users');
			}else{
				#process user input
				extract($_POST);
				
				# create an array of user info
				$data=array(
					'username'=>mysql_real_escape_string($username),
					'password'=>sha1($new_password1.$new_password1),
					'fname'=>mysql_real_escape_string($fname),
					'lname'=>mysql_real_escape_string($lname),
					'registration_date'=>date('Y-m-d',time()),
					'role_id'=>mysql_real_escape_string($usr_role),
					'email'=>mysql_real_escape_string($usr_email),
					'blocked'=>'N',
					'activation_key'=>'111',
					'user_status'=>'Y',
					'display_name'=>mysql_real_escape_string($fname).' '.mysql_real_escape_string($lname)
				);
				# add new user
				$usr_id = $this->User_model->Add($data);
				
				# create an array for system info
				$data=array('ower_id'=>$usr_id);
				# add info to system
				$sys_id = $this->System_model->Add($data);
				
				# create an array of user profile
				$data=array(
					'system_id'=>$sys_id,
					'fullname'=>mysql_real_escape_string($fname).' '.mysql_real_escape_string($lname),
					'email'=>mysql_real_escape_string($usr_email)
				);
				# add new user profile
				$this->Profile_model->Add($data);
				
				#set notification to user redirect
				$this->session->set_flashdata("notification",TRUE);
				
				redirect('manage_users');
			}
		}else{
			#redirect to login page
			redirect('home');
		}
	}
	
	# manage books
	
	# manage category
	
	# send sms
	function sms(){
		#check if user is logged in
		if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 9999){
			# extract user inout
			extract($_POST);
			
			# check if msg and phone number was provided
			if(!empty($sms_msg) && !empty($sms_to)){
				# create an array of sms_to via split of a string
				$phones = explode(",", $sms_to);
				
				# file the sms class file
				$this->load->file('sms/TextMagicAPI.php', false);
				# create an instance of the class
				$sms = new TextMagicAPI();
				
				try {
					# send message
					$sms->send($sms_msg, $phones, true);
					# alert user of error
					$this->session->set_flashdata("noti_sms_success",TRUE);
					
				} catch (UnicodeSymbolsDetectedException $e) {
					//your code
				} catch (WrongPhoneFormatException $e) {
					//your code
				} catch (LowBalanceException $e) {
					//your code
				} catch (TooManyItemsException $e) {
					//your code
				} catch (AuthenticationException $e) {
					//your code
				} catch (IPAddressException $e) {
					//your code
				} catch (RequestsLimitExceededException $e) {
					//your code
				} catch (TooLongMessageException $e) {
					//your code
				} catch (Exception $e) {
					# alert user of error
					$this->session->set_flashdata("noti_sms_sys_error",TRUE);
				}
				
			}else{
				# alert user of error
				$this->session->set_flashdata("noti_sms_error",TRUE);
			}
			
			# redirect to send_sms
			redirect('send_sms');
		}else{
			# redirect to login page
			redirect('home');
		}
	}
	
	# loan history/logs
	
	# login
	function login(){
		if($this->session->userdata('logged_in') != 1){
			#setting validation rules
			$this->form_validation->set_rules('login_detail[username]','Username','required|trim|max_length[50]|xss_clean');
			$this->form_validation->set_rules('login_detail[password]','Password','required|trim|max_length[200]|xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error">','</div>');
			
			#login form validation checkpoint
			if($this->form_validation->run() == FALSE){
				# login failed error
				$this->session->set_flashdata('blank_error',TRUE);
				# redirect to current page
				redirect('home');
			}else{
				#process user input and login the user
				extract($_POST);
				$user_id = $this->User_model->check_login($login_detail['username'],$login_detail['password']);
				if(! $user_id){
					//login failed error
					$this->session->set_flashdata('login_error',TRUE);
				}else{
					//login successful
					#get the user role id
					$user = $this->User_model->Get($user_id);
					#create an array of user data and stores it in a session
					$login_data = array('logged_in' => TRUE,'user_id' => $user_id,'role_id' => $user->role_id);
					$this->session->set_userdata($login_data);
				}
				#redirect user
				redirect('home');
			}
		}else{
			#destroy the session
			$this->session->sess_destroy();
			#redirect to homepage
			redirect('home');
		}
	}
	
}
# Created by: Bevenny Creations