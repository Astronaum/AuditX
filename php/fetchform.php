<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../style/sb-admin-2.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">    <script src="../../js/sidebar.js"></script>
    <script src="../../js/sidebar.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sidebars/">
    <link href="../../style/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style/bootstrapmodif.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script></head>
<style>

</style>
    
<body>
<?php
session_start();
include ("connexion.php");
if(!isset($_SESSION["id_user"]))
	{
	header("location:../index.php");
	}
if (isset($_POST['logout'])){
		session_destroy();
		header("Location:../index.php");
	}
//fetch.php
$id_a=$_SESSION['id_a_c'];
$connect = mysqli_connect("localhost", "root", "", "auditx");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM formulaires
  WHERE id_audit='".$id_a."'
  AND reference LIKE '%".$search."%'
  OR titre LIKE '%".$search."%'
  OR mission LIKE '%".$search."%'
 ";
}
else
{
 $query = "
  SELECT * FROM formulaires WHERE id_audit='".$id_a."'
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
    <table class="table table-striped table-warning">
    <tr><th scope="col" class="text-muted">Référence</th><th scope="col" class="text-muted">Titre</th><th scope="col" class="text-muted">Mission</th><th scope="col" class="text-muted">Rôle</th><th scope="col text-muted"></th><th scope="col"></th><th scope="col"></th>
    <tbody>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
    $r=$row["role"];
    $sql5="SELECT * from roles where id_role='$r'";
    $result5 = mysqli_query($link, $sql5);
    $row5 = mysqli_fetch_array($result5);
    $role=$row5['libelle_role'];
  $output .= '
   <tr>
    <td>'.$row["reference"].'</td>
    <td>'.$row["titre"].'</td>
    <td>'.$row["mission"].'</td>
    <td>'.$role.'</td>
    <td><a class="text-decoration-none text-dark fw-bold " href=ajoutqst.php?id_form='.$row["id_formulaire"].'&id_role='.$r.' >Modifier</a></td>
    <td><a class="text-decoration-none text-danger fw-bold" href=supprimerform.php?id_form='.$row["id_formulaire"].' >Supprimer</a></td>
    </tr>
  ';
 }
 echo $output;
}
else
{
 echo '<p class="text-center">Aucun résultat trouvé.</p>';
}

?>
</body>
</html>