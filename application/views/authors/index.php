		<?php if(!empty($data)): ?>
		<h3>Authors</h3>
		<?php echo anchor('authors/create', 'Create', array('id' => 'create-toggler')) ?>
		<div id="create-author">
			<form action="" method="post">
				<fieldset>
					<legend>Create Author</legend>
					<label for="name">Name</label>
					<input id="name" name="name" type="text" required>
					<?php echo form_error('name') ?>
					<br>

					<input type="submit" value="Create">
					<input type="reset">
					<?php echo anchor('authors/index', 'Cancel', array('id' => 'cancel-create')) ?>
				</fieldset>
			</form>
		</div>

		<div id="error"></div>

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
				<td align="center"><?php echo anchor('authors/delete/' . $r['id'], 'Delete', array('class' => 'delete')) ?></td>
			</tr>
			<?php endforeach ?>
		</table>
		<?php endif ?>

		<?php echo js('jquery') ?>
		<script>
		jQuery(function($) {
			$('table.list').on('click', 'a.delete', function() {
				return confirm("Are you sure to delete this author");
			});

			$('#cancel-create').click(function(e) {
				$('#create-author').hide().children('#name').val("");
				$('#create-author').find('form')[0].reset();

				e.preventDefault();
			}).trigger('click');

			$('#create-toggler').click(function(e) {
				$('#create-author').toggle('slow');
				e.preventDefault();
			});

			$('#create-author').find('form').submit(function(e) {
				e.preventDefault();

				var that = this, xhr = $.ajax({
					url: "<?php echo base_url() ?>authors/ajax_create",
					dataType: "json",
					data: $(that).serialize(),
					type: "POST",
					statusCode: {
						404: function() {
							$('#error').text('Error occurred');
						},
						500: function() {
							$('#error').text('Please enter author name');
						}
					}
				});

				xhr.success(function(data, status, xhrObject) {
					$('table.list').append(
						$('<tr />').append(
							$('<td />').text(data.name + " (0)")
						).append(
							$('<td />').text(data.date_created)
						).append(
							$('<td />').text(data.date_modified)
						).append(
							$('<td />').append(
								$('<a />').attr('href', '<?php echo base_url() ?>authors/edit/' + data.id).text('Edit')
							).attr('align', 'center')
						).append(
							$('<td />').append(
								$('<a />')
									.attr('href', '<?php echo base_url() ?>authors/delete/' + data.id).text('Delete')
									.addClass('delete')
							).attr('align', 'center')
						)
					);

					$(that).parent().hide('slow');
					that.name.value = null;
					that.reset();
				});
			});
		});
		</script>