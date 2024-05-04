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
                                    <th scope="col" class="fs-4">Contenu</th>
                                    <th scope="col" class="fs-4">Auteur</th>
                                    <th scope="col" class="fs-4">Nombre de likes</th>
                                    <th scope="col" class="fs-4 text-center">#</th>
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