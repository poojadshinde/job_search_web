<?php $this->load->view('header');?>
<?php $this->load->view('job_seeker/menu');?>



<h3 class="p-2">Your jobs are here</h3>




<div class="row">
	<div class="col-12">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Title</th>
					
					<th>Deadline</th>
					<th>Posted On</th>
					<th>Upload file</th>
				
					<th>Apply</th>
				
				
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
					<td><?php echo get_time($job->timestamp);?></td>
<td>
	<form enctype="multipart/form-data" action="upload" method="POST">
	<span class="file-field"> 
        <span class="btn btn-rounded purple-gradient btn-sm float-left">
	 
   <input class="btn btn-rounded btn-primary btn-sm"  type="file" name="userfile"></input><br/> 
    <input  class="btn btn-rounded btn-secondary btn-sm" type="submit" value="Upload"></input>
		</span>
		</span>
		</form>
		</td>
		<td>
		<a href="#" class="btn btn-rounded btn-primary btn-sm pull-right m-2 apply" data-job-id="<?php echo $job->job_id;?>"><i class="fa fa-plus mr-2"></i>Apply</a>


					<div class="container">
  
  <!-- Button to Open the Modal -->
 

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body  text-center">
         <small id="model_link"></small>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-rounded btn-primary btn-sm" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>	</td>

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

<script>
$('.apply').click(function(){
  

  var job_id = $(this).attr('data-job-id');

  $.ajax({
		'url':'<?php echo base_url('job_seeker/apply/');?>'+job_id, method:'get','success':function(response)
		{
			if(response==1)
		{
			$('#model_link').html('You have successfully applied for this job');
	}
	else{
		$('#model_link').html('You have already applied for this job');	
	}
	$('#myModal').modal('show');
  }
	})
});
</script>