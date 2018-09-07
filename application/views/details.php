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
                                  
                                  
            
					
			</div>
		</div>
	</div>

</div>
    
<?php $this->load->view('footer');?>