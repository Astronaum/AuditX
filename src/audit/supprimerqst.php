<?php
    session_start();
    include ("../../php/connexion.php");
    if(!isset($_SESSION["id_user"]))
	{
	header("location:../../index.php");
	}

    $id_form=$_GET['id_form'];
    $role=$_GET['id_role'];
    $id=$_GET['id_qst'];

    $sql3="DELETE FROM questions WHERE id_question ='$id'";
    $resultat3=mysqli_query($link,$sql3);

    echo "<script>window.location.replace(\"ajoutqst.php?id_form=".$id_form."&id_role=".$role."\");</script>";
    ?>