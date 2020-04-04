<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Art Co</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>


<body>
<div class="container">

    <?php include('entete.php');
    include('menu.php');
    require_once('fonctions.php');
    require_once('bddlog.php');

    ?>
    <?php

    if (isset($_POST['formconnect'])) {

        if (!empty($_POST['nom']) AND !empty($_POST['mdp'])) {

            $nameconnect = htmlspecialchars($_POST['nom']);
            $mdpconnect = $_POST['mdp'];

            $hash = query_select_user(bdd($hn, $un, $pw))['mdp'];

            if (password_verify($mdpconnect, $hash)) {
                session_start();
                $_SESSION['nom'] = $nameconnect;
                $_SESSION['mdp'] = $mdpconnect;
                header("location: mode_creat.php");
            } else {
                $message = "erreur ce compte n \' exist pas";
            }
        } else {
            $message = "Veillez remplir tous les champs !";
        }
    }

    ?>
</div>
<div class="container login">
    <div class="row">
        <form class="col-sm-4 mx-auto" method="post" action="">
            <div class="form-group">
                <label for="exampleFormControlInput1">Name
                    <input name="nom" type="text" class="form-control" id="exampleFormControlInput1"
                           placeholder="ex: josette"></label>
            </div>
            <div class="form-group">
                <label for="exampleDropdownFormPassword2">Password
                    <input name="mdp" type="password" class="form-control"></label>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="dropdownCheck2">
                    <label class="form-check-label" for="dropdownCheck2">
                        Remember me
                    </label>
                </div>
            </div>
            <button type="submit" name="formconnect" class="btn btn-primary">Sign in</button>
        </form>

    </div>


    <?php
    if (isset($message)) {
        echo '<div class="col-sm-4 mx-auto mt-2"><span style="color: red; text-align: center">' . $message;
        '</div>';
    } ?>

</div>


</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</html>