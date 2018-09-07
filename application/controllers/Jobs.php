<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends CI_Controller {

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

	public function detail($job_id = 0){
		
		$data['job'] = $this->db->get_where('jobs',array('job_id' =>$job_id));

		if($data['job']->num_rows() > 0)
		{
			$data['job'] = $data['job']->result()[0];
			$data['job']->skills = get_job_skills($data['job']->job_id);
			$this->load->view('details', $data);
	
		}
		else{
			echo 'Not found job';
		}
		


		

	}





}
