<?php
session_start();
include ('pdo.php');

if(!isset($_SESSION['userEmail'])){
    header("Location:index.php?erreur=nonconnecte");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
            include('header.php');

            $stmt = $pdo->prepare('SELECT * FROM todo WHERE id_user='.$_SESSION['userId'].' ORDER BY priorite DESC');
            $stmt->execute();
            $mesTaches=$stmt->fetchAll();
        ?>
        <h1>Ma ToDo List</h1>
        <a href="ajouterTache.php"><button type="button" class="btn btn-success">Ajouter une tâche</button></a>

        <div class="container">
            <div class="row">
                <?php foreach($mesTaches as $res){ ?>
                <div class="col-2 <?php if($res['statut']==1){ ?>barre<?php } ?>"><?=$res['titre']?></div>
                <div class="col-3 <?php if($res['statut']==1){ ?>barre<?php } ?>"><?=$res['description']?></div>
                <div class="col-2 <?php if($res['statut']==1){ ?>barre<?php } ?>"><?=$res['date_debut']?></div>
                <div class="col-2 <?php if($res['statut']==1){ ?>barre<?php } ?>"><?=$res['date_limite']?></div>
                <div class="col-3">
                    <a href="changerStatut.php?idTache=<?= $res['id'] ?>"><button type="button" class="btn btn-info">Changer statut</button></a>
                    <a href="#"><button type="button" class="btn btn-warning">Modifier</button></a>
                    <a href="#"><button type="button" class="btn btn-danger">Supprimer</button></a>
                </div>
                <hr>
                <?php } ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>