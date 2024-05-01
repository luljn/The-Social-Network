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
    }
    
    require_once("./src/models/config/config.php");
    use TSN\src\models\config\Config as ModelConfig;

    $startingUrl = (new ModelConfig)->getStartingUrl();
?>

    <section>
        <div class="container mt-5">
            <?php if(isset($isConnected) && $isConnected){ ?>
                <div class="row justify-content-center mt-5">
                    
                    <table class="table table-primary mt-5">
                        <caption align="top" class="text-center text-secondary fs-3 fw-bold mb-3">Vos notifications</caption>
                        <thead>
                            <tr>
                                <th scope="col" class="fs-4">#</th>
                                <th scope="col" class="fs-4">Contenu</th>
                                <th scope="col" class="fs-4">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Vous avez une nouvelle notification</td>
                                <td>01/05/2024</td>
                            </tr>
                        </tbody>
                    </table>

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