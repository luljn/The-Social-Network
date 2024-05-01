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
?>

    <section>
        <div class="container mt-5">
            <div class="row justify-content-center mt-5">
                    
                <h5 class="fs-3 fw-bold text-center text-secondary my-5">Résultats</h5>
                    
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