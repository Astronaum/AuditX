<?php
session_start();
include ("connexion.php");
if(!isset($_SESSION["id_user"]))
	{
	header("location:../index.php");
	}
    $user=$_SESSION["id_user"];
    $pwd=$_POST['pwd'];
    $pwd1=$_POST['pwd1'];

    if(isset($_POST['modifier'])){
        if($pwd==$pwd1){
            $sql="UPDATE users SET pwd='$pwd' WHERE id_user='$user'";
            $resultat=mysqli_query($link,$sql);
            header("location:../src/employe/dashboard.php");
        }else{
            echo "<script> document.location='../src/employe/profil.php'; alert('Une erreur est arrivée, veuillez vérifier que les mots de passe sont similaires');document.location='../src/employe/profil.php'</script>";
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }
?>