<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $title ?></title>

            <!-- CSS -->
            <link rel="stylesheet" href="../../styles/style.css">

            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
                integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

            <!-- Bootstrap icons -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" 
                integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" 
                crossorigin="anonymous" referrerpolicy="no-referrer" />

            <!-- jQuery -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <!-- Chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <body class="d-flex flex-column min-vh-100">

        <header>
            <?= $header ?>
        </header>

        <main>
            <?= $content ?>
        </main>

        <footer class="footer mt-auto py-3 bg-light">
            <?= $footer ?>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <!-- JS -->
        <script src="../../dynamic/tooltip.js"></script>
        <script src="../../dynamic/togglePassword.js"></script>
        <script src="../../dynamic/newPasswordCheck.js"></script>
        <!-- <script src="../../dynamic/addOrRemoveLikeOnPost.js"></script> -->
        <script src="../../dynamic/addCommentOnPost.js"></script>
        <script src="../../dynamic/checkEmail.js"></script>
        <script src="../../dynamic/checkNewEmail.js"></script>
        
    </body>

</html>