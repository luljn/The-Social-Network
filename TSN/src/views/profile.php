<?php $title = "TSN - Mon profil"; ?>
 
<?php 
    ob_start();
    require('header.php');
    $header = ob_get_clean();
?>

<?php 
    ob_start();
    if(isset($_SESSION['isConnected']) && isset($_SESSION["user"])){

        $isConnected = $_SESSION['isConnected'];
        $user = $_SESSION["user"];
    }
?>

    <section class="mt-5">
        <div class="container">
            <div class="row">
                <?php if(isset($isConnected) && $isConnected){ ?>
                    <div class="col-6 mt-5 offset-3">
                        <div class="card mt-5 border border-5">
                            <div class="container">
                                <div class="row">
                                    <div class="col-6">
                                        <?php if($user->getPhoto() == ''){ ?>
                                            <img src="../../img/defaultUserPicture.png" class="card-img-top img-fluid" alt="photo de profile">
                                        <?php 
                                            } 
                                            else {
                                        ?>
                                            <img src=<?= $user->getPhoto()?> class="card-img-top img-fluid" alt="photo de profile">
                                        <?php } ?>
                                        <div class="card-body">
                                            <h5 class="card-title fs-5 text-center"><?= $user->getSurname() . " " . $user->getName(); ?></h5>
                                            <p class="card-text fs-6 text-center">Une petite description à propos de l'utilisateur.</p>
                                        </div>
                                    </div>
                                    <div class="col-6"> 
                                        <div class="container mt-5">
                                            <div class="row gy-2">
                                                <button type="button" class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#userInfosModal">Modifier mes infos personelles</button>
                                                <button type="button" class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#userPasswordModal">Modifier mon mot de passe</button>
                                                <button type="button" class="btn btn-primary col-12">Modifier ma photo de profil</button>
                                                <button type="button" class="btn btn-primary col-12">Gérer mes followers</button>
                                                <button type="button" class="btn btn-primary col-12">Gérer mes followings</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- User informations form modal -->
                    <div class="modal fade" id="userInfosModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Infos personnelles</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Nom</label>
                                            <input type="text" class="form-control" name="nom" id="nom" value="<?= $user->getName(); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="prenom" class="form-label">Prénom</label>
                                            <input type="text" class="form-control" name="prenom" id="prenom" value="<?= $user->getSurname(); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="birthday" class="form-label">Date de naissance</label>
                                            <input type="date" class="form-control" name="birthday" id="birthday" value="<?= $user->getBirthday(); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Adresse Mail</label>
                                            <input type="text" class="form-control" name="email" id="email" value="<?= $user->getEmail(); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Adresse</label>
                                            <input type="text" class="form-control" name="address" id="address" value="<?= $user->getAddress(); ?>"required>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button type="button" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User password form modal -->
                    <div class="modal fade" id="userPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Mot de passe</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="mdp" class="form-label">Mot de passe actuel</label>
                                            <input type="text" class="form-control" name="mdp" id="mdp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nouveauMdp" class="form-label">Nouveau mot de passe</label>
                                            <input type="text" class="form-control" name="nouveauMdp" id="nouveauMdp" required>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button type="button" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                    else{  // The case in which the user is not connected (he does not have access to this page).

                        header("location: http://localhost:4000/index.php?action=loginRequired");
                    }
                ?>
            </div>                      
        </div>
    </section>

<?php $content = ob_get_clean(); ?>

<?php 
    ob_start();
    require('footer.php');
    $footer = ob_get_clean(); 
?>

<?php require('layout.php') ?>