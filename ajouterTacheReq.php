<?php
session_start();
include('pdo.php');

if(!isset($_SESSION["userEmail"])){
    header("Location:index.php?erreur=nonconnecte");
}

//Insertion des données dans la table tâche
$req = $pdo->prepare("
INSERT INTO todo(titre, description, priorite, date_debut, date_limite, statut, id_user)
VALUES (:titre, :description, :priorite, :date_debut, :date_limite, :statut, :id_user)",
array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

$req->execute(
    array(
        ':titre'=>$_POST['titre'],
        ':description'=>$_POST['description'],
        ':priorite'=>$_POST['priorite'],
        ':date_debut'=>$_POST['date_debut'],
        ':date_limite'=>$_POST['date_limite'],
        ':statut'=>0,
        ':id_user'=>$_SESSION['userId']
    )
);

$req->closeCursor();

header('Location:maliste.php?ajout=reussi');

?>