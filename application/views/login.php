<?php $this->load->view('header');?>

<div class="container">
	<div class="row">
		<div class="col-12 col-sm-6 mx-auto">

			<div class="card bg-light py-4 px-4 my-4 no-border">
				<h4 class="text-center">Login here</h4>

				<?php 
				echo $this->input->get('error') == 1 ? '<p class="text-danger p-2 text-left">Credentials doesn\'t match</p>' : '';?>

		 

				<?php echo form_open('user/login', array('class'=>'px-3'));?>
				 
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="user_email" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required="">
					</div>
					 
					<div class="form-group">
						<label>Login as</label>
						 <select class="form-control" name="user_type">
						 	<option value="job_seeker" <?php echo $this->input->get('type') == 'job_seeker' ? 'selected' : '';?>>Job Seeker</option>
						 	<option value="employer" <?php echo $this->input->get('type') == 'employer' ? 'selected' : '';?>>Employer</option>
						 </select>
					</div>
					<div class="w-100 text-center">
						<div class="text-danger text-left">
						<?php echo validation_errors(); ?>
					</div>
					<button type="submit" class="btn btn-primary">Login Now</button>
					
					
						
				
				</div>

				</form>

			</div>
		</div>
	</div>

</div>
    
<?php $this->load->view('footer');?>