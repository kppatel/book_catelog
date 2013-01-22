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
				<?php echo form_dropdown('category', $category); ?>
				<?php echo form_error('category') ?>
				<br>

				<label for="status">Reading Status</label>
				<input type="radio" name="status" value="Read">Read
				<input type="radio" name="status" value="Unread" checked>Unread
				<br>

				<label>Rating</label>
				<input type="radio" name="rating" class="rating" value="1" checked>
				<input type="radio" name="rating" class="rating" value="2">
				<input type="radio" name="rating" class="rating" value="3">
				<input type="radio" name="rating" class="rating" value="4">
				<input type="radio" name="rating" class="rating" value="5">
				<?php echo form_error('rating') ?>
				<br>

				<input type="submit" value="Create">
				<input type="reset">
				<?php echo anchor('books/index', 'Cancel') ?>
			</fieldset>
		</form>
		<?php echo css('rating'), js('jquery'), js('rating') ?>

		<script>
		jQuery(function($) {
			$('input.rating').rating();
		});
		</script>