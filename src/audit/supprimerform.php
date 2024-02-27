<?php
    session_start();
    include ("../../php/connexion.php");
    if(!isset($_SESSION["id_user"]))
	{
	header("location:../../index.php");
	}

    $id_form=$_GET['id_form'];

    $sql4="DELETE FROM questions WHERE id_formulaire ='$id_form'";
    $resultat4=mysqli_query($link,$sql4);

    $sql3="DELETE FROM formulaires WHERE id_formulaire ='$id_form'";
    $resultat3=mysqli_query($link,$sql3);

    echo "<script>window.location.replace(\"modif.php\");</script>";
    ?>