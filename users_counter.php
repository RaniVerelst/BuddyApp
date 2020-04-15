<?php
// FEATURE 13
// Display registered users and connections
include_once("classes/Db.class.php");
include_once("classes/Friendlist.class.php");

$users = new Friendlist();


?>
<div>
<p><?php echo $users->countUsers(); ?> users  </p>
<p><?php echo $users->countConnections(); ?> friendships made </p>
</div>