		<form action="" method="post">
			<fieldset>
				<legend>Edit Author</legend>
				<label for="name">Name</label>
				<input id="name" name="name" type="text" value="<?php echo $author['name'] ?>">
				<?php echo form_error('name') ?>
				<br>

				<input type="hidden" name="id" value="<?php echo $author['id'] ?>">
				<input type="submit" value="Update">
				<input type="reset">
				<?php echo anchor('authors/index', 'Cancel') ?>
			</fieldset>
		</form>