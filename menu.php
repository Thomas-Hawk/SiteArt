<nav class="navbar navbar-expand-lg navbar-light bg-light ">

    <a class="navbar-brand" href="accueil.php">Accueil</a>
    <a target="_blank" href="https://www.instagram.com/cocobozon/"><img class="insta"
                                                                        src="images/16dc_logo_instragram.png"></a>

    <?php
    if (isset($_SESSION) AND !empty($_SESSION)) { ?>
        <a href="logout.php">Deconnection </a>
        <a href="mode_creat.php">/ Mode-creattion</a>
        <?php
    }
    require_once('fonctions.php');
    require_once('bddlog.php');
    $conn = bdd($hn, $un, $pw);
    ?>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="quisuis-je.php">Qui suis-je</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="creations.php" id="navbarDropdownMenuLink" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Crèations
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?php $value1 = null;
                    foreach (query_select_pub($conn) as $value) {
                        if ($value['categorie'] != $value1) { ?>
                            <a class="dropdown-item" href="#"><?php echo $value['categorie'] ?></a><?php
                        }
                        $value1 = $value['categorie'];
                    }
                    ?>

                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>
        </ul>
    </div>
</nav>