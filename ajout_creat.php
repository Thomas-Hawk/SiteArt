<?php session_start() ?>
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
    require_once('bddlog.php') ?>
</div>

<?php
if (isset($_SESSION) AND !empty($_SESSION)) {
$conn = bdd($hn, $un, $pw);
$quser = query_select_user($conn);
$hash = $quser['mdp'];
if (password_verify($_SESSION['mdp'], $hash)) {
//print_r(query_select_pub_categorie($conn)) ;
    if (isset($_POST['formconnect'])) {
        if
        (!empty($_POST['image'] AND !empty($_POST['categorie1'] OR !empty($_POST['categorie2'])))) {

            if ($_POST['categorie2']) {
                $categorie = $_POST['categorie2'];
            } else {
                $categorie = $_POST['categorie1'];
            }
            $commentaire = $_POST['commentaire'];
            $image = $_POST['image'];
            $status = 1;
            $titre=$_POST['titre'];
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                querry_updae_pub($conn, $image, $categorie, $commentaire, $status, $id);
            } else {
                query_add_pub($conn, $image, $categorie,$titre, $commentaire, $status);
            }
            header("location:mode_creat.php");
        } else {
            $message = 'tu as oublier un champs';
        }
    }
    if (isset($_GET['id'])) {

        $id = $_GET['id'];
        //echo $id;
        $querpub = query_select_pub($conn);
        $tabid = $querpub[$id];
        //print_r( $tabid);
        $image = $tabid['image'];
        $categorie = $tabid['categorie'];
       $commentaire = $tabid['commentaire'];
       $titre = $tabid['titre'];
        $status = $tabid['status'];
    }
}
?>
<div class="row">
    <div class="mx-auto "><h1 class="text-center"> <?php echo $quser['nom'] ?> tu es connectée <br>Bienven
            dans le mode création
        </h1></div>
</div>
<div class="container login">

    <form class="col-sm-6 mx-auto " method="post" action="">
        <form class="was-validated">

            <?php if (isset($_GET['id'])) { ?>
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#imagemodif"
                       role="button"
                       aria-expanded="false" aria-controls="multiCollapseExample1">changer d'image ?</a>
                </p>
                <div class="row">
                    <div class="col">
                        <div class="collapse multi-collapse" id="imagemodif">
                            <div class="custom-file">
                                <label class="custom-file-label" for="customFile">choisir une nouvelle image
                                    <input type="file" class="custom-file-input" id="customFile"
                                           name="image" type="file" class="custom-file-input"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else { ?>
                <p>Choisir une image </p>
                <div class="custom-file">
                    <label class="custom-file-label" for="customFile"></label>
                    <input type="file" class="custom-file-input" id="customFile"
                           name="image" type="file" class="custom-file-input">
                </div><?php
            } ?>

            <div class="form-group mt-3">
                <label for="exampleFormControlSelect1">Choisir une categorie</label>
                <select name="categorie1" class="form-control" id="exampleFormControlSelect1">
                    <?php $value1 = null; if (isset($_GET['id'])){?> <option><?php echo $categorie ?></option><?php }
                    foreach (query_select_pub($conn) as $value) {
                        if ($value['categorie'] != $value1) { ?>

                            <option><?php echo $value['categorie'] ?></option><?php
                        }
                        $value1 = $value['categorie'];
                    }
                    ?>
                </select>
            </div>

            <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1"
                   role="button"
                   aria-expanded="false" aria-controls="multiCollapseExample1">La categorie n'existe pas</a>
            </p>
            <div class="row">
                <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Entrez une nouvelle categorie
                                <input name="categorie2" type="text" class="form-control"
                                       placeholder="Last name"></label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput">Entrez un titre</label>
                <input name="titre" type="text" class="form-control" id="formGroupExampleInput" <?php if (isset($_GET['id'])) {?>

                 value="<?php echo $titre; } ?>">

            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1"> Entrez un commentaire</label>
                <textarea name="commentaire" class="form-control" id="exampleFormControlTextarea1" rows="3"
                        ><?php if (isset($_GET['id'])) {

                    echo $commentaire;
                } ?></textarea></div>

            <div class="mt-3">
                <button name="formconnect" type="submit" class="btn btn-primary">Envoyer</button>
            </div>
            <?php
            if (isset($message)) {
                echo $message;
            }

            }
            ?>
        </form>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script>
    bsCustomFileInput.init()
    var btn = document.getElementById('btnResetForm')
    var form = document.querySelector('form')
    btn.addEventListener('click', function () {
        form.reset()
    })
</script>

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