<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer extends CI_Controller {

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

	 public function __construct()
        {
                parent::__construct();
                 
                 if($this->session->userdata('logged_in') != TRUE || $this->session->userdata('type') != 'employer'){
                 	redirect('/user/login');
                 }
        }

 


	public function index()
	{ 




		$user = $this->db->get_where('users',array('user_id' => $this->session->userdata('user_id'), 'type' => $this->session->userdata('type')));

		$user = $user->result()[0];
		$data['user_information'] = $user;




			$this->load->view('employer/home', $data);
			
	 		 
	}


	
	public function jobs(){
		 $jobs = $this->db->get_where('jobs',array('user_id' => $this->session->userdata('user_id')))->result();

		 foreach($jobs as $job){
		 	$job->skills = get_job_skills($job->job_id);
		 }

		  
		 $this->load->view('employer/jobs', array('jobs' => $jobs));
	}


	public function applicants($job_id = 0)
	{
		// if job belongs to this employer


		$job = $this->db->get_where('jobs',array('user_id' => $this->session->userdata('user_id')));

		if($job->num_rows() > 0){
			$job = $job->result()[0];
			$applicants = $this->db->from('applied_job')->join('users','users.user_id = applied_job.user_id')->where('applied_job.job_id',$job_id)->where('users.type', 'job_seeker')->get();
			$data['skills']=$applicants->result();
			//print_r($data);
			
			
			$this->load->view('employer/applicants', $data);
				   }
				   else{
					   echo"no such job found";				   }
		
		}

		
		

		 
		

	public function postjob(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required|min_length[6]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['skills']  = $this->db->get('skills')->result();
			$this->load->view('employer/postjob', $data);
		}
		else{
			$insert_job = array(
				'user_id'=> $this->session->userdata('user_id'),
				'description'=> $this->input->post('description'),
				'title'=> $this->input->post('title'),
				'deadline'=> $this->input->post('deadline'),
				'timestamp'=> time(),
				'status' => 1
			);

			$this->db->insert('jobs',$insert_job);

			$job_id = $this->db->insert_id();

		    if(count($this->input->post('skills'))){
		      $skills = $this->input->post('skills');
		      foreach($skills as $skill){
		      	$this->db->insert('job_skills', array('job_id' => $job_id, 'skill_id' => $skill));
		      }
		    }
			

			redirect('/employer/jobs');
		 

		}
		
		
	}


	public function edit_job($job_id = 0){

		$data['job_id'] = $job_id;
	 
$data['job'] = $this->db->get_where('jobs',array('user_id' => $this->session->userdata('user_id'), 'job_id'=>$job_id));
		
		if($data['job']->num_rows() > 0)
		{
			
			$data['job'] = $data['job']->result()[0];
			$data['skills'] = get_job_skills($job_id);
			$data['skills_array'] = [];
			foreach($data['skills'] as $skill){
				array_push($data['skills_array'], $skill->skill_id);
			}
 
	

		$this->load->library('form_validation');

		//check for data validation

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required|min_length[6]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['skills']  = $this->db->get('skills')->result();
			$this->load->view('employer/edit_job', $data);
			
		}
		else
		{
			
		$update_array= array(
			
			'description'=> $this->input->post('description'),
			'title'=> $this->input->post('title'),
			'deadline'=> $this->input->post('deadline'),
			'timestamp'=> time(),
			
		);
$this->db->delete('job_skills',array('job_id'=>$job_id));


	$this->db->update('jobs',$update_array, array('job_id'=>$job_id,'user_id' => $this->session->userdata('user_id')));
	
	if(count($this->input->post('skills'))){
		$skills = $this->input->post('skills');
		foreach($skills as $skill){
			$this->db->insert('job_skills', array('job_id' => $job_id, 'skill_id' => $skill));
		}
	  }
	  
redirect('/employer/edit_job/'.$job_id);
   
	}
}
			 
	/*$data['job'] = $this->db->get_where('job_skills',array('job_id'=>$job_id));
		
	if($data['job']->num_rows() > 0)
	{
	
	$data['job'] = $data['job']->result()[0];
	
			if(count($this->input->post('skills')))
			{
			$skills = $this->input->post('skills');
				foreach($skills as $skill){
				
					



	
				
				$this->db->update('job_skills',$skill,array('job_id' => $job_id, 'skill_id' => $skill));
				}
			  }
			}
		  

		redirect('/employer/jobs');
		
		 
		 
		}
	}
	
	else{
		echo 'Action cannot be taken';
		redirect('/employer/jobs');
	}*/
		 
	  
} 
	public function check(){
		echo 'here';
	}

	 
}
