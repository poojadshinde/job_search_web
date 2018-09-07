<?php $this->load->view('header');?>


<h4 class="text-center">Applied Jobs Details</h4>
<div class="row">
	<div class="col-12 bg-light ">
                        	
                <?php foreach($skills as $skill){?>
                    <div class="card material-shadow p-3 my-3 no-border mx-5">
                    <div class="card-body text-center">
       
        <small><b>user_id:</b><?php echo $skill->user_id;?></small>
        <small> <b>name:</b><?php echo $skill->name;?></small>
        <small><b>job_id:</b><?php echo $skill->job_id;?></small>
        <small><b>email:</b><?php echo $skill->email;?></small>
        <small><b>timestamp:</b><?php echo $skill->timestamp;?></small>
        </div>
        </div>
      
<?php }?>
		</div>
	</div>


    
<?php $this->load->view('footer');?>