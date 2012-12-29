	<form action="" method="post">
			<fieldset>
				<legend>Edit Book</legend>
				<label for="name">Title</label>
				<input id="name" name="name" type="text" value="<?php echo $book['title'] ?>">
				<?php echo form_error('name') ?>
				<br>

				<label for="category">Category</label>
				<input id="category" name="category" type="text" value="<?php echo $book['category'] ?>">
				<?php echo form_error('category') ?>
				<br>

				<label for="status">Reading Status</label>
				<input id="status" name="status" type="text" value="<?php echo $book['reading_status'] ?>">
				<?php echo form_error('status') ?>
				<br>

				<input type="hidden" name="id" value="<?php echo $book['id'] ?>">
				<input type="submit" value="Update">
				<input type="reset">
				<?php echo anchor('books/index', 'Cancel') ?>
			</fieldset>
		</form>