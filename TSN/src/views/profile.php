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
                                                <button type="button" class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Modifier mes infos personelles</button>
                                                <button type="button" class="btn btn-primary col-12">Modifier mon mot de passe</button>
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
                
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Understood</button>
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