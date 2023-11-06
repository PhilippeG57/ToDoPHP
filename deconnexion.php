<?php
session_start();
include('pdo.php');

unset($_SESSION['userId']);
unset($_SESSION['userEmail']);

header('Location:index.php?deconnexion=success');
?>