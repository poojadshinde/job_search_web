<?php $this->load->view('header');?>

<div class="container">
	<div class="row">
		<div class="col-12 col-sm-6 mx-auto">

			<div class="card bg-light py-4 px-4 my-4 no-border">
				<h4 class="text-center">fill the details  here</h4>

				<?php 
				echo $this->input->get('error') == 1 ? '<p class="text-danger p-2 text-left">User already exists!</p>' : '';?>

		 

				<?php echo form_open('job-seeker/resume', array('class'=>'px-3'));?>
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="user_name" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="user_email" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>Mobile</label>
						<input type="text" name="mobile" class="form-control" required="">
					</div>


			
					<div class="form-group">
						<label>state</label>
						 <select class="form-control" name="user_type">
						 	<option value="maharastra">maharastra</option>
						 	<option value="panjab">panjab</option>
							 <option value="up">up</option>
							 <option value="mp">mp</option>
						 </select>
					</div>


<div class="form-group">
		<?php foreach($skills as $skill) {
			?>

			<div class="form-check form-check-inline">
				<input class="form-check-input" type="checkbox" name="skills[]"   value="<?php echo $skill->skill_id;?>">
				<label class="form-check-label" for="inlineCheckbox1"><?php echo $skill->title;?></label>
			</div>

			
			<?php
		}
		?>
		
	</div>


					<div class="form-group">
					<label>Upload Resume</label>
					<div class="custom-file">
   				 <input type="file" class="custom-file-input" id="validatedCustomFile" required>
   				 <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
    			<div class="invalid-feedback">Example invalid custom file feedback</div>
  				</div>
				  </div>

					<div class="w-100 text-center">
						<div class="text-danger text-left">
						<?php echo validation_errors(); ?>
					</div>
					<button type="submit" class="btn btn-primary">Apply Now</button>
					</div>
				
			</div>
		</div>
	</div>

</div>
    
<?php $this->load->view('footer');?>