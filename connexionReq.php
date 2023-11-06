<?php
session_start();
include('pdo.php');

$stmt = $pdo->prepare('SELECT * FROM users WHERE email= :email');
$stmt -> bindValue(':email',$_POST['email'],PDO::PARAM_STR);
$stmt -> execute();
$userExist = $stmt -> fetch();

if(!empty($userExist)) {
  if(password_verify($_POST['mdp'],$userExist['mdp'])) {
    $_SESSION['userId'] = $userExist['id'];
    $_SESSION['userEmail'] = $userExist['email'];
    header('Location:maliste.php');
  }
  else {
    header('Location:index.php?auth=errormdp');
  }
}
else {
  header('Location:index.php?auth=erroremail');
}
?>