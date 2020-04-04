<?php

function bdd($hn, $un, $pw)
{
    try {
        $conn = new PDO($hn, $un, $pw);
    } catch (Exception $e) {
        die('Ereur :' . $e->getMessage());
    }
    return $conn;
};

function query_select_user($conn)
{
    $requser = $conn->prepare("SELECT * FROM administrateur");
    $requser->execute();
    $result = $requser->fetch();
    return $result;
};
function query_select_pub($conn)
{
    $reqpub = $conn->prepare("SELECT * FROM publications ORDER BY id DESC");
    $reqpub->execute();
    $result = $reqpub->fetchall();
    return $result;
}

function query_add_pub($conn, $image, $categorie, $titre, $commentaire, $status)
{
    $reqpub = $conn->prepare('INSERT INTO publications (image,categorie,commentaire,titre,status) VALUES(?,?,?,?,?)');
    $reqpub->bindParam(1, $image, PDO::PARAM_STR_CHAR);
    $reqpub->bindParam(2, $categorie, PDO::PARAM_STR_CHAR);
    $reqpub->bindParam(3, $commentaire, PDO::PARAM_STR_CHAR);
    $reqpub->bindParam(4, $titre, PDO::PARAM_STR_CHAR);
    $reqpub->bindParam(5, $status, PDO::PARAM_INT);
    $reqpub->execute();
}

function querry_updae_pub($conn, $image, $categorie, $commentaire, $status, $id)
{
    $reqpub = $conn->prepare("UPDATE publications SET (image,categorie,commentaire,status) VALUES(?,?,?,?) WHERE id= ?");
    $reqpub->execute(array($image, $categorie, $commentaire, $status, $id));
};


function modstatus($conn, $value, $id)
{
    if ($value == 1) {
        $status = 0;
        $reqpub = $conn->prepare("UPDATE publications SET status=? WHERE id= ?");
        $reqpub->execute(array($status, $id));
    } else {
        $status = 1;
        $reqpub = $conn->prepare("UPDATE publications SET status=? WHERE id= ?");
        $reqpub->execute(array($status, $id));
    }
};

function querry_updaeId_pub($conn, $id, $id2)
{
  
    $reqpub = $conn->prepare("UPDATE publications SET id=? WHERE id= ?");

    $reqpub->execute(array($id+1000,$id,));
    $reqpub->execute(array($id,$id2));
    $reqpub->execute(array($id2,$id+1000,));
    
};



function switchorder($id1, $id2)
{
    $shadow = $id1;
    $id1 = $id2;
    $id2 = $shadow;

    // querry_updae_pub()
};
