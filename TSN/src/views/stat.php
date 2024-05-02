<?php $title = "TSN - Statitiques"; ?>
 
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

        $followings = $_SESSION['userFollowings'];   // All the followings of the user.
        
        if(!empty($followings)){

            $numberOfFollowings = count($followings);
        }

        else{

            $numberOfFollowings = 0;
        }
    }
    
    require_once("./src/models/config/config.php");
    use TSN\src\models\config\Config as ModelConfig;

    $startingUrl = (new ModelConfig)->getStartingUrl();
?>

    <section>
        <div class="container mt-5">
            <?php if(isset($isConnected) && $isConnected){ ?>
                <div class="row justify-content-center mt-5">
                    
                    <h5 class="fs-3 fw-bold text-center text-secondary my-5">Vos statistiques</h5>
                    <!-- Followers and followings chart -->
                    <div>
                        <canvas id="followChart" width="400" height="100"></canvas>
                    </div>

                    <script>

                        //Followers and followings chart.
                        const ctx = document.getElementById('followChart');

                        followings = parseInt("<?php echo $numberOfFollowings; ?>");
                        followers = 0;

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                            labels: ['Followers', 'Followings'],
                            datasets: [{
                                label: 'Nombres actuels de followers et de followings',
                                data: [followers, followings],
                                borderWidth: 1
                            }]
                            },
                            options: {
                            scales: {
                                y: {
                                beginAtZero: true
                                }
                            }
                            }
                        });
                    </script>
                    
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