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
$connect = mysqli_connect("localhost", "root", "", "auditx");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM agences 
  WHERE nom_agence LIKE '%".$search."%'
 ";
}
else
{
 $query = "
  SELECT * FROM agences
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
    <table class="table table-striped table-warning">
    <tr><th scope="col" class="text-muted">Nom de l\'agence</th><th scope="col" class="text-muted">Nom de la société</th><th scope="col" class="text-muted"></th>
    <tbody>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
    $var=$row["id_societe"];
    $id_ag=$row["id_agence"];
    $query1 = "SELECT libelle_societe FROM societes WHERE id_societe='$var'";
    $result1 = mysqli_query($connect, $query1);
    $row1 = mysqli_fetch_array($result1);
    $libelle=$row1["libelle_societe"];
    $output .= '
    <tr>
    <td>'.$row["nom_agence"].'</td>
    <td>'.$libelle.'</td>
    <td><a class="text-decoration-none text-danger fw-bold" href=supprimerag.php?id='.$id_ag.' >Supprimer</a></td>
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