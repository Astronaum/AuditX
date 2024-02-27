<?php 
session_start();
include ("../../php/connexion.php");
if(!isset($_SESSION["id_user"]))
	{
	header("location:../../index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AuditX - Création de formulaire</title>
    <link rel="shortcut icon" type="x-icon" href="../../img/icon.png">
    <link rel="stylesheet" href="../../style/sb-admin-2.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">    <script src="../../js/sidebar.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sidebars/">
    <link href="../../style/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style/bootstrapmodif.css">
    <script src="../../js/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body id="page-top">

    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3 fw-bold text-danger">AuditX</div>
            </a>

            <hr class="sidebar-divider bg-dark">

            <div class="sidebar-heading text-dark">
                Les créations
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed text-dark" href="creerformulaire.php">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Création d'un formulaire</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed text-dark" href="modif.php">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Création des questions et modification</span>
                </a>
            </li>
            <hr class="sidebar-divider bg-dark">

            <div class="sidebar-heading text-dark">
                Audits
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed text-dark" href="auditer.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Auditer une agence</span>
                </a>
            </li>

            <hr class="sidebar-divider bg-dark">

            <div class="sidebar-heading text-dark">
                Les dépôts
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed text-dark" href="rapports.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Les rapports</span>
                </a>
            </li>

            <hr class="sidebar-divider bg-dark">

            <div class="sidebar-heading text-dark">
                Historique
            </div>

                <li class="nav-item">
                    <a class="nav-link collapsed text-dark" href="histo.php">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Les audits</span>
                    </a>
                </li>
            </ul>
        <div class="dropdown position-absolute bottom-0 start-3">
            <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../../img/avatar.png" alt="mdo" width="24" height="24" class="rounded-circle">
            </a>
            <ul class="dropdown-menu text-small shadow ms-3">
                <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                <li><hr class="sidebar-divider bg-dark mt-2 mb-2"></li>
                <li>
                <form action="../../php/logout.php" method = "post">
                    <button type="submit" class="dropdown-item signoutcolor" name="signout" >Sign out</button>
                </form>
                </li>
            </ul>
        </div>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-dark topbar mb-4 static-top shadow opacity-25">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse justify-content-end me-5">
                        <?php  
                            $research=$_SESSION['username'];
                            $research=explode('.',$research);

                            $sql="SELECT * FROM audits WHERE nom_audit='$research[0]' AND prenom_audit='$research[1]'";
                            $result=mysqli_query($link,$sql);
                            $row=mysqli_fetch_assoc($result);
                            $nom_audit_cour=$row['nom_audit'];
                            $prenom_audit_cour=$row['prenom_audit'];
                            $id_audit_cour=$row['id_audit'];
                            $_SESSION['id_a_c']=$id_audit_cour;
                            echo '<h6 style="color:grey;"> Bonjour, '.$nom_audit_cour.' '.$prenom_audit_cour.' !</h6>'
                        ?>
                        </div>
                      </div>
                </nav>
                <form class="row g-3 m-5 p-5 pt-0" method="post">
                    <div class="col-md-6">
                        <label class="form-label">Réference</label>
                        <input type="text" class="form-control weirdfocus" name="ref" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Titre</label>
                        <input type="text" class="form-control weirdfocus" name="titre" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Mission</label>
                        <input type="text" class="form-control weirdfocus" name="mission" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Rôle ciblé</label>
                        <select class="form-select weirdfocus" name="role">
                        <?php
										$sql="SELECT * from roles";
										$result=mysqli_query($link,$sql);
										while ($fonctions=mysqli_fetch_assoc($result))
										{
										echo '<option value='.$fonctions["id_role"].'>';
										echo $fonctions["libelle_role"];
										echo'</option>';
										}
										?>
                        </select>
                    </div>
                    <div class="col-12 mt-5 text-center">
                        <button type="submit" class="btn btn-warning" name="enregistrer">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>        
</body>
    <script src="../../js/bootstrap.bundle.min.js"></script>
</html>
<?php
if(isset($_POST['enregistrer']) && !empty($_POST['ref'])){
    $ref=$_POST['ref'];
    $titre=$_POST['titre'];
    $mission=$_POST['mission'];
    $role=$_POST['role'];

    $sql="INSERT into formulaires values(NULL,'$id_audit_cour','$ref','$titre','$mission','$role')";
    $resultat=mysqli_query($link,$sql);

    echo "<script>window.location.replace(\"modif.php\");</script>";
}
?>
