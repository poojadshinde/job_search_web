<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_seeker extends CI_Controller {

	/**
	 *  for this controller.
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
                 
                 if($this->session->userdata('logged_in') != TRUE || $this->session->userdata('type') != 'job_seeker'){
                 	redirect('/user/login');
                 }
        }

 


	public function index()
	{ 




		$user = $this->db->get_where('users',array('user_id' => $this->session->userdata('user_id'), 'type' => $this->session->userdata('type')));

		$user = $user->result()[0];
		$data['user_information'] = $user;




			$this->load->view('job_seeker/home', $data);
			
	 		 
    }
    public function jobs(){
		//abcd
        $jobs = $this->db->get('jobs')->result();

        foreach($jobs as $job){
            $job->skills = get_job_skills($job->job_id);
        }

         
        $this->load->view('job_seeker/jobs', array('jobs' => $jobs));
   }

   
	public function detail($job_id = 0){

		if($this->input->post('user_id') == $this->session->userdata('user_id'))
		{
			 // insert a row in applicants userid, job_id, timestamp
		$job_id=$this->db->get_where('jobs',array('job_id' =>$job_id));
		if($job_id->num_rows() > 0)
		{
			$job_id = $job_id->result()[0]->job_id;
			$insert_job = array(
				'user_id'=> $this->session->userdata('user_id'),
				'timestamp'=> time(),
				'job_id'=>$job_id);
				
			
	
			$this->db->insert('applied_job',$insert_job);

			$applied_job_id = $this->db->insert_id();
			
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf';
		 
			$field_name = 'userfile';
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload($field_name))
			{
				 
				  $this->form_validation->set_message('upload', $this->upload->display_errors());
				   
			}
			else
			{
				$image_data = $this->upload->data();
				$filename = $image_data['file_name'];

				$this->db->update('applied_job', array('cv' => $filename), array('id' => $applied_job_id));
				
			 
			}
			echo"you have successfully applied";
		}
		else{
			echo("no id matching");
		}
		 }
		 else{
			$data['job'] = $this->db->get_where('jobs',array('job_id' =>$job_id));

			if($data['job']->num_rows() > 0)
			{
				$data['job'] = $data['job']->result()[0];
				$data['job']->skills = get_job_skills($data['job']->job_id);
				$this->load->view('job_seeker/detail', $data);
		
			}
			else{
				echo 'Not found job';
			}
		 
	 }
	}

			

		

	
	public function apply($job_id = 0){
		$job_id=$this->db->get_where('jobs',array('job_id' =>$job_id));
		if($job_id->num_rows() > 0)
		{
		$user_id= $this->session->userdata('user_id');
			$job_id = $job_id->result()[0]->job_id;
			$insert_job = array(
				'user_id'=> $this->session->userdata('user_id'),
				'timestamp'=> time(),
				'job_id'=>$job_id);
				$user_row = $this->db->get_where('applied_job', array('user_id' => $user_id, 'job_id' => $job_id));

			if($user_row->num_rows() > 0)
			{
			echo "0";
			}
			else
			{
			$this->db->insert('applied_job',$insert_job);
			echo "1";
			}
		}
		
		
	
		}
	
	public function upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf';
     
        $field_name = 'userfile';
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload($field_name))
        {
			print_r($this->upload->display_errors());
			
              $this->form_validation->set_message('upload', $this->upload->display_errors());
              return FALSE;
        }
        else
        {
            $image_data = $this->upload->data();
			$filename = $image_data['file_name'];
			
			$source_image = $image_data['full_path'];
			$user = array('cv' => $source_image);
			$this->db->insert('applied_job',$user);
			
            $config = array
            (
              'source_image' => $image_data['full_path'],
              'new_image' => './uploads/thumbs/',
              'maintain_ratio' => false,
              'width' => 300,
              'height' => 200
			);
			
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            return TRUE;
        }
    }
}