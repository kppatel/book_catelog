<?php
$link = mysql_connect('localhost', 'root', '');

if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db('book_catelog', $link);

if (!$db_selected) {
    die ('Can\'t use test: ' . mysql_error());
}
$statusval=$_GET['statusvalue'];
$bid=$_GET['bid'];
$sql="UPDATE  `books` SET  `reading_status` =  '".$statusval."' WHERE  `id` ='".$bid."'";
$result = mysql_query($sql);
echo $statusval;

?>
