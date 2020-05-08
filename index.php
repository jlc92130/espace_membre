<?php
 session_start();
 include('connexion_php_verif.php');
 require('src/cookie.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
 </head>
<body>
  <?php
include('src/header.php');
  ?>
  
  <nav class="navbar navbar-dark bg-dark navbar-expand-md" >
  <a class="navbar-brand" href="#">Portail</a>

    <div class="container">
      <!-- The burger menu -->
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarText">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse " id="navbarText">
        <ul class="navbar-nav "> 
          <li class="nav-item ative">
            <a class="nav-link text-white" href="#">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white">Dentaire</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white">Shampoing</a>
          </li>
          <?php
          if (isset($_SESSION['connect'])) {
          ?>
          <li class="nav-item">
            <a id="inscription" href='#' class="nav-link text-white">inscription</a>
          </li>
          <?php
          }
          else {
          ?>
          <li class="nav-item">
            <a id="inscription" data-toggle='modal' data-target='#inscription_form' href='#inscription_form' class="nav-link text-white">inscription</a>
          </li>
          <?php
          }
          
          if (isset($_SESSION['connect'])) {
            ?>
            <li>
            <a id="conn"   href='#' class="nav-link text-white" >connexion</a>
          </li>
          <?php
          } 
          else {
          ?>
          <li>
            <a id="conn" data-toggle='modal' data-target='#connexion' href='#connexion' class="nav-link text-white" >connexion</a>
          </li>
          <?php 
          }
          ?>
          <li>
            <a id="deconn" href='deconnexion.php' class="nav-link text-white" >deconnexion</a>
          </li>
        </ul>
      </div>
    </div>
    
  </nav>
  <!--  POPUP FOR INSCRIPTION -->
<div class="container">
<div class="modal fade" id="inscription_form">
  <div class="modal-dialog"> 
    <div class="modal-content animate">
      <?php include('inscription.php'); ?>
    </div>
  </div>
</div>
</div>

<!--  POPUP FOR CONNEXION -->
<div class="container">
<div class="modal fade" id="connexion">
  <div class="modal-dialog  "> 
    <div class="modal-content animate">
      <?php include('connexion.php'); ?>
    </div>
  </div>
</div>
</div>

  
  <section>
  <div class="bandeau">  
    <div class="container">
        <h3 class="text-center ">Inscriptions ouvertes<span class="font-weight-light lead d-block"> Année 2020</span></h3>
          
          <div class="dropdown text-center m-2">
            <button class="btn btn-outline-light  dropdown-toggle mb-4" data-toggle="dropdown">
              Documents
            </button>
            
            <div class="dropdown-menu">
              <a class="dropdown-item" href="dossier_inscription.php">Dossier d'inscription</a>
              <a class="dropdown-item" href="reglement.php">Règlement </a>
              <a class="dropdown-item" href="documents.php">Documents concernant le client</a>
            </div>
          </div>
    </div>
  </div>
  </section>

  
  <section id="ht" class="bg-espace_membre">
    <div class="container  text-center">
      <h2 class="p-3 bg-light">Meilleures ventes</h2>
      <div class="card-deck text-center">
        
        <div class="card" >
          <img class="mt-2" src="https://srv1.parashop.com/34044-home_default/menthe-aquatique-shampooing-detox-400ml.jpg" class="card-img-top"/>
          <div class="card-body">
            <h5 class="card-title">Shampoing Klorane</h5>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary" data-toggle="modal" data-target="#shampoing">Acheter</button>
          </div>
        </div>
        
        <div class="card" >
          <img class="mt-2" src="https://srv3.parashop.com/23657-home_default/dentifrice-blancheur-75-ml.jpg" class="card-img-top"/>
          <div class="card-body">
            <h5 class="card-title">Fluoflor</h5>
          </div>
          <div class="card-footer">
            <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#fluo">Acheter</button>
          </div>
        </div>
        
        <div class="card"  >
          <img class="mt-2" src="https://srv1.parashop.com/23063-home_default/brosse-a-dents-souple.jpg" class="card-img-top"/>
          <div class="card-body">
            <h5 class="card-title">Brosse à dent</h5>
          </div>
          <div class="card-footer">
            <button class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#brosseDent">Acheter</button>
          </div>
        </div>

      </div>
    </div>
  </section>
  
  
 
  <div class="modal " id="shampoing">
    <div class="modal-dialog">
      <div class="modal-content p-0">
        <div class="modal-header">
          <h5 class="modal-title">Shampoing Klorane</h5>
          <button class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-0">
          <img src="https://srv1.parashop.com/34044-home_default/menthe-aquatique-shampooing-detox-400ml.jpg" class="d-block mx-auto w-100" />
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button class="btn btn-primary" data-toggle="tooltip" data-placement="top"  title="Soon available">Ajouter au panier</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal p-0" id="fluo">
    <div class="modal-dialog">
      <div class="modal-content p-0">
        <div class="modal-header">
          <h5 class="modal-title">Fluoflor</h5>
          <button class="close" data-dismiss="modal" aria-label="close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body p-0">
          <img src="https://srv3.parashop.com/23657-home_default/dentifrice-blancheur-75-ml.jpg" class="d-block mx-auto w-100" />
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Soon available">Ajouter au panier</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal p-0" id="brosseDent">
    <div class="modal-dialog">
      <div class="modal-content p-0">
        <div class="modal-header">
          <h5 class="modal-title">Brosse à dent</h5>
          <button class="close" data-dismiss="modal" aria-label="close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img src="https://srv1.parashop.com/23063-home_default/brosse-a-dents-souple.jpg" class="d-block mx-auto w-100"/>
        </div>
        <div class="modal-footer">
          <button class="btn-secondary" data-dismiss="modal">Fermer</button>
          <button class="btn-primary" data-toggle="tooltip" data-placement="top" title="Soon available">Ajouter au panier</button>
        </div>
      </div>
    </div>
  </div>
  
  <?php include('src/footer.php'); ?>
  <?php
  if (isset($_SESSION['connect'])) {
  ?>
<script>
					var connex = document.getElementById('conn');
					connex.className = "nav-link";
					connex.style.color = "green";
</script>
<?php } ?>

</body>
</html>