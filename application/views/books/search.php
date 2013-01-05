		<form action="" method="post">
			<fieldset id="search-box">
				<legend>Search Book</legend>
				<label for="name">Title</label>
				<input id="name" name="name" type="text">

				<label for="author">Author</label>
				<?php	echo form_dropdown('author', $author); ?>

				<label for="category">Category</label>
				<?php	echo form_dropdown('category', $category); ?>

				<input type="submit" value="Search">
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