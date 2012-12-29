	<form action="" method="post">
			<fieldset>
				<legend>Create Book</legend>
				<label for="name">Title</label>
				<input id="name" name="name" type="text" value="<?php echo set_value('name') ?>">
				<?php echo form_error('name') ?>
				<br>

				<label for="author">Author</label>
				<?php	echo form_dropdown('author', $author); ?>
				<?php echo form_error('author') ?>
				<br>

				<label for="category">Category</label>
				<input id="category" name="category" type="text" value="<?php echo set_value('category') ?>">
				<?php//	echo form_dropdown('category', $category); ?>
				<?php echo form_error('category') ?>
				<br>

				<label for="status">Reading Status</label>
				<input id="status" name="status" type="text" value="<?php echo set_value('status') ?>">
				<?php echo form_error('status') ?>
				<br>

				<label for="rating">Rating</label>
				<input id="rating" name="rating" type="text" value="<?php echo set_value('rating') ?>">
				<?php echo form_error('rating') ?>
				<br>

				<input type="submit" value="Create">
				<input type="reset">
				<?php echo anchor('admin/books/index', 'Cancel') ?>
			</fieldset>
		</form>
