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
    <title>AuditX - Détails collaborateurs</title>
    <link rel="shortcut icon" type="x-icon" href="../../img/icon.png">
    <link rel="stylesheet" href="../../style/sb-admin-2.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">    <script src="../../js/sidebar.js"></script>
    <script src="../../js/sidebar.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sidebars/">
    <link href="../../style/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style/bootstrapmodif.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#societe').on('change',function(){
            var societeId = $(this).val();
                        if(societeId){
                            $.get(
                                "../../php/socagence.php",
                                {societe: societeId},
                                function(data){
                                    $('#agence').html(data);
                                }
                            );
                        }else{
                            $('#agence').html('<option>Saisir une société d\'abord</option>');
                        }
            });
            
        });
    </script>

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
                Les ajouts
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed text-dark" href="ajoutcollab.php">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Ajouter un collaborateur</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed text-dark" href="ajoutagence.php">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Ajouter une agence</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed text-dark" href="ajoutauditeur.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Ajouter un auditeur</span>
                </a>
            </li>

            <hr class="sidebar-divider bg-dark">

            <div class="sidebar-heading text-dark">
                Les affectations
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed text-dark" href="affecter.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Affecter un auditeur</span>
                </a>
            </li>

            <hr class="sidebar-divider bg-dark">

            <div class="sidebar-heading text-dark">
                Les visualisations
            </div>

                <li class="nav-item">
                    <a class="nav-link collapsed text-dark" href="collaborateurs.php">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Les collaborateurs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed text-dark" href="agences.php">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Les agences</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed text-dark" href="auditeurs.php">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Les auditeurs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed text-dark" href="rapports.php">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Affectation et rapports</span>
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
                        <?php  echo '<h6 style="color:grey;"> Bonjour, '.$_SESSION['username'].' !</h6>'?>
                        </div>
                      </div>
                </nav> 
                <?php 
                        $id=$_GET['id_collaborateur'];
                        $sql="SELECT * from collaborateurs where id_collaborateur='$id'";
                        $result=mysqli_query($link,$sql);
                        $row=mysqli_fetch_assoc($result);
                        $id_=$row['id_collaborateur'];
                        $name=$row['nom_collaborateur'];
                        $pname=$row['prenom_collaborateur'];
                        $matricule=$row['matricule'];
                        $role=$row['id_role'];
                        $agence=$row['id_agence'];
                        echo'
                        <form class="row g-3 m-5 p-5 pt-0" method="post">
                        <div class="col-md-6">
                            <label class="form-label">Nom</label>
                            <input type="text" class="form-control weirdfocus" name="nom_collaborateur" value="'.$name.'" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Prénom</label>
                            <input type="text" class="form-control weirdfocus" name="prenom_collaborateur" value="'.$pname.'" disabled>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Matricule</label>
                            <input type="text" class="form-control weirdfocus" name="matricule" value="'.$matricule.'" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fonction</label>
                            ';
                                            $sql="SELECT * from roles where id_role='$role'";
                                            $result=mysqli_query($link,$sql);
                                            $fonctions=mysqli_fetch_assoc($result);
                                            $fonctions["libelle_role"];

                            echo'
                            <input type="text" class="form-control weirdfocus" name="matricule" value="'.$fonctions["libelle_role"].'" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Agence</label>
                            ';
                                            $sql="SELECT * from agences where id_agence='$agence'";
                                            $result=mysqli_query($link,$sql);
                                            $ag=mysqli_fetch_assoc($result);
                                            $ag["nom_agence"];
                            echo'
                            <input type="text" class="form-control weirdfocus" name="matricule" value="'.$ag["nom_agence"].'" disabled>
                        </div>
                        <div class="col-12 mt-5 text-center">
                            <button type="submit" class="btn btn-warning" name="revenir">Revenir</button>
                        </div>
                    </form>
                        ';
                ?>
            </div>
        </div>        
</body>
    <script src="../../js/bootstrap.bundle.min.js"></script>
</html>
<?php
if(isset($_POST['revenir'])){
    echo "<script>window.location.replace(\"collaborateurs.php\");</script>";
}
?>