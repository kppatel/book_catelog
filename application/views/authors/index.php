		<?php if(!empty($data)): ?>
		<h3>Authors</h3>
		<?php echo anchor('authors/create', 'Create') ?>
		<table class="list">
			<tr>
				<th>Name</th>
				<th>Date Created</th>
				<th>Date Modified</th>
				<th colspan="2">Actions</th>
			</tr>

			<?php foreach ($data as $r): ?>
			<tr>
				<td><?php echo $r['name'], ' (', $r['books'], ')' ?></td>
				<td><?php echo $r['date_created'] ?></td>
				<td><?php echo $r['date_modified'] ?></td>
				<td align="center"><?php echo anchor('authors/edit/' . $r['id'], 'Edit') ?></td>
				<td align="center"><?php echo anchor('authors/delete/' . $r['id'], 'Delete') ?></td>
			</tr>
			<?php endforeach ?>
		</table>
		<?php endif ?>
