<?php $this->load->view('header');?>
<?php $this->load->view('employer/menu');?>



<h3 class="p-2">Your jobs are here</h3>

<a href="<?php echo base_url('employer/postjob');?>" class="btn btn-primary   p-2"><i class="fa fa-plus mr-2"></i>Post a Job</a>


<div class="row">
	<div class="col-12">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Title</th>
					
					<th>Deadline</th>
					<th>Posted On</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($jobs as $job){
					?>
					<tr>
					<td>
						
						<a href="<?php echo base_url('jobs/detail/'.$job->job_id);?>" class="pull-left"><?php echo $job->title;?></a>
						<?php
						if(gettype($job->skills) == 'array')
						 {
					  
						foreach($job->skills as $skill) {
						?>
						
						<span class="badge bg-grey"><?php echo $skill->title;?></span>
					<?php }}   ?>
					</td>
					<td><?php echo $job->deadline;?></td>
					<td><?php echo get_time($job->timestamp);?>
					<a href="<?php echo base_url('employer/edit_job/'.$job->job_id);?>" class="btn btn-sm btn-primary pull-right m-2"><i class="fa fa-plus mr-2"></i>Edit a job</a>
				
					<a href="<?php echo base_url('employer/applicants/'.$job->job_id);?>" class="btn btn-sm btn-primary pull-right m-2"><i class="fa fa-plus mr-2"></i>View Applicants</a></td>
				</tr>
					<?php
				}
				?>

				
				 
			</tbody>
		</table>
	</div>
</div>



<?php $this->load->view('employer/footer');?>    
<?php $this->load->view('footer');?>