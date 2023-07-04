<?php build('content') ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Create User</h4>
			<?php echo wLinkDefault(_route('user:index'), 'Back to list')?>
			<?php Flash::show()?>
		</div>

		<div class="card-body">
			<?php echo $user_form->start() ?>
				<?php echo $user_form->getRow('user_type')?>
				<?php echo $user_form->getRow('user_code')?>
				<?php echo $user_form->getRow('firstname')?>
				<?php echo $user_form->getRow('lastname')?>
				<?php echo $user_form->getRow('username')?>
				<?php echo $user_form->getRow('password')?>
				<?php echo $user_form->getRow('gender')?>
				<?php echo $user_form->getRow('phone')?>
				<?php echo $user_form->getRow('email')?>
				<?php echo $user_form->getRow('address')?>
				<?php echo $user_form->getRow('profile')?>

				<?php Form::submit('', 'Add Staff')?>
			<?php echo $user_form->end() ?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>