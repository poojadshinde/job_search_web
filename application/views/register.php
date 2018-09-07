<?php $this->load->view('header');?>

<div class="container">
	<div class="row">
		<div class="col-12 col-sm-6 mx-auto">

			<div class="card bg-light py-4 px-4 my-4 no-border">
				<h4 class="text-center">Register here</h4>

				<?php 
				echo $this->input->get('error') == 1 ? '<p class="text-danger p-2 text-left">User already exists!</p>' : '';?>

		 

				<?php echo form_open('user/register', array('class'=>'px-3'));?>
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="user_name" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="user_email" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>Confirm Password</label>
						<input type="password" name="cpassword" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>You are</label>
						 <select class="form-control" name="user_type">
						 	<option value="job_seeker">looking for a job</option>
						 	<option value="employer">looking for candidates</option>
						 </select>
					</div>
					<div class="w-100 text-center">
						<div class="text-danger text-left">
						<?php echo validation_errors(); ?>
					</div>
					<button type="submit" class="btn btn-primary">Register Now</button>
				</div>
				</form>

			</div>
		</div>
	</div>

</div>
    
<?php $this->load->view('footer');?>