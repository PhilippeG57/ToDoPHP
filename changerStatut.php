<?php
session_start();
include('pdo.php');

if(!isset($_SESSION["userStatut"])){
    header("Location:index.php?erreur=accesrefuse");
}

// Je récupère les infos de la tâche concernée
$stmt = $pdo->prepare("SELECT * FROM todo WHERE id=:id");
$stmt->bindValue(':id', $_GET['idTache'], PDO::PARAM_INT);
$stmt->execute();
$todo=$stmt->fetch();
$stmt->closeCursor();

// Je vérifie qu'elle existe et je change son statut
if($todo){
    $stmt = $pdo->prepare("UPDATE todo SET statut = :statut WHERE id = :id");
    if($todo['statut']==0){
        $stmt->bindValue(':statut', 1, PDO::PARAM_INT);
    }else{
        $stmt->bindValue(':statut', 0, PDO::PARAM_INT);  
    }
    $stmt->bindValue(':id', $_GET["idTache"], PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
    header("Location:maliste.php?statut=changed");
    exit;
}
?>