<?php $this->load->view('header');?>
<?php $this->load->view('menu');?>



<h3 class="p-2 text-left">Recently Posted Jobs</h3>


<div class="row">
	<div class="col-12 bg-light">
	<?php foreach($jobs as $job) {
		?>
		<div class="card material-shadow p-3 my-3 no-border">
			<b><?php echo $job->title;?></b>
			<?php
						if(gettype($job->skills) == 'array')
						 {
							 ?>
							 <div class="row">
								 <?php 
					  
						foreach($job->skills as $skill) {
						?>
						 
						<span class="skill-tags">
							<?php echo $skill->title;?>
						</span>
					<?php }
					?>
			</div>
					<div class="w-100 text-right">
					
					<!--<a href="<?php echo base_url('user/pop_up');?>"class="btn btn-rounded btn-primary btn-sm">Apply Now</a>-->
					<?php $this->load->view('model');?>  
					</div>
					<small>posted on <?php echo get_time($job->timestamp);?></small></br>
					<?php 
				}   ?>
	</div>
		<?php
	}
	?>
<nav aria-label="Page navigation example">
  <ul class="pagination">
	  <?php for($i = 1; $i <= ceil($total_records/$per_page); $i++) {
		  ?>
		  <li class="page-item"><a class="page-link" href="<?php echo base_url('user?page='.$i);?>"><?php echo $i;?></a></li>
		  <?php

	  }
	  ?>
  </ul>
</nav>



<?php $this->load->view('employer/footer');?>    
<?php $this->load->view('footer');?>