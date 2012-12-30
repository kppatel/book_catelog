<form action="" method="post">
			<fieldset>
				<legend>Edit Book</legend>
				<label for="name">Title</label>
				<input id="name" name="name" type="text" value="<?php echo $book['title'] ?>">
				<?php echo form_error('name') ?>
				<br>

				<label for="author">Author</label>
				<?php	echo form_dropdown('author', $author, $book['author_id']); ?>
				<br>

				<label for="category">Category</label>
				<?php	echo form_dropdown('category', $category, $book['category_id']); ?>
				<br>

				<label for="status">Reading Status</label>
				<?php
					$options = array(
                  'Read'  => 'Read',
                  'Unread'    => 'Unread'
                );
					echo form_dropdown('status', $options, $book['reading_status']); ?>
				<br>

				<input type="hidden" name="id" value="<?php echo $book['id'] ?>">
				<input type="submit" value="Update">
				<input type="reset">
				<?php echo anchor('books/index', 'Cancel') ?>
			</fieldset>
		</form>