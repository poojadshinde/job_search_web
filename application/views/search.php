
<?php $this->load->view('header');?>



<h3 class="p-2 text-center">Recently Posted Jobs</h3>
<?php

if(isset($e_message)){
    echo '<p class="text-error p-10">'.$e_message.'</p>';
}
else{
    ?>
    <?php
}
?>


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


<?php $this->load->view('employer/footer');?>    





<!--<h3 class="p-2">Your jobs are here</h3>
<?php

if(isset($e_message)){
    echo '<p class="text-error p-10">'.$e_message.'</p>';
}
else{
    ?>
    <?php
}
?>


<table>



<?php foreach($jobs as $job){ ?>
    <tr>
  
      
        <td><?php echo $job->job_id?></td>
        <td><?php echo $job->title?></td>
        <td><?php echo $job->description?></td>
        <td><?php echo $job->deadline?></td>
        <td><?php echo $job->timestamp?></td>
        <td><?php echo $job->status?></td>
    </tr>
<?php } ?>
</table>-->

<?php $this->load->view('footer');?>