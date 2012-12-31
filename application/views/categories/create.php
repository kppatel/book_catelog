		<form action="" method="post">
			<fieldset>
				<legend>Create Category</legend>
				<label for="name">Name</label>
				<input id="name" name="name" type="text">
				<?php echo form_error('name') ?>
				<br>

				<input type="submit" value="Create">
				<input type="reset">
				<?php echo anchor('categories/index', 'Cancel') ?>
			</fieldset>
		</form>
