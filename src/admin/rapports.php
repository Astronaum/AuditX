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
    <title>AuditX - Affectation et rapports</title>
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
</head>
<style>
    .isDisabled {
  color: currentColor;
  cursor: not-allowed;
  opacity: 0.5;
  text-decoration: none;
}
</style>
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
                    //fetch.php
                    $output = '';

                    $query = "SELECT * FROM affectations";
                    $result = mysqli_query($link, $query);
                    if(mysqli_num_rows($result) > 0)
                    {
                    $output .= '
                        <div class="col-md-10 justify-content-center m-auto" >
                        <table class="table table-striped table-warning ms-3 me-3 mt-3">
                        <tr><th scope="col" class="text-muted">ID AFFECTATION</th><th scope="col" class="text-muted">Auditeur</th><th scope="col" class="text-muted">Agence</th><th scope="col" class="text-muted">Contrat d\'auditeur</th><th scope="col" class="text-muted">Rapports</th><th scope="col" class="text-muted"></th>
                        <tbody>
                        </tr>
                    ';
                    while($row = mysqli_fetch_array($result))
                    {
                        $agence=$row["id_agence"];
                        $audit=$row["id_audit"];
                        
                        $query1 = "SELECT * FROM audits where id_audit='$audit'";
                        $result1 = mysqli_query($link, $query1);
                        $row1 = mysqli_fetch_array($result1);
                        $nomcomplet=$row1["nom_audit"].' '.$row1["prenom_audit"];

                        $query2 = "SELECT nom_agence FROM agences where id_agence='$agence'";
                        $result2 = mysqli_query($link, $query2);
                        $row2 = mysqli_fetch_array($result2);
                        $libelle=$row2["nom_agence"];

                    if(!empty($row['rapport']) && !empty($row['contrat'])){
                       $output .= '
                    <tr>
                        <td>'.$row["id_affectation"].'</td>
                        <td>'.$nomcomplet.'</td>
                        <td>'.$libelle.'</td>
                        <td><a class="text-decoration-none text-success fw-bold " href=voircontrat.php?id='.$row["id_affectation"].' >Cliquer ici</a></td>
                        <td><a class="text-decoration-none text-success fw-bold " href=voirrapport.php?id='.$row["id_affectation"].' >Cliquer ici</a></td>
                        <td><a class="text-decoration-none text-danger fw-bold" href=supprimeraffec.php?id='.$row["id_affectation"].' >Supprimer</a></td>
                    </tr>
                    ';
                    }elseif(empty($row['rapport']) && !empty($row['contrat'])){
                        $output .= '
                        <tr>
                            <td>'.$row["id_affectation"].'</td>
                            <td>'.$nomcomplet.'</td>
                            <td>'.$libelle.'</td>
                            <td><a class="text-decoration-none text-success fw-bold " href=voircontrat.php?id='.$row["id_affectation"].' >Cliquer ici</a></td>
                            <td><a class="text-decoration-none text-dark fw-bold isDisabled" >Cliquer ici</a></td>
                            <td><a class="text-decoration-none text-danger fw-bold" href=supprimeraffec.php?id='.$row["id_affectation"].' >Supprimer</a></td>
                        </tr>
                        '; 
                    }elseif(!empty($row['rapport']) && empty($row['contrat'])){
                        $output .= '
                        <tr>
                            <td>'.$row["id_affectation"].'</td>
                            <td>'.$nomcomplet.'</td>
                            <td>'.$libelle.'</td>
                            <td><a class="text-decoration-none text-dark fw-bold isDisabled" >Cliquer ici</a></td>
                            <td><a class="text-decoration-none text-success fw-bold " href=voirrapport.php?id='.$row["id_affectation"].' >Cliquer ici</a></td>
                            <td><a class="text-decoration-none text-danger fw-bold" href=supprimeraffec.php?id='.$row["id_affectation"].' >Supprimer</a></td>
                        </tr>
                        '; 
                    }else{
                        $output .= '
                        <tr>
                            <td>'.$row["id_affectation"].'</td>
                            <td>'.$nomcomplet.'</td>
                            <td>'.$libelle.'</td>
                            <td><a class="text-decoration-none text-dark fw-bold isDisabled" >Cliquer ici</a></td>
                            <td><a class="text-decoration-none text-dark fw-bold isDisabled" >Cliquer ici</a></td>
                            <td><a class="text-decoration-none text-danger fw-bold" href=supprimeraffec.php?id='.$row["id_affectation"].' >Supprimer</a></td>
                        </tr>
                        '; 
                    }
                }
                echo $output;
                    }
                    else
                    {
                    echo '<p class="text-center">Aucun résultat trouvé.</p>';
                    }
                ?>
                </div>
            </div>
        </div>        
</body>
    <script src="../../js/bootstrap.bundle.min.js"></script>
</html>