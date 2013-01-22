	<h3>Books</h3>

	<?php echo anchor('books/create', 'Create') ?>
	<div id="error"></div>
	<?php if(!empty($data)): ?>
	<form action="<?php echo base_url() ?>books/multi_delete" method="post">
		<table class="list">
			<thead>
				<th>#</th>
				<th data-sort="string">Title</th>
				<th data-sort="string">Author</th>
				<th data-sort="string">Category</th>
				<th data-sort="string">Reading Status</th>
				<th data-sort="integer">Rating</th>
				<th colspan="2">Actions</th>
			</thead>

			<tbody>
			<?php foreach ($data as $r): ?>
			<tr id="<?php echo $r['id'] ?>">
				<td><input type="checkbox" name="multi_id[]" value="<?php echo $r['id'] ?>"></td>
				<td class="<?php echo $r['reading_status'] ?>"><?php echo $r['title'] ?></td>
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
				<td align="center"><?php echo anchor('books/delete/' . $r['id'], 'Delete', array('class' => 'delete')) ?></td>
			</tr>
			<?php endforeach ?>
			</tbody>
		</table>

		<input type="submit" value="Delete Selected" class="single-button">
		</form>
		<?php else: ?>
		<p>No records found.</p>
		<?php endif ?>

		<?php echo js('jquery'), js('stupidtable') ?>

	<script>
		jQuery(function($) {
			$("td.Read").css("color","green");
			$("td.Unread").css("color","red");

			$('table.list').stupidtable().bind('aftertablesort', function (event, data) {
        var th = $(this).find("th");
        th.find(".arrow").remove();
        var arrow = data.direction === "asc" ? "&uarr;" : "&darr;";
        th.eq(data.column).append('<span class="arrow">' + arrow +'</span>');
      }).on('click', 'a.delete', function() {
				return confirm("Are you sure to delete this author");
			});

			$('table').on('click', 'a.toggler', function(e) {
				e.preventDefault();
				var that = this;

				$.ajax(that.href).success(function(data) {
					if(data == 'Read') {
						that.href = that.href.replace('Unread', data);
					} else {
						that.href = that.href.replace('Read', data);
					}

					$(that).text(data);
				});


			}).on('click', 'a.delete', function(e)	{
				e.preventDefault();
				if (confirm("Are you sure to delete?"))	{
					var parent = $(this).parent().parent();

					$.ajax(this.href).success(function() {
						parent.fadeOut(function() {
							if ($(this).siblings().length == 1) {
								$(this).parent().append(
									$('<tr />').append(
										$('<td />').attr('colspan', '8').text('No record found')
									)
								).parent().next().hide();
							}
							$(this).remove();
						});

					}).fail(function(jqXHR, textStatus) {
						$('#error').text(textStatus);
					});
				}
			});
		});
	</script>