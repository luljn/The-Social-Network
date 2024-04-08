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
        <div class="container mt-5 d-flex flex-row">
            <div class="row">
                <?php if(isset($isConnected) && $isConnected){ ?>
                    <div class="col-4 mt-5">
                        <div class="card mt-5 position-sticky" style="top: 97px;">
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
                    </div>
                
                    <div class="col-8 mt-5">
                        <div class="d-flex flex-column my-5">
                            <button type="button" class="btn btn-primary my-5">Changer mes informations personelles</button>
                            <button type="button" class="btn btn-primary my-5">Changer ma photo de profil</button>
                            <button type="button" class="btn btn-primary my-5">Gérer mes followers</button>
                            <button type="button" class="btn btn-primary my-5">Gérer mes followings</button>
                        </div>
                    </div>
                <?php } ?>
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