	<h3>Books</h3>

	<?php echo anchor('books/create', 'Create') ?>

	<?php if(!empty($data)): ?>
		<table class="list">
			<tr>
				<th>Title</th>
				<th>Author</th>
				<th>Category</th>
				<th>Reading Status</th>
				<th>Rating</th>
				<th colspan="2">Actions</th>
			</tr>

			<?php foreach ($data as $r): ?>
			<tr>
				<td><?php echo $r['title'] ?></td>
				<td><?php echo $r['author'] ?></td>
				<td><?php echo $r['category'] ?></td>
				<td>
					<?php
						if($r['reading_status'] == 'Read') {
							$js = 'onClick="changeStatus(\'Unread\')\"';
							echo form_button('mybutton', 'Unread');
						 }
						 else {
							$js = 'onClick="changeStatus(\'Read\')\"';
							echo form_button('mybutton', 'Read');
						 }
					?>
				</td>
				<td>
					<?php
						for($i=0; $i < $r['rating']; $i++) {
							echo img('star.jpg');
						}
					?>
				</td>
				<td align="center"><?php echo anchor('books/edit/' . $r['id'], 'Edit') ?></td>
				<td align="center"><?php echo anchor('books/delete/' . $r['id'], 'Delete') ?></td>
			</tr>
			<?php endforeach ?>
		</table>
		<?php endif ?>