<form action="" method="post" onload="checkStar('<?php echo $book['rating']; ?>')">
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
				<?php echo form_dropdown('status', array(
						'Read'  => 'Read',
						'Unread'    => 'Unread'
					), $book['reading_status']) ?>
				<br

					<label>Rating</label>
				<input type="radio" name="rating" class="rating" value="1">
				<input type="radio" name="rating" class="rating" value="2">
				<input type="radio" name="rating" class="rating" value="3">
				<input type="radio" name="rating" class="rating" value="4">
				<input type="radio" name="rating" class="rating" value="5">
				<?php echo form_error('rating') ?>
				<br>

				<input type="hidden" name="id" value="<?php echo $book['id'] ?>">
				<input type="submit" value="Update">
				<input type="reset">
				<?php echo anchor('books/index', 'Cancel') ?>
			</fieldset>
		</form>
<?php echo css('rating'), js('jquery'), js('rating') ?>
<script>
		jQuery(function($) {
			$('input.rating').rating();
			$('input').rating('select',2)

		});
		</script>