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
        <?php
        include('entete.php');
        include('menu.php');
        require_once('fonctions.php');
        require_once('bddlog.php');
        ?>

        <?php
        if (isset($_SESSION) and !empty($_SESSION)) {
            $conn = bdd($hn, $un, $pw);
            $query = query_select_user($conn);
            $hash = $query['mdp'];
            if (password_verify($_SESSION['mdp'], $hash)) {
                if (isset($_POST['modstatus1'])) {
                    // echo $_POST['modstatus1'];
                    $id = $_POST['modstatus1'];
                    $status = 1;
                    modstatus($conn, $status, $id);
                } elseif (isset($_POST['modstatus2'])) {
                    $id = $_POST['modstatus2'];
                    $status = 0;
                    modstatus($conn, $status, $id);
                }

                if ($_POST['tabone'] != "") {
                    $id = $_POST['tabone'];
                    $id2 = $_POST['tabtwo'];
                    querry_updaeId_pub($conn, $id, $id2);
                }

                ?>
                <div class="row">
                    <div class="mx-auto ">
                        <h1 class="text-center"> <?php echo $query['nom'] ?> tu es connectée <br>Bienvenue
                            dans le mode création

                        </h1>
                        <h2 class="text-center"><a href="ajout_creat.php">Ajouter une publication</a></h2>
                    </div>
                </div>
                <div class="row mb-5">

                    <table class="table table-striped" id="columns">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Titre</th>
                                <th scope="col">Commentaire</th>
                                <th scope="col">Categorie</th>
                                <th scope="col">Statut</th>
                                <th scope="col">Actions</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (query_select_pub($conn) as $value) {
                                        $id = $value['id'];
                                        $status = $value['status']
                                        ?>
                                <tr class="column" draggable="true">

                                    <th scope="row"><?php echo $value['id'] ?></th>
                                    <td><img src="images/<?php echo $value['image'] ?>" alt="Card image cap img-thumbnail" width="200"></td>
                                    <td><?php echo $value['titre'] ?></td>
                                    <td><?php echo $value['commentaire'] ?></td>
                                    <td><?php echo $value['categorie'] ?></td>
                                    <td> <?php if ($value['status'] == 1) { ?>
                                            <form method="post" action="">
                                                <button type="submit" name="modstatus1" value="<?php echo $id ?>" class="btn btn-success">Visible
                                                </button>
                                            </form> <?php } else { ?>
                                            <form method="post" action="">
                                                <button type="submit" name="modstatus2" value="<?php echo $id ?>" class="btn btn-dark">Invisible
                                                </button>
                                            </form> <?php } ?></td>
                                    <td>
                                        <form method="get" action="ajout_creat.php">
                                            <button name="id" type="submit" value="<?php echo $id - 1 ?>" class="btn btn-primary">Modifier
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
        <?php
            }
        }
        ?>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="dragdrop.js"></script>

</html>