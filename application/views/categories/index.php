		<?php if(!empty($data)): ?>
		<h3>Categories</h3>
		<?php echo anchor('categories/create', 'Create', array('id' => 'create-toggler')) ?>
		<div id="create-category">
		<form action="" method="post">
			<fieldset>
				<legend>Create Category</legend>
				<label for="name">Name</label>
				<input id="name" name="name" type="text">
				<?php echo form_error('name') ?>
				<br>

				<input type="submit" value="Create">
				<input type="reset">
				<?php echo anchor('categories/index', 'Cancel', array('id' => 'cancel-create')) ?>
			</fieldset>
		</form>
		</div>

		<table class="list">
			<thead>
				<th>Name</th>
				<th>Date Created</th>
				<th>Date Modified</th>
				<th colspan="2">Actions</th>
			</thead>

			<?php foreach ($data as $r): ?>
			<tr>
				<td><?php echo $r['name'], ' (', $r['books'], ')' ?></td>
				<td><?php echo $r['date_created'] ?></td>
				<td><?php echo $r['date_modified'] ?></td>
				<td align="center"><?php echo anchor('categories/edit/' . $r['id'], 'Edit') ?></td>
				<td align="center"><?php echo anchor('categories/delete/' . $r['id'], 'Delete') ?></td>
			</tr>
			<?php endforeach ?>
		</table>
		<?php endif ?>

		<?php echo js('jquery') ?>
		<script>
		jQuery(function($) {
			$('table.list').on('click', 'a.delete', function() {
				return confirm("Are you sure to delete this category");
			});

			$('#cancel-create').click(function(e) {
				$('#create-category').hide().children('#name').val("");
				$('#create-category').find('form')[0].reset();

				e.preventDefault();
			}).trigger('click');

			$('#create-toggler').click(function(e) {
				$('#create-category').toggle('slow');	// Toggles between show and hide for selected element
				e.preventDefault();
			});

			$('#create-category').find('form').submit(function(e) {
				e.preventDefault();

				var that = this, xhr = $.ajax({
					url: "<?php echo base_url() ?>categories/ajax_create",
					dataType: "json",
					data: $(that).serialize(),	// creates a URL encoded text string by serializing form values.(name=abc&id=12)
					type: "POST",
					statusCode: {
						404: function() {
							$('#error').text('Error occurred');
						},
						500: function() {
							$('#error').text('Please enter category name');
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
								$('<a />').attr('href', '<?php echo base_url() ?>categories/edit/' + data.id).text('Edit')
							).attr('align', 'center')
						).append(
							$('<td />').append(
								$('<a />')
									.attr('href', '<?php echo base_url() ?>categories/delete/' + data.id).text('Delete')
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