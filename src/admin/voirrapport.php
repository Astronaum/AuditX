<?php
    session_start();
    include ("../../php/connexion.php");
    if(!isset($_SESSION["id_user"]))
        {
        header("location:../../index.php");
        }
    $id_file=$_GET['id'];

    $query="SELECT rapport FROM affectations where id_affectation='$id_file'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    $file=$row['rapport'];
    $filePath ="../../rapports/".$file;

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