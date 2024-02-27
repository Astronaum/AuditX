<?php
    session_start();
    include ("../../php/connexion.php");
    if(!isset($_SESSION["id_user"]))
        {
        header("location:../../index.php");
        }
    $id=$_GET['id'];

    $sql3="DELETE FROM affectations WHERE id_affectation ='$id'";
    $resultat3=mysqli_query($link,$sql3);
    header("location:rapports.php");
?>