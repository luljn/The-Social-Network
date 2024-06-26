<?php
    if(isset($_SESSION['isConnected']) && isset($_SESSION["user"]) && $_SESSION['isConnected'] == true){

        $isConnected = $_SESSION['isConnected'];
        $user = $_SESSION["user"];
        $followings = $_SESSION['userFollowings'];   // All the followings of the user.
        $notifications =  $_SESSION['userNotifications']; // All the notifications of the user.
        $unreadNotif = $_SESSION['unreadNotificationsNumber'];
    }
?>
<nav class="navbar navbar-expand-md fixed-top navbar-primary bg-primary py-1">
    <div class="container">
        <div class="navbar-brand text-uppercase fw-bold text-white fs-5">
            <span class="bg-light text-primary p-1">T</span>HE 
            <span class="bg-light text-primary p-1">S</span>OCIAL  
            <span class="bg-light text-primary p-1">N</span>ETWORK
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list text-light"></i>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                
                    <li class="nav-item text-light mx-2">
                        <a href="index.php?action=home" class="nav-link"  data-bs-toggle="tooltip" title="Accueil">
                            <i class="bi bi-house text-light fs-3"></i>
                        </a>
                    </li>
                <?php if(isset($isConnected) && $isConnected) {?>
                    <li class="nav-item text-light mx-2">
                        <a href="index.php?action=notification" class="nav-link btn btn-unstyled"  data-bs-toggle="tooltip" title="Notifications">
                            <div class="d-flex flex-row">
                                <i class="bi bi-bell  text-light fs-3"></i>
                                <?php if(!empty($notifications) && $unreadNotif != 0){ ?>
                                    <span class="badge text-bg-secondary fs-5 text-danger">
                                        <?= $unreadNotif; } ?>
                                    </span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item text-light mx-2">
                        <a href="index.php?action=statistics" class="nav-link"  data-bs-toggle="tooltip" title="Statistiques">
                            <i class="bi bi-bar-chart  text-light fs-3"></i>
                        </a>
                    </li>
                <?php }?>
                <div class="container-fluid fs-3">
                    <form action="index.php?action=search" method="POST" class="d-flex mt-2 ms-5 me-2">
                        <input class="form-control me-2" id="research" name="research" type="text" placeholder="Rechercher..." aria-label="Search" required>
                        <button class="btn text-light" type="submit"><i class="bi bi-search" data-bs-toggle="tooltip" title="Recherche"></i></button>
                    </form>
                </div>
                <li class="nav-item dropdown mx-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if(isset($isConnected) && $isConnected && $user->getAdmin() == True){ ?>
                            <i class="bi bi-person-check text-light fs-3"></i>
                        <?php } elseif(isset($isConnected) && $isConnected && $user->getAdmin() == False) { ?>
                            <i class="bi bi-person-circle text-light fs-3"></i>
                        <?php }else{ ?>
                            <i class="bi bi-person-circle text-light fs-3"></i>
                        <?php } ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if(isset($isConnected) && $isConnected) {?>
                            <!-- <li><a class="dropdown-item" href="">Mes follows</a></li> -->
                            <li><a class="dropdown-item" href="index.php?action=myAccount&userId=<?= urldecode($user->getID()) ?>">Mon compte</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?action=myProfile"><?= $user->getSurname(); ?></a></li>
                            <?php if($user->getAdmin() == True){ ?>
                                <li><a class="dropdown-item" href="index.php?action=adminSpace">Espace admin</a></li>
                            <?php }?>
                            <li><a class="dropdown-item" href="index.php?action=signout">Se Déconnecter</a></li>
                        <?php }
                              else {
                        ?>
                            <li><a class="dropdown-item" href="index.php">Se Connecter</a></li>
                            <li><a class="dropdown-item" href="index.php?action=signup">S'inscrire</a></li>
                            <!-- <li><hr class="dropdown-divider"></li> -->
                            <!-- <li><a class="dropdown-item" href="">À propos de TSN</a></li> -->
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>