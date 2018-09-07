<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$total_records=$this->db->from("jobs")->count_all_results();
		//print_r($record);
		$per_page = 5;
		$page = $this->input->get('page') == NULL ? 1 : $this->input->get('page');
		
		$total_pages = ceil($total_records/ $per_page);
	
			$jobs = $this->db->limit($per_page, ($page - 1) * $per_page)->get('jobs')->result();
	
			foreach($jobs as $job){
				
				$job->skills = get_job_skills($job->job_id);
			}
	
			 
			$this->load->view('jobs', array('jobs' => $jobs,'per_page' => $per_page, 'total_records' => $total_records, 'page' => $page));
	   
		
		
	}
	public function send()
	{

		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'ankit27@gmail.com',// your mail name
			'smtp_pass' => 'kkkkkk',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1',
			 'wordwrap' => TRUE
			);
			
			$this->load->library('email',$config);
			$this->email->from('ankit27@gmail.com', 'Support');
			$this->email->to('poojadshinde099@gmail.com');
			$this->email->cc('');
			$this->email->bcc('');
			
			$this->email->subject('Test');
			$this->email->message('This is a test email');
			
		if ( ! $this->email->send())
	{
		// Generate error
		echo "Email is not sent!!";
	}
			
			echo $this->email->print_debugger();
			
		}
	
	
	
	

	
	
   

	public function login(){


		//check if email and password are valid
		$this->load->library('form_validation');

		$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('login');
		}
		else{

			 
 

			//make variables

			$type = $this->input->post('user_type');
			$password = $this->input->post('password');
			$email = $this->input->post('user_email');


			//get salt from database using email and type

			$user_row = $this->db->get_where('users', array('email' => $email, 'type' => $type));

			 
			if($user_row->num_rows() > 0){
				//make hash from salt and password

				$user_row = $user_row->result()[0];

				$hash = md5($password.$user_row->salt);


			//match hash

			//if correct -> set session

				if($hash == $user_row->password){
					 $session_array = array(
					 	'user_id' => $user_row->user_id,
					 	'logged_in' => true,
					 	'type' => $type
					 );

					 $this->session->set_userdata($session_array);

					 if($type == 'employer'){
					 	redirect('employer');
					 }
					 elseif($type == 'job_seeker'){
					 	redirect('job_seeker');
					 }
					 else{
					 	redirect('user/register');
					 }
				}
				else{
					redirect('user/login?error=1');

				}

			 


			}
			else{
				redirect('user/login?error=1');
			}
	
			//else show error
		}
		//
	}

	public function logout(){
		 $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
    $this->session->sess_destroy();
    redirect('user/login');
	}

	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}



	function search_keyword()
    {

		$keyword = $this->input->get('q');

		 $data['jobs']    =   $this->search($keyword);

		 if($data['jobs'] == '0'){
			 $data['e_message'] = "No jobs have ".$keyword;
		 }
		 foreach($data['jobs'] as $job){
			$job->skills = get_job_skills($job->job_id);
		 }
		$this->load->view('search',$data);
    }
 
	
	function search($keyword)
    {
        $this->db->like('title',$keyword);
		$query  =   $this->db->get('jobs');
		if($query->num_rows() >0)
		{
			return	$query=$query->result();
		/*	print_r($query);
		die;
		return $query->result();*/
		}
		else{
			echo "0";

			}
	}

	public function register(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('user_name', 'Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('user_type', 'Type', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('register');
		}
		else{

			$email = $this->input->post('user_email');
			$name = $this->input->post('user_name');
			$type = $this->input->post('user_type');
			$password = $this->input->post('password');

         	 //check if this user exists => show error on frontend

			$check = $this->db->get_where('users', array('type'=> $type, 'email' => $email));

         	if($check->num_rows() == 0){ // new user

         		// generate salt

         	$salt = $this->generateRandomString(5);

         	// generate hash
         	

         	$hash = md5($password.$salt);

         	// store userinfo + hash + salt in users table

         	$user = array(
				 'email' => $email,
				 
         		'password' => $hash,
         		'salt' => $salt,
         		'name' => $name,
         		'type' => $type,
         		'timestamp' => time()
         	);

         	$this->db->insert('users', $user);

         	redirect('/user/login');

         	}
         	else{

         		redirect('/user/register?error=1');



         	}



         	// if user is fresh =>
         	
         }

		// check for post details
		// if correct than register the user from model than redirect to login
		// else show registration page
     }
 }
