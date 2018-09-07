<?php $this->load->view('header');?>
<?php $this->load->view('employer/menu');?>
<div class="card p-3">
	
	<?php echo form_open('employer/postjob', array('class'=>'p-3'));?>
	<div class="form-group">
		<label>Title</label>
		<input type="text" name="title" class="form-control" required="">
	</div>
	<div class="form-group">
		<label>Description</label>
		<textarea class="form-control" rows='6' name="description"></textarea>
	</div>
	<div class="form-group">
		<label>Deadline</label>
		<input type="text" name="deadline" class="form-control datepicker" required="" placeholder="click to choose deadline">						
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
	
	<div class="w-100 text-center">
		<div class="text-danger text-left">
			<?php echo validation_errors(); ?>
		</div>
		<button type="submit" class="btn btn-primary">Post NOW</button>
	</div>
</form>
</div>
<?php $this->load->view('employer/footer');?>    
<?php $this->load->view('footer');?>
<script type="text/javascript">
	$('.datepicker').datepicker();
</script>