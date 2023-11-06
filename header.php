<!-- As a link -->
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Connexion</a>
    <a class="navbar-brand" href="inscription.php">Inscription</a>
    <?php
    if(isset($_SESSION['userEmail'])){
    ?>
    <a class="navbar-brand" href="maliste.php">Ma ToDo list</a>
    <span class="navbar-brand mb-0 h1">Connecté avec l'email <?= $_SESSION['userEmail'] ?></span>
    <a class="navbar-brand" href="deconnexion.php">Se déconnecter</a>    
    <?php
    }else{ ?>
    <span class="navbar-brand mb-0 h1">Non connecté</span>
    <?php } ?>
  </div>
</nav>