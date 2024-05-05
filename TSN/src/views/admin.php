<?php $title = "TSN - Espace d'administration"; ?>
 
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

    if(isset($_SESSION['isConnected']) && isset($_SESSION["user"])){

        $isConnected = $_SESSION['isConnected'];
        $user = $_SESSION["user"];
    }
?>

    <section>
        <div class="container mt-5">
            <div class="row justify-content-center mt-5">
                    
                
                <?php if(isset($isConnected) && $isConnected && $user->getAdmin()){ ?>
                    
                    <h5 class="fs-3 fw-bold text-center text-secondary my-5">Bienvenue Admin</h5>

                <?php } else {
                    
                            header("location: {$startingUrl}/index.php?action=home"); 
                        } 
                ?>
                    
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