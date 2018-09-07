<?php // utility.php
if(!defined('BASEPATH')) exit('No direct script access allowed');
 

function get_time($timestamp){
	return date('H:i m/d/Y', $timestamp);
}
function timeIn($timestamp)
{
	return date('H:i:s',$timestamp);
/*$hours = floor($timestamp / 60);
$days = floor($timestamp / 720);
$minutes = ($timestamp % 60);
echo $days.":".$hours.":".$minutes;*/
}

function get_job_skills($job_id = 0){

	$CI =& get_instance();

	//$jobs = $CI->db->get_where('job_skills', array('job_id'=> $job_id));
	$jobs = $CI->db->from('job_skills')->join('skills','job_skills.skill_id = skills.skill_id')->where('job_skills.job_id',$job_id)->get();

	if($jobs->num_rows() > 0){
		return $jobs->result();
		print_r("$jobs->result();");
	}
	else{
		return 'job doesn\'t exists';

		
	}



}

/*
function version_count($disclaimer_id){
	$CI =& get_instance();
	return $CI->db->get_where('versions',array('disclaimer_id'=>$disclaimer_id))->num_rows();
}
  */

;?>