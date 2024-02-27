<?php
    session_start();
    include ("../../php/connexion.php");
    if(!isset($_SESSION["id_user"]))
        {
        header("location:../../index.php");
        }
    $id_collab=$_GET['id_collab'];
    $id_affec=$_GET['id_affec'];

    $query="SELECT lettre FROM lettres where id_affectation='$id_affec' AND id_collaborateur='$id_collab'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    $file=$row['lettre'];
    $filePath ="../../lettre/".$file;

    if(file_exists($filePath)){
        
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        readfile($filePath);
        exit;
    }else{
        echo "File not exit";
    }

?>