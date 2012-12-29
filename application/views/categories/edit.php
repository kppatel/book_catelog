	<form action="" method="post">
			<fieldset>
				<legend>Edit Category</legend>
				<label for="name">Name</label>
				<input id="name" name="name" type="text" value="<?php echo $category['name'] ?>">
				<?php echo form_error('name') ?>
				<br>

				<input type="hidden" name="id" value="<?php echo $category['id'] ?>">
				<input type="submit" value="Update">
				<input type="reset">
				<?php echo anchor('categories/index', 'Cancel') ?>
			</fieldset>
		</form>
