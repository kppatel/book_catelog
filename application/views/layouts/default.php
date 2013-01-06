<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title><?php echo $template['title'] ?></title>
	<meta name="description" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<?php echo css('base'), css('skeleton'), css('layout'), js('myfunction') ?>

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo base_url() ?>images/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo base_url() ?>images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url() ?>images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url() ?>images/apple-touch-icon-114x114.png">

</head>
<body>
	<div class="container">
		<h1>Book Catelog</h1>

		<ul class="menu">
			<li<?php echo $this->uri->segment(1) == 'books' ? ' class="current"': '' ?>><?php echo anchor('books', 'Books') ?></li>
			<li<?php echo $this->uri->segment(1) == 'authors' ? ' class="current"': '' ?>><?php echo anchor('authors', 'Authors') ?></li>
			<li<?php echo $this->uri->segment(1) == 'categories' ? ' class="current"': '' ?>><?php echo anchor('categories', 'Categories') ?></li>
			<li<?php echo $this->uri->segment(2) == 'search' ? ' class="current"': '' ?>><?php echo anchor('books/search', 'Search') ?></li>
		</ul>
		<?php echo $template['body'] ?>
	</div><!-- container -->
</body>
</html>