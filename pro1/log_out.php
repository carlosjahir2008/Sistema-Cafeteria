
<?php
// solo cierra la secion guardada anterirormente
session_start();

session_unset();
session_destroy();




header("Location: login.php");
exit();
?>
