<?php 
    $title = "TSN - Connexion";
    if(isset($_SESSION['loginFailed'])){

        $loginFailed = $_SESSION['loginFailed'];
    }  
    
?>
 
<?php 
    ob_start();
    require('header.php');
    $header = ob_get_clean(); 
?>

<?php ob_start(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-0 col-sm-0 col-md-6 p-0">
                <img class="img-fluid h-100" src="https://picsum.photos/id/272/1920/1280" alt="Image page de connexion">
            </div>
            <div class="col-12 col-sm-12 col-md-6 d-flex align-items-center px-5 px-sm-5 py-5 py-sm-5">
                <form action="index.php?action=login" method="POST" class="row gy-4 pb-4 border border-3 rounded-3 mt-5">
                    <p class="text-primary text-center fs-1 fw-bold my-0">
                        Connexion
                    </p>
                    <hr>
                    <?php if($loginFailed){ ?>
                        <p class="text-danger fs-5 fw-bold">
                            Email ou mot de passe incorrect.
                        </p>
                    <?php } ?>
                    <div class="col-12">
                        <label for="email" class="form-label">Adresse Mail</label>
                        <input type="text" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="col-12">
                        <label for="mdp" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mdp" id="mdp" required>
                    </div>
                    <div class="col-10">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="bi bi-eye"></i><span> Afficher le mot de passe</span>
                        </button>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Se Connecter
                        </button>
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