<?php 

include_once 'includes/function.php';
include_once 'includes/session.php';
guard('login.php', 'You must login first');

logout('admin.php', 'You must login first');

exit();
?>