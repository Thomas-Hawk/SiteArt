<?php session_start() ?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Art Co</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php include('entete.php');
        include('menu.php');
        require_once('fonctions.php');
        $tab = query_select_pub($conn);
        // var_export($tab);
        var_dump(ceil(count($tab) / 3));
        $countStart = count($tab);
        $countJump = 0;
        $countTotal = count($tab);
        require_once 'bddlog.php'; ?>
        <div class="row mb-5">
            <div class="card-columns">

                <?php

                for ($i = 0; $i < count($tab); $i++) {
                    if ($tab[$i]['status'] == 1) {
                        if ($countJump == ceil(count($tab) / 3)) {
                            $countStart++;
                            $countTotal = $countStart;
                            $countJump = 0 ?>

                            <div class="card">
                                <img class="card-img-top" src="images/<?php echo $tab[$countStart]['image'] ?>" alt="Card image cap img-thumbnail">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $tab[$countStart]['titre'] ?></h5>
                                    <p class="card-text"><?php echo $tab[$countStart]['commentaire'] ?></p>
                                    <p class="card-text"><?php echo $tab[$countStart]['id'] ?></p>
                                    <p class="card-text"><?php echo $i ?></p>
                                </div>
                            </div>
                        <?php } else {
                                    ?>
                            <div class="card">
                                <img class="card-img-top" src="images/<?php echo $tab[$countTotal]['image'] ?>" alt="Card image cap img-thumbnail">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $tab[$countTotal]['titre'] ?></h5>
                                    <p class="card-text"><?php echo $tab[$countTotal]['commentaire'] ?></p>
                                    <p class="card-text"><?php echo $tab[$countTotal]['id'] ?></p>
                                    <p class="card-text"><?php echo $i ?></p>
                                </div>
                            </div>

                <?php
                 $countTotal = $countTotal - 3;
                            $countJump++;
                        }
                    }
                }

                ?>
            </div>
        </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>