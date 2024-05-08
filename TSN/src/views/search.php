<?php $title = "TSN - Recherche"; ?>
 
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

    $resultUsers = $_SESSION['resultUsers']; // All the users retrieved by the search.
    $resultPosts = $_SESSION['resultPosts']; // All the posts retrieved by the search.

    if(isset($_SESSION['isConnected']) && isset($_SESSION["user"])){

        $isConnected = $_SESSION['isConnected'];
        $connectedUser = $_SESSION["user"];
    }
?>

    <section>
        <div class="container mt-5">
            <div class="row justify-content-center mt-5">
                
                <?php if(!empty($resultUsers) || !empty($resultPosts)){ ?>
                    <h5 class="fs-3 fw-bold text-center text-secondary mt-5 mb-1">Résultats</h5>
                    <?php if(!empty($resultUsers)){ 
                            $number = 1;
                    ?>
                        <table class="table table-primary mt-5">
                            <caption align="top" class="text-center text-secondary fs-3 fw-bold mb-3">Utilisateurs</caption>
                            <thead>
                                <tr>
                                    <th scope="col" class="fs-4">#</th>
                                    <th scope="col" class="fs-4">Nom</th>
                                    <th scope="col" class="fs-4">Prénom</th>
                                    <th scope="col" class="fs-4">Description</th>
                                    <th scope="col" class="fs-4 text-center">#</th>
                                    <?php if(isset($isConnected) && $isConnected && $connectedUser->getAdmin()){ ?>
                                        <th scope="col" class="fs-4 text-center">Action admin</th>
                                    <?php } ?>    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($resultUsers as $user){ ?>
                                    
                                    <tr>
                                        <th scope="row"><?= $number ?></th>
                                        <td><?= $user->getName() ?></td>
                                        <td><?= $user->getSurname() ?></td>
                                        <td><?= $user->getDescription() ?></td>
                                        <td class="text-center">
                                            <a href="index.php?action=myAccount&userId=<?= urlencode($user->getID()) ?>">
                                                <button type="button" class="btn btn-primary">
                                                    voir le compte
                                                </button>
                                            </a>
                                        </td>
                                        <?php if(isset($isConnected) && $isConnected && $connectedUser->getAdmin() && !$user->getAdmin()){ ?>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUser">
                                                    actions
                                                </button>
                                            </td>

                                            <!--Admin actions Modal on users-->
                                            <div class="modal fade" id="modalUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Actions administrateur</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="index.php?action=sendWarning" method="POST">
                                                            <div class="mb-1 d-flex flex-row justify-content-between">
                                                                <h5 class="text-secondary fs-5">Envoyer un avertissement à <span class="fw-bold"><?= $user->getSurname() ?></span></h5>
                                                                <input type="hidden" id="idUser" name="idUser" value="<?= $user->getID() ?>">
                                                                <button type="submit" class="btn btn-primary">Avertir</button>
                                                            </div>
                                                        </form>
                                                        <br>
                                                        <form action="index.php?action=banishUser" method="POST">
                                                            <div class="mb-1 d-flex flex-row justify-content-between">
                                                                <h5 class="text-secondary fs-5">Bannir <span class="fw-bold"><?= $user->getSurname() ?></span></h5>
                                                                <input type="hidden" id="idUser" name="idUser" value="<?= $user->getID() ?>">
                                                                <button type="submit" class="btn btn-primary">Bannir</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>    
                                    </tr>
                                <?php $number++; 
                                    } 
                                ?>
                            </tbody>
                        </table>
                    <?php } ?>

                    <?php if(!empty($resultPosts)){ 
                            $numberP = 1;    
                    ?>
                        <table class="table table-primary mt-5">
                            <caption align="top" class="text-center text-secondary fs-3 fw-bold mb-3">Posts</caption>
                            <thead>
                                <tr>
                                    <th scope="col" class="fs-4">#</th>
                                    <th scope="col" class="fs-4 text-center">Contenu</th>
                                    <th scope="col" class="fs-4">Auteur</th>
                                    <th scope="col" class="fs-4">Likes</th>
                                    <th scope="col" class="fs-4 text-center">#</th>
                                    <?php if(isset($isConnected) && $isConnected && $connectedUser->getAdmin()){ ?>
                                        <th scope="col" class="fs-4 text-center">Action admin</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($resultPosts as $post){ ?>
                                    <tr>
                                        <th scope="row"><?= $numberP ?></th>
                                        <td><?= $post->getContent() ?></td>
                                        <td><?= $post->getUser()->getSurname() . " " .  $post->getUser()->getName() ?></td>
                                        <td class="text-center"><?= $post->getLikes() ?></td>
                                        <td>
                                            <a href="index.php?action=myAccount&userId=<?= urlencode($post->getUser()->getID()) ?>">
                                                <button type="button" class="btn btn-primary">
                                                    voir le compte de l'auteur
                                                </button>
                                            </a>
                                        </td>
                                        <?php if(isset($isConnected) && $isConnected && $connectedUser->getAdmin()){ ?>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPost">
                                                    actions
                                                </button>
                                            </td>

                                             <!--Admin actions Modal on posts-->
                                            <div class="modal fade" id="modalPost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Actions administrateur</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="index.php?action=setPostSensible" method="POST">
                                                            <div class="mb-1 d-flex flex-row justify-content-between">
                                                                <h5 class="text-secondary fs-5">Marquer ce post comme sensible</h5>
                                                                <input type="hidden" id="idPost" name="idPost" value="<?= $post->getID() ?>">
                                                                <input type="hidden" id="idPostAuthor" name="idPostAuthor" value="<?= $post->getUser()->getID() ?>">
                                                                <button type="submit" class="btn btn-primary">Marquer</button>
                                                            </div>
                                                        </form>
                                                        <br>
                                                        <form action="index.php?action=deletePost" method="POST">
                                                            <div class="mb-1 d-flex flex-row justify-content-between">
                                                                <h5 class="text-secondary fs-5">Supprimer ce post</h5>
                                                                <input type="hidden" id="idPost" name="idPost" value="<?= $post->getID() ?>">
                                                                <input type="hidden" id="idPostAuthor" name="idPostAuthor" value="<?= $post->getUser()->getID() ?>">
                                                                <button type="submit" class="btn btn-primary">Supprimer</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>  
                                    </tr>
                                <?php $numberP++; 
                                    } 
                                ?>
                            </tbody>
                        </table>
                    <?php } ?>

                <?php } else { ?>
                    <h5 class="fs-3 fw-bold text-center text-secondary my-5">Aucun résultat...</h5>
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