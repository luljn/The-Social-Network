<?php
    if(isset($_SESSION['isConnected']) && isset($_SESSION["user"])){

        $isConnected = $_SESSION['isConnected'];
        $user = $_SESSION["user"];
    }
?>

<div class="container">
    <p class="text-center text-secondary fs-5 fw-bold">
        Copyright © THE SOCIAL NETWORK.
    </p>
</div>