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
			//$checkpoint = 'application/modules_core/pages/views/protected/';
			$header = 'header1';
			//$location = 'protected/';
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
		
		# check if the page exists
		if ( ! file_exists($checkpoint.$page.'.php'))
		{
			if($page == 'edit_book'){
				# edit book
				$this->edit_book();
			}else if($page == 'retrieve_password'){
				# update password
				$this->retrieve_password();
			}else if($page == 'add_user'){
				# add new user
				$this->add_user();
			}elseif($page == 'update_book'){
				# edit book
				$this->update_book();
			}else if($page == 'add_category'){
				# add new category
				$this->add_category();
			}else if($page == 'edit_category'){
				# edit category
				$this->edit_category();
			}else if($page == 'update_category'){
				# update category
				$this->update_category();
			}else if($page == 'add_book'){
				# add new book
				$this->add_book();
			}else if($page == 'genres'){
				$this->genres();
			}else if($page == 'request'){
				# request book
				$this->request();
			}elseif($page == 'books'){
				$this->books();
			}else if($page == 'sms'){
				$this->sms();
			}else if($page == 'update_profile'){
				# update profile
				$this->update_profile();
			}else if($page == 'update_password'){
				# update password
				$this->update_password();
			}else if($page == 'loan'){
				# loan book
				$this->loan_book();
			}else if($page == 'reserve'){
				# reserve book
				$this->reserve_book();
			}else if($page == 'manage_account'){
				# manage account
				$this->manage_account();
			}else if($page == 'payment'){
				# make payment
				$this->payment();
			}else if($page == 'validatePaypal'){
				# validate payment
				$this->validatePaypal();
			}else if($page == 'success'){
				# successful payment
				$this->successPayment();
			}else if($page == 'cancel'){
				# cancel payment
				$this->cancelPayment();
			}else if($page == 'login'){
				# login/logout
				$this->login();
			}else if($page == 'del_history'){
				# login/logout
				$this->del_history();
			}else{
				# Whoops, we don't have a page for that!
				redirect('home');
			}
		}else{
			if($page == 'my_history'){
				#check if user is logged in
				if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 1){
					# query the db for user info base on id
					$user = $this->User_model->Get($this->session->userdata('user_id'));
					
					# get system id base on user id
					$system = $this->System_model->Get($this->session->userdata('user_id'));
					
					# configure pagination
					$config['base_url'] = base_url().'my_history';
					$config['total_rows'] = $this->db->get_where('history',array('system_id'=>mysql_real_escape_string($system->id),'display_history'=>'Y'))->num_rows();
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
					
					$query = $this->db->get_where('history',array('system_id'=>mysql_real_escape_string($system->id),'display_history'=>'Y'),$config['per_page'], $this->uri->segment(2));
					
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
						'genre'=>'',
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
						'genre'=>'',
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
					'genre'=>'',
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
					'genre'=>'',
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
					'genre'=>'',
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
						'systemModel'=>$this->System_model,
						'userModel'=>$this->User_model,
						'display_name'=>$display_name,
						'genre'=>'',
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
						'authors'=> $this->Author_model->Get(),
						'publishers'=> $this->Publisher_model->Get(),
						'display_name'=>$display_name,
						'categoryModel'=>$this->Category_model,
						'authorModel'=>$this->Author_model,
						'publisherModel'=>$this->Publisher_model,
						'genre'=>'',
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
						'genre'=>'',
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
			}elseif($page == 'contact'){
				#setting validation rules
				$this->form_validation->set_rules('subject', '', 'required|trim|max_length[50]|xss_clean');
				$this->form_validation->set_rules('name', '', 'trim|xss_clean');
				$this->form_validation->set_rules('email', '', 'required|valid_email|trim|max_length[50]|xss_clean');
				$this->form_validation->set_rules('message', '', 'required|trim|xss_clean');
	
				$this->form_validation->set_error_delimiters('<div class="alert alert-error" style="display:inline-block;">
				<a class="close" data-dismiss="alert" href="#">x</a><strong>Warning!</strong> ', '</div>');
				
				# array of info to pass to site
				$data = array(
					'title'=>ucwords(str_replace('_',' ',$page)),
					'sitename'=>'ELibrary',
					'categories'=> $this->Category_model->Get(),
					'genre'=>'',
					'display_name'=>$display_name
				);
				
				// loads the header template
				$this->template->load($header,null,$data);
				
				if ($this->form_validation->run() == FALSE) {
					// finds and load the page
					$this->load->view($location.$page,$data);
				}else{
					#process user input and login the user
					extract($_POST);
					
					# load email library
					$this->load->library('email');
					
					$this->email->set_newline("\r\n");
					$this->email->from($email, $name);
					# company email here...
					$this->email->to('drewbdennis@gmail.com');
					$this->email->subject($subject);
					$this->email->message($message);
					
					# check if message was sent...
					if($this->email->send()){
						#set notification to user redirect
						$this->session->set_flashdata("sent_success",TRUE);
					}else{
						#set notification to user redirect
						$this->session->set_flashdata("sent_error",TRUE);
					}
					
					# un-comment to debug
					#echo $this->email->print_debugger();
					
					#redirect
					redirect('contact');
				}
				
				// loads the footer template
				$this->template->load('footer',null,$data);
			}else{
				# array of info to pass to site
				$data = array(
					'title'=>ucwords(str_replace('_',' ',$page)),
					'sitename'=>'ELibrary',
					'categories'=> $this->Category_model->Get(),
					'genre'=>'',
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
		//$this->db->get_where('book',null,$config['per_page'], $this->uri->segment(2));
		//$query = $this->db->order_by('title','asc');
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
	
	# add category
	function add_category(){
		#check if user is logged in
		if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 9999){
			# setting validation rules
			$this->form_validation->set_rules('cat_name','','required|trim|max_length[50]|xss_clean');
			$this->form_validation->set_rules('cat_description','','trim|max_length[255]|xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error">','</div>');
			
			# 
			if($this->form_validation->run() == FALSE){
				# set notification to user redirect
				$this->session->set_flashdata("error",TRUE);
				redirect('categories');
			}else{
				#process user input
				extract($_POST);
				
				# create an array of user info
				$data=array(
					'name'=>mysql_real_escape_string($cat_name),
					'description'=>mysql_real_escape_string($cat_description)
				);
				# add new category
				$cat_id = $this->Category_model->Add($data);
				
				# check if data was added
				if (!empty($cat_id)) {
					#set notification to user redirect
					$this -> session -> set_flashdata("notification", TRUE);
				}
				
				redirect('categories');
			}
		}else{
			#redirect to login page
			redirect('home');
		}
	}
	
	# edit category
	function edit_category(){
		#check if user is logged in
		if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 9999){
			$data = null;
			
			# extract post values
			extract($_POST);
			
			# get category data based on id
			$category = $this->Category_model->Get($cat_id);
			
			$data = '
					<div class="modal-body">
					<input type="hidden" value="'.$cat_id.'" name="cat_id">
				    <label>Category Name</label>
					<input type="text" class="input input-xlarge" id="cat_name" value="'.$category->name.'" name="cat_name">
					<label>Category Description</label>
					<textarea class="span12" id="cat_description" rows="5" cols="30" name="cat_description">'.$category->description.'</textarea>
				  </div>
				  <div class="modal-footer">
				    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				    <input type="submit" class="btn btn-primary" value="Update Category" name="submit">
				  </div>
			';
			
			echo $data;
		}
	}
	
	# update category
	function update_category(){
		#check if user is logged in
		if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 9999){
			# setting validation rules
			$this->form_validation->set_rules('cat_name','','required|trim|max_length[50]|xss_clean');
			$this->form_validation->set_rules('cat_description','','trim|max_length[255]|xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error">','</div>');
			
			# 
			if($this->form_validation->run() == FALSE){
				# set notification to user redirect
				$this->session->set_flashdata("error",TRUE);
				redirect('categories');
			}else{
				#process user input
				extract($_POST);
				
				# create an array of user info
				$data=array(
					'name'=>mysql_real_escape_string($cat_name),
					'description'=>mysql_real_escape_string($cat_description)
				);
				# add new category
				$this->Category_model->Update($cat_id,$data);
				
				# set notification to user redirect
				$this -> session -> set_flashdata("noti_update", TRUE);
				
				redirect('categories');
			}
		}else{
			#redirect to login page
			redirect('home');
		}
	}
	
	# add book (later improve to add author,category,publisher if not in database)
	function add_book(){
		#check if user is logged in
		if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 9999){
			# setting validation rules
			$this->form_validation->set_rules('ISBN','','required|trim|max_length[9]|xss_clean');
			$this->form_validation->set_rules('bk_title','','required|trim|max_length[150]|xss_clean');
			$this->form_validation->set_rules('bk_author','','required|trim|max_length[10]|xss_clean');
			$this->form_validation->set_rules('bk_publisher','','required|trim|max_length[10]|xss_clean');
			$this->form_validation->set_rules('bk_year','','required|trim|max_length[4]|xss_clean');
			$this->form_validation->set_rules('bk_description','','trim|xss_clean');
			$this->form_validation->set_rules('bk_quantity','','required|trim|max_length[10]|xss_clean');
			$this->form_validation->set_rules('bk_price','','trim|max_length[10]|xss_clean');
			$this->form_validation->set_rules('bk_category','','required|trim|max_length[50]|xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error">','</div>');
			
			# validates the form
			if($this->form_validation->run() == FALSE){
				# set notification to user redirect
				$this->session->set_flashdata("error",TRUE);
				redirect('manage_books');
			}else{
				# set upload config
				$config['upload_path'] = './assets/img/books/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 0;
				$config['encrypt_name'] = TRUE;
				
				# loaded and set configuration for library
				$this->load->library('upload', $config);
				
				# check if file was uploaded
				if (!$this->upload->do_upload('userfile')) {
					# set notification to user redirect
					$this->session->set_flashdata("upload_error", TRUE);
				}else{
					# process user input
					extract($_POST);
					
					# get info about uploaded file and assign to $file
					$file = $this->upload->data();
					
					# create an array of user info
					$data=array(
						'ISBN'=>mysql_real_escape_string($ISBN),
						'title'=>mysql_real_escape_string($bk_title),
						'author_id'=>mysql_real_escape_string($bk_author),
						'pub_id'=>mysql_real_escape_string($bk_publisher),
						'year'=>mysql_real_escape_string($bk_year),
						'description'=>mysql_real_escape_string($bk_description),
						'quantity'=>mysql_real_escape_string($bk_quantity),
						'price'=>mysql_real_escape_string($bk_price),
						'image_url'=>mysql_real_escape_string($file['file_name']),
						'cat_name'=>mysql_real_escape_string($bk_category)
					);
					# add new category
					$book_id = $this->Book_model->Add($data);
					
					# set notification to user redirect
					$this -> session -> set_flashdata("notification", TRUE);
					
					# send notification to user about new book
					$this->new_book_notifi($bk_title);
				}
				
				# redirect to manage books
				redirect('manage_books');
			}
		}else{
			#redirect to login page
			redirect('home');
		}
	}
	
	# edit book
	function edit_book(){
		#check if user is logged in
		if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 9999){
			$data = null;
			
			# extract post values
			extract($_POST);
			
			# get book data based on id
			$book = $this->Book_model->Get($book_id);
			
			# get categories
			$categories = $this->Category_model->Get();
			
			# get authora
			$authors = $this->Author_model->Get();
			
			# get publishers
			$publishers = $this->Publisher_model->Get();
			
			$data = '
					<div class="modal-body">
					<input type="hidden" value="'.$book_id.'" name="book_id">
					<div>
						<div class="fileupload fileupload-new" data-provides="fileupload">
						  <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
						  	<img class="pull-left" alt="book_pic" src="'.base_url().'assets/img/books/'.$book->image_url.'" />
						  </div>
						  <div>
						    <span class="btn btn-file">
						    	<span class="fileupload-new">Select image</span>
						    	<span class="fileupload-exists">Change</span>
						    	<input type="file" name="userfile" value="" id="userfile" class="input">
						    </span>
						    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
						  </div>
						</div>
					</div>
					
					<div style="padding-bottom: 10px;">
				    	<input type="text" name="bk_title" value="'.$book->title.'" id="bk_title" class="input input-xlarge" placeholder="Title of Book" maxlength="150">						<span class="label label-important">Required</span>
					</div>
					
					<div style="padding-bottom: 10px;">
						<select id="bk_author" name="bk_author" style="width:280px;">';
							foreach($authors as $author){
								$data = $data.'<option value="'.$author->id.'"';
								if($book->author_id == $author->id){
									$data = $data.'selected="selected">'.$author->au_fname.' '.$author->au_lname.'</option>';
								}else{
									$data = $data.'>'.$author->au_fname.' '.$author->au_lname.'</option>';
								}
							}
					$data = $data.'</select>
						<span class="label label-important">Required</span>
					</div>
					
					<div style="padding-bottom: 10px;">
						<select id="bk_publisher" name="bk_publisher" style="width:280px;">';
							foreach($publishers as $publish){
								$data = $data.'<option value="'.$publish->id.'"';
								if($book->pub_id == $publish->id){
									$data = $data.'selected="selected">'.$publish->pub_name.'</option>';
								}else{
									$data = $data.'>'.$publish->pub_name.'</option>';
								}
							}
					$data = $data.'</select>
						<span class="label label-important">Required</span>
					</div>
					
					<div style="padding-bottom: 10px;">
						<input type="text" name="bk_year" value="'.$book->year.'" id="bk_year" class="input input-xlarge" placeholder="Year Published" maxlength="4">						<span class="label label-important">Required</span>
					</div>
					
					<div style="padding-bottom: 10px;">
						<input type="text" name="bk_quantity" value="'.$book->quantity.'" id="bk_quantity" class="input input-xlarge" placeholder="Quantity" maxlength="10">						<span class="label label-important">Required</span>
					</div>
					
					<div style="padding-bottom: 10px;">
						<div class="input-prepend">
							<span class="add-on span4">RM</span>
							<input type="text" name="bk_price" value="'.$book->price.'" id="bk_price" class="input input-xlarge span12" placeholder="Price" maxlength="10">						</div>
					</div>
					
					<div style="padding-bottom: 10px;">
						<select id="bk_category" name="bk_category" style="width:280px;">';
						
					foreach($categories as $category){
						$data = $data.'<option value="'.$category->name.'"';
						if($book->cat_name == $category->name){
							$data = $data.'selected="selected">'.$category->name.'</option>';
						}else{
							$data = $data.'>'.$category->name.'</option>';
						}
					}	
						
					$data = $data.'</select>
						<span class="label label-important">Required</span>
					</div>
				
					<label>Description</label>
					<textarea name="bk_description" cols="30" rows="5" id="bk_description" class="span12">'.$book->description.'</textarea>				
				</div>
				  <div class="modal-footer">
				    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				    <input type="submit" name="submit" value="Update Book" class="btn btn-primary">
				</div>
			';
			
			echo $data;
		}
	}
	
	# update book
	function update_book(){
		#check if user is logged in
		if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 9999){
			# set upload config
			$config['upload_path'] = './assets/img/books/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = 0;
			$config['encrypt_name'] = TRUE;
			
			# loaded and set configuration for library
			$this->load->library('upload', $config);
			
			# check if file was uploaded
			if (!$this->upload->do_upload('userfile')) {
				# not new book image
				# process user input
				extract($_POST);
				
				# create an array of user info
				$data=array(
					'title'=>mysql_real_escape_string($bk_title),
					'author_id'=>mysql_real_escape_string($bk_author),
					'pub_id'=>mysql_real_escape_string($bk_publisher),
					'year'=>mysql_real_escape_string($bk_year),
					'description'=>mysql_real_escape_string($bk_description),
					'quantity'=>mysql_real_escape_string($bk_quantity),
					'price'=>mysql_real_escape_string($bk_price),
					'cat_name'=>mysql_real_escape_string($bk_category)
				);
				# update category
				$this->Book_model->Update($book_id,$data);
				
				# set notification to user redirect
				$this -> session -> set_flashdata("noti_update", TRUE);
			}else{
				# process user input
				extract($_POST);
				
				# get info about uploaded file and assign to $file
				$file = $this->upload->data();
				
				# create an array of user info
				$data=array(
					'title'=>mysql_real_escape_string($bk_title),
					'author_id'=>mysql_real_escape_string($bk_author),
					'pub_id'=>mysql_real_escape_string($bk_publisher),
					'year'=>mysql_real_escape_string($bk_year),
					'description'=>mysql_real_escape_string($bk_description),
					'quantity'=>mysql_real_escape_string($bk_quantity),
					'price'=>mysql_real_escape_string($bk_price),
					'image_url'=>mysql_real_escape_string($file['file_name']),
					'cat_name'=>mysql_real_escape_string($bk_category)
				);
				# update category
				$this->Book_model->Update($book_id,$data);
				
				# set notification to user redirect
				$this -> session -> set_flashdata("noti_update", TRUE);
				
			}			
			
			# redirect to manage books
			redirect('manage_books');
			
		}else{
			#redirect to login page
			redirect('home');
		}
	}
	
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

	# request book
	function request(){
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
	}
	
	# loan book
	function loan_book(){
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
	}
	
	# reserve book
	function reserve_book(){
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
	}
	
	# manage account
	function manage_account(){
		#check if user is logged in
		if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 9999){
			# get user id for url
			$account_id = $this->uri->segment(2);
			# get user info
			$user = $this->User_model->Get($account_id);
			
			if($user->blocked == 'Y'){
				# enable user account
				$data = array(
					'blocked'=>'N'
				);
				# update user info
				$this->User_model->Edit($account_id,$data);
				# display notification to user
				$this->session->set_flashdata('account_enable',TRUE);
			}else{
				# disable user account
				$data = array(
					'blocked'=>'Y'
				);
				# update user info
				$this->User_model->Edit($account_id,$data);
				# display notification to user
				$this->session->set_flashdata('account_disable',TRUE);
			}
			
			# redirect to send_sms
			redirect('manage_users');
		}else{
			# redirect to login page
			redirect('home');
		}
	}
	
	# new book notification
	function new_book_notifi($bk_time = null){
		# assign bk_title to title
		$title = $bk_time;
		
		# file the sms class file
		$this->load->file('sms/TextMagicAPI.php', false);
		# create an instance of the class
		$sms = new TextMagicAPI();
		
		# check for empty or null input
		if(!empty($title) && $title != ''){
			# get all user, where user isn't an admin
			$query = $this->db->query('select * from user_profile P inner join system S on s.id=p.system_id inner join user U on s.ower_id=U.id
			 where U.role_id!="9999" and P.mobilephone!="" and P.mobilephone!="N/A"');
			$userInfos = $query->result();
			# send notification to those with mobile number only
			foreach($userInfos as $userInfo){
				# create message for user
				$message = 'Dear Reader, a new book entitled "'.$title.'" was added to our collection. So come over, get a copy and start reading.';
				# get and assign user mobile to phone
				$phones = array($userInfo->mobilephone);
				# send sms to user
				try {
					# send sms
					$sms->send($message, $phones, true);
				}catch(Exception $e){
					# write error to log file
					log_message('error', "Catched Exception '".__CLASS__ ."' with message '".$e->getMessage()."' in ".$e->getFile().":".$e->getLine());
				}
			}
		}
	}
	
	# loan history/logs
	
	
	# make payment
	function payment(){
		#check if user is logged in
		if($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 1){
			# extract user input
			extract($_POST);
			
			# check if post data isn't null/empty
			
			# create an array of info to store in session
			$data = array(
				'totalPrice'=>mysql_real_escape_string($total),
				'orderId'=>md5(uniqid (rand(), true))
			);
			# store data in session
			$this->session->set_userdata($data);
			
			# connects to paypal
			$this->paypal();
		}else{
			#redirect to login page
			redirect('home');
		}
	}
	
	# paypal function
	public function paypal() {
		# get and load the paypal library
		$this->load->library('paypal_class');
		$this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
		//$this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
		$this->paypal_class->add_field('currency_code', 'USD');
		$this->paypal_class->add_field('business', $this->config->item('bussinessPayPalAccountTest'));
		//$this->paypal_class->add_field('business', $this->config->item('bussinessPayPalAccount'));
		$this->paypal_class->add_field('return', base_url().'success'); // return url
		$this->paypal_class->add_field('cancel_return', base_url().'cancel'); // cancel url
		$this->paypal_class->add_field('notify_url', base_url().'validatePaypal'); // notify url
		$totalPrice = $this->session->userdata('totalPrice');
		$this->paypal_class->add_field('item_name', 'Outstanding Fines');
		$this->paypal_class->add_field('amount', $totalPrice);
		$this->paypal_class->add_field('custom', $this->session->userdata('orderId'));
		$this->paypal_class->submit_paypal_post(); // submit the fields to paypal
		//$p->dump_fields();      // for debugging, output a table of all the fields
		exit;
	}

	# paypal validation function
	public function validatePaypal() {
		$this->load->library('paypal_class');
		$this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
		//$this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
		if ($this->paypal_class->validate_ipn()) {
		$orderId = trim($_POST['custom']);
		$itemName = trim($_POST['item_name']);
		// put your code here
		}
		break;
	}
	
	# successful payment
	function successPayment(){
		# set notification for user
		$this->session->set_flashdata('success_payment',TRUE);
		
		#redirect to login page
		redirect('fines');
	}
	
	# cancel payment
	function cancelPayment(){
		# set notification for user
		$this->session->set_flashdata('cancel_payment',TRUE);
		
		#redirect to login page
		redirect('fines');
	}
	
	# cancel reservation
	function cancel_reservation()
	{
		if($this->session->userdata('logged_in')){
			# get system id base on user id
			$system = $this->System_model->Get($this->session->userdata('user_id'));
			
			# get ISBN for url
			$book_id = $this->uri->segment(2);
			
			# delete reservation from db
			$data = array(
				'ISBN'=> mysql_real_escape_string($book_id),
				'system_id'=>$system->id
			);
			
			$this->Reservation_model->Delete($data);
			redirect('my_reservation');
			
		}else{
			// redirect to home
			redirect('home');
		}
	}
	
	# delete history
	function del_history()
	{
		if($this->session->userdata('logged_in')){
			# get system id base on user id
			$system = $this->System_model->Get($this->session->userdata('user_id'));
			
			# get history id for url
			$history_id = $this->uri->segment(2);
			
			# update history db
			$data = array(
				'display_history'=>'N'
			);
			
			$this->History_model->Update($history_id,$data);
			redirect('my_history');
			
		}else{
			// redirect to home
			redirect('home');
		}
	}	
	
	# login
	function login(){
		if($this->session->userdata('logged_in') != 1){
			# setting validation rules
			$this->form_validation->set_rules('login_detail[username]','Username','required|trim|max_length[50]|xss_clean');
			$this->form_validation->set_rules('login_detail[password]','Password','required|trim|max_length[200]|xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error">','</div>');
			
			# login form validation checkpoint
			if($this->form_validation->run() == FALSE){
				# login failed error
				$this->session->set_flashdata('blank_error',TRUE);
				# redirect to current page
				redirect('home');
			}else{
				# process user input and login the user
				extract($_POST);
				$user_id = $this->User_model->check_login($login_detail['username'],$login_detail['password']);
				if(! $user_id){
					//login failed error
					$this->session->set_flashdata('login_error',TRUE);
				}else{
					//login successful
					# get the user role id
					$user = $this->User_model->Get($user_id);
					# create an array of user data and stores it in a session
					$login_data = array('logged_in' => TRUE,'user_id' => $user_id,'role_id' => $user->role_id);
					$this->session->set_userdata($login_data);
				}
				
				# get the user role id
				$user = $this->User_model->Get($user_id);
				
				# check if user account is blocked
				if($user->blocked == "Y"){
					# array of user session data
					$login_data = array('logged_in' => '','user_id' => '','role_id' => '');
					# unset user session
					$this->session->unset_userdata($login_data);
					
					# display notification to user
					$this->session->set_flashdata('account_blocked',TRUE);
					#echo 'blocked';
					
				}
				# redirect to homepage
				redirect('home');
			}
		}else{
			# destroy the session
			$this->session->sess_destroy();
			# redirect to homepage
			redirect('home');
		}
	}
	
}
# Created by: Bevenny Creations