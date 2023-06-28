<?php build('content')?>
<div class="col-md-5">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Course Management</h4>
			<?php echo wLinkDefault(_route('course:index'), 'Courses')?>
		</div>
		<div class="card-body">
			<?php Flash::show()?>
			<?php echo $formCourse->start()?>
				<?php echo $formCourse->getRow('course')?>
				<?php echo $formCourse->getRow('course_abbr')?>

				<div class="form-group"><?php Form::submit('', 'Add Course')?></div>
			<?php echo $formCourse->end()?>
		</div>
	</div>
</div>
<?php endbuild()?>
<?php loadTo()?>