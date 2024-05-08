<?php $title = "TSN - 404"; ?>
 
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-8 mt-5">
                <img src="././img/404.svg" alt="404" class="fs-5 img-fluid">
            </div>
        </div>
    </div>
    <div class="mt-1">
        <p class="text-dark text-center fs-3 fw-bold"><?= $errorMessage ?></p>
        <?php if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == false) {?>
            <p class="text-secondary text-center fs-5 fw-bold">
                Connectez-vous <a href="index.php">Ici</a>.
            </p>
        <?php } ?>
    </div>

<?php $content = ob_get_clean(); ?>

<?php 
    ob_start();
    require('footer.php');
    $footer = ob_get_clean(); 
?>

<?php require('layout.php') ?>