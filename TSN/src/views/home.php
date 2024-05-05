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
        // $userFollowingsPosts = $_SESSION["followingsPosts"];
        $userFollowingsPosts = [];
        $likedPosts = $_SESSION['likedPosts'];
    }
?>

    <section class="mt-5">
        <div class="container d-flex flex-row">
            <div class="row">
                <?php if(isset($isConnected) && $isConnected){ // If the user is connected. ?>
                    <div class="col-2">
                        <h5 class="text-center fs-5 fw-bold text-secondary mb-4 position-sticky" style="top: 97px">Vous</h5>
                        <div class="card mt-5 border border-2 border-secondary position-sticky" style="top: 150px;">
                            <?php if($user->getPhoto() == ''){ ?>
                                    <img src="../../img/defaultUserPicture.png" class="card-img-top" alt="photo de profile" width="225" height="225">
                            <?php 
                                  } 
                                  else {
                            ?>
                                    <img src="../../img/users/<?= $user->getPhoto()?>" class="card-img-top" alt="photo de profile" width="225" height="225">
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
                      else { // If the user is not connected.
                ?>
                    <div class="col-1 offset-1">
                        <div class="card"></div>
                    </div>        
                <?php } ?>
                <div class="col-8 mt-5">
                    <?php if(isset($isConnected) && $isConnected){ // If the user is connected.
                            if(!empty($userFollowingsPosts)){  // If the user has at least one following and this one has made at least one post.
                                foreach($userFollowingsPosts as $post){
                                    $postComments = $post->getComments();   // The list of all the comments of the post.
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
                                <hr class="border border-2 border-secondary">
                            <?php } ?>
                            <div class="card-body">
                                <p class="card-text fs-5"><?= $post->getContent(); ?></p>
                            </div>
                            <?php if(isset($isConnected) && $isConnected){ ?>
                                <hr class="border border-2 border-secondary">
                                <div class="d-flex flex-row mx-2 mb-2">
                                    <?php if(!in_array($post->getID(), $likedPosts)){ ?>
                                        <form action="index.php?action=addLike" id="formLike<?= $post->getID() ?>" method="POST">
                                            <input type="hidden" id="idPost" name="idPost" value="<?= $post->getID() ?>">
                                            <button type="submit" class="btn btn-unstyled" name="increment" id="buttonLike<?= $post->getID() ?>" data-target="likeValue<?= $post->getID() ?>">
                                                <i class="bi bi-hand-thumbs-up fs-3 text-primary mx-2" data-bs-toggle="tooltip" title="Liker"></i>
                                            </button>
                                        </form>
                                    <?php  } elseif(in_array($post->getID(), $likedPosts)) {?>
                                        <form action="index.php?action=removeLike" id="formLike<?= $post->getID() ?>" method="POST">
                                            <input type="hidden" id="idPost" name="idPost" value="<?= $post->getID() ?>">
                                            <button type="submit" class="btn btn-unstyled" name="decrement" id="buttonLike<?= $post->getID() ?>" data-target="likeValue<?= $post->getID() ?>">
                                                <i class="bi bi-hand-thumbs-up fs-3 text-primary mx-2" data-bs-toggle="tooltip" title="UnLike"></i>
                                            </button>
                                        </form>
                                    <?php } ?>
                                    <p class="fs-3 me-4 text-secondary" id="likeValue<?= $post->getID() ?>"><?= $post->getLikes(); ?></p>
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
                                            <h5 class="offcanvas-title fs-3" id="offcanvasBottomLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body small">
                                            <div class="container">
                                                <div class="row gx-5">
                                                    <div class="col-6 border border-2 border-success px-5 py-5">
                                                        <h5 class="fs-3 mb-3">Ecrivez votre commentaire sur ce post : </h5>    
                                                        <form action="index.php?action=addComment" method="POST" enctype="multipart/form-data" class="border border-3 rounded-3 px-3 py-3 mb-3">
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
                                                        <div class="card mb-3 border border-2 border-secondary">
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
                                                        </div>
                                                    </div>
                                                    <div class="col-6 border border-2 border-info px-5 py-5">
                                                        <?php if(!empty($postComments)){ // If the post at least one comment 
                                                        ?>
                                                        <h5 class="fs-3 mb-3">Commentaire(s) précédent(s)</h5>
                                                        <?php        foreach($postComments as $postComment){
                                                        
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
                    <?php      }
                            } elseif(empty($userFollowingsPosts)){ // If the user has no following(s) or his following(s) didn't make any post.
                                foreach($randomPosts as $post){
                                    $postComments = $post->getComments();   // The list of all the comments of the post.
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
                                <hr class="border border-2 border-secondary">
                            <?php } ?>
                            <div class="card-body">
                                <p class="card-text fs-5"><?= $post->getContent(); ?></p>
                            </div>
                            <?php if(isset($isConnected) && $isConnected){ ?>
                                <hr class="border border-2 border-secondary">
                                <div class="d-flex flex-row mx-2 mb-2">
                                    <?php if(!in_array($post->getID(), $likedPosts)){ ?>
                                        <form action="index.php?action=addLike" id="formLike<?= $post->getID() ?>" method="POST">
                                            <input type="hidden" id="idPost" name="idPost" value="<?= $post->getID() ?>">
                                            <button type="submit" class="btn btn-unstyled" name="increment" id="buttonLike<?= $post->getID() ?>" data-target="likeValue<?= $post->getID() ?>">
                                                <i class="bi bi-hand-thumbs-up fs-3 text-primary mx-2" data-bs-toggle="tooltip" title="Liker"></i>
                                            </button>
                                        </form>
                                    <?php  } elseif(in_array($post->getID(), $likedPosts)) {?>
                                        <form action="index.php?action=removeLike" id="formLike<?= $post->getID() ?>" method="POST">
                                            <input type="hidden" id="idPost" name="idPost" value="<?= $post->getID() ?>">
                                            <button type="submit" class="btn btn-unstyled" name="decrement" id="buttonLike<?= $post->getID() ?>" data-target="likeValue<?= $post->getID() ?>">
                                                <i class="bi bi-hand-thumbs-up fs-3 text-primary mx-2" data-bs-toggle="tooltip" title="UnLike"></i>
                                            </button>
                                        </form>
                                    <?php } ?>
                                    <p class="fs-3 me-4 text-secondary" id="likeValue<?= $post->getID() ?>"><?= $post->getLikes(); ?></p>
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
                                            <h5 class="offcanvas-title fs-3" id="offcanvasBottomLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body small">
                                            <div class="container">
                                                <div class="row gx-5">
                                                    <div class="col-6 border border-2 border-success px-5 py-5">
                                                        <h5 class="fs-3 mb-3">Ecrivez votre commentaire sur ce post : </h5>    
                                                        <form action="index.php?action=addComment" id="formComment<?= $post->getID() ?>" method="POST" enctype="multipart/form-data" class="border border-3 rounded-3 px-3 py-3 mb-3">
                                                            <div class="mb-3">
                                                                <label for="newComment" class="form-label fs-5">Contenu de votre commentaire</label>
                                                                <textarea name="newComment" id="newComment" cols="50" rows="10" required></textarea>
                                                                <input type="hidden" id="idPost" name="idPost" value="<?= $post->getID() ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="imageComment" class="form-label fs-5">Voulez-vous ajouter une image ?</label>
                                                                <input type="file" class="form-control" id="imageComment" name="imageComment" accept="image/*">
                                                            </div>
                                                            <button type="submit" id="submitComment<?= $post->getID() ?>" class="btn btn-primary">Commenter</button>
                                                        </form>
                                                        <div class="card mb-3 border border-2 border-secondary">
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
                                                        </div>
                                                    </div>
                                                    <div class="col-6 border border-2 border-info px-5 py-5">
                                                        <?php if(!empty($postComments)){ // If the post at least one comment 
                                                        ?>
                                                        <h5 class="fs-3 mb-3">Commentaire(s) précédent(s)</h5>
                                                        <?php        foreach($postComments as $postComment){
                                                        
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
                            }
                        } else { // If the user is not connected.
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
                                <hr class="border border-2 border-secondary">
                            <?php } ?>
                            <div class="card-body">
                                <p class="card-text fs-5"><?= $post->getContent(); ?></p>
                            </div>
                        </div>
                    <?php   
                            }
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
                                                            <button type="submit" class="btn btn-primary">Follow</button>
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