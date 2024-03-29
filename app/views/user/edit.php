<?php build('content') ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Edit User</h4>
			<?php echo wLinkDefault(_route('user:index'), 'Back to list')?>
			<?php Flash::show()?>
		</div>

		<div class="card-body">
			<?php echo $user_form->start() ?>
				<?php
					echo $user_form->addAndCall([
						'type' => 'hidden',
						'name' => 'id',
						'value' => $user->id
					]);
				?>
				<?php echo $user_form->getRow('user_type')?>
				<?php echo $user_form->getRow('user_code')?>
				<?php echo $user_form->getRow('firstname')?>
				<?php echo $user_form->getRow('lastname')?>

				<?php if(isEqual($user->user_type, 'STUDENT')) :?>
					<?php echo $user_form->getRow('course_id')?>
					<?php echo $user_form->getRow('year_lvl')?>
				<?php endif?>

				<?php echo $user_form->getRow('username')?>
				<?php echo $user_form->getRow('password')?>
				<?php echo $user_form->getRow('gender')?>
				<?php echo $user_form->getRow('phone')?>
				<?php echo $user_form->getRow('email')?>
				<?php echo $user_form->getRow('address')?>
				<?php echo $user_form->getRow('profile')?>

				<div class="form-group">
					<?php Form::submit('', 'Update User')?>
				</div>
			<?php echo $user_form->end() ?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>