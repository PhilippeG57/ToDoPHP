<?php
include('pdo.php');

$stmt = $pdo -> prepare('SELECT * FROM users WHERE email= :email');
$stmt -> bindValue(':email',$_POST['email'],PDO::PARAM_STR);
$userExist = $stmt -> fetch();

if (empty($userExist)) {

  $req = $pdo -> prepare("INSERT INTO users(email, mdp) 
  VALUES (:email, :mdp)",array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

  $req -> execute(
    array(
      ':email' => $_POST['email'],
      ':mdp' => password_hash($_POST['mdp'], PASSWORD_DEFAULT)
    )
  );
  $req -> closeCursor();
  header('Location:inscription.php?inscription=success');
}
else {
  header('Location:inscription.php?inscription=error');
}
?>