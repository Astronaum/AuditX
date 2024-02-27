<?php
    session_start();
    include ("../../php/connexion.php");
    if(!isset($_SESSION["id_user"]))
        {
        header("location:../../index.php");
        }

    $id_collaborateur=$_GET['id_collaborateur'];

    $sql2="SELECT * FROM collaborateurs WHERE id_collaborateur ='$id_collaborateur'";
    $resultat2=mysqli_query($link,$sql2);
    $row = mysqli_fetch_array($resultat2);
    $username=$row['matricule'];

    
    $sql3="DELETE FROM collaborateurs WHERE id_collaborateur ='$id_collaborateur'";
    $resultat3=mysqli_query($link,$sql3);

    $sql4="DELETE FROM users WHERE username ='$username'";
    $resultat4=mysqli_query($link,$sql4);
    header("location:collaborateurs.php");
?>