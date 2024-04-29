<?php $title = "TSN - Mon profil"; ?>
 
<?php 
    ob_start();
    require('header.php');
    $header = ob_get_clean();
?>

<?php 
    ob_start();

    require_once("./src/models/config/config.php");
    use TSN\src\models\config\Config as ModelConfig;

    $startingUrl = (new ModelConfig)->getStartingUrl();

    $followings = $_SESSION['userFollowings'];   // All the followings of the user.
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
                                            <img src="../../img/users/<?= $user->getPhoto()?>" class="card-img-top" alt="photo de profile" width="225" height="260">
                                        <?php } ?>
                                        <div class="card-body">
                                            <a class="text-dark text-decoration-none" href="index.php?action=myAccount&userId=<?= urldecode($user->getID()) ?>">
                                                <h5 class="card-title fs-5 fw-bold text-center"><?= $user->getSurname() . " " . $user->getName(); ?></h5>
                                            </a>
                                            <p class="card-text fs-5 text-center mt-3"><?= $user->getDescription() ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6"> 
                                        <div class="container mt-5">
                                            <div class="row gy-2">
                                                <button type="button" class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#userInfosModal">Modifier mes infos personelles</button>
                                                <button type="button" class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#userBirthdayModal">Modifier ma date de naissance</button>
                                                <button type="button" class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#userPasswordModal">Modifier mon mot de passe</button>
                                                <button type="button" class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#userPhotoModal">Modifier ma photo de profil</button>
                                                <button type="button" class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#userDescriptionModal">Modifier ma description</button>
                                                <button type="button" class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#userFollowingsModal">Gérer mes followings</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- User informations form modals -->
                    <div class="modal fade" id="userInfosModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="index.php?action=updatePersonnalInformations" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Infos personnelles</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Nom</label>
                                            <input type="text" class="form-control" name="nom" id="nom" value="<?= $user->getName(); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="prenom" class="form-label">Prénom</label>
                                            <input type="text" class="form-control" name="prenom" id="prenom" value="<?= $user->getSurname(); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Adresse Mail</label>
                                            <input type="text" class="form-control" name="email" id="email" value="<?= $user->getEmail(); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Adresse</label>
                                            <input type="text" class="form-control" name="address" id="address" value="<?= $user->getAddress(); ?>"required>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade" id="userBirthdayModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="index.php?action=updateBirthday" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Date de naissance</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div class="mb-3">
                                            <label for="birthday" class="form-label">Date de naissance : </label>
                                            <span><?= $user->getBirthday(); ?></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="birthday" class="form-label">Nouvelle date de naissance : </label>
                                            <input type="date" class="form-control" name="birthday" id="birthday" required>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- User password form modal -->
                    <div class="modal fade" id="userPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="index.php?action=updatePassword" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Mot de passe</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div class="mb-3 fs-5 fw-bold text-danger" id="messageMdp"></div>
                                        <div class="mb-3">
                                            <label for="mdp" class="form-label">Mot de passe actuel</label>
                                            <input type="text" class="form-control" name="mdp" id="mdp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nouveauMdp1" class="form-label">Nouveau mot de passe</label>
                                            <input type="text" class="form-control" name="nouveauMdp1" id="nouveauMdp1" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nouveauMdp2" class="form-label">Confirmer le nouveau mot de passe</label>
                                            <input type="text" class="form-control" name="nouveauMdp2" id="nouveauMdp2" required>
                                        </div>
                                        <!-- <div class="mb-3">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="bi bi-eye"></i><span> Afficher le mot de passe</span>
                                            </button>
                                        </div> -->
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- User profile photo update modal -->
                    <div class="modal fade" id="userPhotoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="index.php?action=updateProfilePhoto" method="POST" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Photo de profil</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div class="mb-3">
                                            <label for="profilePhoto" class="form-label">Nouvelle photo de profil</label>
                                            <input type="file" class="form-control" name="profilePhoto" id="profilePhoto" accept="image/*" required>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- User description update modal -->
                    <div class="modal fade" id="userDescriptionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="index.php?action=updateDescription" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ma description</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" id="description" cols="50" rows="10" required><?= $user->getDescription(); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- User followings managment modal -->
                    <div class="modal fade" id="userFollowingsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Mes followings</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <?php if(!empty($followings)){ ?>
                                    <div class="modal-body">
                                        <?php foreach($followings as $following){ ?>
                                            <form action="index.php?action=unFollow" method="POST">
                                                <div class="mb-3 d-flex flex-row justify-content-between">

                                                    <?php if($following->getUser()->getPhoto() == ''){ ?>
                                                        <img src="../../img/defaultUserPicture.png" width="50" height="50">
                                                    <?php } else {?>
                                                        <img src="../../img/users/<?= $following->getUser()->getPhoto()?>" width="50" height="50">
                                                    <?php } ?>

                                                    <a class="text-dark text-decoration-none" href="index.php?action=myAccount&userId=<?= urldecode($following->getUser()->getID()) ?>">
                                                        <h5 class="fs-5 fw-bold"><?= $following->getUser()->getSurname() .  " " . $following->getUser()->getName() ?></h5>
                                                    </a>
                                                    <input type="hidden" id="idUserFollowed" name="idUserFollowed" value="<?= $following->getUser()->getID() ?>">
                                                    <button type="submit" class="btn btn-primary">UnFollow</button>
                                                </div>
                                            </form>
                                        <?php } ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="modal-body fs-5">
                                        Vous n'avez aucun following 😓, mais vous pouvez follow un autre utilisateur à tout moment 😉.
                                    </div>
                                <?php } ?>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php }
                    else{  // The case in which the user is not connected (he does not have access to this page).

                        header("location: {$startingUrl}/index.php?action=loginRequired");
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