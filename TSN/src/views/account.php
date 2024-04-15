<?php $title = "TSN - Mon compte"; ?>
 
<?php 
    ob_start();
    require('header.php');
    $header = ob_get_clean();
?>

<?php 
    ob_start();
    $user = $_SESSION['otherUser'];
    if(isset($_SESSION['isConnected']) && isset($_SESSION["user"])){

        $isConnected = $_SESSION['isConnected'];
        $connectedUser = $_SESSION["user"];
    }
?>

    <section class="mt-5">
        <div class="container d-flex flex-row">
            <div class="row">
                <?php if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true 
                         && $_GET['userId'] == $connectedUser->getID()){ // If the account it is the one of the connected user ?>
                    <div class="col-2">
                        <div class="card mt-5 position-sticky d-flex flex-column" style="top: 97px;">
                            <?php if($connectedUser->getPhoto() == ''){ ?>
                                <img src="../../img/defaultUserPicture.png" class="card-img-top img-fluid" alt="photo de profile">
                            <?php 
                                } 
                                else {
                            ?>
                                <img src="<?= $connectedUser->getPhoto()?>" class="card-img-top img-fluid" alt="photo de profile">
                            <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title fs-5 text-center"><?= $connectedUser->getSurname() . " " . $connectedUser->getName(); ?></h5>
                                <p class="card-text fs-6 text-center">Une petite description à propos de l'utilisateur.</p>
                                <?php if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] && $_GET['userId'] == $connectedUser->getID()){ ?>
                                    <div class="text-center">
                                        <a href="index.php?action=myProfile" class="btn btn-primary">Mon profil</a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="mt-2 position-fixed text-center">
                            <button type="button" class="btn btn-primary btn-block justify-content-center" data-bs-toggle="modal" data-bs-target="#userNewPostModal">
                                <i class="bi bi-plus-circle"></i>
                                Nouveau post 
                            </button>
                        </div>
                        <!-- User new post form modal -->
                        <div class="modal fade" id="userNewPostModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Nouveau post</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="newPost" class="form-label">Contenu de votre post</label>
                                                <textarea name="newPost" id="newPost" cols="50" rows="10" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Voulez-vous ajouter une image ?</label>
                                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary">Poster</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php }
                      else{  
                ?>
                <div class="col-2">
                    <div class="card mt-5 position-sticky" style="top: 97px;">
                        <?php if(isset($user) && $user->getPhoto() == ''){ ?>
                            <img src="../../img/defaultUserPicture.png" class="card-img-top img-fluid" alt="photo de profile">
                        <?php 
                              } 
                              elseif(isset($user) && $user->getPhoto() != ''){
                        ?>
                            <img src=<?= $user->getPhoto() ?> class="card-img-top img-fluid" alt="photo de profile">
                        <?php } ?>
                        <div class="card-body">
                            <h5 class="card-title fs-5 text-center"><?= $user->getSurname() . " " . $user->getName(); ?></h5>
                            <p class="card-text fs-6 text-center">Une petite description à propos de l'utilisateur.</p>
                        </div>
                    </div>
                </div>
                <?php } ?>
        
                <div class="col-8 mt-5">
                    
                    <div class="card mb-5">
                        <div class="d-flex flex-row mx-2 mt-2">
                            <img src="../../img/defaultUserPicture.png" alt=""  width="50" height="50">
                            <h5 class="mx-1 mt-2"><?= $user->getSurname() . " " . $user->getName(); ?></h5>
                        </div>
                        <hr>
                        <img src="https://picsum.photos/1920/1080?random=2" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        </div>
                        <hr>
                        <div class="d-flex flex-row mx-2 mb-2">
                            <i class="bi bi-hand-thumbs-up fs-3 text-primary mx-2" data-bs-toggle="tooltip" title="Liker"></i><p class="fs-3 me-4 text-secondary">1</p>
                            <i class="bi bi-chat fs-3 text-primary mx-2" data-bs-toggle="tooltip" title="Commenter"></i><p class="fs-3 me-4 text-secondary">7</p>
                        </div>
                    </div>
                    <!-- <div class="card mb-5">
                        <img src="https://picsum.photos/1920/1080?random=8" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div> -->
                    <!-- <div class="card mb-5">
                        <img src="https://picsum.photos/1920/1080?random=17" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div> -->
                    <!-- <div class="card mb-5">
                        <img src="https://picsum.photos/1920/1080?random=56" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div> -->
                    <!-- <div class="card mb-5">
                        <img src="https://picsum.photos/1920/1080?random=67" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div> -->
                </div>
                <div class="col-2 mt-5">
                    <div id="carousel" class="carousel slide position-sticky" data-bs-ride="carousel" style="top: 97px;">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="5000">
                                <div class="card d-block w-100">
                                    <img src="../../img/defaultUserPicture.png" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title fs-5 text-center">Jackson Follay</h5>
                                        <p class="card-text fs-6 text-center">Petite description à propos de l'utilisateur.</p>
                                        <p class="text-center text-primary fw-bold">Followed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="5000">
                                <div class="card d-block w-100">
                                    <img src="../../img/defaultUserPicture.png" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title fs-5 text-center">Abram Sanders</h5>
                                        <p class="card-text fs-6 text-center">Petite description à propos de l'utilisateur.</p>
                                        <p class="text-center text-primary fw-bold">Followed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="5000">
                                <div class="card d-block w-100">
                                <img src="../../img/defaultUserPicture.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                        <h5 class="card-title fs-5 text-center">Jessica Monroe</h5>
                                        <p class="card-text fs-6 text-center">Petite description à propos de l'utilisateur.</p>
                                        <p class="text-center text-primary fw-bold">Followed</p>
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