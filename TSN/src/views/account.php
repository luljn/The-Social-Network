<?php $title = "TSN - Mon compte"; ?>
 
<?php 
    ob_start();
    require('header.php');
    $header = ob_get_clean();
?>

<?php 
    ob_start();
    $user = $_SESSION['otherUser'];      // This it is used if the user is not connected, or if he is connected and it is not his account.
    $posts = $_SESSION['userPosts'];     // All the posts of the user.
    $followings = $_SESSION['userFollowings'];   // All the followings of the user.

    if(!empty($followings)){

        $firstFollowing = $followings[0];           // The first followings in the list.
    }

    if(count($followings) != 1){

        array_shift($followings);
    }
     
    if(isset($_SESSION['isConnected']) && isset($_SESSION["user"])){

        $isConnected = $_SESSION['isConnected'];
        $connectedUser = $_SESSION["user"];
    }
?>

    <section class="mt-5">
        <div class="container d-flex flex-row">
            <div class="row">
                <?php if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true 
                         && $_GET['userId'] == $connectedUser->getID()){ // If the account it is the one of the connected user. ?>
                    <div class="col-2">
                        <div class="card mt-5 border border-2 border-secondary position-sticky d-flex flex-column" style="top: 150px;">
                            <?php if($connectedUser->getPhoto() == ''){ ?>
                                <img src="../../img/defaultUserPicture.png" class="card-img-top" alt="photo de profile" width="225" height="225">
                            <?php 
                                } 
                                else {
                            ?>
                                <img src="../../img/users/<?= $connectedUser->getPhoto()?>" class="card-img-top" alt="photo de profile" width="225" height="225">
                            <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title fs-5 fw-bold text-center"><?= $connectedUser->getSurname() . " " . $connectedUser->getName(); ?></h5>
                                <p class="card-text fs-5 text-center mt-3"><?= $connectedUser->getDescription(); ?></p>
                                <?php if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] && $_GET['userId'] == $connectedUser->getID()){ ?>
                                    <div class="text-center">
                                        <a href="index.php?action=myProfile" class="btn btn-primary mt-3">Mon profil</a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="mt-5 position-fixed text-center">
                            <button type="button" class="btn btn-primary btn-block justify-content-center mt-3" data-bs-toggle="modal" data-bs-target="#userNewPostModal">
                                <i class="bi bi-pen"></i>
                                Nouveau post 
                            </button>
                        </div>
                        <!-- User new post form modal -->
                        <div class="modal fade" id="userNewPostModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="index.php?action=addPost" method="POST" enctype="multipart/form-data">
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
                <?php } elseif(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true 
                         && $_GET['userId'] != $connectedUser->getID()){ // If the account it is not the one of the connected user. ?>

                    <div class="col-2">
                        <div class="card mt-5 border border-2 border-secondary position-sticky" style="top: 150px;">
                            <?php if(isset($user) && $user->getPhoto() == ''){ ?>
                                <img src="../../img/defaultUserPicture.png" class="card-img-top" alt="photo de profile" width="225" height="225">
                            <?php 
                                } 
                                elseif(isset($user) && $user->getPhoto() != ''){
                            ?>
                                <img src="../../img/users/<?= $user->getPhoto() ?>" class="card-img-top" alt="photo de profile" width="225" height="225">
                            <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title fs-5 fw-bold text-center"><?= $user->getSurname() . " " . $user->getName(); ?></h5>
                                <p class="card-text fs-5 text-center mt-3"><?= $user->getDescription(); ?></p>
                            </div>
                        </div>
                    </div>

                <?php } else { // If the user is not connected. ?>
                    <div class="col-2">
                        <div class="card mt-5 border border-2 border-secondary position-sticky" style="top: 150px;">
                            <?php if(isset($user) && $user->getPhoto() == ''){ ?>
                                <img src="../../img/defaultUserPicture.png" class="card-img-top" alt="photo de profile" width="225" height="225">
                            <?php 
                                } 
                                elseif(isset($user) && $user->getPhoto() != ''){
                            ?>
                                <img src="../../img/users/<?= $user->getPhoto() ?>" class="card-img-top" alt="photo de profile" width="225" height="225">
                            <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title fs-5 fw-bold text-center"><?= $user->getSurname() . " " . $user->getName(); ?></h5>
                                <p class="card-text fs-5 text-center mt-3"><?= $user->getDescription(); ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-8 mt-5">

                    <?php if(empty($posts) && isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true 
                            && $_GET['userId'] == $connectedUser->getID()){ 
                    ?>
                        <div class="card mb-5 border-2 border-secondary">
                            <div class="card-body">
                                <p class="card-text fs-5">
                                    Vous n'avez fait aucun post 😓, mais vous pouvez en faire un grâce au bouton nouveau post 😉.
                                </p>
                            </div>
                        </div>
                        
                    <?php } elseif(empty($posts) && isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === false
                                   || empty($posts) && isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === True && $connectedUser->getID() !== $_GET["userId"])
                    { ?>
                                
                        <div class="card mb-5 border-2 border-secondary">
                            <div class="card-body">
                                <p class="card-text fs-5">
                                    Cet utilisateur(trice) n'a fait aucun post 😓, cette page est donc vide 😭. Y'a rien à voir pour le moment 😥.
                                </p>
                            </div>
                        </div>
                            
                    <?php } ?>

                    <?php
                        foreach($posts as $post){ 
                            $postComments = $post->getComments();   // The list of all the comments of the post.
                    ?>
                        <div class="card mb-5 border border-2 border-primary">
                            <div class="d-flex flex-row mx-2 mt-2">
                            <?php if($post->getUser()->getPhoto() == ''){ ?>
                                <img src="../../img/defaultUserPicture.png" width="50" height="50">
                            <?php } else {?>
                                <img src="../../img/users/<?= $post->getUser()->getPhoto()?>" width="50" height="50">
                            <?php } ?>
                                <h5 class="mx-1 mt-2 fw-bold"><?= $post->getUser()->getSurname() . " " . $post->getUser()->getName(); ?></h5>
                            </div>
                            <hr class="border border-2 border-secondary">
                            <?php if($post->getImage() == ''){ ?>
                                <!-- <img src="https://picsum.photos/1920/1080?random=<?= $post->getUser()->getID(); ?>" class="card-img-top" alt="..."> -->
                            <?php } else {?>
                                <img src="../../img/posts/<?= $post->getImage() ?>" class="card-img-top img-fluid" alt="...">
                                <hr class="border border-2 border-secondary">
                            <?php } ?>
                            <div class="card-body">
                                <p class="card-text fs-5"><?= $post->getContent(); ?></p>
                            </div>
                            <?php if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true){ ?>
                                <hr class="border border-2 border-secondary">
                                <div class="d-flex flex-row mx-2 mb-2">
                                    <button class="btn btn-unstyled"><i class="bi bi-hand-thumbs-up fs-3 text-primary mx-2" data-bs-toggle="tooltip" title="Liker"></i></button>
                                    <p class="fs-3 me-4 text-secondary"><?= $post->getLikes(); ?></p>
                                    <button type="button" class="btn btn-unstyled" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom<?= $post->getID() ?>" aria-controls="offcanvasBottom">
                                        <i class="bi bi-chat fs-3 text-primary mx-2" data-bs-toggle="tooltip" title="Commenter"></i>
                                    </button>
                                    <p class="fs-3 me-4 text-secondary">
                                        <?php if(!empty($postComments)){ 
                                                    echo count($post->getComments());
                                              }
                                              else{
                                                echo "0";
                                              }  
                                        ?>
                                    </p>

                                    <!-- Offcanvas to display the comments of a post -->
                                    <div class="offcanvas offcanvas-bottom h-100" tabindex="-1" id="offcanvasBottom<?= $post->getID() ?>" aria-labelledby="offcanvasBottomLabel">
                                        <div class="offcanvas-header text-center">
                                            <h5 class="offcanvas-title fs-3" id="offcanvasBottomLabel">Commentaires</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body small">
                                            <div class="container">
                                                <div class="row gx-5">
                                                    <div class="col-6">
                                                        <form action="index.php?action=addComment" method="POST" enctype="multipart/form-data" class="border border-3 rounded-3 px-3 py-3 position-sticky" style="top: 1px;">
                                                            <div class="mb-3">
                                                                <label for="newComment" class="form-label fs-5">Contenu de votre commentaire</label>
                                                                <textarea name="newComment" id="newComment" cols="50" rows="10" required></textarea>
                                                                <input type="hidden" id="idPost" name="idPost" value="<?= $post->getID() ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="imageComment" class="form-label fs-5">Voulez-vous ajouter une image ?</label>
                                                                <input type="file" class="form-control" id="imageComment" name="imageComment" accept="image/*">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Commenter</button>
                                                        </form>
                                                    </div>
                                                    <div class="col-6">
                                                        <?php if(!empty($postComments)){ // If the post at least one comment 
                                                                foreach($postComments as $postComment){
                                                        
                                                        ?>
                                                            <div class="card mb-3 border border-2 border-primary">
                                                                <div class="d-flex flex-row mx-2 mt-2">
                                                                    <?php if($postComment->getUser()->getPhoto() == ''){ ?>
                                                                        <img src="../../img/defaultUserPicture.png" width="50" height="50">
                                                                    <?php } else {?>
                                                                        <img src="../../img/users/<?= $postComment->getUser()->getPhoto()?>" width="50" height="50">
                                                                    <?php } ?>
                                                                        <h5 class="mx-1 mt-2 fw-bold"><?= $postComment->getUser()->getSurname() . " " . $postComment->getUser()->getName(); ?></h5>
                                                                </div>
                                                                <hr class="border border-2 border-secondary">
                                                                <?php if($postComment->getImage() == ''){ ?>
                                                                    <!-- <img src="https://picsum.photos/1920/1080?random=<?= $postComment->getUser()->getID(); ?>" class="card-img-top" alt="..."> -->
                                                                <?php } else {?>
                                                                    <img src="../../img/posts/<?= $postComment->getImage() ?>" class="card-img-top img-fluid" alt="...">
                                                                    <hr class="border border-2 border-secondary">
                                                                <?php } ?>
                                                                <div class="card-body">
                                                                    <p class="card-text fs-5"><?= $postComment->getContent(); ?></p>
                                                                </div>
                                                            </div>
                                                        <?php   }
                                                              } 
                                                              elseif(empty($postComments)){ 
                                                        ?>
                                                            <div class="card mb-3 border border-2 border-primary">
                                                                <div class="card-body">
                                                                    <p class="card-text fs-5">
                                                                        Ce post n'a aucun commentaire. 
                                                                        Soyez le(la) premier(e) à le commenter 😉.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        <?php } ?>        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php   
                        }
                    ?>
                </div>

                <?php if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true){ ?>
                    <div class="col-2 mt-5">
                        <?php if(!empty($followings)){ // If the user has at least one following. ?>
                            <?php if($connectedUser->getID() == $_GET["userId"]){ ?>
                                <h5 class="text-center fs-5 fw-bold text-primary mb-4 position-sticky" style="top: 97px">Vos followings</h5>
                            <?php } else { ?>
                                <h5 class="text-center fs-5 fw-bold text-primary mb-4 position-sticky" style="top: 97px">followings</h5>
                            <?php } ?>
                            <div id="carousel" class="carousel slide position-sticky" data-bs-ride="carousel" style="top: 150px;">
                                <div class="carousel-inner">
                                    <div class="carousel-item active" data-bs-interval="5000">
                                        <div class="card d-block w-100 border-2 border-secondary">
                                            <?php if($firstFollowing->getUser()->getPhoto() == ''){ ?>
                                                <img src="../../img/defaultUserPicture.png" class="card-img-top" alt="..." width="225" height="225">
                                            <?php } else { ?>
                                                <img src="../../img/users/<?= $firstFollowing->getUser()->getPhoto() ?>" class="card-img-top" alt="..." width="225" height="225">
                                            <?php } ?>
                                            <div class="card-body">
                                                <a class="text-dark text-decoration-none" href="index.php?action=myAccount&userId=<?= urldecode($firstFollowing->getUser()->getID()) ?>">
                                                    <h5 class="card-title fs-5 text-center fw-bold"><?= $firstFollowing->getUser()->getSurname() . " " . $firstFollowing->getUser()->getName(); ?></h5>
                                                </a>
                                                <p class="card-text fs-5 text-center mt-3"><?= $firstFollowing->getUser()->getDescription(); ?></p>
                                                <?php if($connectedUser->getID() == $_GET["userId"]){ ?>
                                                    <p class="text-center text-primary fs-5 fw-bold mt-3">Followed</p>
                                                <?php } else { ?>
                                                    <p class="text-center text-primary fs-5 fw-bold mt-3">Followed par <?= $user->getSurname() ?></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php foreach($followings as $following) { ?>
                                        <div class="carousel-item" data-bs-interval="5000">
                                            <div class="card d-block w-100 border-2 border-secondary">
                                            <?php if($following->getUser()->getPhoto() == ''){ ?>
                                                <img src="../../img/defaultUserPicture.png" class="card-img-top" alt="..." width="225" height="225">
                                            <?php } else { ?>
                                                <img src="../../img/users/<?= $following->getUser()->getPhoto() ?>" class="card-img-top" alt="..." width="225" height="225">
                                            <?php } ?>
                                                <div class="card-body">
                                                    <a class="text-dark text-decoration-none" href="index.php?action=myAccount&userId=<?= urldecode($following->getUser()->getID()) ?>">
                                                        <h5 class="card-title fs-5 fw-bold text-center"><?= $following->getUser()->getSurname() . " " . $following->getUser()->getName(); ?></h5>
                                                    </a>
                                                    <p class="card-text fs-5 text-center mt-3"><?= $following->getUser()->getDescription(); ?></p>
                                                    <?php if($connectedUser->getID() == $_GET["userId"]){ ?>
                                                        <p class="text-center text-primary fs-5 fw-bold mt-3">Followed</p>
                                                    <?php } else { ?>
                                                        <p class="text-center text-primary fs-5 fw-bold mt-3">Followed par <?= $user->getSurname() ?></p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
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
                        <?php } else if($_GET['userId'] == $connectedUser->getID()) { ?> 
                            <div class="card d-block w-100 border-2 border-secondary position-sticky" style="top: 150px;">
                                <div class="card-body">
                                    <p class="text-center text-dark fs-5 mt-5">
                                        Vous n'avez aucun following 😓, mais vous pouvez follow un autre utilisateur à tout moment 😉.
                                    </p>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="card d-block w-100 border-2 border-secondary position-sticky" style="top: 150px;">
                                <div class="card-body">
                                    <p class="text-center text-dark fs-5 mt-5">
                                        Cet utilisateur(trice) n'a encore aucun following 😓.
                                    </p>
                                </div>
                            </div>        
                        <?php } ?>
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