<?php $title = "TSN - Acceuil"; ?>
 
<?php 
    ob_start();
    require('header.php');
    $header = ob_get_clean();
?>

<?php 
    ob_start();
    $randomPosts = $_SESSION['ramdomPosts'];
    if(isset($_SESSION['isConnected']) && isset($_SESSION["user"])){

        $isConnected = $_SESSION['isConnected'];
        $user = $_SESSION["user"];
        $usersNotFollowed = $_SESSION['usersNotFollowed'];
    }
?>

    <section class="mt-5">
        <div class="container d-flex flex-row">
            <div class="row">
                <?php if(isset($isConnected) && $isConnected){ ?>
                    <div class="col-2">
                        <div class="card mt-5 border border-2 border-secondary position-sticky" style="top: 150px;">
                            <?php if($user->getPhoto() == ''){ ?>
                                    <img src="../../img/defaultUserPicture.png" class="card-img-top img-fluid" alt="photo de profile">
                            <?php 
                                  } 
                                  else {
                            ?>
                                    <img src="../../img/users/<?= $user->getPhoto()?>" class="card-img-top img-fluid" alt="photo de profile">
                            <?php } ?>
                            <div class="card-body">
                                <a class="text-dark text-decoration-none" href="index.php?action=myAccount&userId=<?= urldecode($user->getID()) ?>">
                                    <h5 class="card-title fs-5 fw-bold text-center"><?= $user->getSurname() . " " . $user->getName(); ?></h5>
                                </a>
                                <p class="card-text fs-5 text-center mt-3"><?= $user->getDescription(); ?></p>
                                <div class="text-center">
                                    <a href="index.php?action=myProfile" class="btn btn-primary mt-3">Mon profil</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } 
                      else {
                ?>
                    <div class="col-1 offset-1">
                        <div class="card"></div>
                    </div>        
                <?php } ?>
                <div class="col-8 mt-5">
                    <?php 
                        foreach($randomPosts as $post){ 
                    ?>
                        <div class="card mb-5 border border-2 border-primary">
                            <div class="d-flex flex-row mx-2 mt-2">
                            <?php if($post->getUser()->getPhoto() == ''){ ?>
                                <img src="../../img/defaultUserPicture.png" width="50" height="50">
                            <?php } else {?>
                                <img src="../../img/users/<?= $post->getUser()->getPhoto()?>" width="50" height="50">
                            <?php } ?>
                                <a class="text-dark text-decoration-none" href="index.php?action=myAccount&userId=<?= urldecode($post->getUser()->getID()) ?>">
                                    <h5 class="mx-1 mt-2 card-title fs-5 fw-bold text-center"><?= $post->getUser()->getSurname() . " " . $post->getUser()->getName(); ?></h5>
                                </a>
                            </div>
                            <hr class="border border-2 border-secondary">
                            <?php if($post->getImage() == ''){ ?>
                                <!-- <img src="https://picsum.photos/1920/1080?random=<?= $post->getUser()->getID(); ?>" class="card-img-top" alt="..."> -->
                            <?php } else {?>
                                <img src="../../img/posts/<?= $post->getImage() ?>" class="card-img-top img-fluid" alt="...">
                            <?php } ?>
                            <div class="card-body">
                                <p class="card-text fs-5"><?= $post->getContent(); ?></p>
                            </div>
                            <?php if(isset($isConnected) && $isConnected){ ?>
                                <hr class="border border-2 border-secondary">
                                <div class="d-flex flex-row mx-2 mb-2">
                                    <i class="bi bi-hand-thumbs-up fs-3 text-primary mx-2" data-bs-toggle="tooltip" title="Liker"></i><p class="fs-3 me-4 text-secondary">1</p>
                                    <i class="bi bi-chat fs-3 text-primary mx-2" data-bs-toggle="tooltip" title="Commenter"></i><p class="fs-3 me-4 text-secondary">7</p>
                                </div>
                            <?php } ?>
                        </div>
                    <?php   
                        }
                    ?>
                </div>
                <?php if(isset($isConnected) && $isConnected){ ?>
                    <div class="col-2 mt-5">
                        <?php if(!empty($usersNotFollowed)){ ?>
                            <h5 class="text-center fs-5 fw-bold text-primary mb-4 position-sticky" style="top: 97px;">Découvrez d'autres utilisateurs 👨👩</h5>
                            <div class="position-fixed text-center mx-5">
                                <button type="button" class="btn btn-primary btn-block justify-content-center mt-3" data-bs-toggle="modal" data-bs-target="#usersNotFollowed">
                                    <i class="bi bi-plus-circle"></i>
                                    Découvrir 
                                </button>
                            </div>

                            <div class="modal fade" id="usersNotFollowed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Connaissez-vous ?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        
                                            <div class="modal-body">
                                                <?php foreach($usersNotFollowed as $userToFollow){ ?>
                                                    <form action="index.php?action=newFollow" method="POST">
                                                        <div class="mb-3 d-flex flex-row justify-content-between">
                                                            <?php if($userToFollow->getPhoto() == ''){ ?>
                                                                <img src="../../img/defaultUserPicture.png" width="50" height="50">
                                                            <?php } else {?>
                                                                <img src="../../img/users/<?= $userToFollow->getPhoto()?>" width="50" height="50">
                                                            <?php } ?>
                                                            <a class="text-dark text-decoration-none" href="index.php?action=myAccount&userId=<?= urldecode($userToFollow->getID()) ?>">
                                                                <h5 class="mx-1 mt-2 fs-5 fw-bold"><?= $userToFollow->getSurname() .  " " . $userToFollow->getName() ?></h5>
                                                            </a>
                                                            <input type="hidden" id="idUserToFollow" name="idUserToFollow" value="<?= $userToFollow->getID() ?>">
                                                            <button type="submit" class="btn btn-primary">follow</button>
                                                        </div>
                                                    </form>
                                                <?php } ?>
                                            </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                    <?php } else { ?>
                        <div class="card d-block w-100 border-2 border-secondary position-sticky" style="top: 150px;">
                            <div class="card-body">
                                <p class="text-center text-dark fs-5 mt-5">
                                    Vous avez déjà follow tous les autres utilisateurs de cette plateforme 😄.
                                </p>
                            </div>
                        </div>
                    <?php } ?>
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