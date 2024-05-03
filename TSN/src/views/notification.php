<?php $title = "TSN - Notifications"; ?>
 
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
        $notifications =  $_SESSION['userNotifications']; // All the notifications of the user.
    }
    
    require_once("./src/models/config/config.php");
    use TSN\src\models\config\Config as ModelConfig;

    $startingUrl = (new ModelConfig)->getStartingUrl();
?>

    <section>
        <div class="container mt-5">
            <?php if(isset($isConnected) && $isConnected){ ?>
                <div class="row justify-content-center mt-5">
                    <?php if(!empty($notifications)){ 
                            $number = 1;  
                    ?>
                        <table class="table table-primary mt-5">
                            <caption align="top" class="text-center text-secondary fs-3 fw-bold mb-3">Vos notifications</caption>
                            <thead>
                                <tr>
                                    <th scope="col" class="fs-4">#</th>
                                    <th scope="col" class="fs-4">Contenu</th>
                                    <th scope="col" class="fs-4">Date</th>
                                    <th scope="col" class="fs-4">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($notifications as $notification){ ?>
                                    <?php if ($notification->getReadStatus() == 0){ ?>
                                        <tr class="table-success">
                                    <?php } else { ?>
                                        <tr>
                                    <?php } ?>
                                        <th scope="row"><?= $number ?></th>
                                        <td><?= $notification->getContent() ?></td>
                                        <td><?= $notification->getCreationDate() ?></td>
                                        <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">supprimer</button></td>

                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Supprimer une notification.</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Voulez-vous vraiment supprimer cette notification ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                    <form action="index.php?action=deleteNotification" method="POST">
                                                        <input type="hidden" id="idNotif" name="idNotif" value="<?= $notification->getID() ?>">
                                                        <button type="submit" class="btn btn-primary">Confirmer</button>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                            </div>

                                    </tr>
                                <?php $number++; 
                                      } 
                                ?>
                            </tbody>
                        </table>
                    <?php } else {?>
                        <div class="my-5">
                            <h5 class="text-center text-secondary fs-3 fw-bold my-5">Vous n'avez aucune notification...</h5>
                        </div>
                    <?php   } ?>

                </div>
            <?php } 
                  else { // If the user it not connected (he does not have access to this page).
                    header("location: {$startingUrl}/index.php?action=loginRequired");
                  }
            ?>
        </div>
    </section>

<?php $content = ob_get_clean(); ?>

<?php 
    ob_start();
    require('footer.php');
    $footer = ob_get_clean(); 
?>

<?php require('layout.php') ?>