<?php $title = "TSN - Mon compte"; ?>
 
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
        <div class="container d-flex flex-row">
            <div class="row">
                <?php if(isset($_SESSION['isConnected']) && $isConnected){ ?>
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
                                    <a href="#" class="btn btn-primary">Mon profil</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-8 mt-5">
                    <div class="card mb-5">
                        <img src="https://picsum.photos/1920/1080?random=2" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <img src="https://picsum.photos/1920/1080?random=8" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <img src="https://picsum.photos/1920/1080?random=17" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <img src="https://picsum.photos/1920/1080?random=56" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <img src="https://picsum.photos/1920/1080?random=67" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-2 mt-5">
                    <div id="carousel" class="carousel slide position-sticky" data-bs-ride="carousel" style="top: 97px;">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="5000">
                                <div class="card d-block w-100">
                                    <img src="../../img/defaultUserPicture.png" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title fs-5 text-center">John DOE</h5>
                                        <p class="card-text fs-6 text-center">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <span class="text-center">Followed</span>
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