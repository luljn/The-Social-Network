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
    }
?>

    <section class="mt-5">
        <div class="container d-flex flex-row">
            <div class="row">
                <?php if(isset($isConnected) && $isConnected){ ?>
                    <div class="col-2">
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
                                <div class="text-center">
                                    <a href="index.php?action=myProfile" class="btn btn-primary">Mon profil</a>
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
                        <div class="card mb-5">
                            <div class="d-flex flex-row mx-2 mt-2">
                                <img src="../../img/defaultUserPicture.png" alt=""  width="50" height="50">
                                <h5 class="mx-1 mt-2"><?= $post->getUser()->getSurname() . " " . $post->getUser()->getName(); ?></h5>
                            </div>
                            <hr>
                            <img src="https://picsum.photos/1920/1080?random=<?= $post->getUser()->getID(); ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text"><?= $post->getContent(); ?></p>
                            </div>
                            <hr>
                            <div class="d-flex flex-row mx-2 mb-2">
                                <i class="bi bi-hand-thumbs-up fs-3 text-primary mx-2" data-bs-toggle="tooltip" title="Liker"></i><p class="fs-3 me-4 text-secondary">1</p>
                                <i class="bi bi-chat fs-3 text-primary mx-2" data-bs-toggle="tooltip" title="Commenter"></i><p class="fs-3 me-4 text-secondary">7</p>
                            </div>
                        </div>
                    <?php   
                            }
                    ?>
                </div>
                <?php if(isset($isConnected) && $isConnected){ ?>
                    <div class="col-2 mt-5">
                        <div id="carousel" class="carousel slide position-sticky" data-bs-ride="carousel" style="top: 97px;">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="5000">
                                    <div class="card d-block w-100">
                                        <img src="../../img/defaultUserPicture.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title fs-5 text-center">John DOE</h5>
                                            <p class="card-text fs-6 text-center">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <div class="text-center">
                                                <a href="#" class="btn btn-primary">Follow</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="5000">
                                    <div class="card d-block w-100">
                                        <img src="../../img/defaultUserPicture.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title fs-5 text-center">Jane DOE</h5>
                                            <p class="card-text fs-6 text-center">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <div class="text-center">
                                                <a href="#" class="btn btn-primary">Follow</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="5000">
                                    <div class="card d-block w-100">
                                    <img src="../../img/defaultUserPicture.png" class="card-img-top" alt="...">
                                    <div class="card-body">
                                            <h5 class="card-title fs-5 text-center">Marc DOE</h5>
                                            <p class="card-text fs-6 text-center">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <div class="text-center">
                                                <a href="#" class="btn btn-primary">Follow</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
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