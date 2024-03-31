<?php $title = "TSN - Connexion"; ?>
 
<?php 
    ob_start();
    require('header.php');
    $header = ob_get_clean(); 
?>

<?php ob_start(); ?>

    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-12 col-sm-6 col-md-8 p-0">
                <img class="img-fluid h-100" src="https://picsum.photos/id/272/1920/1280" alt="Image page de connexion">
            </div>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-center px-5 px-sm-5 py-5 py-sm-5">
                <form action="" class="row gy-4 pb-4 border border-3 rounded-3">
                    <p class="text-primary text-center fs-1 fw-bold">
                        Connexion
                    </p>
                    <hr>
                    <div class="col-12">
                              <label for="email" class="form-label">Adresse Mail</label>
                              <input type="text" class="form-control" name="email" id="email">
                    </div>
                    <div class="col-12">
                        <label for="mdp" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mdp" id="mdp">
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary w-100">Se Connecter</button>
                    </div>
                    <p>
                        Pas encore de compte ?
                        <a href="index.php?action=signup">
                            Inscrivez-vous Ici
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php 
    ob_start();
    require('footer.php');
    $footer = ob_get_clean(); 
?>

<?php require('layout.php') ?>