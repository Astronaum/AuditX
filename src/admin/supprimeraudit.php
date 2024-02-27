<?php
    session_start();
    include ("../../php/connexion.php");
    if(!isset($_SESSION["id_user"]))
        {
        header("location:../../index.php");
        }
    $id_audit=$_GET['id_audit'];

    $sql2="SELECT * FROM audits WHERE id_audit ='$id_audit'";
    $resultat2=mysqli_query($link,$sql2);
    $row = mysqli_fetch_array($resultat2);
    $username=$row['nom_audit'].'.'.$row['prenom_audit'];

    $sql3="DELETE FROM audits WHERE id_audit ='$id_audit'";
    $resultat3=mysqli_query($link,$sql3);

    $sql4="DELETE FROM users WHERE username ='$username'";
    $resultat4=mysqli_query($link,$sql4);
    header("location:auditeurs.php");
?>