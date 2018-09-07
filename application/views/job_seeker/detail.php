<?php $this->load->view('header');?>

<div class="container">
	<div class="row">
		<div class="col-12 col-sm-6 mx-auto">

			<div class="card bg-light py-4 px-4 my-4 no-border">
				<h4 class="text-center">Jobs Details</h4>
						
                                  <span> <b> Job_id:</b><?php echo $job->job_id;?></span>
                                  <span> <b> Title:</b> <?php echo $job->title;?> </span>
                 
                 
                                  <span>  <b> Description:</b><?php echo $job->description;?> </span>
                                  <span> <b>  Deadline:</b><?php echo $job->deadline;?> </span>
                                  <span> <b>  Timestamp:</b><?php echo $job->timestamp;?></span>
                                  <span><b>  skills:</b>
                                    <?php foreach($job->skills as $skill) { ?>
                                          <?php echo $skill->title; ?> 
                                    
                                   <?php } ?></span>
      <form action="<?php echo base_url('job_seeker/detail/'.$job->job_id);?>" method="post" enctype="multipart/form-data">
      <div class="form-group my-3">
          <label for="inputAddress">Upload your resume to apply</label>
     <input id="fileToUpload" class="form-control" name="userfile" multiple="" type="file" >

     <input value="Apply for Job" type="submit" class="btn btn-primary my-3">
     <input type="hidden" value="<?php echo $this->session->userdata('user_id');?>" name="user_id">
      </div>
</form>
 
                    
					
			</div>
		</div>
	</div>

</div>
    
<?php $this->load->view('footer');?>