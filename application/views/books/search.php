		<form action="" method="post">
			<fieldset>
				<legend>Search Book</legend>
				<label for="name">Title</label>
				<input id="name" name="name" type="text">
				<br>

				<label for="author">Author</label>
				<?php	echo form_dropdown('author', $author); ?>
				<br>

				<label for="category">Category</label>
				<?php	echo form_dropdown('category', $category); ?>
				<br>

				<input type="submit" value="Search">
				<input type="reset">
				<?php echo anchor('books/index', 'Cancel') ?>
			</fieldset>
		</form>

		<?php if(!empty($results)): ?>
		<table class="list">
			<tr>
				<th>Title</th>
				<th>Author</th>
				<th>Category</th>
				<th>Reading Status</th>
				<th>Rating</th>
			</tr>

			<?php foreach ($results as $r): ?>
			<tr>
				<td><?php echo $r['title'] ?></td>
				<td><?php echo $r['author'] ?></td>
				<td><?php echo $r['category'] ?></td>
				<td><?php echo $r['reading_status'] ?></td>
				<td><?php echo $r['rating'] ?></td>
			</tr>
			<?php endforeach ?>
		</table>
		<?php endif ?>