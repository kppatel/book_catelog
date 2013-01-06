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
			<tr id="<?php echo $r['id'] ?>">
				<td><?php echo $r['title'] ?></td>
				<td><?php echo $r['author'] ?></td>
				<td><?php echo $r['category'] ?></td>
				<td>
					<?php
						$toggle = $r['reading_status'] == 'Read' ? 'Unread' : 'Read';
						echo anchor(
							'books/toggle/'. $r['id'] . '/' . $toggle,
							$r['reading_status'],
							array('class' => 'toggler'));
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
				<td align="center"><?php echo anchor('#', 'Delete', array('class' => 'delete')) ?></td>
			</tr>
			<?php endforeach ?>
		</table>
		<?php endif ?>

		<?php echo js('jquery') ?>

	<script>
		jQuery(function($) {
			$('a.toggler').click(function(e) {
				var that = this;

				$.ajax(that.href).success(function(data) {
						if(data == 'Read') {
							that.href = that.href.replace('Unread', data);
						} else {
							that.href = that.href.replace('Read', data);
						}

						$(that).text(data);
					});

					e.preventDefault();
				});
		});
	</script>
	<script>

$(document).ready(function()
{
	$('a.delete').click(function(e)
	{
		e.preventDefault();
		if (confirm("Are you sure to delete?"))
		{
			var id = $(this).parent().parent().attr('id');
			var parent = $(this).parent().parent();
			$.ajax(
			{
				   type: "POST",
				   url: 'books/delete/' + id,
				   cache: false,

				   success: function()
					 {
							parent.fadeOut('slow', function() {$(this).remove();});
					 }
			 });
		}
	});
});
	</script>