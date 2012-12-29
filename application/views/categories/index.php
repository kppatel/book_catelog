		<?php if(!empty($data)): ?>
		<h3>Results</h3>
		<?php echo anchor('categories/create', 'Create') ?>
		<table class="list">
			<thead>
				<th>Name</th>
				<th>Date Created</th>
				<th>Date Modified</th>
				<th colspan="2">Actions</th>
			</thead>

			<?php foreach ($data as $r): ?>
			<tr>
				<td><?php echo $r['name'] ?></td>
				<td><?php echo $r['date_created'] ?></td>
				<td><?php echo $r['date_modified'] ?></td>
				<td align="center"><?php echo anchor('categories/edit/' . $r['id'], 'Edit') ?></td>
				<td align="center"><?php echo anchor('categories/delete/' . $r['id'], 'Delete') ?></td>
			</tr>
			<?php endforeach ?>
		</table>
		<?php endif ?>