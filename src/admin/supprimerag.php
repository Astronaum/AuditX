<?php
    session_start();
    include ("../../php/connexion.php");
    if(!isset($_SESSION["id_user"]))
	{
	header("location:../../index.php");
	}
    $id=$_GET['id'];

    $sql3="DELETE FROM agences WHERE id_agence ='$id'";
    $resultat3=mysqli_query($link,$sql3);

    header("location:agences.php");
?>