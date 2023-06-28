<?php build('content') ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Courses</h4>
			<?php echo wLinkDefault(_route('course:create'), 'Create Course')?>
		</div>

		<div class="card-body">
			<?php Flash::show()?>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<th>#</th>
						<th>Abbr</th>
						<th>Course</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach($courses as $key => $row) :?>
							<tr>
								<td><?php echo ++$key?></td>
								<td><?php echo $row->course_abbr?></td>
								<td><?php echo $row->course?></td>
								<td>
									<?php echo wLinkDefault(_route('course:edit', $row->id),'Edit Course')?>
								</td>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>