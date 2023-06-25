<?php
session_start();

// Wylogowanie użytkownika
session_unset();
session_destroy();
header("Location: index.php");
exit();
?>
