<?php 
    $title = "TSN - Inscription";
    if(isset($_SESSION['signupFailed'])){

        $signupFailed = $_SESSION['signupFailed'];
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
            <div class="col-12 col-sm-6 col-md-6 d-flex align-items-center px-5 px-sm-5 py-5 py-sm-5">
                <form action="index.php?action=createNewAccount" method="POST" class="row gy-3 pb-4 border border-3 rounded-3 my-5 my-sm-5">
                    <p class="text-primary text-center fs-1 fw-bold my-0">
                        Inscription
                    </p>
                    <p class="text-secondary text-center fs-5 fw-bold my-0">
                        créez un compte, c'est rapide et facile.
                    </p>
                    <hr>
                    <?php if($signupFailed){ ?>
                        <p class="text-danger fs-5 fw-bold">
                            Cette adresse mail est déjà liée à un compte.
                        </p>
                    <?php } ?>
                    <div class="col-6">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" id="nom" required>
                    </div>
                    <div class="col-6">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="prenom" id="prenom" required>
                    </div>
                    <div class="col-12">
                        <label for="birthday" class="form-label">Date de naissance</label>
                        <input type="date" class="form-control" name="birthday" id="birthday" required>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Adresse Mail</label>
                        <input type="text" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Adresse</label>
                        <input type="text" class="form-control" name="address" id="address" required>
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
                        <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                    </div>
                    <p>
                        Vous avez déjà un compte ?
                        <a href="index.php">
                            Connectez-vous Ici
                        </a>
                    </p>
                </form>
            </div>
            <div class="col-12 col-sm-6 col-md-6 p-0">
                <img class="img-fluid h-100" src="https://picsum.photos/id/384/5000/3333" alt="Image page de connexion">
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